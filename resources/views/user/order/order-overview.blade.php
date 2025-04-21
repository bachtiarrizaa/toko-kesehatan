@extends('layouts.main')

@section('container')
<div class="max-w-3xl mx-auto p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4 text-green-600">Order Berhasil!</h2>

    {{-- Informasi User --}}
    <div class="mb-4">
        <p class="mb-1"><strong>Nama Pemesan:</strong> {{ $order->user->name }}</p>
        <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
    </div>

    {{-- Info Order --}}
    <p class="mb-2"><strong>Order ID:</strong> {{ $order->id }}</p>
    <p class="mb-2"><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
    <p class="mb-2"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p class="mb-2"><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>

    {{-- Daftar Produk --}}
    <h3 class="font-semibold mb-2 mt-4">Produk yang dibeli:</h3>
    <ul class="divide-y divide-gray-200">
        @foreach ($order->items as $item)
            <li class="py-2 flex justify-between">
                <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
            </li>
        @endforeach
    </ul>

    {{-- Perhitungan Total --}}
    @php
        $subtotal = $order->total_price;
        $tax = $subtotal * 0.10;
        $totalWithTax = $subtotal + $tax;
    @endphp

    <div class="mt-4 border-t pt-3 space-y-1 text-right">
        <p><span class="font-semibold">Subtotal:</span> Rp {{ number_format($subtotal, 2) }}</p>
        <p><span class="font-semibold">PPN (10%):</span> Rp {{ number_format($tax, 2) }}</p>
        <p class="text-lg font-bold border-t pt-2">Total Akhir: Rp {{ number_format($totalWithTax, 2) }}</p>
    </div>

    <a href="{{ route('home') }}" class="mt-6 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kembali ke Home</a>
</div>
@endsection
