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
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="{{ route('wishlist.index') }}">
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                        </svg>
                        Wishlist
                    </span>
                </a>
                <span class="text-white">&#124;</span>
                <a class="font-light text-white duration-100 hover:text-yellow-400 hover:underline" href="/logout">Logout</a>
            </div>
        @endauth

    </div>
</nav>
<!-- /Nav bar -->