@extends('layouts.main')
@section('container')
  <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <!-- Heading & Filters -->
      <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
        <div>
          <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Our Product</h2>
        </div>
        <div class="flex items-center space-x-4">
          <div>
            <input type="text" id="searchInput" placeholder="Search products..." class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:w-64" />
          </div>
          <form method="GET" action="{{ route('product.index') }}">
              @if(request('category'))
                  <input type="hidden" name="category" value="{{ request('category') }}">
              @endif
              @if(request('max_price'))
                  <input type="hidden" name="max_price" value="{{ request('max_price') }}">
              @endif
          
              <input
                  type="text"
                  name="search"
                  value="{{ request('search') }}"
                  placeholder="Search products..."
                  class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400
                        focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white
                        dark:placeholder-gray-500 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:w-64"
              />
          </form>
          <form id="filterForm" action="{{ route('product.index') }}" method="GET">
            <input type="hidden" name="category" id="categoryInput">
            
            <utton id="sortDropdownButton1" data-dropdown-toggle="categoryDropdown" type="button"
                class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-grey dark:focus:ring-gray-700 sm:w-64">
                
                <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
                </svg>
                
                {{ request('category') ? $categories->find(request('category'))->name : 'Category' }}
                
                <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                </svg>
            </button>b
        
            <div id="categoryDropdown" class="z-50 hidden w-64 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700" data-popper-placement="bottom">
                <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="sortDropdownButton1">
                    <li>
                        <a href="{{ route('product.index', collect(request()->query())->except('category')->toArray()) }}" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm {{ request('category') ? 'text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white' : 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white' }}">
                            All Categories
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('product.index', array_merge(request()->query(), ['category' => $category->id])) }}" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm {{ request('category') == $category->id ? 'bg-gray-100 text-gray-900 dark:bg-gray-600 dark:text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white' }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
          </form>        
        </div>
      </div>
      <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <div class="h-56 w-full">
            <a href="{{ route('product.show', $product->id) }}">
              <img class="mx-auto h-full" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" />
            </a>
          </div>          
          <div class="pt-6">
            <a href="{{ route('product.show', $product->id) }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</a>
  
            <ul class="mt-2 flex items-center gap-4">
              <li class="flex items-center gap-2">
                <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
              </li>
            </ul>
  
            <div class="mt-4 flex items-center justify-between gap-4">
                <form action="{{ route('cart.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="redirect_from_product" value="true">
                  <button type="submit" class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                      <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                      </svg>
                      Add to cart
                  </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

@endsection