<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Trip</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Trip</th>
                <th>Jumlah Peserta</th>
                <th>Total</th>
                <th>Status</th>
                <th>Status Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $i => $t)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $t->nama }}</td>
                    <td>{{ $t->email }}</td>
                    <td>{{ $t->trip->nama_trip ?? '-' }}</td>
                    <td>{{ $t->jumlah_peserta }}</td>
                    <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($t->status) }}</td>
                    <td>{{ ucfirst($t->status_pembayaran) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
