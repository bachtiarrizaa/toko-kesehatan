<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('user.order.order-overview');
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
            }
    
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
    
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong.');
            }
    
            $originalPrice = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
    
            $tax = $originalPrice * 0.1; // contoh 10% pajak
            $total = $originalPrice + $tax;
    
            return view('user.order.order-overview', compact('cartItems', 'originalPrice', 'tax', 'total'));
    
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
    public function show(Order $order)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
