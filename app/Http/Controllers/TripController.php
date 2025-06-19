<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        //$trips = Trip::all();
        $trips = Trip::where('created_by', Auth::id())->where('status', 'aktif')->get();

        return view('pengelola.trips.index', compact('trips'));
    }

    public function create()
    {
        return view('pengelola.trips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_trip' => 'required|string|max:50',
            'deskripsi_trip' => 'required|string|max:100',
            'tanggal_trip' => 'required|date',
            'flyer' => 'required|image|mimes:jpg,jpeg,png',
            'waktu' => 'required|regex:/^\d{2}:\d{2}$/',
            'lokasi' => 'required|string|max:100',
            'tipe_trip' => 'required|in:open,private',
            'jadwal_trip' => 'required|string',
            'itinerary' => 'required|string',
            'kuota' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $path = $request->file('flyer')->store('flyers', 'public');

        Trip::create([
            'nama_trip' => $request->nama_trip,
            'deskripsi_trip' => $request->deskripsi_trip,
            'tanggal_trip' => $request->tanggal_trip,
            'flyer' => $path,
            'waktu' => $request->waktu ?? '00:00',
            'lokasi' => $request->lokasi,
            'tipe_trip' => $request->tipe_trip,
            'jadwal_trip' => $request->jadwal_trip,
            'itinerary' => $request->itinerary,
            'kuota' => $request->kuota,
            'harga' => $request->harga,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip berhasil ditambahkan');
    }

    public function show($id)
    {
       
        $trip = Trip::with('pengelola.ulasanMasuk.peserta.user')->findOrFail($id);

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
            'nama_trip' => 'required|string|max:50',
            'deskripsi_trip' => 'required|string|max:100',
            'tanggal_trip' => 'required|date',
            'flyer' => 'nullable|image|mimes:jpg,jpeg,png',
            'waktu' => 'required|date_format:H:i',
            'lokasi' => 'required|string|max:100',
            'tipe_trip' => 'required|in:open,private',
            'jadwal_trip' => 'required|string',
            'itinerary' => 'required|string',
            'kuota' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,nonaktif',
            
        ]);

        $trip = Trip::findOrFail($id);

        $data = $request->only([
            'nama_trip', 
            'deskripsi_trip', 
            'tanggal_trip', 
            'waktu', 
            'lokasi',
            'tipe_trip',
            'jadwal_trip',
            'itinerary', 
            'kuota', 
            'harga', 
            'status'
        ]);

        if ($request->hasFile('flyer')) {
            $path = $request->file('flyer')->store('flyers', 'public');
            $data['flyer'] = $path;
        }

        $trip->update($data);

        return redirect()->route('trips.index')->with('success', 'Trip berhasil diperbarui');
    }

   public function history(Request $request)
    {
        $status = $request->get('status');

        $trips = Trip::where('created_by', Auth::id())
                    ->when($status, fn($q) => $q->where('status', $status))
                    ->get();

        return view('pengelola.trips.history', compact('trips'));
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip berhasil dihapus');
    }
    public function transaksiIndex()
    {
        $userId = Auth::user()->id;

        $transaksis = \App\Models\Transaksi::with(['trip', 'user'])
            ->whereHas('trip', function ($query) use ($userId) {
                $query->where('created_by', $userId);
            })
            ->latest()
            ->get();

        return view('pengelola.transaksi.index', compact('transaksis'));
    }

    public function peserta($id)
    {
        $trip = Trip::with('transaksis.user')->findOrFail($id);

        if ((int) $trip->created_by !== (int) Auth::id()) 
        {
            abort(403, 'Kamu tidak berhak melihat peserta trip ini.');
        }

        $pesertas = $trip->transaksis()->with('user')->get();

        return view('pengelola.trips.peserta', compact('trip', 'pesertas'));
    }
}
