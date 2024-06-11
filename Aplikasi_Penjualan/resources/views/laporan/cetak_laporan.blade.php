<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Pesanan</title>
</head>
<body>
    <h1>Riwayat Pesanan</h1>
    <table border="1">
        <tr>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total Harga</th>
        </tr>
        @foreach($riwayat as $riwayat)
        <tr>
            <td>{{ $riwayat->name }}</td>
            <td>{{ $riwayat->category_id }}</td>
            <td>{{ $riwayat->price }}</td>
            <td>{{ $riwayat->jumlah }}</td>
            <td>{{ $riwayat->total_harga }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
