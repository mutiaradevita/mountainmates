<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-4">
        <h1 class="text-2xl font-bold">Peserta untuk Trip: {{ $trip->nama_trip }}</h1>
        @if ($participants->count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Bergabung Pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->pivot->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Belum ada peserta yang terdaftar.</p>
        @endif

        <a href="{{ route('pengelola.trips.history') }}" class="btn-secondary">Kembali ke Riwayat Trip</a>
    </div>
</x-app-layout>
