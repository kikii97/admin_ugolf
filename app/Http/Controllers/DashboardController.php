<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil nama user
        $user = Auth::user();

        // Tentukan ucapan berdasarkan waktu
        $hour = now()->hour;
        $greeting = match (true) {
            $hour < 12 => 'Good Morning',
            $hour < 18 => 'Good Afternoon',
            default => 'Good Evening',
        };

        // Ambil data transaksi dari API
        $response = Http::get(env('API_URL') . '/trx');
        
        if ($response->successful()) {
            // Ambil data transaksi dan ubah menjadi koleksi
            $transactions = collect($response->json('data'));

            // Hitung total quantity transaksi
            $totalQuantity = collect($transactions)->sum('qty');

            // Hitung total amount transaksi
            $totalAmount = collect($transactions)->sum('total_amount');

            // Misalnya transaksi dianggap berhasil jika 'payment_status' == 'success'
            $ticketSold = $transactions->where('payment_status', 'S')->count();
        } else {
            // Default jika API gagal
            $totalQuantity = 0;
            $totalAmount = 0;
            $ticketSold = 0;
        }

        // Ambil data merchant dari API
        $merchantResponse = Http::get('http://192.168.43.45/api/merchant');

        if ($merchantResponse->successful()) {
            // Ambil data merchant dan hitung jumlahnya
            $merchants = collect($merchantResponse->json('data'));
            $totalMerchants = $merchants->count();
        } else {
            // Default jika API gagal
            $totalMerchants = 0;
        }

        // Kirim data ke view
        return view('dashboard', [
            'greeting' => $greeting,
            'user' => $user,
            'totalQuantity' => $totalQuantity,
            'totalAmount' => $totalAmount,
            'ticketSold' => $ticketSold,
            'totalMerchants' => $totalMerchants,
            'transactions' => $transactions,
        ]);
    }
}
