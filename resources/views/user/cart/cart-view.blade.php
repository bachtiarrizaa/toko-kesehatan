@extends('layouts.main')
@section('container')
@if ($carts->isEmpty())
    <div class="text-center py-10">
        <p class="text-gray-500 dark:text-gray-400 text-lg">Your cart is currently empty.</p>
        <a href="{{ route('product.index') }}" class="mt-4 inline-block text-primary-700 hover:underline dark:text-primary-500">
            Start Shopping
        </a>
    </div>
@else
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
    
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    @foreach ($carts as $cart)
                        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                <a href="#" class="shrink-0 md:order-1">
                                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="h-20 w-20 object-cover">
                                </a>
                    
                                <label for="counter-input" class="sr-only">Choose quantity:</label>
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center">
                                    <button type="button" class="decrement-btn" data-cart-id="{{ $cart->id }}">-</button>
                                    {{-- <input type="text" id="counter-input" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required /> --}}
                                    <input type="text" 
                                        data-cart-id="{{ $cart->id }}"
                                        class="quantity-input w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" 
                                        value="{{ $cart->quantity }}" />
                                    <button type="button" class="increment-btn" data-cart-id="{{ $cart->id }}">+</button>
                                    </div>
                                    <div class="text-end md:order-4 md:w-32">
                                        <p class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                    
                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                    <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cart->product->name }}</a>
                    
                                    <div class="flex items-center gap-4">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Remove
                                            </button>
                                        </form>
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
                                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($originalPrice, 0, ',', '.') }}</dd>
                            </dl>
            
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($tax, 0, ',', '.') }}</dd>
                            </dl>
                        </div>
            
                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white" id="price-{{ $cart->id }}">Rp {{ number_format($totalPrice, 0, ',', '.') }}</dd>
                        </dl>

                        <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div>
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                            <select name="payment_method" id="payment_method"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option disabled selected>Select Payment Method</option>
                                <option value="cod">Cash on Delivery (COD)</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>

                        </div>
                            
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Checkout
                        </button>
                        </form>
                        
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
        </div>
    </section>
@endif


<script>
    document.querySelectorAll('.increment-btn, .decrement-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const cartId = this.dataset.cartId;
            const input = document.querySelector(`input[data-cart-id='${cartId}']`);
            let quantity = parseInt(input.value);
    
            if (this.classList.contains('increment-btn')) {
                quantity++;
            } else if (this.classList.contains('decrement-btn') && quantity > 1) {
                quantity--;
            }
    
            input.value = quantity;
    
            const response = await fetch(`/cart/${cartId}/update-quantity`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            });
    
            const result = await response.json();
            if (result.success) {
                console.log('Updated!');
            }
        });
    });

    document.querySelector(`#price-${cartId}`).textContent = `Rp ${result.total_price}`;

    document.querySelectorAll('.remove-item-btn').forEach(button => {
        button.addEventListener('click', function() {
            let cartId = this.getAttribute('data-cart-id'); // Ambil cartId dari data attribute
            console.log(cartId); // Pastikan cartId ada
            // Lakukan aksi lain, seperti mengirimkan permintaan AJAX untuk menghapus cart
        });
    });

</script>    
@endsection