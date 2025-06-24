<x-home-layout>
    <section class="pt-[80px] pb-16 bg-snow">
         <!-- Kolom 2: Form -->
                <div class="self-start">
                    <div class="bg-white p-6 rounded-2xl shadow-md w-full">
                        <h2 class="text-xl font-semibold text-center text-pine mb-4">Form Pemesanan</h2>
                        <p class="text-xl font-bold text-gray-800 mb-4">Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>

                        @auth
                        <form action="{{ route('transaksi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_trip" value="{{ $trip->id }}">

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Nama Pemesan</label>
                                <input type="text" name="nama" class="w-full border border-gray-300 rounded-md p-2" placeholder="Nama lengkap Anda" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                                <input type="tel" name="nomor_telepon" class="w-full border border-gray-300 rounded-md p-2" placeholder="Nomor telepon yang dapat dihubungi" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="email" class="w-full border border-gray-300 rounded-md p-2" placeholder="Email Anda" required>
                            </div>

                            <div class="mb-4">
                                <button type="button" id="copyPemesanToPeserta" class="text-sm text-blue-600 underline hover:text-blue-800">
                                    Samakan dengan data pemesan
                                </button>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Jumlah Peserta</label>
                                <input type="number" id="jumlahPeserta" name="jumlah_peserta" class="w-full border border-gray-300 rounded-md p-2" placeholder="Jumlah peserta" min="1" required>
                            </div>

                            <div id="pesertaFields" class="space-y-4 mt-4"></div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Pilih Paket</label>
                                <select name="paket" class="w-full border border-gray-300 rounded-md p-2">
                                    <option value="regular">Paket Reguler</option>
                                    <option value="vip">Paket VIP</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Bulan</label>
                                <select name="bulan" class="w-full border border-gray-300 rounded-md p-2">
                                    <option>Pilih Bulan</option>
                                    <option>Juli</option>
                                    <option>Agustus</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Pilih Jadwal</label>
                                <select name="jadwal" class="w-full border border-gray-300 rounded-md p-2" required>
                                    <option value="">Pilih salah satu</option>
                                    <option>1-3</option>
                                    <option>7-9</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Catatan Khusus</label>
                                <textarea name="catatan_khusus" class="w-full border border-gray-300 rounded-md p-2" placeholder="Catatan khusus untuk trip" rows="4"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="w-full border border-gray-300 rounded-md p-2">
                                    <option value="bank_transfer">Transfer Bank</option>
                                    <option value="e_wallet">Qris</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox" required>
                                    <span class="ml-2 text-sm">Saya setuju dengan <a href="#" class="text-blue-500">syarat dan ketentuan</a>.</span>
                                </label>
                            </div>

                            <button type="submit" class="bg-forest text-white px-4 py-2 rounded-md w-full hover:bg-pine transition">
                                Pesan Sekarang
                            </button>
                        </form>
                        @else
                            <p class="text-center text-red-500 font-semibold mt-4">Login dulu ya sebelum memesan. <a href="{{ route('login') }}" class="text-blue-500 underline">Klik di sini untuk login</a>.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahPesertaInput = document.querySelector('input[name="jumlah_peserta"]');
        const pesertaFieldsContainer = document.getElementById('pesertaFields');
        const btnCopyPemesan = document.getElementById('copyPemesanToPeserta');

        if (jumlahPesertaInput) {
            jumlahPesertaInput.addEventListener('input', generatePesertaFields);
        }

        if (btnCopyPemesan) {
            btnCopyPemesan.addEventListener('click', function () {
                const nama = document.querySelector('input[name="nama"]').value;
                const telepon = document.querySelector('input[name="nomor_telepon"]').value;
                const email = document.querySelector('input[name="email"]').value;

                const peserta1 = pesertaFieldsContainer.querySelector('div.border');

                if (peserta1) {
                    peserta1.querySelector(`input[name="peserta[1][nama]"]`).value = nama;
                    peserta1.querySelector(`input[name="peserta[1][telepon]"]`).value = telepon;
                    peserta1.querySelector(`input[name="peserta[1][email]"]`).value = email;
                } else {
                    alert('Form peserta belum tersedia. Masukkan jumlah peserta dulu.');
                }
            });
        }

        function generatePesertaFields() {
            const jumlah = parseInt(jumlahPesertaInput.value);
            pesertaFieldsContainer.innerHTML = '';

            if (!isNaN(jumlah) && jumlah > 0 && jumlah <= 100) {
                for (let i = 1; i <= jumlah; i++) {
                    const fieldHTML = `
                        <div class="border p-4 rounded-md bg-mist">
                            <h3 class="font-semibold mb-2 text-forest">Data Peserta ${i}</h3>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Nama</label>
                                <input type="text" name="peserta[${i}][nama]" required class="w-full border border-gray-300 rounded-md p-2" placeholder="Nama Peserta ${i}">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
                                <input type="tel" name="peserta[${i}][telepon]" required class="w-full border border-gray-300 rounded-md p-2" placeholder="Nomor Telepon Peserta ${i}">
                            </div>
                            <div class="mb-2">
                                <label class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="peserta[${i}][email]" required class="w-full border border-gray-300 rounded-md p-2" placeholder="Email Peserta ${i}">
                            </div>
                        </div>
                    `;
                    pesertaFieldsContainer.insertAdjacentHTML('beforeend', fieldHTML);
                }
            }
        }
    });
    </script>
</x-home-layout>