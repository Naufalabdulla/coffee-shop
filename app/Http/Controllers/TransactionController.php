<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Product;
use Midtrans\Config as MConfig;
use Midtrans\Snap;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['user', 'products'])
            ->latest()->get();

        return view('transaction.index', compact('transactions'));
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
        $validated = $request->validate([
            // 'product_id' => 'required|exists:products,id',
            // 'quantity'   => 'required|integer|min:1',
            // 'item' => 'required',
            // 'status' => 'required',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'total' => 0,
            'order_id' => 'TRC-' . time(),
        ]);

        $total = 0;
        $items = [];

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $items[] = [
                'id' => $product->id,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'name' => $product->name,
            ];

            $transaction->products()->attach($product->id, [
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            $total += $product->price * $item['quantity'];
        }

        $transaction->update(['total' => $total]);

        MConfig::$serverKey = config('midtrans.server_key');
        MConfig::$isProduction = config('midtrans.is_prod');
        MConfig::$isSanitized = config('midtrans.is_sanitized');
        MConfig::$is3ds = config('midtrans.is_3ds');

        $snapToken = Snap::getSnapToken([
            'transaction_details' => [
                'order_id' => $transaction->order_id,
                'gross_amount' => $total,
            ],
            'item_details' => $items,
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ]);

        $transaction->update(['snaptoken' => $snapToken]);

        return redirect()->route('transactions.index')
            ->with('snapToken', $snapToken);
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
    public function destroy(Transaction $transaction)
    { {
            $transaction->delete();

            return back()->with('success', 'Transaksi berhasil dihapus');
        }
    }
    public function order(Request $request)
    {
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
        return back()->with('success', 'Pesanan berhasil dibuat');

    }

    public function midtranscallback()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_prod');

        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status;
        $fraud = $notif->fraud_status;

        $orderId = $notif->order_id;
        $order = Transaction::where('invoice_number', $orderId)->first();
        if (!$order) {
            return response()->json(['error' => 'order no found'], 404);
        }

        if ($transaction == 'capture') {
            if ($fraud == 'accept') {
                $this->updateOrderStatus($order, 'paid', $notif);
            }
        } else if ($transaction == 'cancel') {
            $this->updateOrderStatus($order, 'canceled', $notif);
        } else if ($transaction == 'deny') {
            $this->updateOrderStatus($order, 'failed', $notif);
        } else if ($transaction == 'settlement') {
            $this->updateOrderStatus($order, 'paid', $notif);
        }
    }

    protected function updateOrderStatus(Transaction $order, string $status, $notif)
    {
        $order->update(['status' => $status]);

        Transaction::updateOrCreate(['order_id' => $order->id], [
            'amount' => $notif->gross_amount,
            'status' => $status,
            'payment_date' => in_array($status, ['paid', 'sattlement']) ? now() : null
        ]);
    }
}