<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pesanan;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Jobs\ProductJob;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = pesanan::with(['category'])->orderBy('created_at', 'DESC');
        if (request()->q != '') {
            $pesanan = $pesanan->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $pesanan = $pesanan->paginate(10);
        return view('pesanan.pesanan', compact('pesanan'));
    }

    public function create()
    {
        $category = Category::orderBy('name', 'DESC')->get();

        return view('pesanan.create', compact('category'));
    }

    public function store(Request $request)
    {
        //VALIDASI REQUESTNYA
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id', //CATEGORY_ID KITA CEK HARUS ADA DI TABLE CATEGORIES DENGAN FIELD ID
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:png,jpeg,jpg' //GAMBAR DIVALIDASI HARUS BERTIPE PNG,JPG DAN JPEG
        ]);

        //JIKA FILENYA ADA
        if ($request->hasFile('image')) {
            //MAKA KITA SIMPAN SEMENTARA FILE TERSEBUT KEDALAM VARIABLE FILE
            $file = $request->file('image');
            //KEMUDIAN NAMA FILENYA KITA BUAT CUSTOMER DENGAN PERPADUAN TIME DAN SLUG DARI NAMA orders. ADAPUN EXTENSIONNYA KITA GUNAKAN BAWAAN FILE TERSEBUT
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //SIMPAN FILENYA KEDALAM FOLDER PUBLIC/PRODUCTS, DAN PARAMETER KEDUA ADALAH NAMA CUSTOM UNTUK FILE TERSEBUT
            $file->storeAs('public/products', $filename);

            //SETELAH FILE TERSEBUT DISIMPAN, KITA SIMPAN INFORMASI PRODUKNYA KEDALAM DATABASE
            $pesanan = Pesanan::create([
                'name' => $request->name,
                'slug' => $request->name,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'image' => $filename, //PASTIKAN MENGGUNAKAN VARIABLE FILENAM YANG HANYA BERISI NAMA FILE SAJA (STRING)
                'price' => $request->price,
                'weight' => $request->weight,
                'stock' => $request->stock,
                'status' => $request->status
            ]);
            //JIKA SUDAH MAKA REDIRECT KE LIST orders
            return redirect(route('pesanan.index'))->with(['success' => 'orders Baru Ditambahkan']);
        }
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id); //QUERY UNTUK MENGAMBIL DATA orders BERDASARKAN ID
        //HAPUS FILE IMAGE DARI STORAGE PATH DIIKUTI DENGNA NAMA IMAGE YANG DIAMBIL DARI DATABASE
        File::delete(storage_path('app/public/products/' . $pesanan->image));
        //KEMUDIAN HAPUS DATA orders DARI DATABASE
        $pesanan->delete();
        //DAN REDIRECT KE HALAMAN LIST orders
        return redirect(route('pesanan.index'))->with(['success' => 'orders Sudah Dihapus']);
    }

    public function massUploadForm()
    {
        $category = Category::orderBy('name', 'DESC')->get();
        return view('orders.bulk', compact('category'));
    }

    public function massUpload(Request $request)
    {
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:xlsx' //PASTIKAN FORMAT FILE YANG DITERIMA ADALAH XLSX
        ]);

        //JIKA FILE-NYA ADA
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '-pesanan.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename); //MAKA SIMPAN FILE TERSEBUT DI STORAGE/APP/PUBLIC/UPLOADS

            //BUAT JADWAL UNTUK PROSES FILE TERSEBUT DENGAN MENGGUNAKAN JOB
            //ADAPUN PADA DISPATCH KITA MENGIRIMKAN DUA PARAMETER SEBAGAI INFORMASI
            //YAKNI KATEGORI ID DAN NAMA FILENYA YANG SUDAH DISIMPAN
            ProductJob::dispatch($request->category_id, $filename);
            return redirect()->back()->with(['success' => 'Upload orders Dijadwalkan']);
        }
    }

    public function edit($id)
    {
        $pesanan = Pesanan::find($id); //AMBIL DATA orders TERKAIT BERDASARKAN ID
        $category = Category::orderBy('name', 'DESC')->get(); //AMBIL SEMUA DATA KATEGORI
        return view('orders.edit', compact('pesanan', 'category')); //LOAD VIEW DAN PASSING DATANYA KE VIEW
    }

    public function update(Request $request, $id)
    {
    //VALIDASI DATA YANG DIKIRIM
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'weight' => 'required|integer',
            'image' => 'nullable|image|mimes:png,jpeg,jpg' //IMAGE BISA NULLABLE
        ]);

        $pesanan = Pesanan::find($id); //AMBIL DATA orders YANG AKAN DIEDIT BERDASARKAN ID
        $filename = $pesanan->image; //SIMPAN SEMENTARA NAMA FILE IMAGE SAAT INI

        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/products', $filename);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/products/' . $pesanan->image));
        }

    //KEMUDIAN UPDATE orders TERSEBUT
        $pesanan->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'weight' => $request->weight,
            'image' => $filename
        ]);
        return redirect(route('orders.index'))->with(['success' => 'Data orders Diperbaharui']);
    }
}
