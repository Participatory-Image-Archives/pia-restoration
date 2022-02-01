<h2 class="text-xl font-bold mb-8 mt-20">3. Create new collection or add to existing</h2>

<div class="mt-10">
    <h3 class="mb-2">Label for new collection</h3>
    <input type="text" name="collection_label" class="border-b border-gray-300 p-1 w-full">
</div>
<div class="mt-10">
    <h3 class="mb-2">Add to existing collection</h3>
    <select name="collection_id" class="w-full p-1 border border-gray-100 shadow-2xl">
        <option value="">?</option>
        @foreach ($collections as $collection)
            @if ($collection->origin == 'restoration')
                <option value="{{ $collection->id }}" {{ ($collection->id ?? 0) == ($set->collection_id ?? 1) ? 'selected' : '' }}>{{ $collection->label }}</option>
            @endif
        @endforeach
    </select>
</div>