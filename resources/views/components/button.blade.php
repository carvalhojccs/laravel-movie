@props([
    'danger' => null,
    'primary' => null,
])
<button type = 'submit'
{{
$attributes->class([
    'inline-flex items-center px-4 py-2 border border-transparent rounded-md uppercase tracking-widest  dark:focus:ring-offset-gray-800 transition ease-in-out duration-150',
    'font-semibold text-xs text-white dark:text-gray-800',
    'dark:bg-gray-200 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300',
    'hover:bg-gray-700 bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
    'bg-red-800 hover:bg-red-500' => $danger,
    'bg-green-800 hover:bg-green-500' => $primary

    ]) }}>
    {{ $slot }}
</button>
