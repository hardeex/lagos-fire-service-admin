@extends('base.base')
@section('title', 'Admin Main Dashboard')
@section('content')
    <div class="container mx-auto my-8 px-4">
        <div class="grid grid-cols-12 gap-8">
            <!-- Form Section - 4 columns -->
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white shadow-md rounded-md p-6">
                    <h2 class="text-xl font-semibold mb-6">Maintain Users</h2>
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="surname" class="block font-medium text-gray-700">Surname</label>
                            <input type="text" id="surname" name="surname"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="Popoola" required>
                        </div>
                        <div>
                            <label for="first_name" class="block font-medium text-gray-700">First Name</label>
                            <input type="text" id="first_name" name="first_name"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="Bashir" required>
                        </div>
                        <div>
                            <label for="middle_name" class="block font-medium text-gray-700">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="">
                        </div>
                        <div>
                            <label for="department" class="block font-medium text-gray-700">Department</label>
                            <select id="department" name="department"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                required>
                                <option value="consult" selected>Consult</option>
                                <option value="lasema">Lagos State Emergency Management Agency</option>
                                <option value="latsma">Lagos Transport Transport Agency Management</option>
                                <option value="lasepa">Lagos Safety and Property Agency</option>
                            </select>
                        </div>
                        <div>
                            <label for="password_type" class="block font-medium text-gray-700">Password Type</label>
                            <select id="password_type" name="password_type"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                required>
                                <option value="Admin" selected>Admin</option>
                                <option value="staff">Staff</option>                                
                            </select>
                        </div>
                        <div>
                            <label for="email" class="block font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="popoola.bashir@fireservley/clearance.org.ng" required>
                        </div>
                        <div>
                            <label for="password" class="block font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="********" required>
                        </div>
                        <div>
                            <label for="confirm_password" class="block font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                                value="********" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md">
                                Save / Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Section - 8 columns -->
            <div class="col-span-12 lg:col-span-8">
                <div class="bg-white shadow-md rounded-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">List of Users on LagosFS LPC Portal</h2>
                        <div class="flex space-x-2">
                            <input type="search" placeholder="Search users..."
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm px-4 py-2">
                            <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-md">
                                Search
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-3 text-left">SN</th>
                                    <th class="px-4 py-3 text-left">Names</th>
                                    <th class="px-4 py-3 text-left">Email</th>
                                    <th class="px-4 py-3 text-left">UserID</th>
                                    <th class="px-4 py-3 text-left">Dept</th>
                                    <th class="px-4 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">1</td>
                                    <td class="px-4 py-3">Popoola Bashir</td>
                                    <td class="px-4 py-3">popoola.bashir@fireservley/clearance.org.ng</td>
                                    <td class="px-4 py-3">FSIC1001</td>
                                    <td class="px-4 py-3">CONSULT</td>
                                    <td class="px-4 py-3 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-3 rounded-md">
                                            delete
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">Daiopo Sodunde Johnson</td>
                                    <td class="border px-4 py-2">fenjan78@gmail.com</td>
                                    <td class="border px-4 py-2">16994177715</td>
                                    <td class="border px-4 py-2">LASEMA--LAGOS STATE EMERGENCY MANAGEMENT AGENCY</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">Tiamyu Mubarack Oladele</td>
                                    <td class="border px-4 py-2">victor.fwave@gmail.com</td>
                                    <td class="border px-4 py-2">16994181434</td>
                                    <td class="border px-4 py-2">LASEMA--LAGOS STATE EMERGENCY MANAGEMENT AGENCY</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">4</td>
                                    <td class="border px-4 py-2">Sanusi Hakeem Kolopo</td>
                                    <td class="border px-4 py-2">hakeem.sanusi@lagosstate.gov.ng</td>
                                    <td class="border px-4 py-2">17077129189</td>
                                    <td class="border px-4 py-2">LASEMA--LAGOS STATE EMERGENCY MANAGEMENT AGENCY</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">5</td>
                                    <td class="border px-4 py-2">Demo Dev Testing</td>
                                    <td class="border px-4 py-2">emmyjenny@gmail.com</td>
                                    <td class="border px-4 py-2">17294386300</td>
                                    <td class="border px-4 py-2">CONSULT</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">6</td>
                                    <td class="border px-4 py-2">Demo Dev Testing</td>
                                    <td class="border px-4 py-2">ahmedappa0010@gmail.com</td>
                                    <td class="border px-4 py-2">17294386929</td>
                                    <td class="border px-4 py-2">CONSULT</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">7</td>
                                    <td class="border px-4 py-2">Adewaie Dev Dev Man</td>
                                    <td class="border px-4 py-2">webmaster4dd@gmail.com</td>
                                    <td class="border px-4 py-2">07294386929</td>
                                    <td class="border px-4 py-2">CONSULT</td>
                                    <td class="border px-4 py-2 text-center">
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-2 rounded-md">delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
