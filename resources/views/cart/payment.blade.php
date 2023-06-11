@extends('layouts.general.main')
@section('title', 'Pago')

@section('content')
    <div class="flex-grow h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto mb-9 px-4 xl:px-0">

        <h2 class="text-xl font-medium mb-6 text-blue-900 md:mt-5">Formalizar pago</h2>
        <form action="{{ route('cart.storeCart') }}" method="post">
            @csrf
            @method('POST')

            <div class="grid gap-6 mb-10">
                {{-- delivery address --}}
                <div>
                    <label for="delivery_address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección de envío</label>
                    <input type="text" name="delivery_address" id="delivery_address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('delivery_address') }}" placeholder="Calle Azagfrán nº56, 41782, Dos Hermanas, Sevilla">
                </div>

                {{-- billing address --}}
                <div>
                    <label for="billing_address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección de facturación</label>
                    <input type="text" name="billing_address" id="billing_address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ old('billing_address') }}" placeholder="Calle Azagfrán nº56, 41782, Dos Hermanas, Sevilla">
                </div>

                {{-- credit_card_number --}}
                <div class="grid grid-cols-2 gap-6 border border-gray-300 bg-white shadow-lg rounded-lg p-4">
                    <div class="border-b col-span-2">
                        <p class="text-md font-medium text-blue-700">Tarjeta de crédito</p>
                    </div>

                    {{-- number--}}
                    <div class="col-span-2">
                        <label for="cc_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de tarjeta</label>
                        <input type="text" name="cc_number" id="cc_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('cc_number') }}" placeholder="0000 0000 0000 0000">
                    </div>

                    {{-- expiry date --}}
                    <div>
                        <label for="cc_expiry_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de expiración</label>
                        <input type="date" name="cc_expiry_date" id="cc_expiry_date" min={{ $today }}
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('cc_expiry_date') }}">
                    </div>

                    {{-- cvc_cvv --}}
                    <div>
                        <label for="cvc_cvv"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CVC / CVV</label>
                        <input type="number" name="cvc_cvv" id="cvc_cvv" max=999
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    {{-- card holder --}}
                    <div class="col-span-2">
                        <label for="card_holder"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titular de la tarjeta</label>
                        <input type="text" name="card_holder" id="card_holder"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('card_holder') }}" placeholder="Luisa Méndez Pozo">
                    </div>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar cambios</button>
            </div>

        </form>
    </div>
    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection
