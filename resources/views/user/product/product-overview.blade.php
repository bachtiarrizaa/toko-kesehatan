@extends('layouts.main')
@section('container')
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        @if(session('success'))
            <div class="alert alert-success text-green-600 bg-green-200 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error text-red-600 bg-red-200 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                <img class="mx-auto h-full" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" />
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0">
                <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $product->name }}
                    </h1>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                        <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>                

                    <div class="mt-4 flex items-center gap-6">
                        <div>
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                Stock: <span class="font-semibold">{{ $product->stock }}</span>
                            </p>
                        </div>
                        
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-center gap-2">
                            <label for="quantity" class="text-sm font-bold text-gray-700 dark:text-gray-300">Quantity:</label>
                            <div class="flex items-center bg-white rounded-lg overflow-hidden">
                                <button type="button" onclick="decreaseQuantity()" class="px-3 py-2 text-gray-700 dark:text-gray-900 hover:bg-gray-100">
                                    -
                                </button>
                                <input 
                                    type="number" 
                                    id="quantity" 
                                    name="quantity" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $product->stock }}" 
                                    class="w-16 text-center bg-white text-gray-900 border-0 focus:ring-0 focus:outline-none"
                                />
                                <button type="button" onclick="increaseQuantity()" class="px-3 py-2 text-gray-700 dark:text-gray-900 hover:bg-gray-100">
                                    +
                                </button>
                            </div>
                        </div>                    
                        
                    </div>                
                
                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <button
                            type="submit"
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-primary rounded-lg border border-primary-200 hover:bg-primary-100 hover:text-white-700 focus:z-10 focus:ring-4 focus:ring-primary-100 dark:focus:ring-primary-700 dark:bg-primary-800 dark:text-primary-400 dark:border-primary-600 dark:hover:text-white dark:hover:bg-primary-700"
                            role="button"
                            >
                                <svg
                                class="w-5 h-5 -ms-2 me-2"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                                />
                            </svg>
                            Add to cart
                        </button>
                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $product->description }}
                    </p>
                </form>
            </div>
        </div>
        </div>
    </section>

    <script>
        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }
        
        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            var max = parseInt(quantityInput.max);
            if (currentValue < max) {
                quantityInput.value = currentValue + 1;
            }
        }
        </script>
@endsection