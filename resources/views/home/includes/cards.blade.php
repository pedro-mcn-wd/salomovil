<h2 class="mb-7 text-blue-900 font-bold text-xl px-10 md:px-5 xl:px-0">Te puede interesar...</h2>

<div class="grid sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-6 xl:gap-12 gap-x-6 gap-y-12 px-20 md:px-5 xl:px-0">
    @foreach ($productsCards as $prod)
        @if ($loop->last)
            <div class="hover:shadow-lg border rounded-2xl shadow bg-gray-50 hidden lg:block">
        @else
            <div class="hover:shadow-lg border rounded-2xl shadow bg-gray-50">
        @endif
            <form action="{{ route('home.showProduct', $prod->id) }}" method="POST">
                @csrf
                @method('GET')
                <input type="hidden" name="origin" value="fromIndex">
                <button type="submit" class="p-1 lg:p-2">
                    <img src="{{ $prod->getFirstMediaUrl('prod_imgs', 'gallery') }}"
                     class="rounded-t-xl w-full h-auto object-cover" alt="imagen">
                </button>
            </form>
            <div class="px-4 pb-4 pt-2 ">
                <h3 class="text-sm font-semibold text-gray-900 mb-2">@php echo ucfirst($prod->name) @endphp</h3>
                <h4 class="text-sm font-bold text-blue-700">{{ $prod->price }}{{ __('€') }}</h4>
            </div>
        </div>
    @endforeach
</div>
