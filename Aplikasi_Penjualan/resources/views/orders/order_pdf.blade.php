<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf Penjualan Helogen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<p>Tanggal Laporan: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>

    <hr>

    <h6>Data Penjualan Helogen Store</h6>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $row)
            <tr>
                <td style="text-align: center;">{{ $row->name }}</td>
                <td style="text-align: center;">{{$row->category->name ?? 'N/A'}}</td>
                <td style="text-align: center;">{{ $row->jumlah }}</td>
                <td style="text-align: center;">Rp. {{ number_format($row->price) }}</td>
                <td style="text-align: center;">{{$row->created_at->format('d-m-Y') }}</td>
                <td style="text-align: center;">Rp. {{ number_format($row->total_harga) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: center; font-weight: bold">Total Harga</td>
                <td style="text-align: center;">
                    Rp {{ number_format($products->sum('total_harga')) }}
                </td>
            </tr>
        </tfoot>
    </table>

       
</body>
</html>
