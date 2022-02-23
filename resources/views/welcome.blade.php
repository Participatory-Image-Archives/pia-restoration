@extends('base')

@section('content')
<div class="absolute top-4 right-4">
    <x-links.default href="{{ route('sets.quickCreate') }}" label="Quick Create"/>
    <x-links.default href="{{ route('sets.create') }}" label="Expanded Form"/>
</div>

<div class="md:flex">
    <div class="w-full md:w-1/3">
        <h2 class="text-2xl mb-8">Sorted chronologicaly</h2>
        <ul class="list">
        @foreach ($sets_chron as $set)
            @if ($set->label)
                <li>
                    <x-links.default :label="$set->label" href="{{ route('sets.edit', [$set]) }}" class="mb-2 label"/>
                </li>
            @endif
        @endforeach
        </ul>
    </div>
    <div class="w-full md:w-2/3">
        <h2 class="text-2xl mb-8">Sorted alphabetically</h2>
        @php
        $current = '';
        @endphp
        <div id="searchable-list">
        <input class="search border-b border-black mb-8 focus:outline-none" placeholder="Search…"/>
        <ul class="list">
        @foreach ($sets as $set)
            @if ($set->label)
                @if ($current != $set->label[0])
                    @php
                        $current = $set->label[0];
                    @endphp
                    <h2 class="text-2xl mt-2 mb-2">{{ $current }}</h2>
                @endif
                <li class="inline">
                    <x-links.default :label="$set->label" href="{{ route('sets.edit', [$set]) }}" class="mb-2 label"/>
                </li>
            @endif
        @endforeach
        </ul>
    </div>
</div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.0.2/list.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            var searchable_list = new List('searchable-list', {
                valueNames: ['label']
            });
        });

    </script>
@endsection