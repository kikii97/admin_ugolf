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
    // Attempt to fetch merchant data from the API
    $response = Http::withToken(session('token'))->get (env('API_URL').'/merchant');

    // Check if the response was successful
    if ($response->successful()) {
        // Parse the response data and transform it into a collection for easy manipulation
        $merchants = collect($response->json('data'))->map(function ($item) {
            return (object) [
                'merchant_id' => $item['merchant_id'] ?? null,
                'merchant_code' => $item['merchant_code'] ?? null,
                'merchant_name' => $item['merchant_name'] ?? null,
                // 'merchant_address' => $item['merchant_address'] ?? null,
                // 'status_merchant' => $item['status_merchant'] ?? 'inactive', // Default value if not present
            ];
        });

        // Pass the merchants data to the view
        return view('terminal.index', compact('merchants'));
    }

    // Redirect to the view with an error message if the API request fails
    return redirect()->route('terminal.index')->withErrors('Gagal mengambil data merchant.');
}


    // public function create($id = null)
    // {
    //     // Fetch merchant data from the API
    //     $response = Http::withToken(session('token'))->get(config('app.api_url') . '/merchant');

    //     if ($response->successful()) {
    //         // Parse the response into collections for easier handling
    //         $data = $response->json();
    //         $merchants = collect($data['data'])->map(function ($item) {
    //             // Return a structured object similar to the previous format
    //             return (object) [
    //                 'merchant_id' => $item['merchant_id'],
    //                 'merchant_code' => $item['merchant_code'],
    //                 'merchant_name' => $item['merchant_name'],
    //                 'merchant_address' => $item['merchant_address'],
    //             ];
    //         });

    //         // Return the data to the view (no need for barangMasuk data)
    //         return view('/terminal', compact('merchants'));
    //     }

    //     // If the API request failed, redirect with an error message
    //     return redirect('/terminal')->withErrors('Gagal mengambil data merchant.');
    // }

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
        $response = Http::withToken(session('token'))->get(config('app.api_url') . '/terminal/' . $id);

        if ($response->successful()) {
            $data = $response->json();
            return view('customer.edit', compact('data'));
        }

        return redirect()->route('customer.index')->withErrors('Gagal mengambil data customer.');
    }

    public function update($id, Request $request)
    {
        $response = Http::withToken(session('token'))->put(config('app.api_url') . '/terminal/' . $id, $request->all());

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
