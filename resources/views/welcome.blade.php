@extends('base')

@section('content')
<div class="absolute top-4 right-4">
    <x-links.default href="{{ route('sets.create') }}" label="Add new set"/>
</div>
<div class="md:flex mb-4">
    <h2 class="text-2xl mb-2 md:w-1/2">
        Sets
    </h2>
</div>

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
                <x-links.default :label="$set->label" href="{{ route('sets.edit', [$set]) }}" class="mb-2 name"/>
            </li>
        @endif
    @endforeach
    </ul>
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