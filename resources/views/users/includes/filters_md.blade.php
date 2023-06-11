<div class="flex justify-end ml-4">
    <form
        action="{{ Route::currentRouteName() == 'users.index' ? route('users.index') : route('users.trashed') }}"
        method="POST" id="frm_filter"
        class="flex items-center jus">
        @csrf
        @method('GET')

        <!-- drawer init and toggle -->
        <div class="text-center group">
            <button type="button"
                class="flex items-center p-2 ml-2 text-sm font-medium text-blue-600 group-hover:text-white bg-white hover:bg-blue-600 rounded-lg shadow"
                data-drawer-target="drawer_filters_md" data-drawer-show="drawer_filters_md"
                data-drawer-placement="top" aria-controls="drawer_filters_md">
                <svg class="mr-2 w-5 h-5 text-blue-600 group-hover:stroke-white" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
                <span class="pr-2.5">Filtros</span>
            </button>
        </div>

        <!-- drawer component -->
        <div id="drawer_filters_md"
            class="rounded-b-xl max-w-screen-xl mx-auto fixed top-0 left-0 right-0 z-40 w-full p-4 transition-transform -translate-y-full bg-white"
            tabindex="-1" aria-labelledby="drawer-top-label">
            <h5 id="drawer-top-label"
                class="w-full inline-flex items-center mb-4 text-xl font-semibold text-blue-600 border-b-2 border-blue-600">
                Filtros de búsqueda
            </h5>
                <div class="grid grid-cols-3 gap-4 w-full">

                    <div class="flex justify-start items-center col-span-3">
                        <h5 class="inline-flex items-center text-base font-semibold text-gray-500">
                            Datos
                            personales</h5>
                    </div>

                    {{-- name --}}
                    <div class="">
                        <label for="name" class="sr-only">Nombre</label>
                        <input type="text" name="name" id="name"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5  "
                            value="{{ $old_values['values_filters']['name'] }}"
                            placeholder="Nombre">
                    </div>

                    {{-- surname_first --}}
                    <div>
                        <label for="surname_first" class="sr-only">Primer pellido</label>
                        <input type="text" name="surname_first" id="surname_first"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full  p-2.5  "
                            value="{{ $old_values['values_filters']['surname_first'] }}"
                            placeholder="Primer apellido">
                    </div>

                    {{-- surname_first --}}
                    <div>
                        <label for="surname_second" class="sr-only">Segundo pellido</label>
                        <input type="text" name="surname_second" id="surname_second"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full  p-2.5  "
                            value="{{ $old_values['values_filters']['surname_second'] }}"
                            placeholder="Segundo apellido">
                    </div>

                    {{-- email --}}
                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input type="text" name="email" id="email"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full  p-2.5  "
                            value="{{ $old_values['values_filters']['email'] }}"
                            placeholder="Email">
                    </div>

                    {{-- dni --}}
                    <div>
                        <label for="dni" class="sr-only">DNI</label>
                        <input type="text" name="dni" id="dni"
                            class="input_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full  p-2.5  "
                            value="{{ $old_values['values_filters']['dni'] }}" placeholder="DNI">
                    </div>

                    {{-- role --}}
                    <div>
                        <label for="role" class="sr-only">Rol</label>
                        <div class="relative w-full">
                            <select name="role" id="role"
                                class="select_filter bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                                <option value="">Selecciona un rol...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $old_values['values_filters']['role'] == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- buttons reset and search --}}
                    <div class="col-span-3">
                        <div class="flex justify-end">
                            <div class="group">
                                <a id="btn_reset_filters"
                                    class="cursor-pointer flex items-center p-2 text-sm font-medium border-2 text-orange-500 border-orange-500 group-hover:text-white bg-white group-hover:bg-orange-500 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                        </path>
                                    </svg>
                                    <span class="mx-2">Resetear filtros</span>
                                </a>
                            </div>
                            <div class="group">
                                <button type="submit"
                                    class="p-2.5 ml-2 flex items-center text-sm font-medium text-blue-600 border-2 border-blue-600 group-hover:text-white bg-white group-hover:bg-blue-600 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                        </path>
                                    </svg>
                                    <span class="mx-2">Filtrar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            <a data-drawer-hide="drawer_filters_md" aria-controls="drawer_filters_md"
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
