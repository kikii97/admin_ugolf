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
        $response = Http::get('http://192.168.43.45/api/trx');
        
        if ($response->successful()) {
            // Ambil data transaksi dan ubah menjadi koleksi
            $transactions = collect($response->json('data'));

            // Hitung total quantity transaksi
            $totalQuantity = collect($transactions)->sum('qty');

            // Hitung total amount dari transaksi yang berhasil ('payment_status' == 'S')
            $successfulTransactions = $transactions->where('payment_status', 'S');
            $totalAmountSuccessful = $successfulTransactions->sum('total_amount');

            // Hitung total amount kesekuruhan (termasuk yang gagal)
            $totalAmountOverall = $transactions->sum('total_amount');

            // Hitung jumlah tiket yang terjual (berstatus 'S' - sukses)
            $ticketSold = $successfulTransactions->count();
        } else {
            // Default jika API gagal
            $totalQuantity = 0;
            $totalAmountSuccessful = 0;
            $totalAmountOverall = 0;
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
            'totalAmountSuccessful' => $totalAmountSuccessful, // Total amount transaksi berhasil
            'totalAmountOverall' => $totalAmountOverall, // Total amount keseluruhan
            'ticketSold' => $ticketSold,
            'totalMerchants' => $totalMerchants,
            'transactions' => $transactions,
        ]);
    }
}
