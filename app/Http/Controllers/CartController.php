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
    // $user = Auth::user();
    // $carts = $user->carts()->with('product')->get();
    public function index()
    {
        try {
            $userId = Auth::id(); // atau auth()->id()
            
            // Ambil semua cart berdasarkan user_id
            $carts = Cart::where('user_id', $userId)->with('product')->get();
            
            // Hitung total harga dan pajak
            $originalPrice = $carts->reduce(function ($carry, $cart) {
                return $carry + ($cart->product->price * $cart->quantity);
            }, 0); // 0 adalah nilai awal untuk total harga asli

            // Misalkan tax adalah 10% dari harga asli
            $tax = $originalPrice * 0.1;

            // Total harga = original price + tax
            $totalPrice = $originalPrice + $tax;

            // Kembalikan ke view dengan data cart, original price, tax, dan total price
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
        try {
            if (!Auth::check()) {
                return response()->json(['error' => 'You must be logged in to add to cart'], 403);
            }

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]);

            $product = Product::findOrFail($request->input('product_id'));

            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

            if ($cart) {
                $cart->quantity += $request->input('quantity');
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->input('quantity'),
                ]);
            }

            session()->flash('success', 'Product added to cart!');

            if ($request->has('redirect_from_product') && $request->input('redirect_from_product') == 'true') {
                return redirect()->route('product.index', $request->product_id);
            }

            return redirect()->route('product.show');
        } catch (\Exception $e) {

            return response()->json(['error' => 'There was an issue adding the product to your cart. Please try again later.'], 500);
        }
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
