<div class="text-start">
    {{-- @if (str_contains(Route::current()->uri, 'catalog'))
        @if (session()->has('origin'))
            <form method="POST" action="{{ session("origin")['origin'] === "fromIndex" ? route('home') : route('home.showCategoryOrSubcategory') }}">
                @csrf
                @method('GET')

                @if (session("origin")['origin'] === "fromShowCat")
                    @if (session("origin")['is'] === 'category')
                        <input type="hidden" name="category" value="{{ session("origin")['id'] }}">
                    @else
                        <input type="hidden" name="subcategory" value="{{ session("origin")['id'] }}">
                    @endif
                @endif

                <button type="submit" class="rotate-180 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </form>
        @else
            <form method="POST" action="{{ $origin['origin'] === "fromIndex" ? route('home') : route('home.showCategoryOrSubcategory') }}">
                @csrf
                @method('GET')

                @if ($origin['origin'] === "fromShowCat")
                    @if ($origin['is'] === 'category')
                        <input type="hidden" name="category" value="{{ $origin['id'] }}">
                    @else
                        <input type="hidden" name="subcategory" value="{{ $origin['id'] }}">
                    @endif
                @endif

                <button type="submit" class="rotate-180 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </form>
        @endif
    @else --}}
        <a
            @if (str_contains(Route::current()->uri, 'users'))
                href="{{ route('users.index') }}"
            @elseif (Route::currentRouteName() == 'categories.edit' || Route::currentRouteName() == 'categories.show')
                href="{{ route('categories.index') }}"
            @elseif (Route::currentRouteName() == 'subcategories.edit' || (Route::currentRouteName() ==  'subcategories.create'))
                href="{{ route('categories.show', $model_id) }}"
            @elseif (str_contains(Route::current()->uri, 'products'))
                href="{{ route('products.index') }}"
            @elseif (str_contains(Route::current()->uri, 'cart'))
                href="{{ route('home') }}"
            @endif

            class="rotate-180 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
            <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </a>
    {{-- @endif --}}
</div>

