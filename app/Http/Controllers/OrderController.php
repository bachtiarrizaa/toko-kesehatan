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
        return view('user.order.order-success');
        // try {
        //     $user = Auth::user();
        //     if (!$user) {
        //         return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        //     }
    
        //     $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
    
        //     if ($cartItems->isEmpty()) {
        //         return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong.');
        //     }
    
        //     $originalPrice = $cartItems->sum(function ($item) {
        //         return $item->product->price * $item->quantity;
        //     });
    
        //     $tax = $originalPrice * 0.1;
        //     $total = $originalPrice + $tax;
    
        //     return view('user.order.order-overview', compact('cartItems', 'originalPrice', 'tax', 'total'));
    
        // } catch (\Exception $e) {
        //     return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        // }
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
        // Validasi input terlebih dahulu
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

            // Buat order terlebih dahulu
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Simpan item ke order_items
            foreach ($carts as $cart) {
                Order_Item::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);
            }

            // Kosongkan cart user
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // return redirect()->route('order.index')->with('success', 'Order placed successfully!');
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
        //
    }

    public function success($id)
    {
        // $order = Order::with('items.product')->findOrFail($id);

        // return view('user.order.order-success', compact('order'));
        $user = Auth::user();
        // Mengambil data chechout yang terakhir kali
        $order = Order::with(['user', 'items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Jika tidak ada data checkout, redirect ke halaman keranjang
        if (!$order) {
            return redirect()->route('user.cart.index')->with('error', 'Checkout tidak ditemukan.');
        }

        return view('user.order.order-success', compact('user', 'order'));
    }

    public function printPDF($id)
    {

        // Cetak pdf hasil checkout
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
