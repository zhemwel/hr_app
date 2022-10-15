<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\AddJob;
use App\Models\ApplyForJob;
use Brian2694\Toastr\Facades\Toastr;

class JobController extends Controller
{
    // job List
    public function jobList()
    {
        $job_list = DB::table('add_jobs')->get();
        return view('job.joblist',compact('job_list'));
    }
    // job view
    public function jobView($id)
    {
        $job_view = DB::table('add_jobs')->where('id',$id)->get();
        return view('job.jobview',compact('job_view'));
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
        $job_list   = DB::table('add_jobs')->get();
       
        return view('job.jobs',compact('department','type_job','job_list'));
    }

    /** job save record */
    public function JobsSaveRecord(Request $request)
    {
        $request->validate([
            'job_title'       => 'required|string|max:255',
            'department'      => 'required|string|max:255',
            'job_location'    => 'required|string|max:255',
            'no_of_vacancies' => 'required|string|max:255',
            'experience'      => 'required|string|max:255',
            'age'             => 'required',
            'salary_from'     => 'required|string|max:255',
            'salary_to'       => 'required|string|max:255',
            'job_type'        => 'required|string|max:255',
            'status'          => 'required|string|max:255',
            'start_date'      => 'required|string|max:255',
            'expired_date'    => 'required|string|max:255',
            'description'     => 'required',
        ]);

        DB::beginTransaction();
        try {
            
            $add_job = new AddJob;
            $add_job->job_title       = $request->job_title;
            $add_job->department      = $request->department;
            $add_job->job_location    = $request->job_location;
            $add_job->no_of_vacancies = $request->no_of_vacancies;
            $add_job->experience   = $request->experience;
            $add_job->age          = $request->age;
            $add_job->salary_from  = $request->salary_from;
            $add_job->salary_to    = $request->salary_to;
            $add_job->job_type     = $request->job_type;
            $add_job->status       = $request->status;
            $add_job->start_date   = $request->start_date;
            $add_job->expired_date = $request->expired_date;
            $add_job->description  = $request->description;
            $add_job->save();

            DB::commit();
            Toastr::success('Create add job successfully :)','Success');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Job fail :)','Error');
            return redirect()->back();
        } 
    }
    
    /** job applicants */
    public function jobApplicants($job_title)
    {
       $apply_for_jobs = DB::table('apply_for_jobs')->where('job_title',$job_title)->get();
        return view('job.jobapplicants',compact('apply_for_jobs'));
    }

    /** job details */
    public function jobDetails($id)
    {
        $job_view_detail = DB::table('add_jobs')->where('id',$id)->get();
        return view('job.jobdetails',compact('job_view_detail'));
    }

    /** apply Job SaveRecord */
    public function applyJobSaveRecord(Request $request) 
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:255',
            'email'     => 'required|string|email',
            'message'   => 'required|string|max:255',
            'cv_upload' => 'required',
        ]);

        DB::beginTransaction();
        try {

            /** upload file */
            $cv_uploads = time().'.'.$request->cv_upload->extension();  
            $request->cv_upload->move(public_path('assets/images'), $cv_uploads);
            
            $apply_job = new ApplyForJob;
            $apply_job->job_title = $request->job_title;
            $apply_job->name      = $request->name;
            $apply_job->phone     = $request->phone;
            $apply_job->email     = $request->email;
            $apply_job->message   = $request->message;
            $apply_job->cv_upload = $cv_uploads;
            $apply_job->save();

            DB::commit();
            Toastr::success('Apply job successfully :)','Success');
            return redirect()->back();
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Apply Job fail :)','Error');
            return redirect()->back();
        } 
    }
}
