@extends('layouts.general.main')
@section('title', 'Ver perfil')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:px-4 xl:px-0 lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto">
        @include('layouts.modals.delete')
        <div class="mt-2 mb-7">
            @include('layouts.buttons.btn_back')
        </div>

        {{-- >= md: --}}
        <div class="static overflow-x-auto rounded-lg shadow-md w-full hidden md:block">
            <table class="table-fixed w-full text-sm text-left text-gray-500">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-200 text-left text-blue-900 uppercase w-full">
                    {{ __($category->name) }} {{ __('(' . $category->code . ')') }}
                </caption>

                <tbody>
                    <tr class="bg-white">
                        <td class="px-6 py-4 break-words" colspan="3">
                            {{ $category->description }}
                        </td>
                    </tr>
                    <tr class="bg-blue-200 text-blue-700">
                        <td class="px-6 py-3" colspan="3">
                            <div class="flex items-center justify-between group">
                                <span class="font-medium uppercase text-base text-blue-900">Subcategorías</span>

                                <form action="{{ route('subcategories.create') }}" method="POST">
                                    @csrf
                                    @method('GET')

                                    <input type="hidden" name="cat_id" value="{{ $category->id }}">

                                    <button type="submit" title="{{ __('Añadir nueva subcategoría') }}" class="flex items-center">
                                        <div
                                            class="h-6 w-6 border-2 border-blue-700 group-hover:text-white group-hover:bg-blue-700 group-hover:border-blue-700 rounded-lg group">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15"></path>
                                            </svg>
                                        </div>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        @if ($subcategories->count())
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-blue-900 uppercase bg-blue-50">
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
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcat)
                                        <tr class="bg-white hover:bg-gray-100">
                                            <td class="px-6 py-4"> {{ $subcat->name }} </td>
                                            <td class="px-6 py-4 break-words"> {{ $subcat->description }} </td>
                                            <td class="px-6 py-4"> {{ $subcat->code }} </td>
                                            <td class="px-6 py-4 text-right">
                                                <button id="{{ 'dropdown_actions_' . $subcat->id }}"
                                                    data-dropdown-toggle="{{ 'dropdownDots_' . $subcat->id }}"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg hover:bg-white"
                                                    type="button">
                                                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="{{ 'dropdownDots_' . $subcat->id }}"
                                                    class="z-10 hidden bg-white rounded-lg shadow-md w-34 border">
                                                    <ul class="text-sm text-gray-700 rounded-lg"
                                                        aria-labelledby="{{ 'dropdown_actions_' . $subcat->id }}">
                                                        <li class="border-y">
                                                            <a href="{{ route('subcategories.edit', $subcat->id) }}"
                                                                class="block px-4 py-2 hover:bg-green-200 text-green-700">{{ __('Editar') }}</a>
                                                        </li>
                                                        <li>
                                                            <button type="button" value="{{ $subcat->id }}"
                                                                data-modal-target="modal_delete"
                                                                class="btn-delete rounded-b-lg block px-4 py-2 hover:bg-red-200 w-full text-end text-red-700">{{ __('Eliminar') }}</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <td class="px-6 py-4">{{ __('No hay subcategorías para esta categoría') }}.</td>
                        @endif
                    </tr>
                </tbody>

            </table>
        </div>

        {{-- < md: --}}
        <div class="static overflow-x-auto rounded-lg shadow-md w-full md:hidden mb-5">
            <table class="table-fixed w-full text-sm text-left text-gray-500">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-200 text-left text-blue-900 uppercase w-full">
                    {{ __($category->name) }} {{ __('(' . $category->code . ')') }}
                </caption>

                <tbody>
                    <tr class="bg-white">
                        <td class="px-6 py-4 break-words" colspan="3">
                            {{ $category->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="static overflow-x-auto rounded-lg shadow-md w-full md:hidden">
            @if ($subcategories->count())
                <table class="w-full text-sm text-left text-gray-500 -min-w-screen-sm">
                    <caption class="px-6 py-4 text-lg font-semibold bg-blue-200 text-left text-blue-900 uppercase w-full">
                        <div class="flex items-center justify-between">
                            <span class="font-medium uppercase text-base text-blue-900">Subcategorías</span>

                            <form action="{{ route('subcategories.create') }}" method="POST">
                                @csrf
                                @method('GET')

                                <input type="hidden" name="cat_id" value="{{ $category->id }}">

                                <button type="submit" title="{{ __('Añadir nueva subcategoría') }}" class="flex items-center">
                                    <div
                                        class="h-6 w-6 border-2 border-blue-700 group-hover:text-white hover:bg-blue-700 hover:border-blue-700 rounded-lg group">
                                        <svg class="text-blue-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15"></path>
                                        </svg>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </caption>
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
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
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcat)
                            <tr class="bg-white hover:bg-gray-100">
                                <td class="px-6 py-4"> {{ $subcat->name }} </td>
                                <td class="px-6 py-4 break-words"> {{ $subcat->description }} </td>
                                <td class="px-6 py-4"> {{ $subcat->code }} </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center">
                                        <div>
                                            <a href="{{ route('subcategories.edit', $subcat->id) }}"
                                                class="block pl-4 py-2 hover:bg-green-200 text-green-700">
                                                <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                                                  </svg>
                                            </a>
                                        </div>
                                        <div>
                                            <button type="button" value="{{ $subcat->id }}"
                                                data-modal-target="modal_delete"
                                                class="btn-delete rounded-b-lg block pl-8 py-2 hover:bg-red-200 w-full text-end text-red-700">
                                                <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                  </svg>
                                            </button>
                                        </div>
                                    </div>
                                    {{-- <div id="{{ 'dropdownDots_' . $subcat->id }}"
                                        class="z-10 hidden bg-white rounded-lg shadow-md w-34 border">
                                        <ul class="text-sm text-gray-700 rounded-lg"
                                            aria-labelledby="{{ 'dropdown_actions_' . $subcat->id }}">
                                            <li class="border-y">
                                                <a href="{{ route('subcategories.edit', $subcat->id) }}"
                                                    class="block px-4 py-2 hover:bg-green-200 text-green-700">{{ __('Editar') }}</a>
                                            </li>
                                            <li>
                                                <button type="button" value="{{ $subcat->id }}"
                                                    data-modal-target="modal_delete"
                                                    class="btn-delete rounded-b-lg block px-4 py-2 hover:bg-red-200 w-full text-end text-red-700">{{ __('Eliminar') }}</button>
                                            </li>
                                        </ul>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            @else
                <td class="px-6 py-4">{{ __('No hay subcategorías para esta categoría') }}.</td>
            @endif
        </div>
        <div class="px-4 py-2 mt-3">
            {!! $subcategories->links() !!}
        </div>
    </div>

    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection

@section('js')
    <script src="{{ asset('js/categories/show.js') }}"></script>
@endsection
