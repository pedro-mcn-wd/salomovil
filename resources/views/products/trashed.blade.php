@extends('layouts.general.main')
@section('title', 'Litado de categorías eliminadas')

@section('content')
    <div class="flex-grow h-full w-full px-2 mdpx-4 xl:px-0 xl:max-w-screen-xl xl:-min-w-screen-xl mx-auto">
        @include('layouts.general.tabs')
        @if ($products->count())
            @include('layouts.modals.forceDelete')
            @include('layouts.modals.deleteAll')
            @include('layouts.modals.restoreAll')
        @endif

        <div class="flex items-center lg:hidden mt-5 -ml-5">
            @include('products.includes.filters_sm')
        </div>

        <div class="static overflow-x-auto mt-5 lg:mt-10 shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left shadow rounded-b-lg text-gray-500 dark:text-gray-400 -min-w-screen-lg">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-100 text-left text-blue-900 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <span class="mr-5">{{ __('Listado de productos eliminados') }}</span>

                    </div>
                </caption>
                @if ($products->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Nombre') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Categoría') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Subcategoría') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Stock (Uds)') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Precio (€)') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
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

                                {{-- code subcat --}}
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
                                    @include('layouts.buttons.dropdown_one_trashed', [
                                        'model_id' => $prod->id,
                                        'route' => 'products.restore',
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
    <script src="{{ asset('js/products/trashed.js') }}"></script>
@endsection
