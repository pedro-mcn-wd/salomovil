@extends('layouts.general.main')
@section('title', 'Listado de ventas')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:px-4 2xl:px-0 2xl:max-w-screen-2xl 2xl:-min-w-screen-2xl mx-auto">

        <div class="static overflow-x-auto mt-10 shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-500 rounded-b-lg shadow" id="table_list">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-100 text-left text-blue-900 rounded-t-lg">
                    <span class="flex items-center justify-between">
                        <span class="mr-5">Listado de ventas</span>

                        <div class="flex items-center justify-center">
                            {{-- download list pdf --}}
                            <form action="{{ route('cart.invoices') }}" method="POST">
                                @csrf
                                @method('GET')

                                <input type="hidden" name="date_from"
                                    value="{{ $old_values['values_filters']['date_from'] }}">
                                <input type="hidden" name="date_to" value="{{ $old_values['values_filters']['date_to'] }}">

                                <button type="submit" class="flex items-center">
                                    <div
                                        class="flex items-center justify-end cursor-pointer text-blue-600 rounded-lg shadow bg-white py-1 pr-2 pl-3 hover:text-white hover:bg-blue-600">
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
                            @include('cart.includes.filters')
                        </div>
                    </span>
                </caption>
                @if ($sales->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Comprador
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dirección de envío
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Dirección de facturación
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tarjeta de crédito
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr class="bg-white border-b hover:bg-gray-100 m-4">

                                {{-- id --}}
                                <td class="px-6 py-3 whitespace-nowrap">
                                    {{ $sale->id }}
                                </td>

                                {{-- name --}}
                                <td class="px-6 py-3 whitespace-nowrap">
                                    {{ $sale->user->userProfile->name }} {{ $sale->user->userProfile->surname_first }}
                                    {{ $sale->user->userProfile->surname_second }}
                                </td>

                                {{-- Dirección de envío --}}
                                <td class="px-6 whitespace-nowrap">
                                    {{ $sale->delivery_address }}
                                </td>

                                {{-- Dirección de facturación --}}
                                <td class="px-6 whitespace-nowrap">
                                    {{ $sale->billing_address }}
                                </td>

                                {{-- Numero de tarjeta de credito --}}
                                <td class="px-6 whitespace-nowrap">
                                    @php
                                        foreach (str_split($sale->credit_card_number) as $ind => $char) {
                                            if ($ind % 4 === 0) {
                                                echo ' ';
                                            }
                                            echo $char;
                                        }
                                    @endphp
                                </td>

                                {{-- Fecha --}}
                                <td class="px-6 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y') }}
                                </td>

                                {{-- actions --}}
                                <td class="px-6 py-4 text-right">
                                    @include('layouts.buttons.dropdown_index', [
                                        'model_id' => $sale->shoppingcart_id,
                                        'route_show_sale' => 'cart.showSale',
                                        'route_invoice_sale' => 'profiles.invoice',
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody class="p-4 text-md font-semibold text-blue-900">
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                No hay ventas coincidentes.
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="px-4 py-2 mt-3">
            {!! $sales->links() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/cart/sales.js') }}"></script>
@endsection
