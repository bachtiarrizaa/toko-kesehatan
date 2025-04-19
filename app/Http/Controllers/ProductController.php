<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('admin.product.index');
    }
    
    public function add_product() {
        return view('admin.product.add-product');
    }

    public function edit($id)
    {
        $category = Product::findOrFail($id);

        return view('admin.product.edit-product', compact('product'));
    }
}
