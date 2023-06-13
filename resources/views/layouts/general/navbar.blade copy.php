<nav class="bg-blue-200 dark:bg-gray-900 shadow fixed top-0 left-0 right-0 z-40 px-5 2xl:px-auto">
    <div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto py-2">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-10 mr-3" alt="Flowbite Logo" />
            <span
                class="self-center text-gray-800 text-2xl font-semibold whitespace-nowrap hidden md:flex">{{ __('SALOMOVIL') }}</span>
        </a>
        {{-- hamburger --}}
        <button data-collapse-toggle="mobile-menu-2" type="button"
                class="inline-flex items-center p-1 ml-1 text-sm text-gray-500 rounded-lg bg-white lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-8 h-8 text-blue-700" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
        </button>
        <div class="flex items-center lg:order-2">
            <button type="button"
                class="flex items-center text-blue-800 rounded-full md:p-2 lg:rounded-4xl lg:hover:bg-white lg:hover:shadow"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
                <span class="flex-1 md:mr-3 whitespace-nowrap text-lg font-semibold hidden md:flex">
                    @if (Auth::user())
                        {{ explode(' ', Auth::user()->userProfile->name)[0] }}
                    @else
                        {{ __('Mi cuenta') }}
                    @endif
                </span>
                @if (Auth::user() && Auth::user()->getFirstMedia('users_avatar'))
                    <div
                        class="relative w-10 h-10 overflow-hidden rounded-full flex justify-center items-center">
                        <img class="rounded-full" src="{{ Auth::user()->getFirstMediaUrl('users_avatar') }}"
                            alt="avatar">
                    </div>
                @else
                    @if (Auth::user())
                        <div
                            class="relative w-9 h-9 overflow-hidden border-2 border-blue-600 rounded-full flex justify-center items-center">
                            <span class="text-blue-600 text-md font-semibold">
                                {{ Initials::initials(Auth::user()->userProfile->name) }}
                            </span>
                        </div>
                    @else
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-10 h-10 text-blue-800 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    @endif
                @endif
            </button>
            @if (Cart::count() > 0)
                <div class="self-start inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -ml-3 md:-ml-5 md:mt-1 z-50">
                    {{ Cart::count() }}
                </div>
            @endif
            <!-- Dropdown menu -->
            <div class="z-50 border hidden text-base list-none text-gray-700 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                id="user-dropdown">
                @if (Auth::user())
                    <span
                        class="block px-4 py-2 font-semibold text-blue-800 dark:hover:bg-gray-600 dark:hover:text-white">
                        @if (Auth::user()->getRoleNames()[0] == 'admin')
                            {{ __('Administrador') }}
                        @else
                            {{ __('Cliente') }}
                        @endif
                    </span>
                @endif
                <ul class="" aria-labelledby="user-menu-button">
                    @if (!Auth::user())
                        <li>
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Iniciar sesión') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Registrarme') }}</a>
                        </li>
                    @endif

                    @if (Auth::user())
                        <li>
                            <a href="{{ route('profiles.show', Auth::user()->userProfile->id) }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Mis datos') }}</a>
                        </li>

                        {{-- admins --}}
                        @role('admin')
                            <li>
                                <a href="{{ route('products.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Productos') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Categorias') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('cart.sales') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Listado de ventas') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Listado de usuarios') }}</a>
                            </li>
                        @endrole

                        {{-- clients --}}
                        @role('client')
                            <li>
                                <a href="{{ route('cart.showCart') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ __('Mi cesta') }}
                                    @if (Cart::count() > 0)
                                        <div class="ml-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full top-1/2 -right-2">{{ Cart::count() }}</div>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('profiles.seeShoppings') }}" class="block px-4 py-2 hover:bg-gray-100">{{ __('Mis compras') }}</a>
                            </li>
                        @endrole

                        <li class="rounded-b-lg border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="block w-full text-start px-4 py-2 hover:bg-gray-100 hover:rounded-b-lg">
                                    {{ __('Cerrar sesión') }}</button>
                            </form>
                        </li>
                    @endif

                </ul>
            </div>
        </div>

        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1 bg-white lg:bg-transparent rounded-lg mt-3 lg:mt-0" id="mobile-menu-2">
            <ul
                class="flex flex-col h-full font-medium p-0 rounded-lg lg:flex-row lg:space-x-2 lg:mt-0 lg:border-0">
                <li class="lg:hover:bg-white hover:shadow lg:rounded-lg">
                    <a href="{{ route('home') }}" class="block py-1 px-3 text-blue-800 text-lg"
                        aria-current="page">{{ __('Home') }}</a>
                </li>
                <li class="lg:hover:bg-white hover:shadow lg:rounded-lg border-y lg:border-none">
                    <a href="{{ route('home.about_us') }}" class="block py-1 px-3 text-blue-800 text-lg" aria-current="page">{{ __('Sobre nosotros') }}</a>
                </li>
                <li class="lg:hover:bg-white hover:shadow lg:rounded-lg">
                    <a href="{{ route('home.contact') }}" class="block py-1 px-3 text-blue-800 text-lg"
                        aria-current="page">{{ __('Contáctanos') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
