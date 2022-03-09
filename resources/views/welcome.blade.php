@extends('base')

@section('content')
<div class="mb-8">
    <x-links.cta-green href="{{ route('sets.create') }}" label="Neue Notiz anlegen"/>
</div>

<div class="md:flex">
    <div class="w-full md:w-1/3">
        <h2 class="text-2xl mb-4">Bisherige Notizen</h2>
        <ul class="">
        @foreach ($sets_chron as $set)
            @if ($set->label)
                <li class="mb-2">
                    &mdash; <span>
                        <a href="{{ route('sets.edit', [$set]) }}" class="pl-1 font-bold hover:underline">{{ date('d. M Y - H:i', strtotime($set->created_at)) }}</a><br>
                        <span class="ml-6 block text-xs break-all leading-relaxed">{{ $set->signatures }}</span>
                    </span>
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