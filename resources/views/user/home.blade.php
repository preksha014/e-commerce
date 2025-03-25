<x-layout>
  <x-slot:heading>MayBell - Online furniture store</x-slot:heading>
  <x-banner :block="getBannerBlock('banner-home')" />
  @include('partials.category')
  @include('partials.products')
</x-layout>