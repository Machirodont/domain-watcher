@php
    use App\Models\DomainCheckLog;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    /**
     * @var int $domain_id
     * @var DomainCheckLog[]|LengthAwarePaginator $logs
     */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Domain log') }}
        </h2>
    </x-slot>

    <div class="bg-blue-500 bg-red-500 hover:bg-blue-700 hover:bg-red-700 ">
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                 <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            DateTime
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Code
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Error
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{ $logs->links() }}
                    @foreach($logs as $log)
                        @php
                            $lineColor = $log->code===200
                                ? 'gray'
                                : 'red';
                        @endphp
                        <tr class="odd:bg-white odd:dark:bg-{{$lineColor}}-900 even:bg-{{$lineColor}}-50 even:dark:bg-{{$lineColor}}-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $log->created_at }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $log->status }}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $log->code }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $log->error }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
