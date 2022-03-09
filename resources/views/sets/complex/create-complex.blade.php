@extends('base')

@section('content')
<div class="absolute top-4 right-4">
    <x-links.default href="/" label="Home"/>
</div>
<div class="md:flex gap-10">
    <div class="md:w-1/3">
        <h2 class="text-xl font-bold mb-8">1. Edit list of signatures</h2>
        <div>
            @include('sets.set-signatures')
        </div>
        <form action="{{ route('sets.store') }}" method="POST">
        
            @csrf
            
            @include('sets.set-meta')
            
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