<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    @yield('styles')

</head>
<body>

    <div class="p-8 mt-8">
        <h1 class="font-bold text-3xl"><a href="/">PIA Restoration Sets</a></h1>
        <p class="text-xs mb-20 w-full md:w-1/2">A set is a number of SGV signatures that are attached to a collection. The set describes which objects belong to the collection. The collection then holds all the files, notes as well as documentation photos regarding the restoration process.</p>

        @yield('content')

    </div>
    
    <a href="/" class="fixed bottom-4 left-4">
        <img class="w-10" src="{{ asset('pia-rat.svg') }}" alt="PIA Logo Rat">
    </a>

    <!--<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>-->
    <!--<script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>-->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('scripts')

</body>
</html>