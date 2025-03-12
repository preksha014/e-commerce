@include('partials.meta')

<x-slot:heading>Login</x-slot:heading>
<!-- Login card  -->
<section class="mx-auto flex-grow w-full mt-10 mb-10 max-w-[1200px] px-5">
    <div class="container mx-auto border px-5 py-5 shadow-sm md:w-1/2">
        <div class="">
            <p class="text-4xl font-bold">LOGIN</p>
            <p>Welcome back </p>
        </div>

        <form class="mt-6 flex flex-col" method="POST" action="/admin/login">
            @csrf
            <label for="email">Email Address</label>
            <input class="mb-3 mt-3 border px-4 py-2" type="email" placeholder="youremail@domain.com" name="email" />
            @error('email')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror

            <label for="email">Password</label>
            <input class="mt-3 border px-4 py-2" type="password"
                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;" name="password" />
                
            @error('password')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
            @enderror

            <button type="submit" class="my-5 w-full bg-violet-900 py-2 text-white">
                LOGIN
            </button>
        </form>

       
    </div>
</section>
<!-- /Login Card  -->