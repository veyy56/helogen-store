@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pesanan</h1>
@stop

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
          
          	<!-- TAMBAHKAN ENCTYPE="" KETIKA MENGIRIMKAN FILE PADA FORM -->
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tambah Pesanan</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    
                                    <!-- DATA KATEGORI DIGUNAKAN DISINI, SEHINGGA SETIAP PRODUK USER BISA MEMILIH KATEGORINYA -->
                                    <select name="category_id" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($category as $row)
                                        <option value="{{ $row->id }}" {{ old('category_id') == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah pesanan</label>
                                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
                                    <p class="text-danger">{{ $errors->first('jumlah') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="total">Total Harga</label>
                                    <input type="number" id="total" class="form-control" value="0" readonly>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        //TERAPKAN CKEDITOR PADA TEXTAREA DENGAN ID DESCRIPTION
        CKEDITOR.replace('description');
    </script>
    <script> console.log('Hi!'); </script>
    <script>
    // Fungsi untuk menghitung total harga
    function hitungTotalHarga() {
        // Mengambil nilai harga dari input dengan id 'price'
        var harga = parseFloat(document.getElementsByName('price')[0].value);
        
        // Mengambil nilai jumlah dari input dengan id 'jumlah'
        var jumlah = parseFloat(document.getElementsByName('jumlah')[0].value);
        
        // Menghitung total harga
        var total = harga * jumlah;
        
        // Menetapkan nilai total harga ke input dengan id 'total'
        document.getElementById('total').value = total.toFixed(0);
    }
    
    // Memanggil fungsi hitungTotalHarga() saat nilai harga atau jumlah diubah
    document.getElementsByName('price')[0].addEventListener('input', hitungTotalHarga);
    document.getElementsByName('jumlah')[0].addEventListener('input', hitungTotalHarga);
</script>

@stop
