@extends('base.base')
@section('title', 'Admin Login')
@section('content')

    <body class="bg-gradient-to-br from-blue-50 to-green-50 min-h-screen">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="max-w-md w-full">
                <!-- Logo and Header -->
                <div class="text-center mb-8">
                    <img src="/images/lagos-logo.png" alt="LagosFSLC Logo" class="h-20 mx-auto mb-4">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                    <p class="text-gray-600">Administrative Portal Access</p>
                </div>

                <!-- Login Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                        @csrf

                        <!-- Email Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="email">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="admin@lagosfslc.gov.ng">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="password">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="••••••••">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword()">
                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                Forgot password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>

                        <!-- Error Alert -->
                        @if (session('error'))
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 mt-4 rounded">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-500"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <!-- Footer -->
                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-600">
                        Protected by LagosFSLC Security
                        <i class="fas fa-shield-alt ml-1 text-blue-600"></i>
                    </p>
                </div>
            </div>
        </div>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const icon = document.querySelector('.fa-eye');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>
    </body>




@endsection
