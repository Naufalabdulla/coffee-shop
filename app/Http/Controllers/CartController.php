<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan cart
    public function index()
    {
        // Ambil semua item di cart untuk user yang sedang login
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        // Hitung jumlah item di cart
        $cartCount = $cartItems->sum('quantity');

        return view('cart.index', compact('cartItems', 'cartCount'));
    }

    // Menambahkan item ke cart
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Tambahkan ke cart
        $product = Product::findOrFail($request->product_id);
        $cart = Cart::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ],
            [
                'quantity' => $request->input('quantity', 1),
                'total_price' => $product->price * $request->input('quantity', 1),
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Mengupdate jumlah item di cart
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update item di cart
        $cartItem = Cart::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $cartItem->product->price * $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    // Menghapus item dari cart
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}
