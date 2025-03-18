@props(['products'])

<!-- /Special offer card -->
<p class="mx-auto mt-10 mb-5 max-w-[1200px] px-5">RECOMMENDED FOR YOU</p>

<!-- Recommendations -->
<section class="mx-auto grid max-w-[1200px] grid-cols-2 gap-3 px-5 pb-10 lg:grid-cols-4">
    <x-product-list :products="$products" />
</section>
<!-- /Recommendations -->