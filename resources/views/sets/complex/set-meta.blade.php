<div class="mt-10">
    <div class="flex mb-2 items-center gap-2 text-xs">
        <h3>Signatures</h3>
        <a href="javascript:;" id="toggle-view" class="bg-black text-white p-1 rounded-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
        </a>
        <a href="javascript:;" id="sort-signatures" class="bg-black text-white p-1 rounded-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
        </a>
    </div>
    <textarea name="signatures" id="signatures" class="w-full h-14 p-4 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)">{{ $set->signatures ?? '' }}</textarea>
</div>

<h2 class="text-xl font-bold mb-8 mt-20">2. Add set information</h2>

<div class="mt-10">
    <h3 class="mb-2 text-xs">Label for set</h3>
    <input type="text" name="label" class="border border-gray-300 p-1 w-full" value="{{ $set->label ?? '' }}">
</div>
<div class="mt-10">
    <h3 class="mb-2 text-xs">Description of set</h3>
    <textarea name="description" id="description" class="w-full h-14 p-4 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)">{{ $set->description ?? '' }}</textarea>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        auto_grow(document.querySelector('#signatures'));

        let signatures = document.querySelector('#signatures');

        document.querySelector('#toggle-view').addEventListener('click', () => {
            if(signatures.value.includes(',')) {
                signatures.value = signatures.value.split(',').join('\n');
            } else {
                signatures.value = signatures.value.split('\n').join(',');
            }
            auto_grow(signatures);
        });
        document.querySelector('#sort-signatures').addEventListener('click', () => {
            let signatures_array = [];

            if(signatures.value.includes(',')) {
                signatures_array = signatures.value.split(',');
                signatures_array.sort();
                signatures.value = signatures_array.join(',');
            } else {
                signatures_array = signatures.value.split('\n');
                signatures_array.sort();
                signatures.value = signatures_array.join('\n');
            }
        });
    })
</script>