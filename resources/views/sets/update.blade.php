@extends('base')

@section('content')

<div class="flex gap-10">
    <div class="w-1/3">
        <h2 class="text-xl font-bold mb-8">1. Construct set</h2>
        <div>
            @include('sets.set-signatures')
        </div>
        <form action="{{ route('sets.update', [$set]) }}" method="POST">
        
            @csrf
            @method('patch')
            
            @include('sets.set-meta')
            @include('sets.set-collection')
            
            <div class="mt-10">
                <button type="submit" class="py-1 px-4 bg-black text-white rounded-full">Save Set</button>
            </div>
        </form>

    </div>

    <div class="w-2/3">
        <h2 class="text-xl font-bold mb-8">3. Restoration Notes and Documents</h2>
        @include('collections.view')

        <hr class="my-8">
        <x-links.bare href="{{ env('PIA_URL') }}collections/{{ $collection->id }}" label="View collection on PIA"/>
    </div>
</div>

<script>

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>

@endsection