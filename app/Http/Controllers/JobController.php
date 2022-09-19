<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    /** applied job*/
    public function userDashboardApplied()
    {
        return view('job.appliedjobs');
    }

    /** interviewing job*/
    public function userDashboardInterviewing()
    {
        return view('job.interviewing');
    }

    /** interviewing job*/
    public function userDashboardOffered()
    {
        return view('job.offeredjobs');
    }

    /** visited job*/
    public function userDashboardVisited()
    {
        return view('job.visitedjobs');
    }

    /** archived job*/
    public function userDashboardArchived()
    {
        return view('job.visitedjobs');
    }

    /** jobs */
    public function Jobs()
    {
        $department = DB::table('departments')->get();
        $type_job   = DB::table('type_jobs')->get();
        return view('job.jobs',compact('department','type_job'));
    }
    
    /** job applicants */
    public function jobApplicants()
    {
        return view('job.jobapplicants');
    }

    /** job details */
    public function jobDetails()
    {
        return view('job.jobdetails');
    }
}
