@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full px-4 py-2 text-sm font-medium leading-5 text-gray-900 bg-gray-200 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full px-4 py-2 text-sm font-medium leading-5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:text-gray-900 focus:bg-gray-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
