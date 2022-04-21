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

    /** page create estimates */
    public function createEstimateIndex()
    {
        return view('sales.createestimate');
    }

    /** page edit estimates */
    public function editEstimateIndex()
    {
        return view('sales.editestimate');
    }

    /** view page estimate */
    public function viewEstimateIndex()
    {
        return view('sales.estimateview');
    }
}
