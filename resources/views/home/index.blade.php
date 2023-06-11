@extends('layouts.general.main')
@section('title', 'Home')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">
@endsection

@section('content')

    <div class="flex-grow h-full w-full md:max-w-screen-md md:-min-w-screen-md lg:max-w-screen-lg lg:-min-w-screen-lg xl:max-w-screen-xl xl:-min-w-screen-xl 2xl:max-w-screen-2xl 2xl:-min-w-screen-2xl mx-auto">
            {{-- categorias --}}
            <div class="md:-mt-5">
                @include('layouts.general.sidebar', ['categories' => $categories])
            </div>

            {{-- carousel --}}
            <div>
                @include('home.includes.carousel')
            </div>

            {{-- card-group --}}
            <div class="mt-20">
                @include('home.includes.cards')
            </div>
    </div>

@endsection
