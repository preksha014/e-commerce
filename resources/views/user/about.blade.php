<x-layout>
  <x-slot:heading>About Us</x-slot:heading>
  {{-- <x-banner :block="getBannerBlock('banner-about')" /> --}}
  <x-banner :image="'src/assets/images/about-us-bg.jpeg'">
    <div
      class="absolute top-1/2 left-1/2 mx-auto flex w-11/12 max-w-[1200px] -translate-x-1/2 -translate-y-1/2 flex-col text-center text-white lg:ml-5">
      <h1 class="text-4xl font-bold sm:text-5xl">About Us</h1>
      <p class="mx-auto pt-3 text-xs lg:w-3/5 lg:pt-5 lg:text-base">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
        Consequatur aperiam natus, nulla, obcaecati nesciunt, itaque
        adipisci earum ducimus pariatur eaque labore.
      </p>
    </div>
    </div>
  </x-banner>
  <section class="flex-grow">
    <div class="mt-6 flex flex-col gap-3">
      <img class="mx-auto w-[200px]" src="{{ asset('src/assets/images/company-logo.svg')}}" alt="Maybell Logo" />
      <p class="text-center text-sm">Since 1999</p>
    </div>

    <div class="mx-auto my-10 flex max-w-[600px] flex-col items-center justify-center px-5">
      <h2 class="w-full text-left text-xl font-bold">Our Mission:</h2>
      <p class="py-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
        placeat odit, est eum dolorem esse totam iusto necessitatibus
        eligendi illo doloribus vero aperiam atque tempora repudiandae
        molestiae nemo distinctio quisquam!
      </p>
      <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
        <img class="object-cover" src="{{ asset('src/assets/images/mission-family.jpg')}}"
          alt="Family in living room" />
        <img class="object-cover" src="{{ asset('src/assets/images/mission-interior.jpg')}}" alt="Interior" />
        <img class="object-cover" src="{{ asset('src/assets/images/mission-materials.jpg')}}" alt="Materials" />
      </div>
      <p class="py-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
        placeat odit, est eum dolorem esse totam iusto necessitatibus
        eligendi illo doloribus vero aperiam atque tempora repudiandae
        molestiae nemo distinctio quisquam!
      </p>

      <h2 class="mt-3 w-full text-left text-xl font-bold">Our Vision:</h2>
      <p class="py-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
        placeat odit, est eum dolorem esse totam iusto necessitatibus
        eligendi illo doloribus vero aperiam atque tempora repudiandae
        molestiae nemo distinctio quisquam!
      </p>

      <h2 class="mt-3 w-full text-left text-xl font-bold">Our Values:</h2>
      <p class="py-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum
        placeat odit, est eum dolorem esse totam iusto necessitatibus
        eligendi illo doloribus vero aperiam atque tempora repudiandae
        molestiae nemo distinctio quisquam!
      </p>
      <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
        <img class="object-cover" src="{{ asset('src/assets/images/mission-family.jpg')}}"
          alt="Family in living room" />
        <img class="object-cover" src="{{ asset('src/assets/images/mission-interior.jpg')}}" alt="Interior" />
        <img class="object-cover" src="{{ asset('src/assets/images/mission-materials.jpg')}}" alt="Materials" />
      </div>
    </div>
  </section>
</x-layout>