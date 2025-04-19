<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    
    public function addCategoryForm() {
        return view('admin.category.add-category');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.category.index')->with('success', 'Berhasil menambah kategori');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
