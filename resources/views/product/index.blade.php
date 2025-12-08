<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop - Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            overflow: hidden;
        }
        
        .main-container {
            display: flex;
            height: 100vh;
        }
        
        .left-section {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
            background: white;
        }
        
        .right-section {
            width: 380px;
            background: #f9f9f9;
            border-left: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }
        
        header {
            margin-bottom: 30px;
        }
        
        header h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 5px;
        }
        
        header p {
            color: #999;
            font-size: 0.95em;
        }
        
        .search-bar {
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }
        
        .search-bar input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
        }
        
        .search-bar input:focus {
            outline: none;
            border-color: #8B6F47;
        }
        
        .categories {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .cat-btn {
            padding: 8px 16px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9em;
        }
        
        .cat-btn.active {
            background: #8B6F47;
            color: white;
            border-color: #8B6F47;
        }
        
        .cat-btn:hover {
            border-color: #8B6F47;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 20px;
        }
        
        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid #f0f0f0;
        }
        
        .product-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        
        .product-image {
            width: 100%;
            height: 140px;
            background: linear-gradient(135deg, #8B6F47 0%, #A0826D 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3em;
        }
        
        .product-info {
            padding: 12px;
        }
        
        .product-name {
            font-size: 0.9em;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        
        .product-price {
            font-size: 1.1em;
            color: #E74C3C;
            font-weight: bold;
        }
        
        /* Right Panel Styles */
        .cart-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .cart-header h2 {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 5px;
        }
        
        .cart-type {
            color: #999;
            font-size: 0.9em;
        }
        
        .cart-items-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }
        
        .empty-cart-msg {
            text-align: center;
            color: #999;
            padding: 40px 20px;
        }
        
        .cart-item {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .cart-item-image {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #8B6F47 0%, #A0826D 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5em;
            flex-shrink: 0;
        }
        
        .cart-item-details {
            flex: 1;
        }
        
        .cart-item-name {
            font-weight: bold;
            color: #333;
            font-size: 0.9em;
            margin-bottom: 5px;
        }
        
        .cart-item-price {
            color: #E74C3C;
            font-size: 0.85em;
        }
        
        .cart-item-qty {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }
        
        .qty-btn {
            width: 20px;
            height: 20px;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            transition: all 0.2s;
        }
        
        .qty-btn:hover {
            background: #f0f0f0;
        }
        
        .qty-display {
            font-size: 0.85em;
            color: #666;
            min-width: 30px;
            text-align: center;
        }
        
        .delete-btn {
            color: #E74C3C;
            cursor: pointer;
            font-size: 1.2em;
            margin-left: auto;
            transition: all 0.2s;
        }
        
        .delete-btn:hover {
            color: #c0392b;
        }
        
        .cart-summary {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.9em;
            color: #666;
        }
        
        .summary-row.total {
            font-size: 1.1em;
            font-weight: bold;
            color: #333;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .checkout-btn {
            width: 100%;
            padding: 12px;
            background: #E74C3C;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s;
        }
        
        .checkout-btn:hover {
            background: #c0392b;
        }
        
        .checkout-btn:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
        }
        
        .login-prompt {
            text-align: center;
            padding: 30px 20px;
            color: #999;
        }
        
        .login-link {
            display: inline-block;
            padding: 10px 20px;
            background: #8B6F47;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 15px;
            transition: all 0.3s;
        }
        
        .login-link:hover {
            background: #6d5735;
        }
        
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .logout-btn {
            background: #E74C3C;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Left Section - Products -->
        <div class="left-section">
            <div class="top-nav">
                <div>
                    <h1>☕ Coffee Shop</h1>
                </div>
                @auth
                    <form method="POST" action="/logout" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                @endauth
            </div>

            <header>
                <h1 style="font-size: 1.8em; margin-bottom: 5px;">Menu Kopi</h1>
                <p>Temukan kopi favorit Anda</p>
            </header>

            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari menu ...">
            </div>

            <div class="categories">
                <button class="cat-btn active" onclick="filterProducts('all')">Semua</button>
                <button class="cat-btn" onclick="filterProducts('espresso')">Espresso</button>
                <button class="cat-btn" onclick="filterProducts('milk')">Dengan Susu</button>
                <button class="cat-btn" onclick="filterProducts('cold')">Dingin</button>
            </div>

            @if($products->count() > 0)
                <div class="products-grid" id="productsGrid">
                    @foreach($products as $product)
                        <div class="product-card" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
                            <div class="product-image">☕</div>
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-price">${{ number_format($product->price / 1000, 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-cart-msg">
                    <p>Produk tidak tersedia</p>
                </div>
            @endif
        </div>

        <!-- Right Section - Cart -->
        <div class="right-section">
            <div class="cart-header">
                <h2>My Order</h2>
                @auth
                    <div class="cart-type">Take out</div>
                @else
                    <div class="cart-type">Guest</div>
                @endauth
            </div>

            <div class="cart-items-container" id="cartItems">
                @auth
                    <div id="cartContent">
                        <div class="empty-cart-msg">Keranjang kosong</div>
                    </div>
                @else
                    <div class="login-prompt">
                        <p>Silakan login untuk mulai berbelanja</p>
                        <a href="/login" class="login-link">Login Sekarang</a>
                    </div>
                @endauth
            </div>

            @auth
                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (10%)</span>
                        <span id="tax">$0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total">$0.00</span>
                    </div>
                    <button class="checkout-btn" id="checkoutBtn" disabled>Checkout</button>
                </div>
            @endauth
        </div>
    </div>

    <script>
        // Cart data management
        let cartData = {};
        const TAX_RATE = 0.10;

        @auth
        // Load cart from localStorage for demo
        function initCart() {
            const saved = localStorage.getItem('tempCart');
            if (saved) {
                cartData = JSON.parse(saved);
            }
            updateCartDisplay();
        }

        function addToCart(productId, productName, price) {
            if (!cartData[productId]) {
                cartData[productId] = {
                    id: productId,
                    name: productName,
                    price: price,
                    quantity: 0
                };
            }
            cartData[productId].quantity++;
            localStorage.setItem('tempCart', JSON.stringify(cartData));
            updateCartDisplay();
        }

        function updateQuantity(productId, delta) {
            if (cartData[productId]) {
                cartData[productId].quantity += delta;
                if (cartData[productId].quantity <= 0) {
                    delete cartData[productId];
                } else {
                    updateCartDisplay();
                }
            }
            localStorage.setItem('tempCart', JSON.stringify(cartData));
            updateCartDisplay();
        }

        function removeFromCart(productId) {
            delete cartData[productId];
            localStorage.setItem('tempCart', JSON.stringify(cartData));
            updateCartDisplay();
        }

        function updateCartDisplay() {
            const cartContent = document.getElementById('cartContent');
            const items = Object.values(cartData);

            if (items.length === 0) {
                cartContent.innerHTML = '<div class="empty-cart-msg">Keranjang kosong</div>';
                document.getElementById('checkoutBtn').disabled = true;
                updateSummary();
                return;
            }

            document.getElementById('checkoutBtn').disabled = false;

            let html = '';
            items.forEach(item => {
                const itemTotal = item.price * item.quantity;
                html += `
                    <div class="cart-item">
                        <div class="cart-item-image">☕</div>
                        <div class="cart-item-details">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">$${(item.price / 1000).toFixed(2)}</div>
                            <div class="cart-item-qty">
                                <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">−</button>
                                <span class="qty-display">${item.quantity}</span>
                                <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                            </div>
                        </div>
                        <div class="delete-btn" onclick="removeFromCart(${item.id})">×</div>
                    </div>
                `;
            });
            cartContent.innerHTML = html;
            updateSummary();
        }

        function updateSummary() {
            const items = Object.values(cartData);
            const subtotal = items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const tax = subtotal * TAX_RATE;
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = '$' + (subtotal / 1000).toFixed(2);
            document.getElementById('tax').textContent = '$' + (tax / 1000).toFixed(2);
            document.getElementById('total').textContent = '$' + (total / 1000).toFixed(2);
        }

        document.getElementById('checkoutBtn').addEventListener('click', function() {
            if (Object.keys(cartData).length > 0) {
                alert('Fitur checkout sedang dikembangkan');
                // Bisa diarahkan ke halaman checkout/payment nantinya
            }
        });

        // Initialize cart on page load
        initCart();

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                const name = card.querySelector('.product-name').textContent.toLowerCase();
                card.style.display = name.includes(searchTerm) ? '' : 'none';
            });
        });

        // Category filter
        function filterProducts(category) {
            // Update button state
            document.querySelectorAll('.cat-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
        @endauth
    </script>
</body>
</html>
