<div class="image mb-4 p-2 bg-gray-100 relative">
    <input type="hidden" name="image_{{ $datenow ?? 'IMAGEID' }}" value="{{ $datenow ?? 'IMAGEID' }}">
    <input type="hidden" name="id_{{ $datenow ?? 'IMAGEID' }}" value="{{ $img->id ?? '' }}">
    <input type="file" accept="image/*" name="document_{{ $datenow ?? 'IMAGEID' }}" class="mb-2" onchange="show_preview(event)">
    <div class="mb-2">
        @if(isset($img) && $img->file_name)
            <img class="preview w-full max-w-xl" src="/{{ 'storage/' . $img->base_path . '/' . $img->file_name }}" alt="{{ $img->file_name }}">
        @else
            <img class="preview w-full max-w-xl">
        @endif
    </div>
    <textarea name="comment_{{ $datenow ?? 'IMAGEID' }}" class="border border-gray-300 p-1 w-full" oninput="auto_grow(this)" placeholder="Kommentar zu Foto hinzufügen">{{ $img->comment ?? '' }}</textarea>
    <div class="absolute top-2 right-2 text-right">
        <button type="button" class="py-1 px-3 bg-red-500 text-white rounded-full text-xs"
onclick="remove_image(event)">x</button>
    </div>
</div>
