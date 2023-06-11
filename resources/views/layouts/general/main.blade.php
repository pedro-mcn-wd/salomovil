<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('dist/css/dropify.min.css') }}">
    <style>
        body{
            background: rgb(37,99,235);
            background: linear-gradient(347deg, rgba(37,99,235,1) 0%, rgba(40,101,235,1) 0%, rgba(124,162,243,1) 9%, rgba(190,209,249,1) 20%, rgba(217,228,252,1) 25%, rgba(245,248,254,1) 37%, rgba(255,255,255,1) 46%);
        }
    </style>

    @yield('css')
</head>
{{-- min-h-screen --}}
<body>
    <div class="container-fluid relative mx-auto flex flex-col justify-between mt-20 md:mt-[4.7em]" style="min-height: calc(100vh - 10em)">
        <div>
            @include('layouts.general.navbar')
        </div>

        {{-- CONTENIDO --}}
        @yield('content')


    </div>

    @include('layouts.general.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


    <script src="{{ asset('dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('js/general/main.js') }}"></script>

    @yield('js')
</body>

</html>
