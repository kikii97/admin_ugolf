<?php
namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class TicketOfficeController extends Controller
{
    // Menampilkan form input loket tiket
    public function create()
    {
        return view('lokasi.index'); // Pastikan view 'ticket_offices.create' sudah ada
    }

    // Menyimpan data loket tiket yang dimasukkan
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'capacity' => 'required|integer',
            'operating_hours' => 'required|string|max:255',
        ]);

        // Menyimpan data ke database
        Lokasi::create($validated);

        // Redirect ke halaman tertentu setelah sukses (misalnya ke halaman daftar loket tiket)
        return redirect()->route('ticket_offices.index')->with('success', 'Loket Tiket berhasil disimpan.');
    }
}
