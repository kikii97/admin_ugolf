<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    // Controller Method (for showing ticket details)
public function showDetails(Detail $detail)
{
    return view('detail', compact('detail'));
}


}
