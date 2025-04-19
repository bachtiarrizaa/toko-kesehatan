<?php

namespace App\Http\Controllers;

use Log;
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

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit-category', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
            ]);

            return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('admin.category.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
