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

    <div class="p-4" x-data="{ image_count: 0 }">
        <form action="{{ route('sets.quickStore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-8">
                <h3 class="mb-2 text-xs">Signature(s)</h3>
                <input type="text" name="signatures" class="border border-gray-300 p-1 w-full">
            </div>

            <div class="mb-8">
                <h3 class="mb-2 text-xs">Photo(s)</h3>
                <template x-for="i in image_count">
                    <div class="image mb-4 pb-4 border-b border-gray-200" x-data>
                        <input type="hidden" x-bind:name="`image_${i}`" x-bind:value="`${i}`">
                        <input type="file" x-bind:name="`document_${i}`" class="mb-2" required
                            onchange="show_preview(event)">
                        <div class="mb-2">
                            <img class="preview w-full max-w-xl">
                        </div>
                        <textarea x-bind:name="`comment_${i}`" class="w-full h-14 p-2 mb-2 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)"></textarea>
                        <div class="text-right p-1">
                            <button type="button" class="py-1 px-4 bg-red-500 text-white rounded-full text-xs"
                    @click="$root.parentNode.removeChild($root)">Remove photo</button>
                        </div>
                    </div>
                </template>
            </div>

            <div class="mb-8">
                <button type="button" class="py-1 px-4 bg-black text-white rounded-full"
                    @click="image_count++">Add new photo</button>
            </div>
            
            <div class="mb-8 text-right">
                <button type="submit" class="py-1 px-4 bg-green-500 text-white rounded-full">Save</button>
            </div>
        </form>
    </div>
    
    <a href="/" class="fixed bottom-4 right-4">
        <img class="w-10" src="{{ asset('pia-rat.svg') }}" alt="PIA Logo Rat">
    </a>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>

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

        /*
            camera.addEventListener('change', function (e) {
            var file = e.target.files[0];
            console.log('file=' + URL.createObjectURL(file));
            // Do something with the image file.
            frame.src = URL.createObjectURL(file);
            addImageToView(file)
            });

            function addImageToView(file) {
            var photo_wrapper = $('<div class="col-6 col-sm-4 mb-3"><div/>'),
                photo = $('<div class="rounded"><div/>');
            photo.css({
                'background-image': "url('" + URL.createObjectURL(file) + "')"
            });
            photo.addClass('cameraRoll');
            cameraRoll.prepend(photo_wrapper.append(photo));
            }
        */
    
    </script>

</body>
</html>