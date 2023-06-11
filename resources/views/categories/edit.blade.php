@extends('layouts.general.main')
@section('title', 'Editar categoría')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:p-4 xl:px-0 lg:max-w-screen-lg mx-auto mb-9 -mt-5 md:-mt-0">
        <div class="mt-2 mb-5">
            @include('layouts.buttons.btn_back')
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-medium mb-6 text-blue-900">{{ __('Editar categoría') }}</h2>
            <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-6 mb-10 md:grid-cols-2">
                    <div class="border-b col-span-2">
                        <p class="text-md font-medium text-blue-700">{{ __('Datos') }}</p>
                    </div>

                    {{-- name --}}
                    <div  class="col-span-2 md:col-span-1">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $category->name }}" placeholder="{{ $category->name }}">
                    </div>

                    {{-- code --}}
                    <div  class="col-span-2 md:col-span-1">
                        <label for="code"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Código') }}</label>
                        <input type="text" name="code" id="code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $category->code }}" placeholder="{{ $category->code }}">
                    </div>

                    {{-- description --}}
                    <div class="col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Descripción') }}</label>
                        <input type="text" name="description" id="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $category->description }}" placeholder="{{ $category->description }}">
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto mt-6 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ __('Guardar cambios') }}
                    </button>
                </div>

            </form>
        </div>

        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection
