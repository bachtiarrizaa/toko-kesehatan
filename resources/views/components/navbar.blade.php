<header class="sticky top-0 z-50 bg-white" x-data="{ isOpen: false, isUserOpen: false}">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8 border-b border-grey-700" aria-label="Global">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
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
          <a href="{{ route('home') }}" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Home</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Category</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Shop</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">About</a>
          <a href="#" class="text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Contact</a>
        </div>
    
        <!-- Search bar -->
        <div class="relative w-full max-w-xs">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-gray-700 bg-white border rounded-lg focus:border-primary-700 focus:outline-none focus:ring focus:ring-primary-300 focus:ring-opacity-40">
          
          <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            <ion-icon name="search-outline"></ion-icon>
          </div>
        </div>

      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center">
        @if (Auth::check())
          <div>
            <div class="flex items-center">
              {{-- <h2 class="ml-2 text-base font-semibold text-gray-900 hover:text-indigo-600">{{ Auth::user()->username }}</h2> --}}
              <a href="#" class="text-2xl hover:text-primary-700 mr-4">
                <ion-icon name="cart-outline"></ion-icon>
              </a>
              <div class="relative ml-3 hover:text-primary-700">
                <div>
                  <button @click="isUserOpen = !isUserOpen" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-400" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
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
                  <a href="#" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                  <a href="#" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                  </form>
                </div>
              </div>
              <h2 class="ml-2 text-base font-semibold text-gray-900 hover:text-primary-400">{{ Auth::user()->username }}</h2>
            </div>
          </div>
        @else
          <a href="#" class="text-2xl hover:text-primary-700 mr-4">
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
        <div class="relative mt-6">
          <input 
            type="text" 
            placeholder="Search..." 
            class="w-full rounded-lg border border-gray-300 py-2 pl-4 pr-10 text-sm text-gray-900 placeholder-gray-400 focus:border-primary-700 focus:outline-none focus:ring focus:ring-primary-200 focus:ring-opacity-40" 
          />
          <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <ion-icon name="search-outline"></ion-icon>
          </div>
        </div>
        <div class="mt-4 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Home</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Category</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Shop</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">About</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-lg font-normal text-gray-900 hover:text-primary-700 hover:font-semibold">Contact</a>
            </div>

            <div class="flex justify-center items-center py-4">
              @if (Auth::check())
                <div class="flex items-center justify-center ">
                  <a href="#" class="text-2xl hover:text-primary-700">
                    <ion-icon name="cart-outline"></ion-icon>
                  </a>
                  <div class="mx-8">
                    |
                  </div>
                  <div class="relative">
                    <div>
                      <button @click="isUserOpen = !isUserOpen" type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary-400" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
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
                      <a href="#" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                      <a href="#" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                      <a href="{{ route('logout') }}" class="block px-4 py-2 text-base text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                      </form>
                    </div>
                  </div>
                  <h2 class="ml-2 text-base font-semibold text-gray-900 hover:text-primary-400">{{ Auth::user()->username }}</h2>
                </div>
              @else
                <a href="#" class="text-2xl hover:text-primary-700 mr-4">
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