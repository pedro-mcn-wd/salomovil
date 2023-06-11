<div id="default-carousel" class="relative w-full md:bg-blue-200 shadow" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden md:h-60 lg:h-96">
        @foreach ($productsCarousel as $prod)
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <div class="hidden md:grid grid-cols-2 gap-4 md:gap-8 2xl:gap-40 mx-20 md:mx-24 2xl:mx-56 h-60 lg:h-full items-center">
                    <div class="hidden md:block">
                        <h3 class="text-md lg:text-xl font-semibold text-blue-900">{{ strtoupper($prod->name) }}</h3>
                        <p class="hidden lg:block mb-10 mt-3 text-gray-900">{{ Str::limit($prod->description, 250) }}</p>
                        <p class="lg:hidden mb-5 mt-3 text-sm text-gray-900">{{ Str::limit($prod->description, 150) }}</p>
                        <form action="{{ route('home.showProduct', $prod->id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="origin" value="fromIndex">
                            <button type="submit"
                                class="shadow text-gray-900 bg-white focus:outline-none hover:bg-blue-400 hover:text-white font-medium rounded-full text-sm px-3 lg:px-5 py-1.5 lg:py-2.5 mr-2 mb-2">
                                Quiero verlo
                            </button>
                        </form>
                    </div>
                    <div class="w-full h-auto lg:h-60 overflow-hidden bg-white text-center">
                        <div class="flex justify-center items-center h-full">
                            <img src="{{ $prod->getFirstMediaUrl('prod_imgs', 'carousel') }}"
                                 class="w-full h-auto object-cover" alt="imagen">
                        </div>
                    </div>
                </div>
                <div class="relative md:hidden">
                    <div class="absolute top-2 left-0 bg-white rounded-r-full font-medium opacity-90 py-1 px-2">
                        <h3 class="text-xl font-semibold text-blue-900">{{ strtoupper($prod->name) }}</h3>
                    </div>
                    <img src="{{ $prod->getFirstMediaUrl('prod_imgs', 'carousel') }}" class="w-full h-auto object-cover" alt="imagen">
                    <div class="absolute bottom-10 right-2">
                        <form action="{{ route('home.showProduct', $prod->id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="origin" value="fromIndex">
                            <button type="submit"
                                class="shadow-md text-gray-900 bg-white border-2 font-medium rounded-full text-md p-2 opacity-90">
                                Ver
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Slider indicators -->
    <div class="absolute z-30 flex space-x-6 lg:space-x-3 -translate-x-1/2 -bottom-7 lg:bottom-5 left-1/2">
        <button type="button" class="w-3 h-3 rounded-full bg-blue-500 lg:bg-white" aria-current="true" aria-label="Slide 1"
            data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-blue-500 lg:bg-white" aria-current="false" aria-label="Slide 2"
            data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-blue-500 lg:bg-white" aria-current="false" aria-label="Slide 3"
            data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-blue-500 lg:bg-white" aria-current="false" aria-label="Slide 4"
            data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full bg-blue-500 lg:bg-white" aria-current="false" aria-label="Slide 5"
            data-carousel-slide-to="4"></button>
    </div>

    <!-- Slider controls -->
    <button type="button"
        class="absolute top-0 left-0 z-30 hidden md:flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-prev>
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-blue-400 dark:bg-gray-800/30 hover:bg-blue-700 dark:group-hover:bg-gray-800/60">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button"
        class="absolute top-0 right-0 z-30 hidden md:flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
        data-carousel-next>
        <span
            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-blue-400 dark:bg-gray-800/30 hover:bg-blue-700 dark:group-hover:bg-gray-800/60">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
