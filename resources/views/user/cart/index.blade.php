@extends('layouts.main')

@section('container')
<section class="bg-white py-4 antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <!-- Cart Items -->
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    @foreach ($carts as $cart)
                        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                            <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                
                                <!-- Tambahkan checkbox di kiri atas -->
                                <div class="flex items-center md:order-0">
                                    <input type="checkbox" class="select-product" data-id="{{ $cart->id }}" checked>
                                </div>

                                <!-- Product Image -->
                                <a href="#" class="shrink-0 md:order-1">
                                    <img src="{{ asset('storage/products/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" class="h-20 w-20 object-cover">
                                </a>

                                <!-- Quantity Controls -->
                                <div class="flex items-center justify-between md:order-3 md:justify-end">
                                    <div class="flex items-center">
                                        <button type="button" class="decrement-btn px-2 py-1 border rounded" data-id="{{ $cart->id }}">-</button>
                                        <input type="text" id="counter-input-{{ $cart->id }}" name="quantity" value="{{ $cart->quantity }}" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" readonly />
                                        <button type="button" class="increment-btn px-2 py-1 border rounded" data-id="{{ $cart->id }}">+</button>
                                    </div>
                                    <div class="text-end md:order-4 md:w-32">
                                        <p class="text-base font-bold text-gray-900 dark:text-white"
                                        data-price="{{ $cart->product->price }}"
                                        id="item-price-{{ $cart->id }}">
                                            Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                    <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $cart->product->name }}</a>
                                    <div class="flex items-center gap-4">
                                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" onsubmit="return confirm('Are you sure to remove this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="me-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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

            <!-- Order Summary -->
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                <dd id="original-price" class="text-base font-medium text-gray-900 dark:text-white">Rp 0</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax (10%)</dt>
                                <dd id="tax-price" class="text-base font-medium text-gray-900 dark:text-white">Rp 0</dd>
                            </dl>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd id="total-price" class="text-base font-bold text-gray-900 dark:text-white">Rp 0</dd>
                        </dl>
                    </div>

                    <a href="#" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed to Checkout</a>

                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">or</span>
                        <a href="{{ route('product.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                            Continue Shopping
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Script Section -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incrementButtons = document.querySelectorAll('.increment-btn');
        const decrementButtons = document.querySelectorAll('.decrement-btn');
        const selectCheckboxes = document.querySelectorAll('.select-product');

        function updatePrice(id) {
            const input = document.getElementById('counter-input-' + id);
            const priceElement = document.getElementById('item-price-' + id);
            const unitPrice = parseInt(priceElement.dataset.price);
            const quantity = parseInt(input.value);
            const newPrice = unitPrice * quantity;

            priceElement.textContent = 'Rp ' + newPrice.toLocaleString('id-ID');
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.select-product:checked').forEach(checkbox => {
                const id = checkbox.dataset.id;
                const priceElement = document.getElementById('item-price-' + id);
                const priceText = priceElement.textContent.replace('Rp', '').replace(/\./g, '').trim();
                total += parseInt(priceText) || 0;
            });
            const tax = Math.round(total * 0.1);
            const grandTotal = total + tax;

            document.getElementById('original-price').textContent = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('tax-price').textContent = 'Rp ' + tax.toLocaleString('id-ID');
            document.getElementById('total-price').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
        }

        incrementButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const input = document.getElementById('counter-input-' + id);
                let value = parseInt(input.value) || 0;
                input.value = value + 1;
                updatePrice(id);
            });
        });

        decrementButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const input = document.getElementById('counter-input-' + id);
                let value = parseInt(input.value) || 0;
                if (value > 1) {
                    input.value = value - 1;
                    updatePrice(id);
                }
            });
        });

        selectCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                calculateTotal();
            });
        });

        calculateTotal();
    });

</script>
@endsection
