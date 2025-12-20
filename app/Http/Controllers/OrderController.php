<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(fn($i) => $i['qty'] * $i['price']);
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        return view('order.index', compact(
            'items','cart','subtotal','tax','total'
        ));
    }

    public function addToCart($id)
    {
        $item = Item::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'name' => $item->name,
                'price' => $item->price,
                'image' => $item->image,
                'qty' => 1
            ];
        }

        session()->put('cart', $cart);
        return back();
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['qty']++;
        }
        session()->put('cart', $cart);
        return back();
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        }
        session()->put('cart', $cart);
        return back();
    }


    public function pay()
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['qty'] * $i['price']);
        $total = $subtotal + ($subtotal * 0.10);

        Transaction::create([
            'user_id' => 1, // default user untuk demo
            'total' => $total
        ]);

        session()->forget('cart');
        return redirect('/transactions');
    }

    public function transactions()
    {
        $transactions = Transaction::where(
            'user_id', 1 // default user untuk demo
        )->latest()->get();

        return view('order.transaction', compact('transactions'));
    }
}
