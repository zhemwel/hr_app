<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExpenseReportsController extends Controller
{
    // View Page
    public function index()
    {
        return view('reports.expensereport');
    }

    // View Page
    public function invoiceReports()
    {
        return view('reports.invoicereports');
    }

    // Daily Report Page
    public function dailyReport()
    {
        return view('reports.dailyreports');
    }

    // Leave Reports Page
    public function leaveReport()
    {
        $leaves = DB::table('leaves_admins')
            ->join('users', 'users.user_id', '=', 'leaves_admins.user_id')
            ->select('leaves_admins.*', 'users.*')
            ->get();

        return view('reports.leavereports', compact('leaves'));
    }
}
