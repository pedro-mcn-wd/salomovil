<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- he tenido que poner los cdns de Tailwindcss y Flowbite porque de lo contrario el despliegue no corre los estilos --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <title>@yield('title')</title>
</head>
<body>
    <div class="container-fluid mx-auto flex flex-col h-screen justify-between">

        @yield('content')

    </div>

    <script src="{{ asset('js/general/main.js') }}"></script>
    @yield('js')
</body>
</html>
