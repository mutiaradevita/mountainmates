<x-home-layout>
    <section class="pt-[80px] pb-12 bg-snow">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            <!-- Bagian Atas: Detail Trip -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Kolom 1: Gambar + Nama + Deskripsi -->
                <div class="w-full max-w-md mx-auto overflow-hidden rounded-xl mb-4">
                    <img src="http://localhost/storage/flyers/{{ $trip->flyer }}" alt="{{ $trip->nama_trip }}" class="w-full max-h-[150px] object-cover">
                    <h1 class="text-center text-2xl font-bold text-pine mb-2 mt-4">{{ $trip->nama_trip }}</h1>
                    <p class="text-gray-700">{{ $trip->deskripsi_trip }}</p>
                </div>

                <!-- Kolom 2: Highlights -->
                <div class="space-y-4">
                    <div class="bg-mist p-4 rounded-lg">
                        <h2 class="font-semibold text-forest mb-1">Highlights:</h2>
                        <ul class="text-sm text-gray-700">
                            <li><strong>Meeting Point:</strong> {{ $trip->lokasi }}</li>
                            <li><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('l, d M Y') }}</li>
                            <li><strong>Start:</strong> {{ $trip->waktu }}</li>
                            <li><strong>Tipe Trip:</strong> {{ ucfirst($trip->tipe_trip) }}</li>
                            <li><strong>Kuota:</strong> {{ $trip->kuota }} orang</li>
                            <li><strong>Harga:</strong> Rp{{ number_format($trip->harga, 0, ',', '.') }}</li>
                        </ul>
                    </div>

                     <div class="bg-snow border border-gray-300 p-4 rounded-lg">
                        <button id="jadwalButton" class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold mb-2">Jadwal</button>
                        <button id="itineraryButton" class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold">Itinerary</button>
                    </div>

                    <div id="jadwalContainer" class="hidden">
                        <p><strong>Jadwal trip:</strong> {{ $trip->jadwal_trip }}</p> 
                    </div>
                    <div id="itineraryContainer" class="hidden">
                        <p><strong>Itinerary trip:</strong> {{ $trip->itinerary }}</p> 
                    </div>
                </div>
            </div>

             <!-- Form Pemesanan untuk Pendaki -->
            <div class="bg-white p-6 rounded-2xl shadow max-w-xl mx-auto mt-8">
                <h2 class="text-xl font-semibold text-center text-pine mb-4">Form Pemesanan</h2>
                <p class="text-xl font-bold text-gray-800 mb-4">Rp{{ number_format($trip->harga, 0, ',', '.') }}</p>

                <!-- Form Input untuk Pemesanan -->
                @auth
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
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
                        <label class="block text-sm font-medium mb-1">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" class="w-full border border-gray-300 rounded-md p-2" placeholder="Jumlah peserta" min="1" required>
                    </div>

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
    </section>
    <script>
        document.getElementById('jadwalButton').addEventListener('click', function() {
            document.getElementById('jadwalContainer').classList.toggle('hidden');
            document.getElementById('itineraryContainer').classList.add('hidden');
        });

        document.getElementById('itineraryButton').addEventListener('click', function() {
            document.getElementById('itineraryContainer').classList.toggle('hidden');
            document.getElementById('jadwalContainer').classList.add('hidden');
        });
    </script>
</x-home-layout>
