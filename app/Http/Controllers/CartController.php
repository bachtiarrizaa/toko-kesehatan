<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();
        return view('user.cart.index', compact('carts'));
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
        try
        {
            if (!Auth::check()) {
                return response()->json(['error' => 'You must be logged in to add to cart'], 403);
            }

            $request->validate([
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|integer|min:1',
            ]);

            // Ambil data produk
            $product = Product::findOrFail($request->input('product_id'));

            // Cek jika produk sudah ada di cart untuk user yang sama
            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();
            // Jika produk sudah ada, update quantity
            if ($cart) {
                $cart->quantity += $request->input('quantity');
                $cart->save();
            } else {
                // Jika produk belum ada di cart, tambahkan item baru
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->input('quantity'),
                ]);
            }

            // return response()->json(['success' => true, 'message' => 'Product added to cart!']);
            session()->flash('success', 'Product added to cart!');

            return redirect()->route('product.show', $request->product_id);
        } catch (\Exception $e) 
        {
             // Menangkap error dan log
            //  Log::error('Error adding product to cart: ' . $e->getMessage());

             // Mengembalikan response error jika terjadi masalah
             return response()->json(['error' => 'There was an issue adding the product to your cart. Please try again later.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        try {
            // Ambil data cart milik user yang sedang login
            $cartItems = Cart::where('user_id', Auth::id())->get();
            return view('cart.index', compact('cartItems'));
        } catch (\Exception $e) {
            // Menangkap error dan log
            // Log::error('Error fetching cart items: ' . $e->getMessage());

            // Mengembalikan response error jika terjadi masalah
            return response()->json(['error' => 'There was an issue fetching your cart. Please try again later.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        try {
            // Pastikan cart milik user yang sedang login
            if ($cart->user_id !== Auth::id()) {
                return abort(403, 'Unauthorized');
            }
    
            $cart->delete();
    
            return redirect()->route('cart.index')->with('success', 'Product removed from cart');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Failed to remove product: ' . $e->getMessage());
        }
    }
}
