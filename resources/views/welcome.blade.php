@extends('base')

@section('content')
<div class="mb-8">
    <x-links.cta-green href="{{ route('sets.create') }}" label="Neue Notiz anlegen"/>
</div>

<div class="md:flex">
    <div id="sets-list" class="w-full md:w-1/3">
        <h2 class="text-2xl mb-2">Bisherige Notizen</h2>
        <input type="text" class="fuzzy-search mb-4 border-b border-gray-600" placeholder="Notizen durchsuchen">
        <ul class="list">
        @foreach ($sets_chron as $set)
            @if ($set->label)
                <li class="mb-2">
                    &mdash; <span>
                        <a href="{{ route('sets.edit', [$set]) }}" class="signatures pl-1 font-bold hover:underline">{{ $set->signatures }}</a><br>
                        <span class="date ml-6 block text-xs break-all leading-relaxed">{{ date('d. M Y - H:i', strtotime($set->created_at)) }}</span>
                    </span>
                </li>
            @endif
        @endforeach
        </ul>
    </div>
</div>

@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            var searchable_list = new List('sets-list', {
                valueNames: ['signatures', 'date']
            });
        });

    </script>
@endsection