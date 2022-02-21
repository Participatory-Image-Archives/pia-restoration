<h3 class="mb-2 text-xs">Add range of signatures</h3>
<div class="flex gap-2">
    <span class="p-1">SGV_</span>
    <input type="text" id="collection" placeholder="10P" class="border border-gray-300 p-1 w-20">
    <span class="p-1">_</span>
    <input type="number" placeholder="1" min="0" max="99999" id="range_start" class="border border-gray-300 p-1 w-20">
    <span class="p-1">bis</span>
    <input type="number" placeholder="10" min="0" max="99999" id="range_end" class="border border-gray-300 p-1 w-20">
    <button id="add_range" class="py-1 px-4 bg-black text-white text-xs rounded-full">Add</button>
</div>

<script>

    document.addEventListener('DOMContentLoaded', () => {
        let add_range = document.querySelector('#add_range'),
            collection = document.querySelector('#collection'),
            range_start = document.querySelector('#range_start'),
            range_end = document.querySelector('#range_end'),
            signatures = document.querySelector('#signatures');

        add_range.addEventListener('click', () => {
            if(collection.value != '' && range_start.value != '' && range_end.value != '') {
                if(signatures.value != '' && signatures.value.substring(signatures.value.length-1) != ',') {
                    signatures.value += ',';
                }
                for(let i = range_start.value; i <= range_end.value; i++) {
                    signatures.value += 'SGV_'+collection.value+'_'+pad(i, 5)+',';
                }
                signatures.value = signatures.value.replace(/,\s*$/, "");
                auto_grow(signatures);
            } else {
                alert('Fill out all necessary fields.');
            }
        })
    })

    function pad(num, size) {
        num = num.toString();
        while (num.length < size) num = "0" + num;
        return num;
    }

</script>