@extends('layouts.general.main')
@section('title', 'Ver perfil')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:px-4 xl:px-0 lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto">
        <div class="mt-2 mb-7">
            @include('layouts.buttons.btn_back')
        </div>

        {{-- Product Information --}}
        <div class="static overflow-x-auto rounded-lg shadow-md w-full bg-gray-50">
            <div class="w-full p-4 bg-blue-100 flex flex-col md:flex-row md:items-center md:justify-between">
                {{-- name --}}
                <h5 class="col-span-3 text-2xl font-semibold text-blue-900">{{ $product->name }}</h5>
                <span class="float-right text-sm mt-3 md:mt-0">
                    <a href="{{ route('products.edit', $product->id) }}"
                        class="font-medium text-green-600 hover:text-white bg-white hover:bg-green-600 rounded-lg shadow py-1 px-2 inline-block align-middle">Editar</a>
                    </a>
                </span>
            </div>
            <div class="grid md:grid-cols-3 gap-10 p-6">
                {{-- gallery --}}
                <div class="col-span-2 row-span-2 grid gap-5">
                    <div class="w-full relative">
                        <img id="mainImage" class="w-full rounded-lg"  src="@if(count($images)!==0) {{ $images[0]->getUrl('gallery') }} @else {{ __('#') }} @endif" alt="{{ $product->name }}">
                        <button id="prevBtn" type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button id="nextBtn" type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                    <div id="thumbnailsContainer" class="overflow-x-hidden">
                        <div class="grid grid-cols-5 gap-4">
                            @foreach ($images as $image)
                                <img class="border p-1 thumbnail rounded-lg inline-block cursor-pointer" src="{{ $image->getUrl('gallery') }}" alt="gallery_image">
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- info --}}
                <div class="grid gap-6 col-span-2 md:col-span-1">
                    <div class="flex items-end">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Categoría: </h6>
                        <p class="text-md text-gray-900">{{ $product->category->name }}</p>
                    </div>

                    <div class="flex items-end">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Subcategoría: </h6>
                        <p class="text-md text-gray-900">{{ $product->subcategory->name }}</p>
                    </div>

                    <div>
                        <h6 class="text-lg font-semibold text-blue-800">Descripción</h6>
                        <p class="text-md text-gray-900">{{ $product->description }}</p>
                    </div>

                    <div class="flex items-end">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Precio: </h6>
                        <p class="text-md text-gray-900">{{ $product->price }}{{ __('€') }}</p>
                    </div>

                    <div class="flex items-end">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Stock: </h6>
                        <p class="text-md text-gray-900">{{ $product->stock }}{{ __(' unidades') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection

@section('js')
    <script src="{{ asset('js/products/show.js') }}"></script>
@endsection
