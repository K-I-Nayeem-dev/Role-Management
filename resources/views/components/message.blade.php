@if (Session::has('success'))
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="text-sm  text-gray-950 dark:text-black  bg-green-200 border-green-400 mt-2 py-3 text-center rounded mb-3 ease-linear">{{ __(Session::get('success')) }}</p>
@endif

@if (Session::has('error'))
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-900 dark:text-black  bg-red-300 border-red-400 mt-2 py-3 text-center rounded mb-3 ease-linear">{{ __(Session::get('error')) }}</p>
@endif

{{-- @if (Session::has('edit-permission'))
    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
        class="text-sm text-gray-600 dark:text-gray-400  bg-green-200 border-green-400 mt-2 py-3 text-center rounded mb-3 ease-linear">{{ __(Session::get('edit-permission')) }}</p>
@endif --}}
