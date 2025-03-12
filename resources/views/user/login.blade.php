<x-layout>
    <x-slot:heading>Login</x-slot:heading>

    <!-- Login card  -->
    <section class="mx-auto flex-grow w-full mt-10 mb-10 max-w-[1200px] px-5">
        <div class="container mx-auto border px-5 py-5 shadow-sm md:w-1/2">
          <div class="">
            <p class="text-4xl font-bold">LOGIN</p>
            <p>Welcome back, customer!</p>
          </div>

          <form class="mt-6 flex flex-col">
            <label for="email">Email Address</label>
            <input
              class="mb-3 mt-3 border px-4 py-2"
              type="email"
              placeholder="youremail@domain.com"
            />

            <label for="email">Password</label>
            <input
              class="mt-3 border px-4 py-2"
              type="password"
              placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
            />
          </form>

          <button class="my-5 w-full bg-violet-900 py-2 text-white">
            LOGIN
          </button>

          <p class="text-center">
            Don`t have account?
            <a href="/signup" class="text-violet-900">Register now</a>
          </p>
        </div>
      </section>
      <!-- /Login Card  -->
</x-layout>