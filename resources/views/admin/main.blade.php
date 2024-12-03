@extends('base.base')
@section('title', 'Admin Main Dashboard')
@section('content')
    <div class="bg-gradient-to-br from-blue-50 to-gray-100 min-h-screen p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-lg rounded-xl p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
                <p class="text-gray-600 mb-6">Manage your system settings and monitor activities</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Maintain Section -->
                    <div class="bg-gray-50 rounded-xl p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-center bg-blue-100 rounded-full w-16 h-16 mb-4 mx-auto">
                            <i class="fa fa-cog text-blue-600 text-2xl"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-center mb-4">Maintain</h2>
                        <select
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="route-selector">
                            <option value="">-setup key areas-</option>
                            <option value="user">Users</option>
                            <option value="agencies">Agencies</option>
                            <option value="lga">LGA-LCDA</option>
                            <option value="industries">Industries</option>
                            <option value="rates">Rates</option>
                        </select>
                    </div>

                    <!-- Task Section -->
                    <div class="bg-gray-50 rounded-xl p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-center bg-green-100 rounded-full w-16 h-16 mb-4 mx-auto">
                            <i class="fa fa-tasks text-green-600 text-2xl"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-center mb-4">Tasks</h2>
                        <select
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="task-selector">
                            <option>-common task-</option>
                            <option value="field-form">Field Form</option>
                            <option value="reminders">Reminders</option>
                            <option value="approvals">Approvals</option>
                            <option value="portal">Portal Settings</option>
                            <option value="visitation">Calendar-Visitations</option>
                            <option value="audit">Audit Trail</option>
                        </select>
                    </div>

                    <!-- Report Section -->
                    <div class="bg-gray-50 rounded-xl p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-center bg-purple-100 rounded-full w-16 h-16 mb-4 mx-auto">
                            <i class="fa fa-file-text text-purple-600 text-2xl"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-center mb-4">Reports</h2>
                        <select
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            id="report-selector">
                            <option>-report-</option>
                            <option value="business">Business</option>
                            <option value="calendar">Calendar</option>
                            <option value="invoices">Invoices/Bills</option>
                            <option value="history">Account History</option>
                            <option value="documents">Uploaded Documents</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // For Maintenance Section
        document.getElementById('route-selector').addEventListener('change', function() {
            const value = this.value;
            if (value) {
                let url = '';
                switch (value) {
                    case 'user':
                        url = '{{ route('admin.manage-users') }}';
                        break;
                    case 'agencies':
                        url = '#';
                        break;
                    case 'lga':
                        url = '#';
                        break;
                    case 'industries':
                        url = '{{ route('admin.manage-inudstry') }}';
                        break;
                    case 'rates':
                        url = '#';
                        break;
                }
                if (url) {
                    window.location.href = url;
                }
            }
        });

        // For Tasks Section
        document.getElementById('task-selector').addEventListener('change', function() {
            const value = this.value;
            if (value) {
                let url = '';
                switch (value) {
                    case 'reminders':
                        url = '#';
                        break;
                    case 'approvals':
                        url = '#';
                        break;
                    case 'portal':
                        url = '#';
                        break;
                    case 'visitation':
                        url = '#';
                        break;
                    case 'audit':
                        url = '#';
                        break;
                    case 'field-form':
                        url = '{{route('admin.field-form')}}';
                        break;
                }
                if (url) {
                    window.location.href = url;
                }
            }
        });

        // For Reports Section
        document.getElementById('report-selector').addEventListener('change', function() {
            const value = this.value;
            if (value) {
                let url = '';
                switch (value) {
                    case 'business':
                        url = '{{ route('admin.manage-business') }}';
                        break;
                    case 'calendar':
                        url = '#';
                        break;
                    case 'invoices':
                        url = '{{ route('admin.invoice') }}';
                        break;
                    case 'history':
                        url = '{{ route('admin.account') }}';
                        break;
                    case 'documents':
                        url = '{{ route('admin.upload') }}';
                        break;
                }
                if (url) {
                    window.location.href = url;
                }
            }
        });
    </script>
@endsection
