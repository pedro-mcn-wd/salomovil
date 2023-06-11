@extends('layouts.general.main')
@section('title', 'Crear usuario')

@section('content')
    <div class="flex-grow h-full w-full px-2 md:p-4 xl:px-0 lg:max-w-screen-lg mx-auto">
        <div class="mb-7">
            @include('layouts.general.tabs')
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg">
            <h2 class="text-xl font-medium mb-6 text-blue-900">Crear usuario</h2>
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-6 mb-10 md:grid-cols-2">
                    <div class="border-b col-span-2">
                        <p class="text-md font-medium text-blue-700">Información personal</p>
                    </div>

                    {{-- name --}}
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('name') }}" placeholder="Gloria">
                    </div>

                    {{-- surname_first --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="surname_first" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primer
                            apellido</label>
                        <input type="text" name="surname_first" id="surname_first"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('surname_first') }}"
                            placeholder="Guzmán">
                    </div>

                    {{-- surname_second --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="surname_second" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Segundo
                            apellido</label>
                        <input type="text" name="surname_second" id="surname_second"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('surname_second') }}"
                            placeholder="Torres">
                    </div>

                    {{-- dni --}}
                    <div  class="col-span-2 md:col-span-1">
                        <label for="dni"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                        <input type="text" name="dni" id="dni"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('dni') }}" placeholder="00000000A">
                    </div>

                    {{-- birthdate --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                            nacimiento</label>
                        <input type="date" name="birthdate" id="birthdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            max={{ $today }}
                            value="{{ old('birthdate') }}">
                    </div>

                    {{-- bio --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="bio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biografía</label>
                        <textarea name="bio" id="bio"
                            class="bg-gray-50 border max-h-48 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            rows="9" style="min-height: 4rem"></textarea>
                    </div>

                    {{-- avatar --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="avatar"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avatar</label>
                        <input type="file" name="avatar" class="dropify" data-height="178">
                    </div>

                    <div class="border-b col-span-2 mt-5">
                        <p class="text-md font-medium text-blue-700">Datos de usuario</p>
                    </div>

                    {{-- email --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('email') }}" placeholder="gloria02@gmail.com">
                    </div>

                    {{-- roles --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="roles" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                        <select name="roles" id="roles"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($roles as $role)
                                <option
                                    @if($role == 'client') selected @endif
                                    value="{{ $role }}">{{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-fit sm:w-auto mt-6 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Crear usuario</button>
                </div>
            </form>
        </div>
        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/users/create.js') }}"></script>
@endsection
