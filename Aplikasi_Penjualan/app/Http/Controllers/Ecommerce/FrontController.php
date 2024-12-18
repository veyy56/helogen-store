<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class FrontController extends Controller
{
    // Terdapat fungsi index untuk tampilan website menu costumer
    public function index()
    {
        // Menampilkan produk terbaru, dengan paginasi 8 produk per halaman
        $products = Product::orderBy('created_at', 'DESC')->paginate(8);

        return view('costumer.index', compact('products'));
    }

    public function product()
    {
        // Menampilkan semua produk dengan paginasi 12 produk per halaman
        $products = Product::orderBy('created_at', 'DESC')->paginate(12);

        return view('costumer.produk', compact('products'));
    }

    public function categoryProduct($slug)
    {
        // Menampilkan produk berdasarkan kategori
        $products = Category::where('slug', $slug)
            ->first()
            ->product()
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('costumer.produk', compact('products'));
    }

    public function show($slug)
    {
        // Menampilkan detail produk berdasarkan slug
        $product = Product::with(['category'])->where('slug', $slug)->first();

        return view('costumer.show', compact('product'));
    }

    // Tambahkan metode baru untuk fitur pencarian
    public function search(Request $request)
    {
        $query = $request->input('q'); // Mengambil parameter pencarian dari input form
        
        // Query untuk mencari produk berdasarkan nama
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('costumer.produk', compact('products'));
    }
}
