<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class TrxController extends Controller
{
    public function index()
    {
        
        return view('transaction');
    }

}
