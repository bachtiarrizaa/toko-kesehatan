@extends('layouts.main')
@section('container')
<section class="bg-white py-8 antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-5xl">
        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
  
          <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
            <div>
              <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
              <select id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                <option selected>All orders</option>
                <option value="pre-order">Pre-order</option>
                <option value="transit">In transit</option>
                <option value="confirmed">Confirmed</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
  
            <span class="inline-block text-gray-500 dark:text-gray-400"> from </span>
  
            <div>
              <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
              <select id="duration" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                <option selected>this week</option>
                <option value="this month">this month</option>
                <option value="last 3 months">the last 3 months</option>
                <option value="lats 6 months">the last 6 months</option>
                <option value="this year">this year</option>
              </select>
            </div>
          </div>
        </div>
  
        <div class="mt-6 flow-root sm:mt-8">
          <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($orders as $order)
            <div class="flex flex-wrap items-center gap-y-4 py-6">
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                    <a href="#" class="hover:underline">{{ $order->id }}</a>
                  </dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('d-m-Y') }}</dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                  <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">Rp {{ number_format($order->total_price, 2) }}</dd>
                </dl>
    
                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                  <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                  <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                    {{ ucfirst($order->status) }}
                  </dd>
                </dl>

                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Action:</dt>
                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                      @if($order->status === 'pending')
                          <a href="#" class="text-blue-600 hover:text-blue-800 mr-8">View</a>
                          <form action="{{ route('history-order.cancel', $order->id) }}" method="POST" class="inline-block">
                              @csrf
                              <button type="submit" class="text-red-600 hover:text-red-800">Cancel Order</button>
                          </form>
                      @elseif($order->status === 'accepted')
                          <button type="button" data-modal-target="feedbackmodal{{ $order->id }}" data-modal-toggle="feedbackmodal{{ $order->id }}" class="text-green-600 hover:text-green-800">Feedback</button>
                      @else
                          <a href="{{ route('order.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 mr-8">View</a>
                      @endif

                      <!-- Main modal -->
                      <div id="feedbackmodal{{ $order->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                          <div class="relative p-4 w-full max-w-md max-h-full">
                              <!-- Modal content -->
                              <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                  <!-- Modal header -->
                                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                          Feedback Form
                                      </h3>
                                      <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                          </svg>
                                          <span class="sr-only">Close modal</span>
                                      </button>
                                  </div>
                                  <!-- Modal body -->
                                  <form class="p-4 md:p-5" action="{{ route('feedback.store') }}" method="POST">
                                    @csrf
                                      <div class="grid gap-4 mb-4 grid-cols-2">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <div class="col-span-2">
                                          <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Feedback</label>
                                          <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>                    
                                        </div>
                                          <div class="col-span-2">
                                            <div class="col-span-2 sm:col-span-1">
                                              <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
                                              <input type="number" name="rating" id="rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                                            </div>
                                          </div>
                                      </div>
                                      <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                          <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                          Kirim
                                      </button>
                                  </form>
                              </div>
                          </div>
                      </div> 
                    </dd>              
                </dl>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
</section>
@endsection