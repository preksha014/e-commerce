@props(['active' => false])

<a {{ $attributes->merge([
        'class' => 'block rounded-md px-4 py-2 ' . ($active ? 'bg-violet-700 text-white' : 'text-white hover:bg-violet-700 hover:text-white')
    ]) }} 
    aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>
