<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        return view('dashboard.index', compact(
            'products',
            'cart',
            'subtotal',
            'tax',
            'total'
        ));
    }

    public function order()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        return view('dashboard.index', compact(
            'products',
            'cart',
            'subtotal',
            'tax',
            'total'
        ));
    }

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

    public function cancel()
    {
        session()->forget('cart');

        return redirect()->route('dashboard')
            ->with('success', 'Pesanan dibatalkan');
    }
}
