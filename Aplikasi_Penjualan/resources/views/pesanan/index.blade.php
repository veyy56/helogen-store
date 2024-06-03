@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pesanan</h1>
@stop

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Pesanan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Daftar Pesanan Pelanggan
                            </h4>
                            <div class="float-right">
                                <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                             <!-- TABLE UNTUK MENAMPILKAN DATA PRODUK -->
                             <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Created At</th>
                                            <th>Total Harga</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($product as $row)
                                        <tr>
                                            <td>
                                                <!-- <strong>{{ $product->firstItem() }}</strong> -->
                                                <strong>{{ $row->name }}</strong>
                                                <td>{{$row->category->name }}</span></td>

                                                <td>Rp. {{number_format ($row->price) }}</span></td>

                                                <td>{{$row->created_at->format('d-m-Y') }}</span></td>

                                                <td>{{ $row->total_harga }}</span></td><br>
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="6" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse

                                        
                                    </tbody>
                                </table>
                            </div>
                            {!! $product->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
