<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Order_Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role_id === 1) {
            $orders = Order::with('user')->latest()->get();
            return view('admin.order.index', compact('orders'));
        } else {
            $orders = auth()->user()->orders()->latest()->get();
            return view('user.order.order-success', compact('orders'));
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
        $request->validate([
            'payment_method' => 'required|in:cod,credit_card,paypal',
        ]);

        try {
            $user = Auth::user();
            $carts = Cart::where('user_id', $user->id)->get();

            if ($carts->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            DB::beginTransaction();

            $totalPrice = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                Order_Item::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('order.success', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order placement failed: ' . $e->getMessage());

            return back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        try {
            if (auth()->user()->id !== $order->user_id) {
                abort(403, 'You are not authorized to view this order');
            }
    
            return view('user.order.show', compact('order'));
    
        } catch (\Exception $e) {
            return redirect()->route('history-order')->with('error', 'Failed to load order details');
        }
    }

    public function success($id)
    {

        $user = Auth::user();
        $order = Order::with(['user', 'items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$order) {
            return redirect()->route('user.cart.index')->with('error', 'Checkout tidak ditemukan.');
        }

        return view('user.order.order-success', compact('user', 'order'));
    }

    public function printPDF($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('user.order.pdf', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pembelian.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
            $order->update([
                'status' => $request->status
            ]);
    
            return back()->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
