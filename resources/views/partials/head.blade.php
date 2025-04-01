<!-- Header -->
<header class="mx-auto flex h-16 max-w-[1200px] items-center justify-between px-5">
  <a href="/">
    <img class="cursor-pointer sm:h-auto sm:w-auto" src="{{ asset('src/assets/images/company-logo.svg') }}"
      alt="company logo" />
  </a>

  <form id="search-form" class="relative hidden h-9 w-2/5 items-center border border-gray-200 md:flex transition-all duration-200 ease-in-out focus-within:border-blue-500" autocomplete="off" data-debug="search-form">
    <!-- Search Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="mx-3 h-4 w-4 text-gray-500">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
    </svg>
  
    <!-- Search Input -->
    <input 
      id="search-input" 
      name="query" 
      class="w-full outline-none bg-transparent placeholder-gray-400 text-gray-800 focus:ring-0" 
      type="search" 
      placeholder="Search for products..." 
      value="{{ $query ?? '' }}" 
      data-debug="search-input"
    />
  
    <!-- Search Results Dropdown -->
    <div 
      id="search-results" 
      class="absolute left-0 right-0 top-full z-50 mt-1 hidden max-h-96 overflow-y-auto bg-white shadow-lg rounded-md border border-gray-100"
      data-debug="search-results"
    ></div>
  </form>

  @auth('customer')
  <div class="hidden gap-3 md:!flex">
    <a href="{{ route('wishlist.index') }}" class="flex cursor-pointer flex-col items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
      </svg>

      <p class="text-xs">Wishlist</p>
    </a>

    <a href="{{ route('cart.view') }}" class="relative flex cursor-pointer flex-col items-center justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
        <path fill-rule="evenodd"
          d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 004.25 22.5h15.5a1.875 1.875 0 001.865-2.071l-1.263-12a1.875 1.875 0 00-1.865-1.679H16.5V6a4.5 4.5 0 10-9 0zM12 3a3 3 0 00-3 3v.75h6V6a3 3 0 00-3-3zm-3 8.25a3 3 0 106 0v-.75a.75.75 0 011.5 0v.75a4.5 4.5 0 11-9 0v-.75a.75.75 0 011.5 0v.75z"
          clip-rule="evenodd" />
      </svg>
      <span id="cart-count"
        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"
        style="{{ isset($cart_count) && $cart_count > 0 ? '' : 'display: none;' }}">
        {{ $cart_count ?? 0 }}
      </span>
      <p class="text-xs">Cart</p>
    </a>

    <a href="{{ route('account.profile') }}" class="relative flex cursor-pointer flex-col items-center justify-center">
      <span class="absolute bottom-[33px] right-1 flex h-2 w-2">
        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex h-2 w-2 rounded-full bg-red-500"></span>
      </span>

      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="h-6 w-6">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
      </svg>

      <p class="text-xs">Account</p>
    </a>
    @endauth
  </div>
</header>
<!-- /Header -->