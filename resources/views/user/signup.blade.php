<x-layout>
    <x-slot:heading>Sign Up</x-slot:heading>

    <!-- Register card  -->
    <section class="mx-auto mt-10 w-full flex-grow mb-10 max-w-[1200px] px-5">
      <div class="container mx-auto border px-5 py-5 shadow-sm md:w-1/2">
        <div class="">
          <p class="text-4xl font-bold">CREATE AN ACCOUNT</p>
          <p>Register for new customer</p>
        </div>

        <form class="mt-6 flex flex-col" method="POST" action="/signup">
          @csrf
          <label for="name">Full Name</label>
          <input
            class="mb-3 mt-3 border px-4 py-2"
            type="text"
            name="name"
            :value="old($name)"
            placeholder="Bogdan Bulakh"
          />

          @error('name')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror

          <label class="mt-3" for="email">Email Address</label>
          <input
            class="mt-3 border px-4 py-2"
            type="email"
            name="email"
            :value="old($name)"
            placeholder="user@mail.com"
          />

          @error('email')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror

          <label class="mt-5" for="password">Password</label>
          <input
            class="mt-3 border px-4 py-2"
            type="password"
            name="password"
            :value="old($name)"
            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
          />
          @error('password')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror

          <label class="mt-5" for="password_confirmation">Confirm password</label>
          <input
            class="mt-3 border px-4 py-2"
            type="password"
            name="password_confirmation"
            :value="old($name)"
            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
          />

          @error('password_confirmation')
            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
          @enderror

          <button class="my-5 w-full bg-violet-900 py-2 text-white">
            CREATE ACCOUNT
          </button>
          
        </form>

        <p class="text-center">
          Already have an account?
          <a href="/login" class="text-violet-900">Login now</a>
        </p>
      </div>
    </section>
    <!-- /Register Card  -->
</x-layout>