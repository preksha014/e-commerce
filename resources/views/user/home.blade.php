<x-layout>
  <x-slot:heading>MayBell - Online furniture store</x-slot:heading>
    @include('partials.banner')
    @include('partials.category')
    @include('partials.products')

    {{-- <x-product-list :product></x-product-list> --}}
</x-layout>