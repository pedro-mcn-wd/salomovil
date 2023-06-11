<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @if ($is === 'category')
            <li class="inline-flex items-center">
                <form action="{{ route('home.showCategoryOrSubcategory') }}" method="POST">
                    @csrf
                    @method('GET')
                    <input type="hidden" name="category" value="{{ $section->id }}">
                    <button type="submit"
                        class="inline-flex items-center text-lg font-medium text-blue-800 hover:text-blue-600 dark:text-blue-400 dark:hover:text-white">
                        <svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        <span class="ml-2">{{ $section->name }}</span>
                    </button>
                </form>
            </li>
        @else
            <li class="inline-flex items-center">
                <form action="{{ route('home.showCategoryOrSubcategory') }}" method="POST">
                    @csrf
                    @method('GET')
                    <input type="hidden" name="category" value="{{ $section->category->id }}">
                    <button type="submit"
                        class="inline-flex items-center text-lg font-medium text-blue-800 hover:text-blue-600 dark:text-blue-400 dark:hover:text-white">
                        <svg class="w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                        <span class="ml-2">{{ $section->category->name }}</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route('home.showCategoryOrSubcategory') }}" method="POST">
                    @csrf
                    @method('GET')
                    <input type="hidden" name="subcategory" value="{{ $section->id }}">
                    <button type="submit"
                        class="inline-flex items-center text-lg font-medium text-blue-800 hover:text-blue-600 dark:text-blue-400 dark:hover:text-white">
                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
                          </svg>
                        <span class="ml-2">{{ $section->name }}</span>
                    </button>
                </form>
            </li>
        @endif
    </ol>
</nav>
