<x-home-layout>
    <div class="min-h-screen bg-snow pb-12 flex items-center justify-center pt-[80px]">
        <div class="max-w-xl w-full px-4 py-8 bg-white shadow rounded-xl mt-6">
            <h2 class="text-2xl font-bold text-pine mb-6">Bayar Sekarang</h2>
            <p class="mb-2">Total yang harus dibayar:</p>
            <p class="text-xl font-bold text-forest mb-6">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
            @section('scripts')
<!-- Script Snap Midtrans -->
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil!');
                console.log(result);
                // Opsional redirect
                window.location.href = '/peserta/transaksi/sukses';
            },
            onPending: function(result) {
                alert('Menunggu pembayaran.');
                console.log(result);
            },
            onError: function(result) {
                alert('Terjadi kesalahan.');
                console.log(result);
            }
        });
    };
</script>
@endsection

            <p class="mb-4 text-sm text-gray-600">Silakan transfer ke rekening berikut:</p>
            <ul class="mb-6 text-sm text-gray-700 space-y-1">
                <li><strong>Bank:</strong> BRI</li>
                <li><strong>No Rek:</strong> 1234567890</li>
                <li><strong>Atas Nama:</strong> CV Mountain Mates</li>
            </ul>
        </div>
    </div>
</x-home-layout>
