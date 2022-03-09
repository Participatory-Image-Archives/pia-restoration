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
<body class="overflow-x-hidden">

    <div class="p-4">
        <h1 class="font-bold text-3xl"><a href="/">PIA Restoration</a></h1>
        <p class="text-xs mb-4 w-full md:w-1/2">Mit diesem Werkzeug lassen sich Notizen, Fotos und andere Dokumente an Signaturen hängen. Ein zukünftigen Werkzeug wird diese Signaturen auslesen und die Dokumente mit den digitalisierten Objekten verknüpfen.</p>

        @yield('content')

    </div>
    
    <a href="/" class="fixed top-2 right-2">
        <img class="w-10" src="{{ asset('pia-rat.svg') }}" alt="PIA Logo Rat">
    </a>

    <!--<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>-->
    <!--<script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>-->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @yield('scripts')

</body>
</html>