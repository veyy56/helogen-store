<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // TERDAPAT Fungsi INDEX UNTUK TAMPILAN HALAMAN LIST KATEGORI
    
    public function index()
    {
        $category = Category::with(['parent'])->orderBy('created_at', 'DESC')->paginate(10);
        $parent = Category::getParent()->orderBy('name', 'ASC')->get();

        // variabel kategori berisi daftar kategori
        return view('kategori.kategori', compact('category', 'parent'));
    }

    // TERDAPAT Fungsi STORE UNTUK MENAMBAHKAN KATEGORI BARU
    // DAN REDIRECT KE HALAMAN LIST KATEGORI
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories'
        ]);

        //FIELD slug AKAN DITAMBAHKAN KEDALAM COLLECTION $REQUEST
        $request->request->add(['slug' => $request->name]);

        Category::create($request->except('_token'));

        return redirect(route('category.index'))->with(['success' => 'Kategori Baru Ditambahkan!']);
    }

    public function edit($id)
    {
        $category = Category::find($id); //QUERY MENGAMBIL DATA BERDASARKAN ID
        $parent = Category::getParent()->orderBy('name', 'ASC')->get(); //INI SAMA DENGAN QUERY YANG ADA PADA METHOD INDEX

        //LOAD VIEW EDIT.BLADE.PHP PADA FOLDER CATEGORIES
        //DAN PASSING VARIABLE CATEGORY & PARENT
        return view('kategori.edit', compact('category', 'parent'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|max:50|unique:categories,name,' . $id
        ]);

        $category = Category::find($id); //QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //KEMUDMIAN PERBAHARUI DATANYA
        //POSISI KIRI ADALAH NAMA FIELD YANG ADA DITABLE CATEGORIES
        //POSISI KANAN ADALAH VALUE DARI FORM EDIT
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        //REDIRECT KE HALAMAN LIST KATEGORI
        return redirect(route('category.index'))->with(['success' => 'Kategori Diperbaharui!']);
    }

    public function destroy($id)
    {

        //JADI NNTI HASIL QUERYNYA AKAN MENAMBAHKAN FIELD BARU BERNAMA child_count YANG BERISI JUMLAH DATA ANAK KATEGORI
        $category = Category::withCount(['child'])->find($id);
        //JIKA KATEGORI INI TIDAK DIGUNAKAN SEBAGAI PARENT ATAU CHILDNYA = 0
        if ($category->child_count == 0) {
            //MAKA HAPUS KATEGORI INI
            $category->delete();
            //DAN REDIRECT KEMBALI KE HALAMAN LIST KATEGORI
            return redirect(route('category.index'))->with(['success' => 'Kategori Dihapus!']);
        }
        //SELAIN ITU, MAKA REDIRECT KE LIST TAPI FLASH MESSAGENYA ERROR YANG BERARTI KATEGORI INI SEDANG DIGUNAKAN
        return redirect(route('category.index'))->with(['error' => 'Kategori Ini Memiliki Anak Kategori!']);
    }
}
