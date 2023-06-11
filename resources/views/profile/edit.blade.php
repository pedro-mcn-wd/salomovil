@extends('layouts.general.main')
@section('title', 'Editar perfil')

@section('content')

    <div class="flex-grow md:mt-8 h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto px-4 xl:px-0">
        {{-- Edit personal information --}}
        <div class="relative overflow-x-auto p-4 rounded-lg shadow-md col-span-3 w-full bg-white">

            <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-6 mb-10 md:grid-cols-2">
                    <div class="border-b col-span-2">
                        <p class="text-lg font-medium text-blue-900">Información personal</p>
                    </div>
                    {{-- user_profile --}}
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $profile->name }}" placeholder="{{ $profile->name }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="surname_first"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primer
                            apellido</label>
                        <input type="text" name="surname_first" id="surname_first"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $profile->surname_first }}"
                            placeholder="{{ $profile->surname_first }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="surname_second"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Segundo
                            apellido</label>
                        <input type="text" name="surname_second" id="surname_second"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $profile->surname_second }}"
                            placeholder="{{ $profile->surname_second }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="dni"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                        <input type="text" name="dni" id="dni"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $profile->dni }}" placeholder="{{ $profile->dni }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="birthdate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de nacimiento</label>
                        <input type="date" name="birthdate" id="birthdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ $profile->birthdate }}">
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <label for="bio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biografía</label>
                        <textarea name="bio" id="bio"
                            class="bg-gray-50 border max-h-48 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            rows="9" style="min-height: 4rem">{{ $profile->bio }}</textarea>
                    </div>

                    {{-- image --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="avatar"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
                        <input type="file" name="avatar" class="dropify" data-height="178"
                            data-default-file="{{ Auth::user()->getFirstMediaUrl('users_avatar') }}">
                    </div>

                    {{-- password --}}
                    <div class="col-span-2">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ Auth::user()->email }}" placeholder="{{ Auth::user()->email }}">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" value="{{ old('password') }}">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                            contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" value="">
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <button type="submit"
                    class="w-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto mt-6 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Guardar cambios</button>
                </div>

            </form>
        </div>
    </div>

    @include('layouts.msg.error')
    @include('layouts.msg.actual_password_error')
@endsection

@section('js')
    <script src="{{ asset('js/profile/edit.js') }}"></script>
@endsection
