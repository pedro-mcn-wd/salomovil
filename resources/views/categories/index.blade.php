@extends('layouts.general.main')
@section('title', 'Listado de categorías')

@section('content')
    <div class="flex-grow h-full w-full px-2 mdpx-4 xl:px-0 xl:max-w-screen-xl xl:-min-w-screen-xl mx-auto">
        @include('layouts.general.tabs')
        @include('layouts.modals.delete')

        <div class="static overflow-x-auto mt-10 shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-500" id="table_list">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-200 text-left text-blue-900">
                    Listado de categorías
                </caption>
                @if ($categories->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Nombre') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Descripción') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Código') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $cat)
                            <tr class="bg-white border-b hover:bg-gray-100">

                                {{-- name --}}
                                <td class="px-6 py-4">
                                    {{ $cat->name }}
                                </td>

                                {{-- description --}}
                                <td class="px-6 py-4 truncate">
                                    {{ $cat->description }}
                                </td>

                                {{-- code --}}
                                <td class="px-6 py-4">
                                    {{ $cat->code }}
                                </td>

                                {{-- actions --}}
                                <td class="px-6 py-4 text-right">
                                    @include('layouts.buttons.dropdown_index', [
                                                'model_id' => $cat->id,
                                                'route_show' => 'categories.show',
                                                'route_edit' => 'categories.edit'
                                            ])
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody class="p-4 text-md font-semibold text-blue-900">
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                {{ __('No hay categorías registradas.') }}
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="px-4 py-2 mt-3">
            {!! $categories->links() !!}
        </div>
        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/categories/index.js') }}"></script>
@endsection
