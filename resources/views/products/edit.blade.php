@extends('layouts.general.main')
@section('title', 'Editar producto')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:p-4 xl:px-0 lg:max-w-screen-lg mx-auto">
        <div class="mt-2 mb-5">
            @include('layouts.buttons.btn_back')
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-medium mb-6 text-blue-900">Editar producto</h2>
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-6 mb-10 md:grid-cols-2">
                    <div class="border-b col-span-2">
                        <p class="text-md font-medium text-blue-700">Datos</p>
                    </div>

                    <div class="col-span-2 grid grid-cols-2 md:grid-cols-3 gap-6">
                        {{-- name --}}
                        <div class="col-span-2 md:col-span-1">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $product->name }}" placeholder="Funda LG XL">
                        </div>

                        {{-- stock --}}
                        <div>
                            <label for="stock"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="number" name="stock" id="stock" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $product->stock }}" placeholder="150">
                        </div>

                        {{-- price --}}
                        <div>
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" step="0.01" name="price" id="price" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ $product->price }}" placeholder="20.50">
                        </div>
                    </div>


                    {{-- category --}}
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                        <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($categories as $category)

                                <option value="{{ $category->id }}" @if($product->category_id === $category->id) selected @endif
                                    >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- subcategory --}}
                    <div>
                        <label for="subcategory" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subcategoría</label>
                        <select name="subcategory" id="subcategory"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" data-cat_id="{{ $subcategory->category_id }}" class="hidden"
                                    @if($product->subcategory_id === $subcategory->id) selected @endif
                                    >{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- description --}}
                    <div class="col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea name="description" id="description"
                            class="bg-gray-50 border max-h-48 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            rows="9" style="min-height: 4rem">{{ $product->description }}</textarea>
                    </div>

                    {{-- images --}}
                    <div class="col-span-2">
                        <label for="images_products"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágenes</label>
                        <input multiple type="file" id="images_products" name="images_products[]" class="dropify"
                            data-height="178" data-show-remove="false" data-allowed-file-extensions="jpg jpeg png">
                    </div>

                    {{-- uploaded_images --}}
                    <div id="countImages" class="hidden">{{ count($images) }}</div>
                    @if (count($images)>0)
                    <div class="col-span-2">
                        <div class="mb-2">
                            <h5 class="text-sm font-medium text-gray-900">Imágenes subidas</h5>
                        </div>
                        <div id="uploaded_images_container" class="grid grid-cols-3 md:grid-cols-5 gap-6 border rounded-lg p-4">
                            @foreach ($images as $img)
                                <div class="image-container relative">
                                    <img src="{{ $img->getUrl('gallery') }}" alt="" class=" rounded-lg">
                                    <a href="{{ route('products.deleteImage', ['img_id' => $img->id, 'prod_id' => $product->id]) }}"
                                        class="delete-button absolute top-0 right-0 bg-white p-1" style="border-radius: 0 0 0 0.5em;">
                                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif


                    {{-- thumbnails --}}
                    <div id="container_prev" class="col-span-2 hidden">
                        <div class="mb-2">
                            <h5 class="text-sm font-medium text-gray-900">Imágenes para subir</h5>
                        </div>
                        <div id="preview_images_container" class="col-span-2 grid grid-cols-5 gap-6 border rounded-lg p-4">

                        </div>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto mt-6 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Actualizar producto</button>
                </div>
            </form>
        </div>

        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/products/edit.js') }}"></script>
@endsection
