@extends('layouts.main')
@section('container')
    <section class="bg-white py-4 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
    
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    @foreach ($carts as $cart)
                        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a href="#" class="shrink-0 md:order-1">
                                    {{-- <img class="h-20 w-20" src="{{ $cart->product->image_url ?? 'https://via.placeholder.com/80' }}" alt="{{ $cart->product->name }}"> --}}
                                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="h-20 w-20">

                                </a>
                
                                <label for="counter-input" class="sr-only">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                <div class="flex items-center">
                                    <button type="button" class="decrement-btn" data-id="{{ $cart->id }}">-</button>
                                    </button>
                                    <input type="text" id="counter-input-{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" required />
                                    <button type="button" class="increment-btn" data-id="{{ $cart->id }}">+</button>
                                </div>
                                <div class="text-end md:order-4 md:w-32">
                                    <p
                                        class="text-base font-bold text-gray-900 dark:text-white"
                                        data-price="{{ $cart->product->price }}"
                                        id="item-price-{{ $cart->id }}">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                                </div>
                                </div>
                
                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cart->product->name }}</a>
                
                                <div class="flex items-center gap-4">
                                    <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>
                                    Remove
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
        
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                            </dl>
            
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                            </dl>
                        </div>
            
                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white">$8,191.00</dd>
                        </dl>
                    </div>
        
                    <a href="#" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Checkout</a>
        
                    <div class="flex items-center justify-center gap-2">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                    <a href="#" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                        Continue Shopping
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const incrementButtons = document.querySelectorAll('.increment-btn');
            const decrementButtons = document.querySelectorAll('.decrement-btn');
        
            function updatePrice(id) {
                const input = document.getElementById('counter-input-' + id);
                const priceElement = document.getElementById('item-price-' + id);
                const unitPrice = parseInt(priceElement.dataset.price);
                const quantity = parseInt(input.value);
                const newPrice = unitPrice * quantity;
        
                priceElement.textContent = 'Rp' + newPrice.toLocaleString('id-ID');
            }
        
            incrementButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const input = document.getElementById('counter-input-' + id);
                    let value = parseInt(input.value);
                    input.value = isNaN(value) ? 1 : value + 1;
                    updatePrice(id);
                });
            });
        
            decrementButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const input = document.getElementById('counter-input-' + id);
                    let value = parseInt(input.value);
                    if (!isNaN(value) && value > 1) {
                        input.value = value - 1;
                        updatePrice(id);
                    }
                });
            });
        });
    </script>        
        
@endsection