<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ADMIN: List produk
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * ADMIN: Form tambah produk
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * ADMIN: Simpan produk
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        // upload gambar ke public/img
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('img'), $imageName);

        Product::create([
            'name'      => $request->name,
            'price'     => $request->price,
            'image_url' => 'img/' . $imageName
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil ditambahkan');
    }

    /**
     * ADMIN: Form edit produk
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * ADMIN: Update produk
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image'
        ]);

        $data = [
            'name'  => $request->name,
            'price' => $request->price,
        ];

        // jika upload gambar baru
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $data['image_url'] = 'img/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil diupdate');
    }

    /**
     * ADMIN: Hapus produk
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}