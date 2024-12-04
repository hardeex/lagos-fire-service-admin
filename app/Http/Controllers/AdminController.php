<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;
use ReflectionFunctionAbstract;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{


    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function adminLoginOne(Request $request)
    {
        Log::info('Incoming login request data', ['request' => $request->except('lpw')]);

        try {
            // Validate incoming request data and prepare the payload
            $validatedData = $request->validate([
                'lemail' => ['required', 'email'],
                'lpw' => ['required', 'string'],
            ]);

            // Send the POST request to the login endpoint
            $response = (new Client())->post(config('api.base_url') . '/admin/login/1', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'lemail' => $validatedData['lemail'],
                    'lpassword' => $validatedData['lpw'],
                ],
            ]);

            // Decode the response and log it
            $responseData = json_decode($response->getBody(), true);
            Log::info('Login response received', ['response' => $responseData]);

            // Store credentials in session for further processing
            Session::put('admin_email', $validatedData['lemail']);
            Session::put('admin_password', $validatedData['lpw']);
            Log::info('Credentials stored in session', [
                'email' => $validatedData['lemail'],
                'session_has_email' => Session::has('admin_email'),
                'session_has_password' => Session::has('admin_password'),
            ]);

            // Handle login response
            if (!isset($responseData['status'])) {
                Log::error('Unexpected response format from login API', ['response' => array_keys($responseData)]);
                return redirect()->back()
                    ->withErrors(['error' => 'Unexpected response from the server.'])
                    ->withInput();
            }

            if ($responseData['status'] === 'success') {
                if (isset($responseData['user'])) {
                    Session::put('user', $responseData['user']);
                }
                Log::info('Session data after login', [
                    'has_user_data' => Session::has('user'),
                    'has_admin_email' => Session::has('admin_email'),
                    'has_admin_password' => Session::has('admin_password'),
                ]);
                return redirect()->route('admin.main')
                    ->with('success', $responseData['message'] ?? 'Login successful!');
            }

            return redirect()->back()->withErrors(['error' => 'Invalid credentials.'])->withInput($request->except('lpw'));
        } catch (RequestException $e) {
            // Handle exceptions
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $responseBody = $e->hasResponse() ? json_decode($e->getResponse()->getBody(), true) : null;
            Log::error('Login request failed', [
                'status_code' => $statusCode,
                'request' => ['lemail' => $request->input('lemail')],
                'response' => $responseBody,
                'email' => $request->input('lemail'),
            ]);

            // Handle specific HTTP status codes
            switch ($statusCode) {
                case 401:
                    return redirect()->back()
                        ->withErrors(['error' => 'Invalid credentials.'])
                        ->withInput($request->except('lpw'));
                default:
                    return redirect()->back()
                        ->withErrors(['error' => 'An error occurred while connecting to the server.'])
                        ->withInput($request->except('lpw'));
            }
        }
    }



    public function otpVerify()
    {
        return view('admin.otp');
    }


    public function adminLoginTwo(Request $request)
    {
        Log::info('Admin login with OTP method called');

        // Validate incoming request data
        $validatedData = $request->validate([
            'lemail' => ['required', 'email'],
            'loginotp' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
        ]);

        // Retrieve the email from the session
        $sessionEmail = session('admin_email');
        $sessionPassword = session('admin_password');

        // Ensure the email and password match the session data
        if ($validatedData['lemail'] !== $sessionEmail || $sessionPassword !== $validatedData['loginotp']) {
            Log::warning('Email or OTP mismatch', [
                'email' => $validatedData['lemail'],
                'session_email' => $sessionEmail,
                'otp' => '[REDACTED]',
            ]);

            return redirect()->back()->withErrors(['error' => 'Invalid email or OTP. Please try again.'])->withInput();
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/admin/login/2';

        try {
            // Log the validated data before sending it to the microservice
            Log::info('Validated data for OTP login:', $validatedData);

            // Prepare the payload
            $payload = [
                'lemail' => $validatedData['lemail'],
                'loginotp' => $validatedData['loginotp'],
            ];

            // Log the payload for debugging
            Log::info('Payload for admin login OTP:', $payload);

            // Send the OTP verification request
            $response = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $payload,
            ]);

            // Parse and log the API response
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response received for OTP verification:', $responseData);

            // Check the response status and handle accordingly
            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->route('auth.dashboard')
                    ->with('success', $responseData['message'] ?? 'OTP verified successfully!');
            }

            // Log failure response and redirect with an error
            Log::warning('OTP verification failed', [
                'message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload,
            ]);

            return redirect()->back()
                ->withErrors(['error' => $responseData['message'] ?? 'OTP verification failed.'])
                ->withInput();
        } catch (RequestException $e) {
            // Log the error details if the request fails
            Log::error('OTP verification request failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to verify OTP. Please try again.'])
                ->withInput();
        }
    }


    public function createAdminUser(Request $request)
    {
        Log::info('Admin user creation method called');

        // Validate the incoming request data
        $validatedData = $request->validate([
            'lsname' => ['required', 'string'],
            'lfname' => ['required', 'string'],
            'lmname' => ['nullable', 'string'],
            'ldept' => ['required', 'string'],
            'lemail' => ['required', 'email'],
            'lpassword' => ['required', 'string'],
            'lpasswordtype' => ['required', 'string'],
            'lstatus' => ['required', 'string'],
        ]);

        // Log the incoming request data for debugging
        Log::info('Validated data for admin user creation:', $validatedData);

        // Check if the admin is authorized (i.e., ensure the session has an admin's email and password)
        $sessionEmail = session('admin_email');
        $sessionPassword = session('admin_password');

        if (!$sessionEmail || !$sessionPassword) {
            Log::warning('Unauthorized access attempt', ['email' => $sessionEmail]);

            return redirect()->route('auth.login-user')
                ->withErrors(['error' => 'Unauthorized access. Please log in again.']);
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/admin/create';

        try {
            // Prepare the payload for the API request
            $payload = [
                'lsname' => $validatedData['lsname'],
                'lfname' => $validatedData['lfname'],
                'lmname' => $validatedData['lmname'] ?? '', // Optional field
                'ldept' => $validatedData['ldept'],
                'lemail' => $validatedData['lemail'],
                'lpassword' => $validatedData['lpassword'],
                'lpasswordtype' => $validatedData['lpasswordtype'],
                'lstatus' => $validatedData['lstatus'],
            ];

            // Log the payload before sending the request
            Log::info('Payload for creating admin user:', $payload);

            // Send the POST request to the admin creation endpoint
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Decode and log the response data
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response for user creation received:', $responseData);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->route('admin.user.list')
                    ->with('success', $responseData['message'] ?? 'User created successfully!');
            }

            // Log the error if user creation fails
            Log::warning('User creation failed', [
                'message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload,
            ]);

            return redirect()->back()
                ->withErrors(['error' => $responseData['message'] ?? 'User creation failed.'])
                ->withInput();
        } catch (RequestException $e) {
            // Log detailed error information
            Log::error('User creation request failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to create user. Please try again.'])
                ->withInput();
        }
    }


    public function setRoles(Request $request)
    {
        Log::info('Admin set roles method called');

        // Validate the incoming request data
        $validatedData = $request->validate([
            'token' => ['required', 'string'],
            'model_table' => ['required', 'string'],
            'roles' => ['required', 'string'],
            'useremail' => ['required', 'email'],
        ]);

        // Log the incoming request data for debugging
        Log::info('Validated data for setting roles:', $validatedData);

        // Retrieve the email and password from the session
        $sessionEmail = session('business_email');
        $sessionPassword = session('business_password');

        // Check if session has the required data
        if (!$sessionEmail || !$sessionPassword) {
            Log::warning('Unauthorized access attempt', ['email' => $sessionEmail]);

            return redirect()->route('auth.login-user')
                ->withErrors(['error' => 'Unauthorized access. Please log in again.']);
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/admin/setroles';

        try {
            // Prepare the payload for the API request, using the session email
            $payload = [
                'email' => $sessionEmail, // Use the email from the session
                'token' => $validatedData['token'],
                'model_table' => $validatedData['model_table'],
                'roles' => $validatedData['roles'],
                'useremail' => $validatedData['useremail'],
            ];

            // Log the payload before sending the request
            Log::info('Payload for setting roles:', $payload);

            // Send the POST request to the admin set roles endpoint
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Decode and log the response data
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response for set roles received:', $responseData);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return redirect()->route('admin.roles.list')
                    ->with('success', $responseData['message'] ?? 'Roles set successfully!');
            }

            // Log the error if setting roles fails
            Log::warning('Setting roles failed', [
                'message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload,
            ]);

            return redirect()->back()
                ->withErrors(['error' => $responseData['message'] ?? 'Failed to set roles.'])
                ->withInput();
        } catch (RequestException $e) {
            // Log detailed error information
            Log::error('Set roles request failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'Failed to set roles. Please try again.'])
                ->withInput();
        }
    }



    public function roleList(Request $request)
    {
        Log::info('Admin role list method called');

        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Retrieve the email and password from the session
        $sessionEmail = session('business_email');
        $sessionPassword = session('business_password');

        // Check if the session contains the necessary data
        if (!$sessionEmail || !$sessionPassword) {
            Log::warning('Unauthorized access attempt', ['email' => $sessionEmail]);

            return redirect()->route('auth.login-user')
                ->withErrors(['error' => 'Unauthorized access. Please log in again.']);
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/admin/role-list';

        try {
            // Prepare the payload with the email and password from the session
            $payload = [
                'email' => $sessionEmail, // Use the email from the session
                'token' => $sessionPassword, // Use the password from the session as token
            ];

            // Log the payload for debugging purposes
            Log::info('Payload for role list API request:', $payload);

            // Make the POST request to the admin role list endpoint
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Decode the response data
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response for role list received:', $responseData);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Roles list loaded successfully!',
                    'data' => $responseData['data'] ?? [],
                ]);
            }

            // Log the error if role list retrieval fails
            Log::warning('Role list retrieval failed:', [
                'message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $responseData['message'] ?? 'Failed to load roles.',
                'data' => [],
            ]);
        } catch (RequestException $e) {
            // Log detailed error information
            Log::error('Role list request failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to load roles. Please try again.',
                'data' => [],
            ]);
        }
    }


    public function loadIndustries(Request $request)
    {
        Log::info('Admin load industries method called');

        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Retrieve the email and password from the session
        $sessionEmail = session('business_email');
        $sessionPassword = session('business_password');

        // Check if the session contains the necessary data
        if (!$sessionEmail || !$sessionPassword) {
            Log::warning('Unauthorized access attempt', ['email' => $sessionEmail]);

            return redirect()->route('auth.login-user')
                ->withErrors(['error' => 'Unauthorized access. Please log in again.']);
        }

        $client = new Client();
        $apiUrl = config('api.base_url') . '/admin/loadindustries';

        try {
            // Prepare the payload with the email and password from the session
            $payload = [
                'email' => $sessionEmail, // Use the email from the session
                'token' => $sessionPassword, // Use the password from the session as token
            ];

            // Log the payload for debugging purposes
            Log::info('Payload for load industries API request:', $payload);

            // Make the POST request to the admin load industries endpoint
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => $payload,
            ]);

            // Decode the response data
            $responseData = json_decode($response->getBody(), true);
            Log::info('API response for load industries received:', $responseData);

            if (isset($responseData['status']) && $responseData['status'] === 'success') {
                return response()->json([
                    'status' => 'success',
                    'message' => $responseData['message'] ?? 'Industries loaded successfully!',
                    'data' => $responseData['data'] ?? [],
                ]);
            }

            // Log the error if industries loading fails
            Log::warning('Industries loading failed:', [
                'message' => $responseData['message'] ?? 'Unknown error.',
                'payload' => $payload,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $responseData['message'] ?? 'Failed to load industries.',
                'data' => [],
            ]);
        } catch (RequestException $e) {
            // Log detailed error information
            Log::error('Load industries request failed', [
                'error' => $e->getMessage(),
                'payload' => $payload,
                'response' => $e->hasResponse() ? (string) $e->getResponse()->getBody() : null,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to load industries. Please try again.',
                'data' => [],
            ]);
        }
    }


    public function main()
    {
        return view('admin.main');
    }

    public function manageUsers()
    {
        return view('admin.manage_user');
    }

    public function manageIndustry()
    {
        return view('admin.manage_industry');
    }

    public function manageBusiness()
    {
        return view('admin.manage_business');
    }

    public function invoice()
    {
        return view('admin.invoice');
    }

    public function accountHistory()
    {
        return view('admin.account_history');
    }

    public function uploadDocument()
    {
        return view('admin.upload_document');
    }


    public function fieldForm()
    {
        return view('admin.field-form');
    }
}
