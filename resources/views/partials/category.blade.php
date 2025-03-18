<!-- /Cons bages  -->

<h2 class="mx-auto mb-5 mt-10 max-w-[1200px] px-5">SHOP BY CATEGORY</h2>

<!-- Categories -->
<section class="mx-auto grid max-w-[1200px] grid-cols-2 px-5 lg:grid-cols-3 lg:gap-5">
  <!-- 1 -->

  @foreach ($categories as $category)
    <a href="{{ route('category.show', $category->slug) }}">
        <div class="relative cursor-pointer">
            <img class="mx-auto h-auto w-auto brightness-50 duration-300 hover:brightness-100"
                 src="{{ asset('storage/' . $category->image) }}" alt="Category image" />

            <p class="pointer-events-none absolute top-1/2 left-1/2 w-11/12 -translate-x-1/2 -translate-y-1/2 text-center text-white lg:text-xl">
                {{ $category->name }}
            </p>
        </div>
    </a>
@endforeach

</section>
<!-- /Categories  -->