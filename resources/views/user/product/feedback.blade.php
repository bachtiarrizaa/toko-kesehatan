@extends('layouts.main')
@section('container')

<section class="bg-white py-8 antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>  
      <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
          <div class="space-y-6">
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <div class="flex flex-col md:flex-row justify-center gap-4">
                <div class="flex-shrink-0">
                  <img class="h-24 w-24" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                </div>
                <div class="flex-1 space-y-4">
                  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    <div class="flex-1">
                      <a href="#" class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                        PC system All in One APPLE iMac (2023) Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU
                      </a>
                    </div>
                    <div class="flex items-center gap-2">
                      <input type="text" id="counter-input" value="2" class="w-14 rounded-md border border-gray-300 p-1 text-center text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white" />
                      <p class="text-base font-bold text-gray-900 dark:text-white">$1,499</p>
                    </div>
                  </div>

                  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    <div class="flex-1">                      
                      <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your feedback</label>
                      <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                    </div>
            
                    <div class="justify-items-center">
                      <div class="w-14">
                        <label for="rating" class="sr-only">Rating</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" class="w-full rounded-md border border-gray-300 p-2 text-sm text-gray-900" placeholder="5" />
                      </div>

                      <div class="mt-2">
                        <button type="button" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                          Save
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
  
        <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
          <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <p class="text-xl font-semibold text-gray-900 dark:text-white">Order Information</p>
  
            <div class="space-y-4">
              <div class="space-y-2">
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Order Id</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Payement Method</dt>
                  <dd class="text-base font-medium text-green-600">-$299.00</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Payment Date</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                </dl>
  
                <dl class="flex items-center justify-between gap-4">
                  <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Price</dt>
                  <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                </dl>
              </div>
            </div>
  
            <a href="{{ route('history-order') }}" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                My History Order
            </a>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection