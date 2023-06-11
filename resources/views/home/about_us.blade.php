@extends('layouts.general.main')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('content')

    <div class="flex-grow mb-10 h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto">
        <div class="w-full rounded-lg shadow-lg mt-10 p-10 text-center bg-white">
            <h1 class="text-3xl font-semibold text-blue-700 mb-5">Sobre nosotros</h1>
            <h3 class="text-lg text-gray-800">
                {{ __('Somos una empresa dedicada principalmente al comercio de productos y servicios de telefonía desde hace 10 años.
                Nos caracteriza nuestro compromiso con el cliente y una atención personalizada para ayudarte a encontrar justo lo que necesitas. Nuestro productos son siempre de primera calidad y
                nuestro servicio cercano y ameno.') }}
            </h3>

            <figure class="max-w-screen-md mx-auto text-center mt-20">
                <svg aria-hidden="true" class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                        fill="currentColor" />
                </svg>
                <blockquote>
                    <p class="text-xl italic font-medium text-gray-900 dark:text-white">"Los clientes no esperan que seas perfecto. Esperan que les aporten soluciones cuando tienen algún problema"</p>
                </blockquote>
                <div class="flex items-center justify-center divide-x-2 divide-gray-500 dark:divide-gray-700 mt-2">
                    <cite class="pr-3 font-medium text-gray-900 dark:text-white">Donald Porter</cite>
                    <cite class="pl-3 text-sm text-gray-500 dark:text-gray-400 flex flex-col md:flex-row">
                        <span>Profesor de la Universidad de</span>
                        <span>&nbsp;Carolina del Norte</span>
                    </cite>
                </div>
            </figure>

            <figure class="max-w-screen-md mx-auto text-center mt-10">
                <svg aria-hidden="true" class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                        fill="currentColor" />
                </svg>
                <blockquote>
                    <p class="text-xl italic font-medium text-gray-900 dark:text-white">"Tu cliente más insatisfecho es tu mejor fuente de aprendizaje"</p>
                </blockquote>
                <div class="flex items-center justify-center divide-x-2 divide-gray-500 dark:divide-gray-700 mt-2">
                    <cite class="pr-3 font-medium text-gray-900 dark:text-white">Bill Gates</cite>
                    <cite class="pl-3 text-sm text-gray-500 dark:text-gray-400">Fundador de Microsoft</cite>
                </div>
            </figure>

            <figure class="max-w-screen-md mx-auto text-center mt-10">
                <svg aria-hidden="true" class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z"
                        fill="currentColor" />
                </svg>
                <blockquote>
                    <p class="text-xl italic font-medium text-gray-900 dark:text-white">"La percepción del cliente es tu realidad"</p>
                </blockquote>
                <div class="flex items-center justify-center divide-x-2 divide-gray-500 dark:divide-gray-700 mt-2">
                    <cite class="pr-3 font-medium text-gray-900 dark:text-white">Kate Zabriskie</cite>
                    <cite class="pl-3 text-sm text-gray-500 dark:text-gray-400">Presidente de Training Works, Inc.</cite>
                </div>
            </figure>

        </div>

    </div>

@endsection
