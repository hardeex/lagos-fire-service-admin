@extends('base.base')
@section('title', 'Uploaded Documents')
@section('content')

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Uploaded Documents</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all documents uploaded to the system including their details
                    and status.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <div class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700">Document Type:</label>
                    <select
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="all">All</option>
                        <option value="financial-receipt">Financial Receipt</option>
                        <option value="financial-other">Financial Other Document</option>
                        <option value="visitation">visitation Document</option>
                        <option value="other">Other Documents</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">SN
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Image</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Business</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Doc
                                        Type</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Author</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Source</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Comment</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Admin Note</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @php
                                    $dummyData = [
                                        [
                                            'image_url' => '/api/placeholder/40/40',
                                            'date' => '2024-03-02 16:55:39',
                                            'business' => 'laurie@yahoo.com',
                                            'doc_type' => 'Technical document',
                                            'author' => 'laurie@yahoo.com',
                                            'source' => 'BusinessPortal',
                                            'comment' => 'Corrections on inspections',
                                            'admin_comment' => 'Reviewed',
                                        ],
                                        [
                                            'image_url' => '/api/placeholder/40/40',
                                            'date' => '2024-10-19 07:41:56',
                                            'business' => 'jerreycloud704@gmail.com',
                                            'doc_type' => 'Financial - Other Document',
                                            'author' => 'jerreycloud704@gmail.com',
                                            'source' => 'BusinessPortal',
                                            'comment' => 'fgfg',
                                            'admin_comment' => 'Pending review',
                                        ],
                                        [
                                            'image_url' => '/api/placeholder/40/40',
                                            'date' => '2024-10-20 09:15:23',
                                            'business' => 'smith@example.com',
                                            'doc_type' => 'Technical document',
                                            'author' => 'smith@example.com',
                                            'source' => 'BusinessPortal',
                                            'comment' => 'Updated specifications',
                                            'admin_comment' => '',
                                        ],
                                    ];
                                @endphp

                                @foreach ($dummyData as $index => $document)
                                    <tr class="hover:bg-gray-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-900 sm:pl-6">
                                            {{ $index + 1 }}</td>
                                        <td class="whitespace-nowrap px-3 py-4">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-md object-cover"
                                                    src="{{ $document['image_url'] }}" alt="Document thumbnail">
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $document['date'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <a href="mailto:{{ $document['business'] }}"
                                                class="text-indigo-600 hover:text-indigo-900">{{ $document['business'] }}</a>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <span
                                                class="inline-flex rounded-full bg-blue-100 px-2 text-xs font-semibold leading-5 text-blue-800">
                                                {{ $document['doc_type'] }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $document['author'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $document['source'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $document['comment'] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if ($document['admin_comment'])
                                                <span
                                                    class="inline-flex rounded-full {{ $document['admin_comment'] === 'Reviewed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} px-2 text-xs font-semibold leading-5">
                                                    {{ $document['admin_comment'] }}
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex rounded-full bg-gray-100 text-gray-800 px-2 text-xs font-semibold leading-5">
                                                    No review
                                                </span>
                                            @endif
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
