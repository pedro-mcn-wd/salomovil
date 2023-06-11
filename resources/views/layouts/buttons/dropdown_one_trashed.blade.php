<button type="button"  id="{{ 'dropdown_actions_' . $model_id }}"
    data-dropdown-toggle="{{ 'dropdownDots_' . $model_id }}" data-dropdown-placement="bottom"
    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg hover:bg-white">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
        </path>
    </svg>
</button>

<!-- Dropdown menu -->
<div id="{{ 'dropdownDots_' . $model_id }}"
    class="z-10 hidden bg-white rounded-xl shadow w-34">
    <ul class="text-sm text-gray-700 rounded-lg divide-y border"
        aria-labelledby="{{ 'dropdown_actions_' . $model_id }}">
        <li>
            <a href="{{ route($route, $model_id) }}"
                class="block rounded-t-lg px-4 py-2 hover:bg-green-200 text-green-700 font-medium">{{ __('Restaurar') }}
            </a>
        </li>
        <li>
            <button type="button" value="{{ $model_id }}"
                data-modal-target="modal_forceDelete"
                class="btn-forceDelete block px-4 py-2 hover:bg-red-200 w-full text-end rounded-b-lg text-red-700 font-medium">
                {{ __('Eliminar permanentemente') }}
            </button>
        </li>
    </ul>
</div>
