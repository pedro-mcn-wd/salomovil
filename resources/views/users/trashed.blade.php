@extends('layouts.general.main')
@section('title', 'Listado de usuarios eliminados')

@section('content')
    <div class="flex-grow h-full w-full px-2 mdpx-4 xl:px-0 xl:max-w-screen-xl xl:-min-w-screen-xl mx-auto">
        @include('layouts.general.tabs')
        @if ($users->count())
            @include('layouts.modals.forceDelete')
            @include('layouts.modals.deleteAll')
            @include('layouts.modals.restoreAll')
        @endif

        <div class="flex items-center lg:hidden mt-5 -ml-5">
            @include('users.includes.filters_sm')
        </div>

        <div class="static overflow-x-auto mt-5 lg:mt-10 shadow rounded-lg">
            <table class="table-auto w-full text-sm text-left shadow rounded-b-lg text-gray-500 dark:text-gray-400">
                <caption class="px-6 py-4 text-lg font-semibold bg-blue-100 text-left text-blue-900 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <span class="mr-5">{{ __('Listado de usuarios eliminados') }}</span>
                        <div class="flex items-center justify-end">

                            {{-- filters --}}
                            <div class="hidden md:flex">
                                @include('users.includes.filters_md')
                            </div>
                            {{-- buttons restoreAll & deleteFordeall --}}
                            @if ($users->count())
                                <div class="ml-5">
                                    @include('layouts.buttons.dropdown_all_trashed',[
                                        'route_restore_all' => 'users.restoreAll',
                                        'route_delete_all' => 'users.forceDeleteAll'
                                    ])
                                </div>
                            @endif
                        </div>
                    </div>
                </caption>

                @if ($users->count())
                    <thead class="text-xs text-blue-900 uppercase bg-blue-50 dark:bg-gray-700 dark:text-gray-400">
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
                            <th scope="col" class="px-6 py-3 text-end w-60">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr class="bg-white border-b hover:bg-gray-100">
                                <td scope="row" class="px-6 py-4 whitespace-nowrap dark:text-white">
                                    {{ $user->userProfile->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                                    {{ $user->userProfile->surname_first }} {{ $user->userProfile->surname_second }}
                                </td>
                                <td scope="row" class="px-6 py-4 whitespace-nowrap dark:text-white">
                                    {{ $user->userProfile->dni }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap dark:text-white">
                                    @foreach ($user->getRoleNames() as $roleName)
                                        {{ $roleName }}
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @include('layouts.buttons.dropdown_one_trashed',['model_id'=>$user->id, 'route' => 'users.restore'])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody class="p-4 text-md font-semibold text-blue-900">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row" class="px-6 py-4 whitespace-nowrap dark:text-white">
                                No hay usuarios eliminados.
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
    <script src="{{ asset('js/users/trashed.js') }}"></script>
@endsection
