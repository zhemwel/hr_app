<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\AddJob;
use App\Models\ApplyForJob;
use Carbon\Carbon;
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
        /** update count */
        $post = AddJob::find($id);
        $update = ['count' =>$post->count + 1,];
        AddJob::where('id',$post->id)->update($update);

        $job_view = DB::table('add_jobs')->where('id',$id)->get();
        return view('job.jobview',compact('job_view'));
    }

    /** users dashboard index */
    public function userDashboard()
    {
        $job_list   = DB::table('add_jobs')->get();
        return view('job.userdashboard',compact('job_list'));
    }

    /** jobs dashboard index */
    public function jobsDashboard() {
        return view('job.jobsdashboard');
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

    /** download */
    public function downloadCV($id) {
        $cv_uploads = DB::table('apply_for_jobs')->where('id',$id)->first();
        $pathToFile = public_path("assets/images/{$cv_uploads->cv_upload}");
        return \Response::download($pathToFile);
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

    /** applyJobUpdateRecord */
    public function applyJobUpdateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'id'              => $request->id,
                'job_title'       => $request->job_title,
                'department'      => $request->department,
                'job_location'    => $request->job_location,
                'no_of_vacancies' => $request->no_of_vacancies,
                'experience'      => $request->experience,
                'age'             => $request->age,
                'salary_from'     => $request->salary_from,
                'salary_to'       => $request->salary_to,
                'job_type'        => $request->job_type,
                'status'          => $request->status,
                'start_date'      => $request->start_date,
                'expired_date'    => $request->expired_date,
                'description'     => $request->description,
            ];

            AddJob::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Updated Leaves successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Leaves fail :)','Error');
            return redirect()->back();
        } 
    }

    /** manage Resumes */
    public function manageResumesIndex()
    {
        return view('job.manageresumes');
    }

    /** shortlist candidates */
    public function shortlistCandidatesIndex()
    {
        return view('job.shortlistcandidates');
    }

    /** interview questions */
    public function interviewQuestionsIndex()
    {
        return view('job.interviewquestions');
    }

    /** offer approvals */
    public function offerApprovalsIndex()
    {
        return view('job.offerapprovals');
    }

    /** experience level */
    public function experienceLevelIndex()
    {
        return view('job.experiencelevel');
    }

    /** candidates */
    public function candidatesIndex()
    {
        return view('job.candidates');
    }
}
