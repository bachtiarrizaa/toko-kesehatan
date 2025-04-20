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
        try {
            // Validasi input
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Update quantity
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back()->with('success', 'Quantity updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update quantity: ' . $e->getMessage());
        }
    }

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
