@props(['block'])   
<div class="relative">
    {{-- <img class="w-full object-cover brightness-50 filter lg:h-[500px]" src="{{ asset($image) }}" alt="Banner image" /> --}}

    {{-- {{ $slot }} --}}

    {!! $block->content !!}
</div>