<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use PDF;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create A New Controller Instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show The Application Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Main Dashboard
    public function index()
    {
        return view('dashboard.dashboard');
    }

    // Employee Dashboard
    public function emDashboard()
    {
        $dt = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        return view('dashboard.emdashboard', compact('todayDate'));
    }

    public function generatePDF(Request $request)
    {
        $pdf = PDF::loadView('payroll.salaryview');

        // Download PDF File
        return $pdf->download('pdfview.pdf');
    }
}
