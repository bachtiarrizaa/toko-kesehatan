<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $userId = Auth::id();
            
            $carts = Cart::where('user_id', $userId)->with('product')->get();
            
            $originalPrice = $carts->reduce(function ($carry, $cart) {
                return $carry + ($cart->product->price * $cart->quantity);
            }, 0);

            $tax = $originalPrice * 0.1;

            $totalPrice = $originalPrice + $tax;

            return view('user.cart.cart-view', compact('carts', 'originalPrice', 'tax', 'totalPrice'));

        } catch (\Exception $e) {
            // Menangani error
            return back()->withErrors(['message' => 'Gagal memuat keranjang.']);
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
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::findOrFail($request->product_id);

            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                $existingCart->quantity += $request->quantity;
                $existingCart->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }

        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        try {

            $cartItems = Cart::where('user_id', Auth::id())->get();
            return view('cart.index', compact('cartItems'));
        } catch (\Exception $e) {

            return response()->json(['error' => 'There was an issue fetching your cart. Please try again later.'], 500);
        }
    }

    public function checkout(Request $request)
    {
        try {
            $userId = Auth::id();  // Mendapatkan ID pengguna yang sedang login
            
            // Ambil data keranjang untuk pengguna yang sedang login
            $carts = Cart::where('user_id', $userId)->get();

            if ($carts->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
            }

            // Hitung total harga dan pajak
            $totalPrice = $carts->sum(function($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $tax = $totalPrice * 0.1; // Misalnya 10% pajak, Anda bisa sesuaikan

            // Simpan data order ke tabel 'orders'
            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $totalPrice + $tax,
                'payment_method' => 'default', // Misalnya 'default', bisa diubah sesuai metode pembayaran yang dipilih
                'status' => 'ok', // Status sementara
            ]);

            // Setelah berhasil menyimpan order, kita bisa menghapus semua item dari keranjang
            Cart::where('user_id', $userId)->delete();

            // Redirect ke halaman konfirmasi atau sukses
            return redirect()->route('order.confirmation')->with('success', 'Checkout berhasil!');

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function buyNow($id)
    {
        $product = Product::findOrFail($id);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->product_id = $product->id;
        $order->quantity = 1;
        $order->total_price = $product->price;
        $order->status = 'pending'; // atau langsung "paid" kalau ingin diselesaikan langsung
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Purchase successful!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    public function updateQuantity(Request $request, $id)
    {
        try {
            $cart = Cart::findOrFail($id);

            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            $cart->quantity = $request->quantity;
            $cart->save();

            return response()->json([
                'success' => true,
                'message' => 'Quantity updated successfully',
                'total_price' => number_format($cart->product->price * $cart->quantity, 0, ',', '.')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid quantity.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Cart $cart)
    // {
    //     try {
    //         // Validasi input
    //         $request->validate([
    //             'quantity' => 'required|integer|min:1',
    //         ]);

    //         // Update quantity
    //         $cart->quantity = $request->quantity;
    //         $cart->save();

    //         return redirect()->back()->with('success', 'Quantity updated successfully!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Gagal update quantity: ' . $e->getMessage());
    //     }
    // }

    // public function updateQuantity(Request $request, $cartId)
    // {
    //     try {
    //         // Validasi inputan
    //         $request->validate([
    //             'quantity' => 'required|integer|min:1', // Pastikan quantity valid
    //         ]);

    //         // Ambil data cart berdasarkan cartId
    //         $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->firstOrFail();

    //         // Update quantity
    //         $cartItem->quantity = $request->input('quantity');
    //         $cartItem->save();

    //         return response()->json([
    //             'success' => 'Quantity updated successfully!',
    //             'new_quantity' => $cartItem->quantity
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'error' => 'Failed to update quantity: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        try {
            $userId = Auth::id();  // Ambil ID user yang sedang login
    
            // Pastikan cart yang akan dihapus milik pengguna yang sedang login
            if ($cart->user_id === $userId) {
                $cart->delete();  // Hapus item dari cart
                return redirect()->route('cart.index')->with('success', 'Item removed successfully.');
            }
    
            return redirect()->route('cart.index')->with('error', 'Item not found or you are not authorized to delete this item.');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }    
}
