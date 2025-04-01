<!-- Nav bar -->
<!-- hidden on small devices -->

<nav class="relative bg-violet-900">
    <div class="mx-auto hidden h-12 w-full max-w-[1200px] items-center md:flex">
        <div class="mx-7 flex gap-8">
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/">Home</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline"
                href="/catalog">Catalog</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/about">About
                Us</a>
            <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/contact">Contact
                Us</a>
        </div>

        @guest('customer')
            <div class="ml-auto flex gap-4 px-5">
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/login">Login</a>

                <span class="text-white">&#124;</span>

                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/signup">Sign
                    Up</a>
            </div>
        @endguest

        @auth('customer')
            <div class="ml-auto flex gap-4 px-5">
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/logout">Logout</a>
            </div>
        @endauth

    </div>
</nav>
<!-- /Nav bar -->