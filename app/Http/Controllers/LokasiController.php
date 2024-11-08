<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;
use Yajra\DataTables\DataTables;

class LokasiController extends Controller
{
    // Display the main view
    public function index()
    {
        return view('lokasi.index'); // Assumes the Blade file is located in resources/views/lokasi/index.blade.php
    }

    // Fetch data for DataTable
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Lokasi::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    // Store new Lokasi data
    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        Lokasi::create([
            'kode_lokasi' => $request->kode_lokasi,
            'lokasi' => $request->lokasi,
        ]);

        return response()->json(['success' => 'Data Lokasi berhasil disimpan!']);
    }
}

