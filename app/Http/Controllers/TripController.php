<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $trips = Trip::query()
            ->where('created_by', Auth::id()) 
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('tanggal_mulai', 'asc')
            ->orderBy('waktu', 'asc')
            ->get();

        return view('pengelola.trips.index', compact('trips'));
    }

    public function create()
    {
        return view('pengelola.trips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_trip' => 'required|string|max:255',
            'deskripsi_trip' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'meeting_point' => 'required|string|max:255',
            'kuota' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
            'dp_persen' => 'required|integer|min:0|max:100',
            'paket' => 'nullable|string',
            'itinerary' => 'required|string',
            'flyer' => 'required|image|mimes:jpg,jpeg,png',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu' => 'required|date_format:H:i',
            'durasi' => 'required|string|max:255',
            'sudah_termasuk' => 'nullable|string',
            'belum_termasuk' => 'nullable|string',
        ]);

        $path = $request->file('flyer')->store('flyers', 'public');

        Trip::create([
            'nama_trip' => $request->nama_trip,
            'deskripsi_trip' => $request->deskripsi_trip,
            'lokasi' => $request->lokasi,
            'meeting_point' => $request->meeting_point,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'dp_persen' => $request->dp_persen,
            'paket' => $request->paket,
            'itinerary' => $request->itinerary,
            'flyer' => $path,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu' => $request->waktu,
            'durasi' => $request->durasi,
            'sudah_termasuk' => $request->sudah_termasuk,
            'belum_termasuk' => $request->belum_termasuk,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pengelola.trips.index')->with('success', 'Trip berhasil ditambahkan');
    }

    public function show($id)
    {
        $trip = Trip::findOrFail($id);

        return view('pengelola.trips.show', compact('trip'));
    }

    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        return view('pengelola.trips.edit', compact('trip'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_trip' => 'required|string|max:255',
            'deskripsi_trip' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'meeting_point' => 'required|string|max:255',
            'kuota' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
            'dp_persen' => 'required|integer|min:0|max:100',
            'paket' => 'nullable|string',
            'itinerary' => 'required|string',
            'flyer' => 'nullable|image|mimes:jpg,jpeg,png',
            'status' => 'required|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu' => 'required|date_format:H:i',
            'durasi' => 'required|string|max:255',
            'sudah_termasuk' => 'nullable|string',
            'belum_termasuk' => 'nullable|string',
        ]);

        $trip = Trip::findOrFail($id);

        $data = [
            'nama_trip' => $request->nama_trip,
            'deskripsi_trip' => $request->deskripsi_trip,
            'lokasi' => $request->lokasi,
            'meeting_point' => $request->meeting_point,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'dp_persen' => $request->dp_persen,
            'paket' => $request->paket,
            'itinerary' => $request->itinerary,
            'status' => $request->status,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu' => $request->waktu,
            'durasi' => $request->durasi,
            'sudah_termasuk' => $request->sudah_termasuk,
            'belum_termasuk' => $request->belum_termasuk,
        ];

        if ($request->hasFile('flyer')) {
            $data['flyer'] = $request->file('flyer')->store('flyers', 'public');
        }

        $trip->update($data);

        return redirect()->route('pengelola.trips.index')->with('success', 'Trip berhasil diperbarui');
    }

    public function history(Request $request)
    {
        $status = $request->get('status');

        $trips = Trip::where('created_by', Auth::id())
                    ->when($status, fn($q) => $q->where('status', $status))
                    ->orderBy('tanggal_mulai', 'asc')
                    ->orderBy('waktu', 'asc')
                    ->get();

        return view('pengelola.trips.history', compact('trips'));
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('pengelola.trips.index')->with('success', 'Trip berhasil dihapus');
    }

    public function transaksiIndex()
    {
        $userId = Auth::user()->id;

        $transaksis = Transaksi::with(['trip', 'user'])
            ->whereHas('trip', function ($query) use ($userId) {
                $query->where('created_by', $userId);
            })
            ->latest()
            ->get();

        return view('pengelola.transaksi.index', compact('transaksis'));
    }

    public function peserta($id)
    {
        $trip = Trip::with('transaksi.user')->findOrFail($id);

        if ((int) $trip->created_by !== (int) Auth::id()) {
            abort(403, 'Kamu tidak berhak melihat peserta trip ini.');
        }

        $pesertas = $trip->transaksi()->with(['user', 'peserta'])->get();

        return view('pengelola.trips.peserta', compact('trip', 'pesertas'));
    }
}
 