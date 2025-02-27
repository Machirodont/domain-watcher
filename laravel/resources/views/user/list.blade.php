@php
    /**
     * @var \App\Models\User $user
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

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Registration
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @php
                            $buttonColor = is_null($user->activated_at) ? 'blue' : 'red';
                            $buttonText = is_null($user->activated_at) ? 'Activate' : 'Deactivate';
                            $action = is_null($user->activated_at) ? 'activate' : 'deactivate';
                        @endphp

                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="/user/{{ $action }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="submit" value="{{ $buttonText }}"
                                           class="bg-{{ $buttonColor }}-500 hover:bg-{{ $buttonColor }}-700 text-white font-bold py-2 px-4 rounded">
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->created_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
