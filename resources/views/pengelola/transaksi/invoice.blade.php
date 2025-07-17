<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Invoice Pembayaran</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      padding: 40px;
      color: #2F2F2F;
      font-size: 14px;
    }

    h1 {
      color: #14532D;
      font-size: 24px;
      text-align: center;
    }

    .section {
      margin-bottom: 30px;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 10px;
      color: #14532D;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #DEF7EC;
    }

    .highlight {
      background-color: #ECFDF5;
      padding: 12px;
      border-left: 4px solid #059669;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: #888;
      margin-top: 60px;
    }
  </style>
</head>
<body>
  <h1>Invoice Pembayaran</h1>
  <p style="text-align: center;">ID: <strong>INV-{{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}</strong></p>

  <div class="section">
    <div class="section-title">Informasi Peserta</div>
    <table>
      <tr><th>Nama</th><td>{{ $transaksi->nama }}</td></tr>
      <tr><th>Email</th><td>{{ $transaksi->email }}</td></tr>
      <tr><th>Nomor Telepon</th><td>{{ $transaksi->nomor_telepon }}</td></tr>
    </table>
  </div>

  <div class="section">
    <div class="section-title">Detail Trip</div>
    <table>
      <tr><th>Nama Trip</th><td>{{ $transaksi->trip->nama_trip }}</td></tr>
      <tr><th>Lokasi</th><td>{{ $transaksi->trip->lokasi }}</td></tr>
      <tr>
        <th>Tanggal Trip</th>
        <td>{{ \Carbon\Carbon::parse($transaksi->trip->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($transaksi->trip->tanggal_selesai)->format('d M Y') }}</td>
      </tr>
      <tr><th>Jumlah Peserta</th><td>{{ $transaksi->jumlah_peserta }}</td></tr>
    </table>
  </div>

  <div class="section">
    <div class="section-title">Rincian Pembayaran</div>
    <table>
      <tr>
        <td colspan="1">Total Harga</td>
        <td colspan="2"><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
      </tr>
      <tr>
        <td>DP</td>
        <td>Rp {{ number_format($transaksi->total_dp, 0, ',', '.') }}</td>
        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y') }}</td>
      </tr>

      @if($transaksi->status_pembayaran === 'lunas')
        <tr>
          <td>Pelunasan</td>
          <td>Rp {{ number_format($transaksi->total_pelunasan, 0, ',', '.') }}</td>
          <td>{{ \Carbon\Carbon::parse($transaksi->updated_at)->format('d M Y') }}</td>
        </tr>
      @else
        <tr>
          <td><strong>Sisa yang Harus Dibayarkan</strong></td>
          <td colspan="2"><strong>Rp {{ number_format($transaksi->total - $transaksi->total_dp, 0, ',', '.') }}</strong></td>
        </tr>
      @endif
    </table>

    <div class="highlight">
      Status Pembayaran: <strong style="color: green">{{ ucfirst($transaksi->status_pembayaran) }}</strong>
    </div>
  </div>

  <div class="footer">
    Terima kasih telah mempercayakan perjalanan peserta bersama Mountain Mates.<br>
    Jika ada pertanyaan, silakan hubungi tim Anda.
  </div>
</body>
</html>
