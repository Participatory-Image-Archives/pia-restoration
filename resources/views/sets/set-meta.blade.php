<div class="mt-10">
    <h3 class="mb-2">Comma-separated signatures</h3>
    <textarea name="signatures" id="signatures" class="w-full h-14 p-4 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)">{{ $set->signatures ?? '' }}</textarea>
</div>

<h2 class="text-xl font-bold mb-8 mt-20">2. Add set information</h2>

<div class="mt-10">
    <h3 class="mb-2">Label for set</h3>
    <input type="text" name="label" class="border-b border-gray-300 p-1 w-full" value="{{ $set->label ?? '' }}">
</div>
<div class="mt-10">
    <h3 class="mb-2">Description of set</h3>
    <textarea name="description" id="description" class="w-full h-14 p-4 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)">{{ $set->description ?? '' }}</textarea>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        auto_grow(document.querySelector('#signatures'));
    })
</script>