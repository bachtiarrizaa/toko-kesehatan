<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Ambil semua pesanan yang dimiliki oleh user yang sedang login
            $orders = auth()->user()->orders;

            return view('user.order.history', compact('orders'));
        } catch (\Exception $e) {
            // Menangani error, misalnya jika tidak ada pesanan atau error lainnya
            return back()->with('error', 'Unable to fetch order history');
        }
    }

    public function cancel($orderId)
    {
        try {
            // Cek apakah order ada dan milik user yang sedang login
            $order = Order::findOrFail($orderId);

            // Pastikan order adalah milik user yang sedang login
            if ($order->user_id !== Auth::id()) {
                return redirect()->route('history-order')->with('error', 'You are not authorized to cancel this order.');
            }

            // Pastikan status order masih 'pending'
            if ($order->status !== 'pending') {
                return redirect()->route('history-order')->with('error', 'Only pending orders can be cancelled.');
            }

            // Update status order menjadi 'cancelled' atau status lain sesuai kebutuhan
            $order->status = 'cancelled';
            $order->save();

            // Redirect ke halaman history dengan pesan sukses
            return redirect()->route('history-order')->with('success', 'Order has been cancelled successfully.');

        } catch (\Exception $e) {
            // Tangani jika terjadi error (misalnya order tidak ditemukan)
            return redirect()->route('history-order')->with('error', 'Failed to cancel the order. Please try again later.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
