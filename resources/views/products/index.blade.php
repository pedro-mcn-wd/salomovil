@extends('layouts.general.main')
@section('title', 'Listado de productos')

@section('content')
    <div class="flex-grow h-full w-full px-2 mdpx-4 xl:px-0 xl:max-w-screen-xl xl:-min-w-screen-xl mx-auto">
        @include('layouts.general.tabs')
        @include('layouts.modals.delete')

        <div class="flex items-center mt-5 lg:-mb-5">
            {{-- download list pdf --}}
            <form action="{{ route('products.pdf') }}" method="POST">
                @csrf
                @method('GET')

                <input type="hidden" name="name" value="{{ $old_values['values_filters']['name'] }}">
                <input type="hidden" name="description" value="{{ $old_values['values_filters']['description'] }}">
                <input type="hidden" name="category" value="{{ $old_values['values_filters']['category'] }}">
                <input type="hidden" name="subcategory" value="{{ $old_values['values_filters']['subcategory'] }}">
                <input type="hidden" name="min_stock" value="{{ $old_values['values_filters']['min_stock'] }}">
                <input type="hidden" name="max_stock" value="{{ $old_values['values_filters']['max_stock'] }}">
                <input type="hidden" name="min_price" value="{{ $old_values['values_filters']['min_price'] }}">
                <input type="hidden" name="max_price" value="{{ $old_values['values_filters']['max_price'] }}">
                <input type="hidden" name="sort_in_order" value="{{ $old_values['values_filters']['sort_in_order'] }}">
                <input type="hidden" name="sort_by_field" value="{{ $old_values['values_filters']['sort_by_field'] }}">

                <button type="submit" class="flex items-center">
                    <div
                        class="flex items-center justify-end cursor-pointer text-blue-600 rounded-lg shadow bg-blue-100 border border-blue-200 py-1.5 pr-2 pl-3 hover:text-white hover:bg-blue-600">
                        <span class="text-sm">{{ __('PDF') }}</span>
                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25">
                            </path>
                        </svg>
                    </div>
                </button>
            </form>

            {{-- filters --}}
            @include('products.includes.filters_sm')
        </div>

        <div class="static overflow-x-auto mt-5 lg:mt-10 shadow rounded-lg">
            <table class="table-fixed w-full text-sm text-left text-gray-500 -min-w-screen-lg" id="table_list">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-200 text-left text-blue-900">
                    <span class="flex items-center justify-between">
                        <span class="mr-5">{{ __('Listado de productos') }}</span>


                    </span>
                </caption>
                @if ($products->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-[30%]">
                                {{ __('Nombre') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Categoría') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Subcategoría') }}
                            </th>
                            <th scope="col" class="px-6 py-3 w-[10%]">
                                {{ __('Stock (Uds)') }}
                            </th>
                            <th scope="col" class="px-6 py-3 w-[10%]">
                                {{ __('Precio (€)') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-end w-[10%]">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $prod)
                            <tr class="bg-white border-b hover:bg-gray-100">

                                {{-- name --}}
                                <td class="px-6 py-4">
                                    {{ $prod->name }}
                                </td>

                                {{-- code cat --}}
                                <td class="px-6 py-4">
                                    {{ $prod->category->name }}
                                </td>

                                {{-- code subcat--}}
                                <td class="px-6 py-4">
                                    {{ $prod->subcategory->name }}
                                </td>

                                {{-- stock --}}
                                <td class="px-6 py-4">
                                    {{ $prod->stock }}
                                </td>

                                {{-- price --}}
                                <td class="px-6 py-4">
                                    {{ $prod->price }}
                                </td>

                                {{-- actions --}}
                                <td class="px-6 py-4 text-right">
                                    @include('layouts.buttons.dropdown_index', [
                                                'model_id' => $prod->id,
                                                'route_show' => 'products.show',
                                                'route_edit' => 'products.edit'
                                            ])
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody class="p-4 text-md font-semibold text-blue-900">
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ __('No hay productos registrados.') }}
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="px-4 py-2 mt-3">
            {!! $products->links() !!}
        </div>

        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/products/index.js') }}"></script>
@endsection
