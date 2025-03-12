@props(['activeColumn' => null])

<table class="hidden lg:table w-full border-collapse">
    <thead class="h-16 bg-neutral-100">
        <tr>
            @foreach (['address' => 'ADDRESS', 'payment' => 'PAYMENT METHOD', 'order' => 'ORDER REVIEW'] as $key => $label)
                <th class="px-6 py-3 text-left font-bold uppercase text-black 
                           {{ $activeColumn === $key ? 'bg-gray-700 text-white' : 'bg-neutral-100' }}"
                    aria-current="{{ $activeColumn === $key ? 'page' : 'false' }}">
                    {{ $label }}
                </th>
            @endforeach
        </tr>
    </thead>
</table>
