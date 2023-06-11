<div class="flex justify-end ml-4">
    <form action="{{ route('cart.sales') }}" method="POST" id="frm_filter" class="flex items-center">
        @csrf
        @method('GET')

        <!-- drawer init and toggle -->
        <div class="text-center group">
            <button type="button"
                class="flex items-center py-2 pr-2 pl-3 ml-2 text-sm font-medium text-blue-600 group-hover:text-white bg-white hover:bg-blue-600 rounded-lg shadow"
                data-drawer-target="drawer_filters" data-drawer-show="drawer_filters" data-drawer-placement="top"
                aria-controls="drawer_filters">
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
        <div id="drawer_filters"
            class="rounded-b-xl max-w-screen-lg mx-auto fixed top-0 left-0 right-0 z-40 w-full p-4 transition-transform -translate-y-full bg-white"
            tabindex="-1" aria-labelledby="drawer-top-label">
            <h5 id="drawer-top-label"
                class="w-full inline-flex items-center mb-4 text-xl font-semibold text-blue-600 border-b-2 border-blue-600">
                Filtros de búsqueda
            </h5>
            <div class="grid gap-6">
                <div class="grid grid-cols-3 gap-4 w-full">

                    <div class="flex justify-start items-center col-span-3">
                        <h5 class="inline-flex items-center text-base font-semibold text-gray-500">Indica un rango de fechas de facturación</h5>
                    </div>

                    {{-- date from --}}
                    <div>
                        <label for="date_from" class="sr-only">Inicio</label>
                        <input type="date" name="date_from" id="date_from"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                            value="{{ $old_values['values_filters']['date_from'] }}">
                    </div>

                    {{-- date to --}}
                    <div>
                        <label for="date_to" class="sr-only">Fin</label>
                        <input type="date" name="date_to" id="date_to"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                            value="{{ $old_values['values_filters']['date_to'] }}">
                    </div>

                    {{-- buttons reset and search --}}
                    <div class="">
                        <div class="flex justify-end">
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
            </div>

            <a data-drawer-hide="drawer_filters" aria-controls="drawer_filters"
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
