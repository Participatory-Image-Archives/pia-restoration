<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

    <div class="p-4">
        <form action="{{ route('sets.quickStore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-8">
                <h3 class="mb-2 text-xs">Signature(s)</h3>
                <input type="text" name="signatures" class="border border-gray-300 p-1 w-full">
            </div>

            <div class="mb-8">
                <h3 class="mb-2 text-xs">Photo(s)</h3>
                <div id="image_wrapper"></div>
            </div>

            <div class="mb-8">
                <button type="button" class="py-1 px-4 bg-black text-white rounded-full"
                    onclick="add_image()">Add new photo</button>
            </div>
            
            <div class="mb-8 text-right">
                <button type="submit" class="py-1 px-4 bg-green-500 text-white rounded-full">Save</button>
            </div>
        </form>
    </div>
    
    <a href="/" class="fixed bottom-4 left-4">
        <img class="w-10" src="{{ asset('pia-rat.svg') }}" alt="PIA Logo Rat">
    </a>

    <template id="image_template">
        <div class="image mb-4 pb-4 border-b border-gray-200">
            <input type="hidden" name="image_COUNT" value="COUNT">
            <input type="file" name="document_COUNT" class="mb-2" required
                onchange="show_preview(event)">
            <div class="mb-2">
                <img class="preview w-full max-w-xl">
            </div>
            <textarea name="comment_COUNT" class="w-full h-14 p-2 mb-2 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)"></textarea>
            <div class="text-right p-1">
                <button type="button" class="py-1 px-4 bg-red-500 text-white rounded-full text-xs"
        onclick="remove_image(event)">Remove photo</button>
            </div>
        </div>
    </template>

    <script>

        let template = document.querySelector('#image_template'),
            image_wrapper = document.querySelector('#image_wrapper');

        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }

        function show_preview(evt){
            if (evt.target.files.length > 0) {
                var preview = URL.createObjectURL(evt.target.files[0]);
                evt.target.parentNode.querySelector('img.preview').src = preview;
            }
        }

        function add_image() {
            let img = document.createElement('div');
            
            img.innerHTML = template.innerHTML.replace(/COUNT/g, Date.now());
            image_wrapper.appendChild(img);
        }

        function remove_image(evt){
            let target = evt.target.closest('.image');
            target.parentNode.removeChild(target);
        }
    
    </script>

</body>
</html>