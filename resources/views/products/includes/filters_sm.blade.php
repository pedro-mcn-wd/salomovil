<div class="flex justify-end ml-4">
    <form
        action="{{ Route::currentRouteName() == 'products.index' ? route('products.index') : route('products.trashed') }}"
        method="POST" id="frm_filter" class="flex items-center jus">
        @csrf
        @method('GET')

        <!-- drawer init and toggle -->
        <div class="text-center group">
            <button type="button"
                class="flex items-center p-2 ml-2 text-sm font-medium text-blue-600 group-hover:text-white bg-blue-100 border border-blue-200 hover:bg-blue-600 rounded-lg shadow"
                data-drawer-target="drawer_filters_sm" data-drawer-show="drawer_filters_sm" data-drawer-placement="top"
                aria-controls="drawer_filters_sm">
                <svg class="mr-2 w-5 h-5 text-blue-600 group-hover:stroke-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                <span class="pr-2.5">Filtros</span>
            </button>
        </div>

        <!-- drawer component -->
        <div id="drawer_filters_sm"
            class="rounded-b-xl max-w-screen-xl mx-auto fixed top-0 left-0 right-0 z-40 w-full p-4 transition-transform -translate-y-full bg-white"
            tabindex="-1" aria-labelledby="drawer-top-label">
            <h5 id="drawer-top-label"
                class="w-full inline-flex items-center mb-4 text-xl font-semibold text-blue-600 border-b-2 border-blue-600">
                {{ __('Filtros de búsqueda') }}
            </h5>
            <div class="grid grid-cols-2 gap-4 w-full">

                {{-- name --}}
                <div>
                    <label for="name" class="sr-only">{{ __('Nombre') }}</label>
                    <input type="text" name="name" id="name"
                        class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['name'] }}" placeholder="Nombre">
                </div>

                {{-- description --}}
                <div>
                    <label for="description" class="sr-only">{{ __('Descripción') }}</label>
                    <input type="text" name="description" id="description"
                        class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['description'] }}" placeholder="Descripción">
                </div>

                {{-- category --}}
                <div>
                    <label for="category" class="text-base font-semibold text-gray-500 sr-only">{{ __('Categoría') }}</label>
                    <div class="relative w-full">
                        <select name="category" id="category"
                            class="mt-2 select_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                            <option value="">{{ __('Todas las categorías') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $old_values['values_filters']['category'] == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- subcategory --}}
                <div>
                    <label for="subcategory" class="text-base font-semibold text-gray-500 sr-only">{{ __('Subcategoría') }}</label>
                    <div class="relative w-full">
                        <select name="subcategory" id="subcategory"
                            class="mt-2 select_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                            <option value="" data-cat_id="0">{{ __('Todas las subcategorías') }}</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}" data-cat_id="{{ $subcategory->category_id }}" class="hidden"
                                    {{ $old_values['values_filters']['subcategory'] == $subcategory->id ? 'selected' : '' }}>
                                    {{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- min_stock --}}
                <div>
                    <label for="min_stock" class="text-base font-semibold text-gray-500 sr-only">{{ __('Stock Mínimo') }}</label>
                    <input type="number" name="min_stock" id="min_stock"
                        class="mt-2 input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['min_stock'] }}" min=0 placeholder="Stock Mínimo">
                </div>

                {{-- max_stock --}}
                <div>
                    <label for="max_stock" class="text-base font-semibold text-gray-500 sr-only">{{ __('Stock Máximo') }}</label>
                    <input type="number" name="max_stock" id="max_stock"
                        class="mt-2 input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['max_stock'] }}" min=0 placeholder="Stock Máximo">
                </div>

                {{-- min_price --}}
                <div>
                    <label for="min_price" class="text-base font-semibold text-gray-500 sr-only">{{ __('Precio Mínimo') }}</label>
                    <input type="number" name="min_price" id="min_price"
                        class="mt-2 input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['min_price'] }}" min=0 placeholder="Precio Mínimo">
                </div>

                {{-- max_price --}}
                <div>
                    <label for="max_price" class="text-base font-semibold text-gray-500 sr-only">{{ __('Precio Máximo') }}</label>
                    <input type="number" name="max_price" id="max_price"
                        class="mt-2 input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                        value="{{ $old_values['values_filters']['max_price'] }}" min=0 placeholder="Precio Máximo">
                </div>

                {{-- sort_in_order --}}
                <div>
                    <label for="sort_in_order" class="text-base font-semibold text-gray-500 sr-only">Ordenar en sentido</label>
                    <select name="sort_in_order" id="sort_in_order"
                        class="select_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-2">
                        <option value="">Ordenar...</option>
                        <option value="asc"
                            {{ $old_values['values_filters']['sort_in_order'] == 'asc' ? 'selected' : '' }}
                            >A - Z</option>
                        <option value="desc"
                            {{ $old_values['values_filters']['sort_in_order'] == 'desc' ? 'selected' : '' }}
                            >Z - A</option>
                    </select>
                </div>

                {{-- sort_by_field --}}
                <div>
                    <label for="sort_by_field" class="text-base font-semibold text-gray-500 sr-only">Por</label>
                    <select name="sort_by_field" id="sort_by_field" disabled
                        class="select_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 mt-2">
                        <option value="">Por...</option>
                        @foreach ($sort_fields as $ind => $field)
                            <option value="{{ $ind }}"
                                {{ $old_values['values_filters']['sort_by_field'] == $ind ? 'selected' : '' }}
                            >{{ $field }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- buttons reset and search --}}
                <div class="col-span-2">
                    <div class="flex justify-center">
                        <div class="group">
                            <a id="btn_reset_filters"
                                class="cursor-pointer flex items-center p-2 text-sm font-medium border-2 text-orange-500 border-orange-500 group-hover:text-white bg-white group-hover:bg-orange-500 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                    </path>
                                </svg>
                                <span class="mx-2">Resetear filtros</span>
                            </a>
                        </div>
                        <div class="group">
                            <button type="submit"
                                class="p-2.5 ml-2 flex items-center text-sm font-medium text-blue-600 border-2 border-blue-600 group-hover:text-white bg-white group-hover:bg-blue-600 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                    </path>
                                </svg>
                                <span class="mx-2">Filtrar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <a data-drawer-hide="drawer_filters_sm" aria-controls="drawer_filters_sm"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </a>
        </div>
    </form>
</div>
