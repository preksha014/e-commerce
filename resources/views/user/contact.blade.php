<x-layout>
    <x-slot:heading>Contact Us</x-slot:heading>
        @include('partials.banner')

{{-- 
        <!-- BG Image  -->

        <div class="relative">
          <img
            class="w-full object-cover brightness-50 filter lg:h-[500px]"
            src="./assets/images/contact-bg.jpeg"
            alt="Iphone with Macbook image"
          />

          <div
            class="absolute top-1/2 left-1/2 mx-auto flex w-11/12 max-w-[1200px] -translate-x-1/2 -translate-y-1/2 flex-col text-center text-white lg:ml-5"
          >
            <h1 class="text-4xl font-bold sm:text-5xl">Contact us</h1>
            <p class="mx-auto pt-3 text-xs lg:w-3/5 lg:pt-5 lg:text-base">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit.
              Consequatur aperiam natus, nulla, obcaecati nesciunt, itaque
              adipisci earum ducimus pariatur eaque labore.
            </p>
          </div>
        </div>

        <!-- /BG IMAGE  -->
      </div> --}}

        <!-- Contact section  -->

        <section class="mx-auto my-5 text-center">
          <h2 class="text-3xl font-bold">Have another question?</h2>
          <p>Complete the form below</p>
        </section>

        <!-- Form  -->

        <form class="mx-auto my-5 max-w-[600px] px-5 pb-10" action="">
          <div class="mx-auto">
            <div class="my-3 flex w-full gap-2">
              <input
                class="w-1/2 border px-4 py-2"
                type="email"
                placeholder="E-mail"
              />
              <input
                class="w-1/2 border px-4 py-2"
                type="text"
                placeholder="Full Name"
              />
            </div>
          </div>

          <select
            class="mb-3 w-full border px-4 py-2"
            name="pets"
            id="pet-select"
          >
            <option value="">Please choose a category</option>
            <option value="delivery">Delivery</option>
            <option value="support">Support</option>
            <option value="profile">Profile</option>
            <option value="careers">Careers</option>
            <option value="another">Another category</option>
          </select>

          <textarea
            class="w-full border px-4 py-2"
            placeholder="Write a commentary..."
            name=""
            id=""
          ></textarea>

          <div
            class="lg:items:center container mt-4 flex flex-col justify-between lg:flex-row"
          >
            <div class="flex items-center">
              <input class="mr-3" type="checkbox" />
              <label for="checkbox">
                I have read and agree with
                <a href="#" class="text-violet-900">terms &amp; conditions</a>
              </label>
            </div>
            <button class="my-3 bg-amber-400 px-4 py-2 lg:my-0">
              Send Message
            </button>
          </div>
        </form>

        <!-- /Form  -->
      </section>
</x-layout>
