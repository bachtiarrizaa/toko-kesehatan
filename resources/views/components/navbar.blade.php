<header class="sticky top-0 z-50 bg-white" x-data="{ isOpen: false, isUserOpen: false}">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 border-b border-grey-700" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-20 md:h-20 w-auto sm:h-12" src="{{ asset('assets/images/logo/careline.png') }}" alt="">
        </a>
      </div>
      <div class="flex lg:hidden">
        <button @click="isOpen = !isOpen" type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          {{-- <span class="sr-only">Open main menu</span> --}}
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:flex-col items-center gap-4"> 
        <div class="flex gap-x-12">
          <a href="{{ route('home') }}" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Beranda</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Tentang Kami</a>
          <a href="{{ route('product.index') }}" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Produk</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Lokasi</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Kontak</a>
        </div>
    
        <!-- Search bar -->
        <div class="relative w-full flex justify-center">
          <form class="flex items-center w-full max-w-sm">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
              <input type="search" id="simple-search" class="w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari produk" required>
              <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Search
              </button>
            </div>
          </form>
        </div>        
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center">
        @if (Auth::check())
          <div>
            <div class="flex items-center">
              <a href="{{ route('cart.index') }}" class="text-2xl mr-3">
                <svg class="w-[45px] h-[45px] text-gray-800 dark:text-white hover:text-primary-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                </svg>
              </a>              
              <div class="relative hover:text-primary-700">
                <div>
                  <button @click="isUserOpen = !isUserOpen" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-grey focus:ring-offset-2 focus:ring-offset-grey-400" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">Open user menu</span>
                    <img class="h-10 w-auto rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                  </button>
                </div>
    
                <!--
                  Dropdown menu, show/hide based on menu state.
    
                  Entering: "transition ease-out duration-100"
                    From: "transform opacity-0 scale-95"
                    To: "transform opacity-100 scale-100"
                  Leaving: "transition ease-in duration-75"
                    From: "transform opacity-100 scale-100"
                    To: "transform opacity-0 scale-95"
                -->
                <div
                x-show="isUserOpen"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                  <!-- Active: "bg-gray-100", Not Active: "" -->
                  <a href="{{ route('profile') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                  <a href="{{ route('history-order') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">History Order</a>
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                  </form>
                </div>
              </div>
              <h2 class="ml-2 text-base font-normal text-gray-900">{{ Auth::user()->username }}</h2>
            </div>
          </div>
        @else
          <a href="{{ route('cart.index') }}" class="text-2xl hover:text-primary-700 mr-4">
              <ion-icon name="cart-outline"></ion-icon>
          </a>
          <a href="{{ route('login') }}" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Sign in <span aria-hidden="true">&rarr;</span></a>
        @endif
        </div>    
    </nav>

    <!-- Mobile menu, show/hide based on menu open state. -->
    <div x-show="isOpen" class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-10"></div>
      <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
            <img class="h-20 w-auto" src="{{ asset('assets/images/logo/careline.png') }}" alt="">
          </a>
          <button @click="isOpen = !isOpen" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <!-- Search bar -->
        <div class="relative w-full flex justify-center mt-4">
          <form class="flex items-center w-full max-w-sm">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
              <input type="search" id="simple-search" class="w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Cari produk" required>
              <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Search
              </button>
            </div>
          </form>
        </div>
        <div class="mt-4 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="{{ route('home') }}" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Beranda</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Tentang Kami</a>
              <a href="{{ route('product.index') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Produk</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Lokasi</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Kontak</a>
            </div>

            <div class="flex justify-center items-center py-4">
              @if (Auth::check())
                <div class="flex items-center justify-center ">
                  <a href="{{ route('cart.index') }}" class="text-2xl hover:text-primary-700">
                    {{-- <ion-icon name="cart-outline"></ion-icon> --}}
                    <svg class="w-[45px] h-[45px] text-gray-800 dark:text-white hover:text-primary-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                    </svg>
                  </a>
                  <div class="mx-4">
                    |
                  </div>
                  <div class="relative">
                    <div>
                      <button @click="isUserOpen = !isUserOpen" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-grey focus:ring-offset-2 focus:ring-offset-grey-400" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-auto rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                      </button>
                    </div>
        
                    <!--
                      Dropdown menu, show/hide based on menu state.
        
                      Entering: "transition ease-out duration-100"
                        From: "transform opacity-0 scale-95"
                        To: "transform opacity-100 scale-100"
                      Leaving: "transition ease-in duration-75"
                        From: "transform opacity-100 scale-100"
                        To: "transform opacity-0 scale-95"
                    -->
                    <div
                    x-show="isUserOpen"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                      <!-- Active: "bg-gray-100", Not Active: "" -->
                      <a href="{{ route('profile') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                      <a href="{{ route('history-order') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">History Order</a>
                      <a href="{{ route('logout') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                      </form>
                    </div>
                  </div>
                  {{-- <h2 class="ml-2 text-base font-normal text-gray-900">{{ Auth::user()->username }}</h2> --}}
                </div>
              @else
                <a href="{{ route('cart.index') }}" class="text-2xl hover:text-primary-700 mr-4">
                  <ion-icon name="cart-outline"></ion-icon>
                </a>
                <div class="mx-8">
                  |
                </div>
                <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:text-primary-700">Sign In <span aria-hidden="true">&rarr;</span></a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>