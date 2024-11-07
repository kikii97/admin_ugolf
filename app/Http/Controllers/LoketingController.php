<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LoketingController extends Controller
{
    /**
     * Display the form for ticket booking.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('loketing.create');
    }

    public function create()
    {
        // Retrieve the total price from the session if it exists
        $totalPrice = session('totalPrice', null);

        // Display the "loketing.create" view with the total price data
        return view('loketing.create', compact('totalPrice'));
    }

    /**
     * Handle the form submission for ticket booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'ticket_price' => 'required|numeric|min:0',       // Validate ticket price
            'ticket_quantity' => 'required|numeric|min:1',    // Validate ticket quantity
        ]);

        // Calculate total price
        $totalPrice = $validated['ticket_price'] * $validated['ticket_quantity'];

        // Store total price in session to display in the next request
        session()->flash('totalPrice', $totalPrice);

        // Redirect back to the form to display total price
        return redirect()->route('loketing.create');
    }

    /**
     * Provide data for the DataTable via AJAX request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Yajra\DataTables\DataTables
     */
    public function getLoketingData(Request $request)
    {
        // Sample data for demonstration
        $data = [
            ['kode_loket' => 'LK001', 'harga_tiket' => 50000],
            ['kode_loket' => 'LK002', 'harga_tiket' => 60000],
            // Add more rows as needed
        ];

        // Return data for DataTables
        return DataTables::of($data)->make(true);
    }
}
