<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-semibold">Coffee Shop</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-gray-700 hover:text-gray-900">Home</a>
                        <a href="/order" class="text-gray-700 hover:text-gray-900">Menu</a>
                        <a href="/transactions" class="text-gray-700 hover:text-gray-900">Transactions</a>
                    </div>
                </div>
            </div>
        </nav>
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
