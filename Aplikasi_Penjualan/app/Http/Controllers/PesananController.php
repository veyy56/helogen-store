<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Category;

use PDF;
// use App\Models\Order;

class PesananController extends Controller
{
    public function index()
    {
        $product = Pesanan::with(['category'])->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $product = $product->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $product = $product->paginate(10);
        return view('pesanan.index', compact('product'));
    }

    public function cetakPesanan()
    {
        $products = Pesanan::with(['category'])->orderBy('created_at', 'DESC')->get();
        
        $pdf = PDF::loadView('orders.order_pdf', compact('products'));
        return $pdf->download('laporan-penjualan.pdf');
    }


    public function create()
    {
        $categories = Category::orderBy('name', 'DESC')->get();
        return view('pesanan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        // Save the order
        Pesanan::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->price * $request->jumlah,
        ]);

        return redirect(route('pesanan.index'))->with('success', 'Produk Pesan Ditambahkan');
    }


}
