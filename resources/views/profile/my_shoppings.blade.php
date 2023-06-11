@extends('layouts.general.main')
@section('title', 'Ver mis compras')

@section('content')
    <div class="flex-grow h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto">
        {{-- Shopping Cart Products --}}
        <div class="w-full border-b border-gray-300 mb-10 mt-6">
            <h3 class="text-xl font-semibold text-blue-800 my-1">Mis pedidos</h3>
        </div>

        @if ($carts)
            @foreach ($carts as $oneCart)
                <div class="relative overflow-x-auto mt-8 rounded-lg shadow-lg w-full mb-20">
                    <table class="table-auto w-full text-sm text-left text-blue-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-blue-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="bg-blue-200">
                                <th colspan="4" class="px-6 py-4 text-md font-bold text-blue-800 whitespace-nowrap">
                                    <div class="grid gap-1">
                                        <span>{{ __('Pedido Nº') }}{{ $oneCart['id'] }}</span>
                                        <span class="float-right">{{ $oneCart['created_at'] }}</span>
                                    </div>
                                </th>
                                <th>
                                    <a href="{{ route('profiles.invoice', $oneCart['id']) }}">
                                        <div class="flex items-center justify-end mr-5">
                                            <span class="">{{ __('PDF') }}</span>
                                            <svg class="w-8 text-blue-800 cursor-pointer" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25"></path>
                                            </svg>
                                        </div>
                                    </a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    <span class="sr-only">{{ __('Image') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    {{ __('Producto') }}
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    {{ __('Unidades') }}
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    {{ __('Precio unitario') }}
                                </th>
                                <th scope="col" class="px-6 py-4 font-semibold">
                                    {{ __('Precio subtotal') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oneCart['items'] as $item)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="w-32 p-4">
                                        <img src="{{ $item['url_img'] }}" alt="{{ $item['name'] }}"
                                            class="w-12 h-12 rounded-md">
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $item['name'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $item['qty'] }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $item['price'] }}{{ __('€') }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $item['price'] * $item['qty'] }}{{ __('€') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="font-semibold text-gray-800 bg-blue-100">
                                <th scope="row" colspan="4" class="px-6 py-3 text-base">{{ __('TOTAL') }}</th>
                                <td class="px-6 py-3 font-bold">{{ $oneCart['total'] }}{{ __('€') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endforeach
        @else
            <p class="px-6 py-4 text-md font-semibold text-blue-900">No hay productos en la cesta.</p>
        @endif

    </div>
    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection
