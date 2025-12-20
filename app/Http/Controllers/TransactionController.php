<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'product'])
            ->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        Transaction::create([
            // 'user_id'    => auth()->user()->id(),
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'status'     => 'ordered',
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Pesanan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
         $request->validate([
            'status' => 'required|in:ordered,paid,processing,done,cancelled'
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status transaksi diperbarui');
    }

   /**
     * Hapus transaksi
     */
    public function destroy(Transaction $transaction){
    {
        $transaction->delete();

        return back()->with('success', 'Transaksi berhasil dihapus');
    }
}
    public function order(Request $request) {
        $request->validate([

            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
        $transaction = Transaction::create([
            // 'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => 'ordered'
        ]);
        return back()->with('success','Pesanan berhasil dibuat');

    }
}