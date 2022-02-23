@extends('base')

@section('content')
<div class="absolute top-4 right-4">
    <x-links.default href="/" label="Home"/>
    <form action="{{ route('sets.destroy', [$set]) }}" method="post" class="inline-block">
        @csrf
        @method('delete')

        <x-buttons.delete/>
    </form>
</div>
<div class="flex gap-10">
    <div class="w-1/3">
        <h2 class="text-xl font-bold mb-8">1. Edit list of signatures</h2>
        <div>
            @include('sets.set-signatures')
        </div>
        <form action="{{ route('sets.update', [$set]) }}" method="POST">
        
            @csrf
            @method('patch')
            
            @include('sets.set-meta')
            
            <div class="mt-10">
                <button type="submit" class="py-1 px-4 bg-black text-white rounded-full">Save Set</button>
            </div>
        </form>

    </div>

    <div class="w-2/3 border-l border-gray-300 pl-8">
        <h2 class="text-xl font-bold mb-8">3. Add documents</h2>
        <div class="mb-10">
            <h2 class="text-xs mb-2">Documents</h2>
            <div>
                <ul class="grid grid-cols-3 gap-2">
                @foreach ($set->documents as $document)
                    <li class="mb-2">
                        @if(preg_match('(\.jpg|\.jpeg|\.png)', $document->file_name) === 1)
                            <a href="/{{ 'storage/' . $document->base_path . '/' . $document->file_name }}">
                                <img src="/{{ 'storage/' . $document->base_path . '/' . $document->file_name }}" alt="{{ $document->file_name }}">
                            </a>
                        @else
                            <x-links.default :label="$document->label" href="/{{ 'storage/' . $document->base_path . '/' . $document->file_name }}"/>
                        @endif
                            <p class="text-xs p-1 pl-3">{{ $document->comment }}</p>
                    </li>
                @endforeach
                </ul>
            </div>
            <hr class="my-8">
            <form class="inline-block" x-data x-ref="documentsupload" method="POST" enctype="multipart/form-data" action="{{ route('sets.uploadDocuments', [$set]) }}">
                @csrf
                <input type="file" name="documents[]" class="mb-2" required multiple>
                <textarea name="comment" id="comment" class="border border-gray-300 p-1 w-full mb-2" placeholder="Comment"></textarea>
                <x-buttons.default type="submit" label="Upload documents"/>
            </form>
        </div>
    </div>
</div>

<script>

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }

</script>

@endsection