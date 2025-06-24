<x-home-layout>
    <section class="pt-[80px] pb-12 bg-snow">
        <div class="max-w-7xl mx-auto px-6 space-y-12">
            <!-- Bagian Atas: Detail Trip -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Kolom 1: Gambar + Nama + Deskripsi -->
                <div class="w-full max-w-md mx-auto overflow-hidden rounded-xl mb-4">
                    <img src="{{ asset('storage/' . $trip->flyer) }}" alt="{{ $trip->nama_trip }}" class="w-full max-h-[150px] object-cover">
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
    </section>

    <section class="bg-mist py-12">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-center text-pine mb-8">Ulasan dari Peserta</h2>

            @if($trip->pengelola && $trip->pengelola->ulasanDiberikan->count())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($trip->pengelola->ulasanDiberikan as $ulasan)
                        <div class="bg-white p-6 rounded-xl shadow">
                            <p class="text-gray-700 italic mb-3">“{{ $ulasan->komentar }}”</p>
                            <div class="text-sm text-gray-600">
                                <strong>{{ $ulasan->peserta->user->name ?? 'Anonim' }}</strong>
                                <div class="text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        {{ $i <= $ulasan->rating ? '★' : '☆' }}
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 italic">Belum ada ulasan untuk pengelola ini.</p>
            @endif
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
