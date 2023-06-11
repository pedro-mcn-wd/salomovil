@extends('layouts.general.main')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('content')

    <div class="flex-grow mb-10 h-full w-full xl:max-w-screen-xl xl:-min-w-screen-xl 2xl:max-w-screen-2xl 2xl:-min-w-screen-2xl mx-auto">
            {{-- categorias --}}
            <div>
                @include('layouts.general.sidebar', ['categories' => $categories])
            </div>

            <div class="mt-5 mb-8 px-5">
                @include('home.includes.breadcrumb')
            </div>

            <div class="grid md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-12 px-5 xl:px-0">
                @foreach ($products as $prod)
                    <div class="hover:shadow-lg border rounded-2xl shadow bg-white">
                        <form action="{{ route('home.showProduct', $prod->id) }}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="origin" value="fromShowCat">
                            <input type="hidden" name="is" value="{{ $is }}">
                            <input type="hidden" name="id" value="{{ $section->id }}">

                            <button type="submit">
                                <img src="{{ $prod->getFirstMediaUrl('prod_imgs', 'gallery') }}"
                                 class="rounded-t-xl w-full h-auto object-cover" alt="imagen">
                            </button>
                        </form>
                        <div class="px-4 pb-4 pt-2">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">@php echo ucfirst($prod->name) @endphp</h3>
                            <h4 class="text-sm font-bold text-blue-700">{{ $prod->price }}{{ __('€') }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>

@endsection
