@extends('layouts.main')
@section('container')
    <section class="bg-white py-8 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order Overview</h2>
                {{-- <span class="inline-flex items-center rounded-md bg-yellow-100 px-2.5 py-0.5 text-sm font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                    {{ ucfirst($order->status) }}
                </span> --}}
            </div>
            
            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <div class="grid gap-6 mb-6 md:grid-cols-3">
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order Id</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->id }}
                                        </div>
                                    </div>
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Date</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->payment_method }}
                                        </div>
                                    </div>
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->user->name }}
                                        </div>
                                    </div>
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->user->telp }}
                                        </div>
                                    </div>
                                    <div>
                                        <label for="orderId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                        <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            {{ $order->user->address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $subtotal = $order->total_price;
                    $tax = $subtotal * 0.10;
                    $totalWithTax = $subtotal + $tax;
                @endphp
                
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Price summary</p>
            
                        <div class="space-y-4">
                            <div class="space-y-2">
                                @foreach ($order->items as $item)
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 w-72">{{ $item->product->name }}</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $item->quantity }}</dd>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($item->price * $item->quantity, 2) }}</dd>
                                </dl>
                                @endforeach
                
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($tax, 2) }}</dd>
                                </dl>
                            </div>
                
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalWithTax, 2) }}</dd>
                            </dl>
                        </div>
            
                        <a href="{{ route('order.print', $order->id) }}"
                        class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >
                            Print PDF
                        </a>
            
                        <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                        <a href="{{ route('product.index') }}" title="" class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
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