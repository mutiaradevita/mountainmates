<x-home-layout>
    <section class="bg-snow pt-28 pb-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <h1 class="text-2xl font-bold text-pine mb-6 text-center">Testimoni Peserta</h1>

            @forelse ($testimonis as $testimoni)
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <p class="text-stone mb-3">"{{ $testimoni->isi }}"</p>

                    <div class="text-sm text-stone flex flex-col md:flex-row md:justify-between">
                        <div>
                            <span class="font-semibold text-pine">{{ $testimoni->user->name }}</span> 
                            untuk 
                            <span class="font-semibold text-forest">{{ $testimoni->trip->nama_trip }}</span> 
                            oleh 
                            <span class="text-moss">{{ $testimoni->trip->pengelola->name ?? 'Mountain Mates' }}</span>
                        </div>
                        <div class="mt-2 md:mt-0">
                            <span>{{ $testimoni->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-stone">Belum ada testimoni dari peserta.</p>
            @endforelse

            <div class="mt-6">
                {{ $testimonis->links() }}
            </div>
        </div>
    </section>
</x-home-layout>
