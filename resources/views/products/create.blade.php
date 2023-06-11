@extends('layouts.general.main')
@section('title', 'Crear producto')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:p-4 xl:px-0 lg:max-w-screen-lg mx-auto">
        <div class="mb-7">
            @include('layouts.general.tabs')
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-medium mb-6 text-blue-900">Crear producto</h2>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

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
                                value="{{ old('name') }}" placeholder="Funda LG XL">
                        </div>

                        {{-- stock --}}
                        <div>
                            <label for="stock"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                            <input type="number" name="stock" id="stock" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('stock') }}" placeholder="150">
                        </div>

                        {{-- price --}}
                        <div>
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" step="0.01" name="price" id="price" min="0"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                value="{{ old('price') }}" placeholder="20.50">
                        </div>
                    </div>

                    {{-- category --}}
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoría</label>
                        <select name="category" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    >{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- description --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea name="description" id="description"
                            class="bg-gray-50 border max-h-48 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            rows="9" style="min-height: 4rem"></textarea>
                    </div>

                    {{-- imágenes --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="Imágenes"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Imágenes</label>
                        <input multiple type="file" id="images_products" name="images_products[]" class="dropify"
                            data-height="178" data-show-remove="false" data-allowed-file-extensions="jpg jpeg png">
                    </div>

                    {{-- thumbnails --}}
                    <div id="preview_images_container" class="col-span-2 grid grid-cols-5 gap-6"></div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto mt-6 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Crear producto</button>
                </div>
            </form>
        </div>
        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/products/create.js') }}"></script>
@endsection
