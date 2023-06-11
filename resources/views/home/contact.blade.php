@extends('layouts.general.main')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('content')

    <div class="flex-grow mb-10 w-full h-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto">
        <div class="w-full md:rounded-lg shadow-lg p-10 text-center bg-white">
            <h1 class="text-3xl font-semibold text-blue-700 mb-8">Contáctanos</h1>
            <div class="grid gap-6 mb-4">
                <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-center">
                    <svg class="w-8 mr-2 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                    </svg>
                    <a href="#" class="hover:text-blue-600">{{ __('salomovil@gmail.es') }}</a>
                </h3>
            </div>

            <div class="grid gap-6 mb-4">
                <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-center">
                      <svg class="mr-2" fill="#2563eb" xmlns="http://www.w3.org/2000/svg" height="1.4em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    <a href="#" class="hover:text-blue-600">{{ __('667 34 84 44') }}</a>
                </h3>
            </div>

            <div class="grid gap-6 mb-4">
                <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-center">
                    <svg class="w-8 mr-2 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"></path>
                      </svg>
                    <a href="#" class="hover:text-blue-600">{{ __('955 67 88 99') }}</a>
                </h3>
            </div>

            <div class="grid gap-6 mb-4">
                <h3 class="text-xl font-semibold text-gray-700 flex items-center justify-center">
                    <svg class="mr-2" fill="#2563eb"  xmlns="http://www.w3.org/2000/svg" height="1.4em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg>
                    <a href="#" class="hover:text-blue-600">{{ __('Facebook') }}</a>
                </h3>
            </div>

            <div class="flex flex-col items-center mt-20">
                <h3 class="text-xl font-semibold text-blue-700 mb-10">¡Tienda física próximamente!</h3>
                <iframe class="w-[100%] shadow-lg" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3172.954259753085!2d-5.941508923627579!3d37.31991113823072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd126fde66f395a1%3A0x2797e95e1c6c6acd!2sAv.%20Manuel%20Clavero%20Ar%C3%A9valo%2C%209%2C%2041704%20Dos%20Hermanas%2C%20Sevilla!5e0!3m2!1ses!2ses!4v1686240410428!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

@endsection
