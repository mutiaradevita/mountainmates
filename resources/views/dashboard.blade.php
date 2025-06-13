<x-app-layout>
    <!-- Page Heading -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-l-4 border-green-500 bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            {{ session('success') }}
            <button type="button" class="close text-green-500" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-l-4 border-green-500 bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Order In Card -->
        <div class="bg-white shadow-md rounded-lg border-l-4 border-blue-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-blue-600 uppercase mb-1">Order In</div>
                </div>
                <div class="text-gray-300 bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-calendar fa-2x text-blue-500"></i>
                </div>
            </div>
        </div>

        <!-- Order Finish Card -->
        <div class="bg-white shadow-md rounded-lg border-l-4 border-green-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-green-600 uppercase mb-1">Order Finish</div>
                    {{-- <div class="text-3xl font-bold text-gray-800">{{ $event->where('status', 'success')->count() }}</div> --}}
                </div>
                <div class="text-gray-300 bg-green-100 p-3 rounded-full">
                    <i class="fas fa-dollar-sign fa-2x text-green-500"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="bg-white shadow-md rounded-lg border-l-4 border-indigo-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-indigo-600 uppercase mb-1">Total Revenue</div>
                    {{-- <div class="text-3xl font-bold text-gray-800">Rp {{ number_format($monthlyRevenue ?? 25000000, 0, ',', '.') }}</div> --}}
                    <div class="text-xs text-green-600 mt-1">↗ +18% dari bulan lalu</div>
                </div>
                <div class="text-gray-300 bg-indigo-100 p-3 rounded-full">
                    <i class="fas fa-clipboard-list fa-2x text-indigo-500"></i>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bg-white shadow-md rounded-lg border-l-4 border-yellow-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-yellow-600 uppercase mb-1">{{ __('Users') }}</div>
                    {{-- <div class="text-3xl font-bold text-gray-800">{{ $usersCount ?? 'OPO' }}</div> --}}
                </div>
                <div class="text-gray-300 bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-users fa-2x text-yellow-500"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Recent Bookings -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Booking Terbaru</h3>
                <a href="#" class="text-sm text-blue-500 hover:text-blue-700">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-2 text-blue-600">Nama</th>
                            <th class="text-left py-2 text-blue-600">Trip</th>
                            <th class="text-left py-2 text-blue-600">Tanggal</th>
                            <th class="text-left py-2 text-blue-600">Status</th>
                            <th class="text-left py-2 text-blue-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings ?? [] as $booking)
                        <tr class="border-b border-gray-100">
                            <td class="py-3">{{ $booking->user->name }}</td>
                            <td class="py-3">{{ $booking->trip->name }}</td>
                            <td class="py-3">{{ $booking->trip_date->format('d M Y') }}</td>
                            <td class="py-3">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="py-3">
                                <button class="text-blue-500 hover:text-blue-700 text-sm">Detail</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-3">Tidak ada booking terbaru</td>
                            <td class="py-3"></td>
                            <td class="py-3"></td>
                            <td class="py-3"></td>
                            <td class="py-3"></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="block w-full px-4 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-center">
                    <i class="fas fa-globe fa-lg inline mr-2"></i>
                    Lihat Website
                </a>
                <a href=# class="block w-full px-4 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition text-center">
                    <i class="fas fa-users fa-lg inline mr-2"></i>
                    Kelola Pengguna
                </a>
                <a href=# class="block w-full px-4 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition text-center">
                    <i class="fas fa-map-marked-alt fa-lg inline mr-2"></i>
                    Kelola Trip
                </a>
                <a href="#" class="block w-full px-4 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-center">
                    <i class="fas fa-chart-bar fa-lg inline mr-2"></i>
                    Laporan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>