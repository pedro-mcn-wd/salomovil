<!-- drawer init and show -->
<div class="max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto mb-5 md:mt-9">
    <button
        class="flex justify-items-center text-blue-800 font-medium rounded-lg text-lg py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none hover:shadow p-4"
        type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
        aria-controls="drawer-navigation">
        <svg class="w-7 h-7" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
        </svg>
        <p class="text-blue-800 font-semibold ml-1 text-lg">{{ __('Categorías') }}</p>
    </button>
</div>

<!-- drawer component -->
<div id="drawer-navigation"
    class="overflow-y-auto fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white dark:bg-gray-800 md:mt-20"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="shadow text-base font-semibold text-white uppercase dark:text-gray-400 p-4 bg-blue-400">
        {{ __('CATEGORIAS') }}
    </h5>
    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center  dark:hover:bg-gray-600 dark:hover:text-white hover:shadow dropdown-content">
        <svg aria-hidden="true" class="w-5 h-5" fill="white" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">{{ __('Close menu') }}</span>
    </button>
    <div class="border-b mb-20">
        <ul class="space-y-2 font-medium divide-y">
            @foreach ($categories as $cat)
                <li style="margin:0;">
                    <button id="{{ __('dropdown_') }}{{ Str::lower($cat->code) }}"
                            data-collapse-toggle="{{ __('dropdown_') }}{{ Str::lower($cat->code) }}{{ __('_toggle') }}"
                            class="text-blue-800 text-md p-4 w-full hover:bg-blue-100 hover:shadow sidebar_butttons text-left"
                            type="button">{{ $cat->name }}
                    </button>
                    <div id="{{ __('dropdown_') }}{{ Str::lower($cat->code) }}{{ __('_toggle') }}"
                        class="pl-10 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg dark:bg-gray-700 ">
                        <ul class="text-sm text-blue-800 dark:text-gray-200" aria-labelledby="{{ __('dropdown_') }}{{ Str::lower($cat->code) }}">
                            <li>
                                <form action="{{ route('home.showCategoryOrSubcategory') }}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <input type="hidden" name="category" value="{{ $cat->id }}">
                                    <button type="submit"
                                    class="block px-4 py-2 w-full text-start hover:bg-gray-100  dark:hover:bg-gray-600 dark:hover:text-white hover:shadow dropdown-content">
                                        Todo
                                    </button>
                                </form>
                            </li>
                            @foreach ($cat->subcategories as $subcat)
                                <li>
                                    <form action="{{ route('home.showCategoryOrSubcategory') }}" method="POST">
                                        @csrf
                                        @method('GET')
                                        <input type="hidden" name="subcategory" value="{{ $subcat->id }}">
                                        <button type="submit"
                                            class="block px-4 py-2 w-full text-start hover:bg-gray-100  dark:hover:bg-gray-600 dark:hover:text-white hover:shadow dropdown-content">
                                            {{ $subcat->name }}
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
