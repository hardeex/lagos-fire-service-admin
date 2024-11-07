@extends('base.base')
@section('title', 'List of Businesses')
@section('content')
    <div class="p-4 sm:p-6">
        <!-- Main Content Grid -->
        <div class="flex gap-6">
            <!-- Business Info Card -->
            <div class="w-80">
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Business Important Standings</h3>
                    <div class="space-y-3">
                        <div>
                            <h4 class="text-sm text-gray-600">Business Name:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">Email and Phone Verifications:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">HQ and Branch Declarations:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">Unpaid Invoice(s):</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">Total Business Documents:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">Date of Next Inspection:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div>
                            <h4 class="text-sm text-gray-600">Date of Last Inspection:</h4>
                            <div class="text-sm">---</div>
                        </div>
                        <div class="pt-3 space-y-2">
                            <button
                                class="w-full bg-white text-blue-600 border border-blue-600 px-3 py-1.5 rounded text-sm hover:bg-blue-50">
                                View Registration Form
                            </button>
                            <button
                                class="w-full bg-white text-blue-600 border border-blue-600 px-3 py-1.5 rounded text-sm hover:bg-blue-50">
                                View Messages/Notes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Table -->
            <div class="flex-1">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SN</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Business Name</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Outstanding</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $businesses = [
                                        [
                                            'name' => 'Dandave School',
                                            'email' => 'dandaveschool@gmail.com',
                                            'phone' => '+2348034083081',
                                            'outstanding' => 0,
                                        ],
                                        [
                                            'name' => 'DEMO Academy',
                                            'email' => 'james.akademirowa@gmail.com',
                                            'phone' => '+2348017532811',
                                            'outstanding' => 0,
                                        ],
                                        [
                                            'name' => 'Resourcepath Enterprise',
                                            'email' => 'hakeem.sanusi@lagostate.gov.ng',
                                            'phone' => '+234 8084351824',
                                            'outstanding' => -50000,
                                        ],
                                        [
                                            'name' => 'T & T Nigeria Ltd',
                                            'email' => 'sanusihakeem15@gmail.com',
                                            'phone' => '08084351824',
                                            'outstanding' => 0,
                                        ],
                                        [
                                            'name' => '123456',
                                            'email' => 'olawale.ajibuwa@gmail.com',
                                            'phone' => '+2348069461666',
                                            'outstanding' => 0,
                                        ],
                                    ];
                                @endphp

                                @foreach ($businesses as $index => $business)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $business['name'] }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $business['email'] }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">{{ $business['phone'] }}</div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div
                                                class="text-sm {{ $business['outstanding'] < 0 ? 'text-red-600' : 'text-gray-500' }}">
                                                {{ $business['outstanding'] }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded text-sm">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
