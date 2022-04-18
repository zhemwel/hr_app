<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    /** page estimates */
    public function estimatesIndex()
    {
        return view('sales.estimates');
    }
}
