<div class="mb-4">
    <h3 class="mb-2 font-bold">Signaturen *</h3>
    <input type="text" name="signatures" class="border border-gray-300 p-2 w-full" value="{{ $aggregation->signatures ?? '' }}" required>
</div>
<div class="mb-4">
    <h3 class="mb-2 font-bold">Erfasst durch *</h3>
    <input type="text" name="origin" class="border border-gray-300 p-2 w-full" value="{{ $aggregation->origin ?? '' }}" required>
</div>

<div class="mb-8">
    <h3 class="mb-2 text-xs">Allgmeiner Kommentar (optional)</h3>
    <textarea type="text" name="description" class="border border-gray-300 p-2 w-full" oninput="auto_grow(this)">{{ $aggregation->description ?? '' }}</textarea>
</div>
