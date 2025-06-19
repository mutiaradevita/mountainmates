<x-peserta-layout>
    <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-semibold text-pine mb-4">Beri Ulasan untuk {{ $trip->nama_trip }}</h2>

        <form action="{{ route('ulasan.store', $trip->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-stone mb-1">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" required class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-stone mb-1">Komentar</label>
                <textarea name="komentar" rows="4" required class="w-full border rounded p-2"></textarea>
            </div>
            <button type="submit" class="bg-pine text-white px-4 py-2 rounded hover:bg-forest">Kirim Ulasan</button>
        </form>
    </div>
</x-peserta-layout>
