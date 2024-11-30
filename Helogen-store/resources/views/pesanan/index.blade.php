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
                                <a href="{{ route('pesanan.cetak') }}" class="btn btn-danger btn-sm">Cetak PDF</a>
                            </div>
                            <!-- Uji COba -->
                            <!-- <form action="{{ route('pesanan.index') }}" method="get">
                                <div class="input-group mb-3 col-md-4 float-right">
                                    <input type="text" id="created_at" name="date" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">Filter</button>
                                    </div>
                                    <a target="_blank" class="btn btn-primary ml-2" id="exportpdf">Export PDF</a>
                                </div>
                            </form> -->
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
                                            <th style="text-align: center;">Nama Produk</th>
                                            <th style="text-align: center;">Kategori</th>
                                            <th style="text-align: center;">Jumlah</th>
                                            <th style="text-align: center;">Harga</th>
                                            <th style="text-align: center;">Tanggal</th>
                                            <th style="text-align: center;">Total Harga</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($product as $row)
                                        <tr>
                                            <td style="text-align: center;">{{ $row->name }}</td>
                                            <td style="text-align: center;">{{ $row->category->name ?? 'N/A' }}</td>
                                            <td style="text-align: center;">{{ $row->jumlah }}</td>
                                            <td style="text-align: center;">Rp. {{ number_format($row->price) }}</td>
                                            <td style="text-align: center;">{{ $row->created_at->format('d-m-Y') }}</td>
                                            <td style="text-align: center;">Rp. {{ number_format($row->total_harga) }}</td>
                                        </tr>
                                        @empty
                                            <td colspan="6" class="text-center">Tidak ada data</td>
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
@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function() {
            let start = moment().startOf('month')
            let end = moment().endOf('month')

            $('#exportpdf').attr('href', 'order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

            $('#created_at').daterangepicker({
                startDate: start,
                endDate: end
            }, function(first, last) {
                $('#exportpdf').attr('href', 'order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
            })
        })
    </script>
@endsection()