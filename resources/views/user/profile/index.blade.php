@extends('layouts.main')
@section('container')
<section class="bg-white py-4 antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">
      <div class="py-4 md:py-8">
        <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
          <div class="space-y-4">
            <div class="flex space-x-4">
              <img class="h-16 w-16 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene avatar" />
              <div>
                  <h2 class="flex items-center text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">{{ $user->name }}</h2>
                    <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> {{ $user->username }} </span>
              </div>
            </div>
            <dl class="">
              <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $user->email }}</dd>
            </dl>
            <dl>
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Gender</dt>
              <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
                {{ $user->gender }}
              </dd>
            </dl>
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Date of Birthday</dt>
              <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                </svg>
                {{ $user->date_of_birth }}
              </dd>
            </dl>
          </div>
          <div class="space-y-4">
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Paypal ID</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $user->paypalId }}</dd>
            </dl>
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Phone Number</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $user->telp }}</dd>
            </dl>
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">Address</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $user->address }}</dd>
            </dl>
            <dl>
              <dt class="font-semibold text-gray-900 dark:text-white">City</dt>
              <dd class="text-gray-500 dark:text-gray-400">{{ $user->city }}</dd>
            </dl>
          </div>
        </div>
      </div>
      <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800 md:p-8">
        <h3 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white">Latest orders</h3>
        @foreach ($orders as $order)
          <div class="flex flex-wrap items-center gap-y-4 border-b border-gray-200 pb-4 dark:border-gray-700 md:pb-5">
              <dl class="w-1/2 sm:w-48">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                      <a href="#" class="hover:underline">{{ $order->id }}</a>
                  </dd>
              </dl>

              <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('d-m-Y') }}</dd>
              </dl>

              <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">Rp {{ number_format($order->total_price, 2) }}</dd>
              </dl>

              <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                  <dd class="me-2 mt-1.5 inline-flex shrink-0 items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                      <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                      </svg>
                      {{ ucfirst($order->status) }}
                  </dd>
              </dl>

              <dl class="w-1/2 sm:w-1/5 md:flex-1 lg:w-auto">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Action:</dt>
                  <div>
                      <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                          <a href="#" class="hover:underline">View</a>
                      </dd>
                      
                      <!-- Add the cancel button only if the order status is 'pending' -->
                      @if ($order->status === 'pending')
                          <form action="#" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="mt-1.5 text-base font-semibold text-red-600 hover:underline">Cancel</button>
                          </form>
                      @endif
                  </div>
              </dl>
          </div>
      @endforeach

      </div>
    </div>
</section>
@endsection