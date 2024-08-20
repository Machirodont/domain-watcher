@php
    /**
     * @var \App\Models\Domain $domain
      * @var \App\Models\DomainGroup[] $groups
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
                    $buttonText = is_null($domain->id) ? 'Create' : 'Save';
                @endphp
                <form action="{{ route('domain.edit') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $domain->id }}">
                    Name: <input type="text" name="url" value="{{ $domain->url }}"><br>
                    Group:
                    <select name="group_id">
                        @foreach($groups as $group)
                            <option
                                value="{{$group->id}}" {{$group->id === $domain->group_id ? 'selected' : ''}} >{{$group->name}}</option>
                        @endforeach

                    </select><br>
                    <input type="submit" value="{{ $buttonText }}"
                           class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-4 rounded">
                </form>
                <br><br>
                <form action="{{ route('domain.reset') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $domain->id }}">
                    <input type="submit" value="Reset"
                           class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                </form>
                <form action="{{ route('domain.delete') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $domain->id }}">
                    <input type="submit" value="Delete"
                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
