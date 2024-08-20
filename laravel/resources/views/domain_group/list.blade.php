@php
    /**
     * @var \App\Models\DomainGroup[] $groups
     */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users list') }}
        </h2>
    </x-slot>

    <div class="bg-blue-500 bg-red-500 hover:bg-blue-700 hover:bg-red-700 ">
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <a href="{{ route('domain_group.edit_form') }}" class="bg-cyan-400 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">New</a>
                <br><br>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $group->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $group->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('domain_group.edit_form', ['id' => $group->id]) }}" class="bg-cyan-400 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
