@extends('base')

@section('content')

<div class="flex gap-10">
    <div class="w-1/3">
        <h2 class="text-xl font-bold mb-8">1. Construct set</h2>
        <div>
            @include('sets.set-signatures')
        </div>
        <form action="{{ route('sets.store') }}" method="POST">
        
            @csrf
            
            @include('sets.set-meta')
            @include('sets.set-collection')
            
            <div class="mt-10">
                <button type="submit" class="py-1 px-4 bg-black text-white rounded-full">Save Set</button>
            </div>
        </form>

    </div>
</div>

<script>

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>

@endsection