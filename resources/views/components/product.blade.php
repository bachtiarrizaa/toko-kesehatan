<section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <!-- Heading & Filters -->
      <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
        <div>
          <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Our Products</h2>
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
              <form action="{{ route('cart.store') }}" method="POST" onsubmit="return showAddToCartAlert()">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="redirect_from_product" value="true">
                <button type="submit"
                    class="inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                    </svg>
                    Add to cart
                </button>
              </form>                   
              {{-- <button type="button" class="inline-flex items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Buy
              </button> --}}
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="w-full text-center">
        <a href="{{ route('product.index') }}"
        class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-grey dark:focus:ring-gray-700"
        >Show more</a>
      </div>
    </div>

    <script>
      function showAddToCartAlert() {
          alert("Berhasil ditambahkan ke keranjang!");
          return true;
      }
  </script>
</section>