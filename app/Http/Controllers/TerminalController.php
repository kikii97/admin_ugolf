<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class TerminalController extends Controller
{
    public function index()
    {
        
        return view('terminal.index');
    }

    public function store(Request $request)
    {
        // Mengirim permintaan API untuk menambahkan customer baru
        $response = Http::withToken(session('token'))->post(config('app.api_url') . '/terminal', $request->all());

        // Memeriksa apakah respons berhasil
        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Data successfully added!']);
        }

        // Menangani status respons HTTP yang berbeda
        if ($response->clientError()) {
            return response()->json(['success' => false, 'message' => 'Gagal menambahkan data.'], $response->status());
        }

        if ($response->serverError()) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menambahkan data.'], $response->status());
        }

        // Cadangan untuk kasus lain
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menambahkan data.'], 500);
    }

    public function edit($id)
    {
        $response = Http::withToken(session('token'))->get(config('http://localhost') . '/terminal/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('customer.edit', compact('data'));
        }

        return redirect()->route('customer.index')->withErrors('Gagal mengambil data customer.');
    }

    public function update($id, Request $request)
    {
        $response = Http::withToken(session('token'))->put(config('app.api_url') . '/customers/' . $id, $request->all());

        if ($response->successful()) {
            return redirect()->route('customer.index')->with('success', 'Data successfully updated!');
        }

        return back()->withErrors('Gagal memperbarui data customer.');
    }

    public function delete($id)
    {
        $response = Http::withToken(session('token'))->delete(config('app.api_url') . '/customers/' . $id);

        if ($response->successful()) {
            return redirect()->route('customer.index')->with('success', 'Data successfully deleted!');
        }

        return back()->withErrors('Gagal menghapus data customer.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        $response = Http::withToken(session('token'))->post(config('app.api_url') . '/customers/delete-selected', ['ids' => $ids]);

        if ($response->successful()) {
            return response()->json(['success' => 'Data successfully deleted!']);
        }

        return response()->json(['error' => 'Gagal menghapus data customer.'], 500);
    }
}
