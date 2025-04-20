@extends('layouts.main')
@section('container')
    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        @if(session('success'))
            <div class="alert alert-success text-green-600 bg-green-200 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Menampilkan pesan error jika ada -->
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
                    
                        <!-- Rating -->
                        <div class="flex items-center mt-2 sm:mt-0 gap-1">
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400" >
                            (5.0)
                        </p>
                        <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white" >
                            345 Reviews
                        </a>
                    </div>                

                    <div class="mt-4 flex items-center gap-6">
                        <!-- Stock -->
                        <div>
                            <p class="text-sm font-bold text-gray-600 dark:text-gray-400">
                                Stock: <span class="font-semibold">{{ $product->stock }}</span>
                            </p>
                        </div>
                        
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <!-- Quantity -->
                        <div class="flex items-center gap-2">
                            <label for="quantity" class="text-sm font-bold text-gray-700 dark:text-gray-300">Quantity:</label>
                            <div class="flex items-center bg-white rounded-lg overflow-hidden">
                                <!-- Minus Button -->
                                <button type="button" onclick="decreaseQuantity()" class="px-3 py-2 text-gray-700 dark:text-gray-900 hover:bg-gray-100">
                                    -
                                </button>
                                <!-- Input -->
                                <input 
                                    type="number" 
                                    id="quantity" 
                                    name="quantity" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $product->stock }}" 
                                    class="w-16 text-center bg-white text-gray-900 border-0 focus:ring-0 focus:outline-none"
                                />
                                <!-- Plus Button -->
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
                            <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                            </svg>
                            Add to cart
                        </button>

                        <a
                        href="#"
                        title=""
                        class="text-white mt-4 sm:mt-0 bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 flex items-center justify-center"
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

                        Buy
                        </a>
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