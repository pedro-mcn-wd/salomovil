<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
    <ul class="flex flex-wrap -mb-px">

        @if (Route::current()->uri == 'users' || Route::current()->uri == 'users/create' || Route::current()->uri == 'users_trashed')
            <li class="mr-2">
                <a href="{{ route('users.index') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'users.index') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Listado</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('users.create') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'users.create') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Crear usuario</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('users.trashed') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'users.trashed') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Usuarios eliminados</a>
            </li>

        @elseif (Route::current()->uri == 'categories' || Route::current()->uri == 'categories/create' || Route::current()->uri == 'categories_trashed')

            <li class="mr-2">
                <a href="{{ route('categories.index') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'categories.index') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Listado</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('categories.create') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'categories.create') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Crear categoría</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('categories.trashed') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'categories.trashed') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Categorías eliminadas</a>
            </li>

        @elseif (Route::current()->uri == 'products' || Route::current()->uri == 'products/create' || Route::current()->uri == 'products_trashed')

            <li class="mr-2">
                <a href="{{ route('products.index') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'products.index') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Listado</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('products.create') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'products.create') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Crear producto</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('products.trashed') }}" class="inline-block p-4 hover:text-blue-600 hover:border-blue-600 hover:rounded-t-lg hover:border-b-2 @if(Route::currentRouteName() == 'products.trashed') text-blue-600 border-b-2 border-blue-600 rounded-t-lg active @endif dark:text-blue-500 dark:border-blue-500" aria-current="page">Productos eliminados</a>
            </li>

        @endif

    </ul>
</div>

