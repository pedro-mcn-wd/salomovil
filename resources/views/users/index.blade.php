@extends('layouts.general.main')
@section('title', 'Listado de usuarios')

@section('content')
    <div class="flex-grow h-full w-full px-2 mdpx-4 xl:px-0 xl:max-w-screen-xl xl:-min-w-screen-xl mx-auto">
        @include('layouts.general.tabs')
        @include('layouts.modals.delete')

        <div class="flex items-center md:hidden mt-5">
            {{-- download list pdf --}}
            <form action="{{ route('users.pdf') }}" method="POST">
                @csrf
                @method('GET')

                <input type="hidden" name="name" value="{{ $old_values['values_filters']['name'] }}">
                <input type="hidden" name="surname_first" value="{{ $old_values['values_filters']['surname_first'] }}">
                <input type="hidden" name="surname_second" value="{{ $old_values['values_filters']['surname_second'] }}">
                <input type="hidden" name="email" value="{{ $old_values['values_filters']['email'] }}">
                <input type="hidden" name="dni" value="{{ $old_values['values_filters']['dni'] }}">
                <input type="hidden" name="role" value="{{ $old_values['values_filters']['role'] }}">

                <button type="submit" class="flex items-center">
                    <div
                        class="flex items-center justify-end cursor-pointer text-blue-600 rounded-lg shadow bg-blue-100 border border-blue-200 py-1.5 pr-2 pl-3 hover:text-white hover:bg-blue-600">
                        <span class="text-sm">{{ __('PDF') }}</span>
                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25">
                            </path>
                        </svg>
                    </div>
                </button>
            </form>

            {{-- filters --}}
            @include('users.includes.filters_sm')
        </div>

        <div class="static overflow-x-auto mt-5 lg:mt-10 shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left text-gray-500 rounded-b-lg shadow" id="table_list">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-100 text-left text-blue-900 rounded-t-lg">
                    <span class="flex items-center justify-between">
                        <span class="mr-5">Listado de usuarios</span>

                        <div class="hidden md:flex items-center">
                            {{-- download list pdf --}}
                            <form action="{{ route('users.pdf') }}" method="POST">
                                @csrf
                                @method('GET')

                                <input type="hidden" name="name" value="{{ $old_values['values_filters']['name'] }}">
                                <input type="hidden" name="surname_first" value="{{ $old_values['values_filters']['surname_first'] }}">
                                <input type="hidden" name="surname_second" value="{{ $old_values['values_filters']['surname_second'] }}">
                                <input type="hidden" name="email" value="{{ $old_values['values_filters']['email'] }}">
                                <input type="hidden" name="dni" value="{{ $old_values['values_filters']['dni'] }}">
                                <input type="hidden" name="role" value="{{ $old_values['values_filters']['role'] }}">

                                <button type="submit" class="flex items-center">
                                    <div
                                        class="flex items-center justify-end cursor-pointer text-blue-600 rounded-lg shadow bg-white py-1 pr-2 pl-3 hover:text-white hover:bg-blue-600">
                                        <span class="text-sm">{{ __('PDF') }}</span>
                                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3 3m0 0l3-3m-3 3V2.25">
                                            </path>
                                        </svg>
                                    </div>
                                </button>
                            </form>

                            {{-- filters --}}
                            @include('users.includes.filters_md')
                        </div>
                    </span>
                </caption>
                @if ($users->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Apellidos
                            </th>
                            <th scope="col" class="px-6 py-3">
                                DNI
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rol
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b hover:bg-gray-100 m-4">

                                {{-- name --}}
                                <td scope="row" class="flex items-center px-6 py-3 whitespace-nowrap">
                                    <div
                                        class="relative w-11 h-11 overflow-hidden bg-blue-200 rounded-full mr-3 flex justify-center items-center">
                                        @if ($user->getFirstMedia('users_avatar'))
                                            <img class="rounded-full w-11 h-11"
                                                src="{{ $user->getFirstMediaUrl('users_avatar') }}" alt="avatar">
                                        @else
                                            <span class="text-white text-base">
                                                {{ Initials::initials($user->userProfile->name) }}
                                            </span>
                                        @endif
                                    </div>
                                    {{ $user->userProfile->name }}
                                </td>

                                {{-- surname --}}
                                <td class="px-6 whitespace-nowrap">
                                    {{ $user->userProfile->surname_first }}
                                    {{ $user->userProfile->surname_second }}
                                </td>

                                {{-- dni --}}
                                <td class="px-6 whitespace-nowrap">
                                    {{ $user->userProfile->dni }}
                                </td>

                                {{-- role --}}
                                <td class="px-6 whitespace-nowrap">
                                    @foreach ($user->getRoleNames() as $roleName)
                                        {{ $roleName }}
                                    @endforeach
                                </td>

                                {{-- actions --}}
                                <td class="px-6 py-4 text-right">
                                    @include('layouts.buttons.dropdown_index', [
                                        'model_id' => $user->id,
                                        'route_show' => 'users.show',
                                        'route_edit' => 'users.edit',
                                    ])
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody class="p-4 text-md font-semibold text-blue-900">
                        <tr class="bg-white border-b">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap">
                                No hay usuarios coincidentes.
                            </td>
                        </tr>
                    </tbody>
                @endif
            </table>
        </div>
        <div class="px-4 py-2 mt-3">
            {!! $users->links() !!}
        </div>
        @include('layouts.msg.success')
        @include('layouts.msg.error')
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/users/index.js') }}"></script>
@endsection
