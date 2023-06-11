@extends('layouts.general.main')
@section('title', 'Ver producto')

@section('content')
    <div class="flex-grow h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto px-2 md:px-4 xl:px-0">
        <div>
            @include('layouts.general.sidebar', ['categories' => $categories])
        </div>

        {{-- Product Information --}}
        <div class="static overflow-x-auto rounded-lg shadow-md w-full bg-white">
            <div class="w-full p-4 bg-blue-100">
                {{-- name --}}
                <h5 class="text-2xl font-semibold text-blue-900">{{ $product->name }}</h5>
            </div>
            <div class="grid grid-cols-4 lg:grid-cols-3 gap-10 p-6">
                {{-- gallery --}}
                <div class="col-span-4 md:col-span-2 lg:row-span-2 grid gap-5">
                    <div class="w-full relative">
                        <img id="mainImage" class="w-full rounded-lg"
                                src="@if(count($images)!==0) {{ $images[0]->getUrl('gallery') }} @else {{ __('#') }} @endif" alt="{{ $product->name }}">
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
                                <img class="border p-1 thumbnail rounded-lg inline-block cursor-pointer" src="{{ $image->getUrl('gallery') }}" alt="thumbnail">
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- info --}}
                <div class="col-span-4 md:col-span-2 lg:col-span-1 grid gap-6">
                    <div class="flex items-baseline">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Categoría: </h6>
                        <p class="text-md text-gray-900">{{ $product->category->name }}</p>
                    </div>

                    <div class="flex items-baseline">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Subcategoría: </h6>
                        <p class="text-md text-gray-900">{{ $product->subcategory->name }}</p>
                    </div>

                    <div>
                        <h6 class="text-lg font-semibold text-blue-800">Descripción:</h6>
                        <p class="text-md text-gray-900">{{ $product->description }}</p>
                    </div>

                    <div class="flex items-baseline">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Precio: </h6>
                        <p class="text-md text-gray-900">{{ $product->price }}{{ __('€') }}</p>
                    </div>

                    <div class="flex items-baseline">
                        <h6 class="text-lg font-semibold text-blue-800 mr-2">Stock: </h6>
                        <p class="text-md text-gray-900">
                            @if ($product->stock > 0)
                                {{ $product->stock }}{{ __(' uds.') }}
                            @else
                                <span class="text-red-600 font-semibold">{{ __('Sin stock') }}</span>
                            @endif

                        </p>
                    </div>

                    <form action="{{ route('cart.add') }}" class="contents" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="origin[origin]" value="{{ $origin['origin'] }}">
                        @if (array_key_exists('is', $origin))
                            <input type="hidden" name="origin[is]" value="{{ $origin['is'] }}">
                            <input type="hidden" name="origin[id]" value="{{ $origin['id'] }}">
                        @endif

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center">
                            <h6 class="text-lg font-semibold text-blue-800 mr-2">Cantidad: </h6>
                            <input type="number" id="quantity" name="quantity" class="bg-gray-50 border max-w-[40%] border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5" placeholder="1" value="1" min=1 max={{ $product->stock }}>
                        </div>

                        <div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path></svg>
                                Añadir
                            </button>
                        </div>
                    </form>
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
