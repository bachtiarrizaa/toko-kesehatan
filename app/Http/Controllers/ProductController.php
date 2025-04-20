<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();
    
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
    
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $categories = Category::all();
        $products = $query->paginate(12); // <-- ini yang digunakan, bukan Product::all()
    
        if (Auth::check() && Auth::user()->role_id === 1) {
            return view('admin.product.index', compact('products', 'categories'));
        } else {
            return view('user.product.index', compact('products', 'categories'));
        }
    }
    
    public function create() {
        $categories = Category::all();
        return view('admin.product.add-product', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        try {

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $imageName = basename($imagePath);
            } else {
                $imageName = null;
            }

            Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imageName,
            ]);
            
            return redirect()->route('admin.product.index')->with('success', 'Successfully added the product');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Product $product)
    {
        return view('user.product.product-overview', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.product.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
                    Storage::disk('public')->delete('products/' . $product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
                $imageName = basename($imagePath);
            } else {
                $imageName = $product->image;
            }

            $product->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Product $product) {
        try {
            $product->delete();

            return redirect()->route('admin.product.index')->with('success', 'Category successfully deleted');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
