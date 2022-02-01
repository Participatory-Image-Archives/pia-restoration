<div class="flex gap-2">
    <div class="w-1/2">
        <div class="mb-10">
            <h2 class="text-xs mb-2">Documents</h2>
            <div>
                <ul>
                @foreach ($collection->documents as $document)
                    <li class="mb-2"><x-links.default :label="$document->label" href="/{{ 'storage/' . $document->base_path . '/' . $document->file_name }}"/></li>
                @endforeach
                </ul>
            </div>
            <form class="inline-block" x-data x-ref="documentsupload" method="POST" enctype="multipart/form-data" action="{{ route('collections.uploadDocuments', [$collection]) }}">
                @csrf
                <input x-ref="documents" @change="$refs.documentsupload.submit()" class="hidden" type="file" name="documents[]" required multiple>
                <x-buttons.default @click="$refs.documents.click()" label="Upload documents"/>
            </form>
        </div>
        <div class="mb-10">
            <h2 class="text-xs mb-2">Notes</h2>
            <div>
                <ul>
                @foreach ($collection->docs as $doc)
                    <li class="mb-2"><x-links.default :label="$doc->label" href="{{ env('DOCS_URL') }}/{{ $doc->id }}/edit"/></li>
                @endforeach
                </ul>

                <form action="{{ env('DOCS_URL') }}/create" method="get" class="inline-block">
                    @csrf
                    <input type="hidden" name="collections" value="{{ $collection->id }}">
                    <input type="hidden" name="label" value="{{ $collection->label }}">
                    
                    <x-buttons.default label="New Note" type="submit"/>
                </form>
            </div>
        </div>
        <div class="">
            <h2 class="text-xs mb-2">Maps</h2>
            <div>
                <ul>
                @foreach ($collection->maps as $map)
                    <li class="mb-2"><x-links.default :label="$map->label" href="{{ env('MAPS_URL') }}/{{ $map->id }}"/></li>
                @endforeach
                </ul>

                <form action="{{ env('MAPS_URL') }}/create" method="get" class="inline-block">
                    @csrf
                    <input type="hidden" name="collections" value="{{ $collection->id }}">
                    <input type="hidden" name="label" value="{{ $collection->label }}">
                    
                    <x-buttons.default label="New Map" type="submit"/>
                </form>
            </div>
        </div>
    </div>
    <div class="w-1/2">
        <h2 class="text-xs mb-2">Images</h2>
        <form x-ref="imageupload" method="POST" enctype="multipart/form-data" action="{{ route('collections.uploadImage', [$collection]) }}" x-data>
            @csrf
            <input x-ref="images" @change="$refs.imageupload.submit()" class="hidden" type="file" name="images[]" accept="image/*" required multiple>
            <x-buttons.default @click="$refs.images.click()" label="Upload images"/>
        </form>

        <div class="grid gap-2 grid-flow-row grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 mt-4">
            @foreach ($collection->images as $image)
                <a href="{{ env('PIA_URL') }}images/{{ $image->id }}" class="print-image">
                    <img class="inline-block mr-2 w-full" src="https://pia-iiif.dhlab.unibas.ch/{{$image->base_path != '' ? $image->base_path.'/' : ''}}{{$image->signature}}.jp2/full/360,/0/default.jpg" alt="{{$image->title}}" title="{{$image->title}}">
                </a>
            @endforeach
        </div>
    </div>
</div>