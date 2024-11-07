@extends('base.base')
@section('title', 'Maintain Key Unit Areas')
@section('content')
    <div class="container mx-auto my-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Maintain Key Unit Areas</h1>

        <div class="grid grid-cols-12 gap-8">
            <!-- Left Side - Configuration Forms -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Local Government Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Local Government / LCDA</h2>
                    <div class="space-y-4">
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">--select LGA-LCDA--</option>
                        </select>
                        <input type="text" placeholder="Type a local government"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex-1">Save</button>
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex-1">Delete</button>
                        </div>
                    </div>
                </div>

                <!-- Agencies Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Agencies</h2>
                    <div class="space-y-4">
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">--select Agency--</option>
                        </select>
                        <input type="text" placeholder="Agency Label"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <input type="text" placeholder="Agency Full Names"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex-1">Save</button>
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex-1">Delete</button>
                        </div>
                    </div>
                </div>

                <!-- Industries Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Industries</h2>
                    <div class="space-y-4">
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">--select Industry--</option>
                        </select>
                        <input type="text" placeholder="Industry Name here"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <div class="flex space-x-2">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex-1">Save</button>
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex-1">Delete</button>
                        </div>
                    </div>
                </div>

                <!-- Building Type Section -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">Building Type</h2>
                    <div class="space-y-4">
                        <select
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">--select Sector--</option>
                        </select>
                        <input type="text" placeholder="Business Location/branches type"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                            Update Building Type
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side - Annual Rates Table -->
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div
                        class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
                        <h2 class="text-xl font-semibold">Annual Rates</h2>
                        <div class="flex flex-wrap gap-4 items-center">
                            <select class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option>2017</option>
                            </select>
                            <input type="text" placeholder="Enter levy"
                                class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Update
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SN</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Industry</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sector</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Building</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Year</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rates</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">1</td>
                                    <td class="px-6 py-4">PRIVATE EDUCATIONAL FACILITIES</td>
                                    <td class="px-6 py-4">SECONDARY</td>
                                    <td class="px-6 py-4">HEAD OFFICE</td>
                                    <td class="px-6 py-4">2023</td>
                                    <td class="px-6 py-4">10,000</td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
