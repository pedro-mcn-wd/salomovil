@extends('layouts.general.main')
@section('title', 'Perfil')

@section('content')
    <div class="flex-grow h-full w-full lg:max-w-screen-lg lg:-min-w-screen-lg mx-auto px-4 xl:px-0">
        {{-- Avatar --}}
        <div class="flex justify-center mb-14 mt-5">
            <div class="rounded-full w-60 h-60 bg-blue-100 flex justify-center items-center mt-4">
                @if (Auth::user()->getFirstMedia('users_avatar'))
                    <img class="rounded-full w-60 h-60" src="{{ Auth::user()->getFirstMediaUrl('users_avatar') }}" alt="avatar">
                @else
                    <span class="text-white text-8xl">
                        {{ Initials::initials($profile->name) }}
                    </span>
                @endif
            </div>
        </div>
        {{-- Personal Information --}}
        <div class="relative overflow-x-auto rounded-lg shadow-md w-full">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption
                    class="px-6 py-4 text-lg font-semibold bg-blue-100 text-left text-blue-900 dark:text-white dark:bg-gray-800">
                    Información personal
                    <span class="float-right text-sm">
                        <a href="{{ route('profiles.edit', Auth::user()->userProfile->id) }}"
                            class="font-medium text-green-600 hover:text-white bg-white hover:bg-green-600 rounded-lg shadow py-1 px-2 inline-block align-middle">Editar</a>
                        </a>
                    </span>
                </caption>

                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1">
                            Nombre
                        </th>
                        <td class="px-6 py-4">
                            {{ $profile->name }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Apellidos
                        </th>
                        <td class="px-6 py-4">
                            {{ $profile->surname_first }} {{ $profile->surname_second }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            DNI
                        </th>
                        <td class="px-6 py-4">
                            {{ $profile->dni }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Fecha de nacimiento
                        </th>
                        <td class="px-6 py-4">
                            @if ($profile->birthdate != null)
                                {{ $birthdate }}
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white align-top">
                            Biografía
                        </th>
                        <td class="px-6 py-4  break-words">
                            {{ $profile->bio }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Email
                        </th>
                        <td class="px-6 py-4">
                            {{ Auth::user()->email }}
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>

    </div>
    @include('layouts.msg.success')
    @include('layouts.msg.error')
@endsection
