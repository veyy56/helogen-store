<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Category;

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

    public function destroy($id)
    {
        // Add your destroy logic here if needed
    }

    public function massUploadForm()
    {
        // Add your mass upload form logic here if needed
    }

    public function massUpload(Request $request)
    {
        // Add your mass upload logic here if needed
    }

    public function edit($id)
    {
        // Add your edit logic here if needed
    }

    public function update(Request $request, $id)
    {
        // Add your update logic here if needed
    }
}
