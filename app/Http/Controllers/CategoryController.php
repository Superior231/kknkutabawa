<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ], [
            'name.unique' => 'Kategori sudah ada',
        ]);

        $data = $request->all();

        $category = Category::create($data);

        if ($category) {
            return redirect()->route('project.index')->with('success', 'Kategori berhasil dibuat!');
        } else {
            return redirect()->route('project.index')->with('error', 'Kategori gagal dibuat!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ], [
            'name.unique' => 'Kategori sudah ada',
        ]);
        
        $data = $request->all();
        $category = Category::find($id);

        $category->update($data);

        if ($category) {
            return redirect()->route('project.index')->with('success', 'Kategori berhasil diupdate!');
        } else {
            return redirect()->route('project.index')->with('error', 'Kategori gagal diupdate!');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        if ($category) {
            return redirect()->route('project.index')->with('success', 'Kategori berhasil dihapus!');
        } else {
            return redirect()->route('project.index')->with('error', 'Kategori gagal dihapus!');
        }
    }
}
