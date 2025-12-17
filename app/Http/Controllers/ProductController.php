<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan semua produk.
     */
    public function index()
    {
        // Mengambil semua data produk dari database
        $products = Product::all();
        $cart = session()->get('cart', []);

        // Mengirim data produk ke view
        return view('product.index', compact('products', 'cart'));
    }

    public function order()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);

        return view('product.index', compact('products', 'cart'));
    }

    /**
     * Tambah produk ke cart
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'name'  => $product->name,
                'price' => $product->price,
                'qty'   => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }

    /**
     * Update jumlah item
     */
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $request->qty);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']--;

            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

}
