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
                <h3 class="mb-2 text-xs">Comment</h3>
                <textarea name="description" id="description" class="w-full h-14 p-4 border border-gray-100 bg-white shadow-xl overflow-hidden" oninput="auto_grow(this)"></textarea>
            </div>

            <div class="mb-8">
                <h3 class="mb-2 text-xs">Photos or other files</h3>
                <input type="file" name="documents[]" class="mb-2" required multiple>
            </div>
            
            <div class="mb-8">
                <button type="submit" class="py-1 px-4 bg-black text-white rounded-full">Save</button>
            </div>
        </form>
    </div>
    
    <a href="/" class="fixed bottom-4 right-4">
        <img class="w-10" src="{{ asset('pia-rat.svg') }}" alt="PIA Logo Rat">
    </a>

    <script>

        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
    
    </script>

</body>
</html>