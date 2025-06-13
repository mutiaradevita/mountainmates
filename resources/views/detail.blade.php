<x-home-layout>
    <section class="pt-[80px] pb-12 bg-snow">
    <div class="max-w-7xl mx-auto px-6 space-y-12">
        <!-- Bagian Atas: 2 Kolom -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Kolom 1: Gambar + Nama + Keterangan -->
            <div class="w-full max-w-md mx-auto overflow-hidden rounded-xl mb-4">
                <img src="{{ asset('img/img1.jpeg') }}" alt="Gunung Rinjani"
                     class="w-full h-[150px] object-cover"> 
                <h1 class="text-center text-2xl font-bold text-pine mb-2 mt-4">Pendakian Gunung Rinjani</h1> <!-- Added margin-top -->
                <p class="text-gray-700">
                    Rasakan pengalaman mendaki salah satu gunung tertinggi di Indonesia bersama Mountain Mates. Pendakian ini akan membawa ke puncak Rinjani dan Danau Segara Anak yang ikonik.
                </p>
            </div>

            <!-- Kolom 2: Highlights + Jadwal & Itinerary -->
            <div class="space-y-4">
                <div class="bg-mist p-4 rounded-lg">
                    <h2 class="font-semibold text-forest mb-1">Highlights:</h2>
                    <ul class="text-sm text-gray-700">
                        <li><strong>Meeting Point:</strong> Basecamp Sembalun</li>
                        <li><strong>Jadwal:</strong> Jumat - Senin setiap minggu</li>
                        <li><strong>Start:</strong> Jumat pukul 06.00 WITA</li>
                        <li><strong>Finish:</strong> Senin pukul 14.00 WITA</li>
                        <li>Termasuk porter, makan 3x sehari, dan dokumentasi</li>
                    </ul>
                </div>

                <div class="bg-snow border border-gray-300 p-4 rounded-lg">
                    <button class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold mb-2">Jadwal</button>
                    <button class="bg-mist text-pine px-4 py-2 rounded-md w-full font-semibold">Itinerary</button>
                </div>
            </div>
        </div>

        <!-- Bagian Bawah: Form Pemesanan -->
        <div class="bg-white p-6 rounded-2xl shadow max-w-xl mx-auto">
            <h2 class="text-xl font-semibold text-center text-pine mb-4">Form Pemesanan</h2>
            <p class="text-xl font-bold text-gray-800 mb-4">Rp2.850.000</p>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Tahun</label>
                <input type="text" value="2025" class="w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Bulan</label>
                <select class="w-full border border-gray-300 rounded-md p-2">
                    <option>Pilih Bulan</option>
                    <option>Juli</option>
                    <option>Agustus</option>
                </select>
            </div>

            <button class="bg-forest text-white px-4 py-2 rounded-md w-full hover:bg-pine transition">
                Pesan Sekarang
            </button>
        </div>
    </div>
</section>
</x-home-layout>
