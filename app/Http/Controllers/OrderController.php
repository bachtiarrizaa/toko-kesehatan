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
        // return view('user.order.order-success');
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
        try {
            // Pastikan hanya user yang terkait dengan order yang bisa mengaksesnya
            if (auth()->user()->id !== $order->user_id) {
                abort(403, 'You are not authorized to view this order');
            }
    
            // Pass order data ke view
            return view('user.order.show', compact('order'));
    
        } catch (\Exception $e) {
            // Jika ada error, bisa menangani dengan try-catch
            return redirect()->route('history-order')->with('error', 'Failed to load order details');
        }
    }

    public function storeFeedback(Request $request, Order_Item $orderItem)
    {
        $request->validate([
            'feedback' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Hanya pemilik order yang bisa mengisi feedback
        if ($orderItem->order->user_id !== auth()->id()) {
            abort(403);
        }

        $orderItem->update([
            'feedback' => $request->feedback,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Feedback submitted!');
    }


    public function success($id)
    {

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
