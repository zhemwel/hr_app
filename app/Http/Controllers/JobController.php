<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    // job List
    public function jobList()
    {
        return view('job.joblist');
    }
    // job view
    public function jobView()
    {
        return view('job.jobview');
    }

    /** job dashboard index */
    public function userDashboard() {
        return view('job.userdashboard');
    }

    /** user all job */
    public function userDashboardAll() 
    {
        return view('job.useralljobs');
    }

    /** save job */
    public function userDashboardSave()
    {
      return view('job.savedjobs');
    }
}
