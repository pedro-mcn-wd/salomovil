@extends('layouts.general.main')
@section('title', 'Ver cesta')

@section('content')
    <div class="flex-grow h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg px-3 mx-auto">
        <div>
            @include('layouts.general.sidebar', ['categories' => $categories])
        </div>

        {{-- Shopping Cart Products --}}
        <div class="relative overflow-x-auto mt-8 rounded-lg shadow-lg w-full">
            @if (Cart::count())
                {{-- table >= lg: --}}
                <table class="hidden lg:table table-auto w-full text-sm text-left text-blue-500">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-gray-700">
                        <tr class="bg-blue-200">
                            <th colspan="5" class="px-6 py-4 text-xl text-blue-800">{{ __('Cesta') }}</th>
                            <th class="text-center">
                                <a href="{{ route('cart.clear') }}" class="text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm pl-2 pr-3 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-5" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                    </svg>
                                    <span class="ml-2 whitespace-nowrap">{{ __('Vaciar cesta') }}</span>
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="col" class="px-6 py-4">
                                <span class="sr-only">{{ __('Image') }}</span>
                            </th>
                            <th scope="col" class="px-6 py-4">
                                {{ __('Producto') }}
                            </th>
                            <th scope="col" class="px-6 py-4">
                                {{ __('Unidades') }}
                            </th>
                            <th scope="col" class="px-6 py-4">
                                {{ __('Precio unitario') }}
                            </th>
                            <th scope="col" class="px-6 py-4">
                                {{ __('Precio subtotal') }}
                            </th>
                            <th scope="col" class="px-6 py-4 sr-only">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $row)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="w-32 p-4">
                                    <img src="{{ $row->options->url_img }}" alt="{{ $row->name }}"
                                        class="w-12 h-12 rounded-md">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $row->name }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    <div class="flex items-center space-x-3">

                                        <form action="{{ route('cart.updateItem') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="operation" value="rest">
                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                            <button
                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                type="submit">
                                                <span class="sr-only">{{ __('Quantity button rest') }}</span>
                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <span class="mx-2">{{ $row->qty }}</span>

                                        <form action="{{ route('cart.updateItem') }}" method="POST" disabled>
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="operation" value="sum">
                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                            <button
                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                type="submit">
                                                <span class="sr-only">Quantity button sum</span>
                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $row->price }}{{ __('€') }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $row->price * $row->qty }}{{ __('€') }}
                                </td>
                                <td class="px-6 py-4  text-center">
                                    <form action="{{ route('cart.removeItem') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                        <button type="submit"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            <svg class="w-7" fill="none" stroke="currentColor" stroke-width="1.5"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-800 bg-blue-100">
                            <th scope="row" colspan="4" class="px-6 py-3 text-base">{{ __('TOTAL') }}</th>
                            <td class="px-6 py-3 font-bold">{{ Cart::total() }}{{ __('€') }}</td>
                            <td class="text-center">
                                <a href="{{ route('cart.payCart') }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm pl-2 pr-3 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="ml-2 whitespace-nowrap">{{ __('HACER PEDIDO') }}</span>
                                </a>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                {{-- table < lg: --}}
                <table class="lg:hidden table-fixed w-full text-sm text-left text-blue-500 bg-white">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-100 dark:bg-gray-700">
                        <caption class="bg-blue-200">
                            <div class="flex items-center justify-between px-4 py-3">
                                <p class="text-xl text-blue-800 font-bold uppercase">{{ __('Cesta') }}</p>
                                <div class="text-center">
                                    <a href="{{ route('cart.clear') }}" class="text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm pl-2 pr-3 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="w-5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                        </svg>
                                        <span class="ml-2">{{ __('Vaciar cesta') }}</span>
                                    </a>
                                </div>
                            </div>
                        </caption>
                    </thead>
                    {{-- tbody >= md: --}}
                    <tbody class="hidden md:table-row-group">
                        @foreach ($cart as $row)
                            <tr class="bg-white border-b">
                                <td colspan="2" class="pl-10 pr-5 py-10 align-top">
                                    <img src="{{ $row->options->url_img }}" alt="{{ $row->name }}"
                                        class="rounded-md">
                                </td>
                                <td class="align-top pl-4  py-10 w-1/2">
                                    <table class="table w-full">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class=" pb-4">
                                                    {{ __('Producto') }}
                                                </th>
                                                <td class=" pb-4 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class=" py-4">
                                                    {{ __('Unidades') }}
                                                </th>
                                                <td class=" py-4 font-semibold text-gray-900 dark:text-white">
                                                    <div class="flex items-center space-x-3">

                                                        <form action="{{ route('cart.updateItem') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="operation" value="rest">
                                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                            <button
                                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                                type="submit">
                                                                <span class="sr-only">{{ __('Quantity button rest') }}</span>
                                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </form>

                                                        <span class="mx-2">{{ $row->qty }}</span>

                                                        <form action="{{ route('cart.updateItem') }}" method="POST" disabled>
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="operation" value="sum">
                                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                            <button
                                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                                type="submit">
                                                                <span class="sr-only">Quantity button sum</span>
                                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class=" py-4 whitespace-nowrap">
                                                    {{ __('Precio unitario') }}
                                                </th>
                                                <td class=" py-4 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->price }}{{ __('€') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class=" py-4 whitespace-nowrap">
                                                    {{ __('Precio subtotal') }}
                                                </th>
                                                <td class=" py-4 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->price * $row->qty }}{{ __('€') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class=" py-4  text-start">
                                                    <form action="{{ route('cart.removeItem') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                        <button type="submit"
                                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                            <svg class="w-7" fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- tbody < md: --}}
                    <tbody class="md:hidden">
                        @foreach ($cart as $row)
                            <tr class="bg-white border-t">
                                <td class="p-5  w-full">
                                    <img src="{{ $row->options->url_img }}" alt="{{ $row->name }}"
                                        class="rounded-md">
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top p-5">
                                    <table class="table w-full">
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="pb-2">
                                                    {{ __('Producto') }}
                                                </th>
                                                <td class="pb-2 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->name }}
                                                </td>
                                                <td colspan="2" class="pb-2 align-top text-end">
                                                    <form action="{{ route('cart.removeItem') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                        <button type="submit"
                                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                                            <svg class="w-7" fill="none" stroke="currentColor" stroke-width="1.5"
                                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="py-4">
                                                    {{ __('Unidades') }}
                                                </th>
                                                <td class="py-4 font-semibold text-gray-900 dark:text-white">
                                                    <div class="flex items-center space-x-3">

                                                        <form action="{{ route('cart.updateItem') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="operation" value="rest">
                                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                            <button
                                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                                type="submit">
                                                                <span class="sr-only">{{ __('Quantity button rest') }}</span>
                                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </form>

                                                        <span class="mx-2">{{ $row->qty }}</span>

                                                        <form action="{{ route('cart.updateItem') }}" method="POST" disabled>
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="operation" value="sum">
                                                            <input type="hidden" name="rowId" value="{{ $row->rowId }}">
                                                            <button
                                                                class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                                type="submit">
                                                                <span class="sr-only">Quantity button sum</span>
                                                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="py-4 whitespace-nowrap">
                                                    {{ __('Precio unitario') }}
                                                </th>
                                                <td class="py-4 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->price }}{{ __('€') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="py-4 whitespace-nowrap">
                                                    {{ __('Precio subtotal') }}
                                                </th>
                                                <td class="py-4 font-semibold text-gray-900 dark:text-white">
                                                    {{ $row->price * $row->qty }}{{ __('€') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <caption class="lg:hidden caption-bottom">
                        <div class="bg-blue-200 p-3 flex items-center justify-between">
                            <span class="font-bold text-gray-800">{{ __('TOTAL: ') }}&nbsp;{{ Cart::total() }}{{ __('€') }}</span>
                            <a href="{{ route('cart.payCart') }}" class="text-white bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm pl-2 pr-3 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="ml-2">{{ __('HACER PEDIDO') }}</span>
                            </a>
                        </div>
                    </caption>
                </table>
            @else
                <p class="px-6 py-4 text-md font-semibold text-blue-900">No hay productos en la cesta.</p>
            @endif
        </div>
    </div>
    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection
