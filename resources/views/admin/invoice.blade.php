@extends('base.base')
@section('title', 'Business Invoices/Bills')
@section('content')
    <div class="p-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Business Invoices/Bills</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Invoice Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Invoice To
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Invoice #
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Due Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Amount
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $invoices = [
                                [
                                    'invoice_date' => '2023-12-21 05:08:34',
                                    'invoice_to' => 'james.ayeteminowa@gmail.com',
                                    'invoice_number' => '170313514526',
                                    'due_date' => '2023-12-21 05:08:34',
                                    'total_amount' => -90000,
                                    'status' => 'PAID',
                                ],
                                [
                                    'invoice_date' => '2023-12-26 14:10:15',
                                    'invoice_to' => 'hakeem.sanusi@lagostate.gov.ng',
                                    'invoice_number' => '170359815680',
                                    'due_date' => '2023-12-26 14:10:15',
                                    'total_amount' => -50000,
                                    'status' => 'UNPAID',
                                ],
                                [
                                    'invoice_date' => '2024-02-08 13:27:32',
                                    'invoice_to' => 'olawale.ajibuwa@gmail.com',
                                    'invoice_number' => '170739862690',
                                    'due_date' => '2024-02-08 13:27:32',
                                    'total_amount' => -270000,
                                    'status' => 'PAID',
                                ],
                                [
                                    'invoice_date' => '2024-02-08 19:16:32',
                                    'invoice_to' => 'vitor.fwwave@gmail.com',
                                    'invoice_number' => '170741792568',
                                    'due_date' => '2024-02-08 19:16:32',
                                    'total_amount' => -40000,
                                    'status' => 'PAID',
                                ],
                            ];
                        @endphp

                        @foreach ($invoices as $invoice)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($invoice['invoice_date'])->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $invoice['invoice_to'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $invoice['invoice_number'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($invoice['due_date'])->format('Y-m-d H:i:s') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ number_format($invoice['total_amount']) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $invoice['status'] === 'PAID' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $invoice['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded text-sm transition-colors duration-200">
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
@endsection
