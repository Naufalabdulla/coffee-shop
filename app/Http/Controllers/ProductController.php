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

        // Mengirim data produk ke view
        return view('product.index', compact('products'));
    }
}
