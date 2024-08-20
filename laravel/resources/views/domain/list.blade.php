@php
    /**
     * @var \App\Models\Domain[] $domains
     */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users list') }}
        </h2>
    </x-slot>

    <div class="bg-blue-500 bg-red-500 hover:bg-blue-700 hover:bg-red-700
    odd:dark:bg-red-900 even:bg-red-50 even:dark:bg-red-800
    odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800
    ">
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <a href="{{ route('domain.edit_form') }}"
                   class="bg-cyan-400 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">New</a>
                <br><br>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Url
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Group
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Last check
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domains as $domain)
                        @php
                            $lineColor = $domain->status===\App\Services\CheckDomains\DomainStatus::ONLINE
                                ? 'gray'
                                : 'red';
                        @endphp
                        <tr class="odd:bg-white odd:dark:bg-{{$lineColor}}-900 even:bg-{{$lineColor}}-50 even:dark:bg-{{$lineColor}}-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $domain->url }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $domain->group?->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $domain->last_check_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $domain->status }}
                                @if($domain->status===\App\Services\CheckDomains\DomainStatus::OFFLINE)
                                    <br>
                                    <small>since {{ $domain->offline_since }}</small>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('domain.edit_form', ['id' => $domain->id]) }}"
                                   class="bg-cyan-400 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('domain_check_log.list', ['domainId' => $domain->id]) }}"
                                   class="bg-cyan-400 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">Logs</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
