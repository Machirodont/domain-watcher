@php
    /**
     * @var \App\Models\DomainGroup $group
     */
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit domain group') }}
        </h2>
    </x-slot>

    <div class="bg-blue-500 bg-red-500 hover:bg-blue-700 hover:bg-red-700 ">
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                @php
                    $buttonText = is_null($group->id) ? 'Create' : 'Save';
                    $domainsCount = $group->domains()->count();
                @endphp
                <form action="{{ route('domain_group.edit') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $group->id }}">
                    <input type="text" name="name" value="{{ $group->name }}"><br>
                    Domains: {{ $domainsCount }} <br>
                    <input type="submit" value="{{ $buttonText }}"
                           class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                </form>
                <br><br>
                @if( $domainsCount === 0 )
                    <form action="{{ route('domain_group.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $group->id }}">
                        <input type="submit" value="Delete"
                               class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
