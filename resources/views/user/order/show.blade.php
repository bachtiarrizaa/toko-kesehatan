@extends('layouts.main')
@section('container')
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-semibold">Order Details</h2>

        <div class="bg-white shadow-md rounded-lg p-4 mt-6">
            <div class="flex items-center justify-between mb-4">
                <p class="text-lg font-semibold">Order ID: #{{ $order->id }}</p>
                <p class="text-gray-500">Status: {{ $order->status }}</p>
            </div>

            <div class="mb-4">
                <p class="text-md font-semibold">Order Date: {{ $order->created_at->format('d-m-Y') }}</p>
                <p class="text-md font-semibold">Total Price: Rp {{ number_format($order->total_price, 2) }}</p>
            </div>
                <tbody>

                    @foreach ($order->orderItems as $item)
                        <div class="mb-4 border p-4 rounded">
                            <p><strong>{{ $item->product->name }}</strong></p>
                            <p>Qty: {{ $item->quantity }}</p>
                            <p>Total: ${{ $item->price * $item->quantity }}</p>

                            <form action="{{ route('feedback.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                
                                <textarea name="message" placeholder="Tulis feedback..." required class="w-full border rounded p-2"></textarea>
                                <input type="number" name="rating" min="1" max="5" required placeholder="Rating (1-5)" class="w-20 border rounded mt-2 p-1">

                                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">Kirim</button>
                            </form>
                        </div>
                    @endforeach


                </tbody>
            </table>
            

            <div class="mt-6">
                <a href="{{ route('history-order') }}" class="text-blue-600 hover:underline">Back to History</a>
            </div>
        </div>
    </div>
@endsection
