<x-home-layout>
    <section class="pt-[80px] pb-16 bg-snow">
        <div class="max-w-3xl mx-auto px-6 space-y-6 animate-fade-in">

            <!-- Gambar -->
            <div class="w-full overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('storage/' . $trip->flyer) }}" alt="Trip {{ $trip->nama_trip }}" class="w-full max-h-[300px] object-cover">
            </div>

            <!-- Nama + Deskripsi -->
            <div>
                <h1 class="text-2xl font-bold text-pine mb-2">{{ $trip->nama_trip }}</h1>
                <p class="text-gray-700">{{ $trip->deskripsi_trip }}</p>
            </div>

            <!-- Highlights -->
            <div class="bg-mist p-4 rounded-lg shadow-sm">
                <h2 class="font-semibold text-forest mb-2">Highlights:</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Meeting Point:</strong> {{ $trip->lokasi }}</li>
                    <li><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($trip->tanggal_trip)->translatedFormat('l, d M Y') }}</li>
                    <li><strong>Start:</strong> {{ $trip->waktu }}</li>
                    <li><strong>Tipe Trip:</strong> {{ ucfirst($trip->tipe_trip) }}</li>
                    <li><strong>Kuota:</strong> {{ $trip->kuota }} orang</li>
                    <li><strong>Harga:</strong> Rp{{ number_format($trip->harga, 0, ',', '.') }}</li>
                </ul>
            </div>

            <!-- Tombol dan Konten Jadwal -->
            <div class="bg-white border border-gray-300 p-4 rounded-lg space-y-2">
                <button id="jadwalButton" class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold">
                    Lihat Jadwal
                </button>
                <div id="jadwalContainer" class="hidden bg-white p-4 rounded-lg shadow">
                    <p><strong>Jadwal trip:</strong> {{ $trip->jadwal_trip }}</p>
                </div>

                <!-- Tombol dan Konten Itinerary -->
                <button id="itineraryButton" class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold">
                    Lihat Itinerary
                </button>
                <div id="itineraryContainer" class="hidden bg-white p-4 rounded-lg shadow">
                    <p><strong>Itinerary trip:</strong> {{ $trip->itinerary }}</p>
                </div>
            </div>

            <!-- Tombol Pesan -->
            <div class="text-center">
                <a href="{{ route('peserta.form', $trip->id) }}" class="bg-forest text-white px-6 py-3 rounded-md inline-block hover:bg-pine transition font-semibold">
                    Pesan Sekarang
                </a>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jadwalBtn = document.getElementById('jadwalButton');
            const itineraryBtn = document.getElementById('itineraryButton');
            const jadwalBox = document.getElementById('jadwalContainer');
            const itineraryBox = document.getElementById('itineraryContainer');

            jadwalBtn.addEventListener('click', function () {
                jadwalBox.classList.toggle('hidden');
            });

            itineraryBtn.addEventListener('click', function () {
                itineraryBox.classList.toggle('hidden');
            });
        });
    </script>
</x-home-layout>
