@extends('layouts.main')
@section('container')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order Overview</h2>
            <span class="inline-flex items-center rounded-md bg-yellow-100 px-2.5 py-0.5 text-sm font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                {{ ucfirst($order->status) }}
            </span>
        </div>
  
      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
          <div class="space-y-6">
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex flex-col md:flex-row gap-4">
                  <!-- Product Image -->
                  <div class="flex-shrink-0">
                    <img class="h-24 w-24 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                  </div>
              
                  <!-- Right Content -->
                  <div class="flex-1 space-y-4">
                    <!-- Row 1: Product name | Quantity | Price -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                      <div class="flex-1">
                        <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                            {{ $item->product->name }}
                        </a>
                      </div>
                      <div class="flex items-center gap-2">
                        <p id="counter-input" value="2" class="w-14 rounded-md border border-gray-300 p-1 text-center text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                        <p class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->total_price, 2) }}</p>
                      </div>
                    </div>
              
                    <!-- Row 2: Feedback | Rating | Save -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                      <!-- Feedback -->
                      <div class="flex-1">
                        <label for="feedback" class="sr-only">Feedback</label>
                        <textarea id="feedback" rows="2" class="w-full rounded-md border border-gray-300 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Write your feedback..."></textarea>
                      </div>
              
                      <!-- Rating -->
                      <div class="w-20">
                        <label for="rating" class="sr-only">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" class="w-full rounded-md border border-gray-300 p-2 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="5" />
                      </div>
              
                      <!-- Save Button -->
                      <div>
                        <button type="button" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                          Save
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
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
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                  <dd class="text-base font-medium text-green-600">-$299.00</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store Pickup</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
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
    </div>
</section>
@endsection