<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Coffee Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }
        
        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .header-nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .header-nav a, .header-nav button {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .header-nav a:hover, .header-nav button:hover {
            background: rgba(255, 255, 255, 0.4);
        }
        
        .cart-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        
        .cart-title {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #2a5298;
            padding-bottom: 15px;
        }
        
        .empty-cart {
            text-align: center;
            padding: 50px;
            color: #666;
        }
        
        .empty-cart p {
            font-size: 1.1em;
            margin-bottom: 20px;
        }
        
        .empty-cart a {
            display: inline-block;
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .empty-cart a:hover {
            transform: scale(1.05);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        
        table thead {
            background: #f8f9fa;
        }
        
        table th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #ddd;
        }
        
        table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .quantity-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .quantity-form input {
            width: 70px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        
        .btn-update {
            background: #28a745;
            color: white;
        }
        
        .btn-update:hover {
            background: #218838;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        .cart-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 30px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.1em;
            margin-bottom: 15px;
        }
        
        .summary-row.total {
            font-size: 1.3em;
            font-weight: bold;
            color: #2a5298;
            border-top: 2px solid #ddd;
            padding-top: 15px;
        }
        
        .checkout-btn {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .checkout-btn:hover {
            transform: scale(1.02);
        }
        
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🛒 Keranjang Belanja</h1>
            <div class="header-nav">
                <a href="/">← Kembali ke Produk</a>
                @auth
                    <form method="POST" action="/logout" style="display: inline;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endauth
            </div>
        </header>

        <div class="cart-container">
            @if(session('success'))
                <div class="success-message">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="empty-cart">
                    <p>😴 Keranjang belanja Anda kosong</p>
                    <a href="/">Mulai berbelanja sekarang</a>
                </div>
            @else
                <h2 class="cart-title">Daftar Pesanan Anda</h2>
                
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Kuantitas</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product->name }}</td>
                                <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td><strong>Rp {{ number_format($item->total_price, 0, ',', '.') }}</strong></td>
                                <td>
                                    <div style="display: flex; gap: 10px;">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <div class="quantity-form">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                                <button type="submit" class="btn btn-update">Update</button>
                                            </div>
                                        </form>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete" onclick="return confirm('Hapus item ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Jumlah Item:</span>
                        <span>{{ $cartItems->sum('quantity') }} item</span>
                    </div>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($cartItems->sum('total_price'), 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Ongkir:</span>
                        <span>Rp 10.000</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total Pembayaran:</span>
                        <span>Rp {{ number_format($cartItems->sum('total_price') + 10000, 0, ',', '.') }}</span>
                    </div>
                </div>

                <button class="checkout-btn" onclick="alert('Fitur pembayaran sedang dikembangkan')">Lanjutkan ke Pembayaran</button>
            @endif
        </div>
    </div>
</body>
</html>
