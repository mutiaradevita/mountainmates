@extends('layouts.app')

@section('content')
<div class="pt-[90px] pb-20 bg-snow min-h-screen">
    <div class="max-w-3xl mx-auto px-4 md:px-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl p-8 space-y-6">

            <h2 class="text-2xl font-bold text-center text-pine mb-6">💳 Pelunasan Trip</h2>

            <div class="text-sm text-gray-700 space-y-2">
                <p><strong>Trip:</strong> {{ $transaksi->trip->nama_trip ?? '-' }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($transaksi->total, 0, ',', '.') }}</p>
                <p><strong>DP Dibayar:</strong> Rp {{ number_format($transaksi->total_dp, 0, ',', '.') }}</p>
                <p><strong>Sisa Pelunasan:</strong> <span class="text-lg font-semibold text-forest">Rp {{ number_format($transaksi->total - $transaksi->total_dp, 0, ',', '.') }}</span></p>
            </div>

            <div class="pt-6">
                <button id="pay-button" class="w-full bg-pine text-white px-5 py-3 rounded-lg hover:bg-forest transition font-semibold">
                    🔁 Bayar Pelunasan Sekarang
                </button>
            </div>

            <div class="pt-4 text-xs text-gray-500 text-center">
                Pastikan kamu menyelesaikan pembayaran untuk mengamankan slot tripmu.
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Script --}}
<script type="text/javascript" src="{{ config('midtrans.snap_url') }}"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const payBtn = document.getElementById("pay-button");
        if (payBtn) {
            payBtn.addEventListener("click", function (e) {
                e.preventDefault();
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function () {
                        alert("Pelunasan berhasil!");
                        location.href = "{{ route('peserta.transaksi.index') }}";
                    },
                    onPending: function () {
                        alert("Pelunasan tertunda.");
                    },
                    onError: function () {
                        alert("Pelunasan gagal.");
                    },
                    onClose: function () {
                        alert("Popup ditutup tanpa menyelesaikan pembayaran.");
                    }
                });
            });
        }
    });
</script>
@endsection
