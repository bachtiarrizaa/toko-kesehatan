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
            $orders = auth()->user()->orders;

            return view('user.order.history', compact('orders'));
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to fetch order history');
        }
    }

    public function cancel($orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            if ($order->user_id !== Auth::id()) {
                return redirect()->route('history-order')->with('error', 'You are not authorized to cancel this order.');
            }

            if ($order->status !== 'pending') {
                return redirect()->route('history-order')->with('error', 'Only pending orders can be cancelled.');
            }

            $order->status = 'cancelled';
            $order->save();

            return redirect()->route('history-order')->with('success', 'Order has been cancelled successfully.');

        } catch (\Exception $e) {
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
