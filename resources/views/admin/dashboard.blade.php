<x-app-layout>
    <div class="p-6 bg-snow min-h-screen">
        <h1 class="text-2xl font-bold text-pine mb-6">Dashboard Admin</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-forest mb-2">Total Pengguna</h2>
                <p class="text-3xl font-bold text-pine">125</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-forest mb-2">Total Trip</h2>
                <p class="text-3xl font-bold text-pine">23</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold text-forest mb-2">Pendaftar Hari Ini</h2>
                <p class="text-3xl font-bold text-pine">8</p>
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold text-pine mb-4">Navigasi Cepat</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('home') }}" class="px-4 py-2 bg-forest text-white rounded-lg hover:bg-pine transition">Lihat Website</a>
                <a href="#" class="px-4 py-2 bg-sunset text-white rounded-lg hover:bg-earth transition">Kelola Pengguna</a>
                <a href="#" class="px-4 py-2 bg-sky text-white rounded-lg hover:bg-lake transition">Kelola Trip</a>
            </div>
        </div>
    </div>
</x-app-layout>
