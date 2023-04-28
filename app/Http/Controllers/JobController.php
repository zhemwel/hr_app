<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\AddJob;
use App\Models\ApplyForJob;
use App\Models\Category;
use App\Models\Question;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class JobController extends Controller
{
    // Job List
    public function jobList()
    {
        $job_list = DB::table('add_jobs')
            ->get();

        return view('job.joblist', compact('job_list'));
    }

    // Job View
    public function jobView($id)
    {
        /** Update Count */
        $post = AddJob::find($id);
        $update = ['count' =>$post->count + 1,];

        AddJob::where('id',$post->id)
            ->update($update);

        $job_view = DB::table('add_jobs')
            ->where('id',$id)
            ->get();

        return view('job.jobview', compact('job_view'));
    }

    /** Users Dashboard Index */
    public function userDashboard()
    {
        $job_list = DB::table('add_jobs')
            ->get();

        return view('job.userdashboard', compact('job_list'));
    }

    /** Jobs Dashboard Index */
    public function jobsDashboard()
    {
        return view('job.jobsdashboard');
    }

    /** User All Job */
    public function userDashboardAll()
    {
        return view('job.useralljobs');
    }

    /** Save Job */
    public function userDashboardSave()
    {
        return view('job.savedjobs');
    }

    /** Applied Job*/
    public function userDashboardApplied()
    {
        return view('job.appliedjobs');
    }

    /** Interviewing Job*/
    public function userDashboardInterviewing()
    {
        return view('job.interviewing');
    }

    /** Interviewing Job*/
    public function userDashboardOffered()
    {
        return view('job.offeredjobs');
    }

    /** Visited Job*/
    public function userDashboardVisited()
    {
        return view('job.visitedjobs');
    }

    /** Archived Job*/
    public function userDashboardArchived()
    {
        return view('job.visitedjobs');
    }

    /** Jobs */
    public function Jobs()
    {
        $department = DB::table('departments')->get();
        $type_job = DB::table('type_jobs')->get();
        $job_list = DB::table('add_jobs')->get();

        return view('job.jobs', compact('department', 'type_job', 'job_list'));
    }

    /** Job Save Record */
    public function JobsSaveRecord(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'no_of_vacancies' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'age' => 'required',
            'salary_from' => 'required|string|max:255',
            'salary_to' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'expired_date' => 'required|string|max:255',
            'description' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $add_job = new AddJob;
            $add_job->job_title = $request->job_title;
            $add_job->department = $request->department;
            $add_job->job_location = $request->job_location;
            $add_job->no_of_vacancies = $request->no_of_vacancies;
            $add_job->experience = $request->experience;
            $add_job->age = $request->age;
            $add_job->salary_from = $request->salary_from;
            $add_job->salary_to = $request->salary_to;
            $add_job->job_type = $request->job_type;
            $add_job->status = $request->status;
            $add_job->start_date = $request->start_date;
            $add_job->expired_date = $request->expired_date;
            $add_job->description = $request->description;
            $add_job->save();

            DB::commit();
            Toastr::success('Create Add Job Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Job Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Job Applicants */
    public function jobApplicants($job_title)
    {
        $apply_for_jobs = DB::table('apply_for_jobs')
            ->where('job_title',$job_title)
            ->get();

        return view('job.jobapplicants', compact('apply_for_jobs'));
    }

    /** Download */
    public function downloadCV($id)
    {
        $cv_uploads = DB::table('apply_for_jobs')
            ->where('id',$id)
            ->first();

        $pathToFile = public_path("assets/images/{$cv_uploads->cv_upload}");

        return \Response::download($pathToFile);
    }

    /** Job Details */
    public function jobDetails($id)
    {
        $job_view_detail = DB::table('add_jobs')
            ->where('id',$id)
            ->get();

        return view('job.jobdetails', compact('job_view_detail'));
    }

    /** Apply Job Save Record */
    public function applyJobSaveRecord(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email',
            'message' => 'required|string|max:255',
            'cv_upload' => 'required',
        ]);

        DB::beginTransaction();

        try {
            /** Upload File */
            $cv_uploads = time().'.'.$request->cv_upload->extension();
            $request->cv_upload->move(public_path('assets/images'), $cv_uploads);

            $apply_job = new ApplyForJob;
            $apply_job->job_title = $request->job_title;
            $apply_job->name = $request->name;
            $apply_job->phone = $request->phone;
            $apply_job->email = $request->email;
            $apply_job->message = $request->message;
            $apply_job->cv_upload = $cv_uploads;
            $apply_job->save();

            DB::commit();
            Toastr::success('Apply Job Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Apply Job Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Apply Job Update Record */
    public function applyJobUpdateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'id' => $request->id,
                'job_title' => $request->job_title,
                'department' => $request->department,
                'job_location' => $request->job_location,
                'no_of_vacancies' => $request->no_of_vacancies,
                'experience' => $request->experience,
                'age' => $request->age,
                'salary_from' => $request->salary_from,
                'salary_to' => $request->salary_to,
                'job_type' => $request->job_type,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'expired_date' => $request->expired_date,
                'description' => $request->description,
            ];

            AddJob::where('id',$request->id)
                ->update($update);

            DB::commit();
            Toastr::success('Updated Leaves Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Leaves Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Manage Resumes */
    public function manageResumesIndex()
    {
        $department = DB::table('departments')
            ->get();

        $type_job = DB::table('type_jobs')
            ->get();

        $manageResumes = DB::table('add_jobs')
            ->join('apply_for_jobs', 'apply_for_jobs.job_title', 'add_jobs.job_title')
            ->select('add_jobs.*', 'apply_for_jobs.*')
            ->get();

        return view('job.manageresumes', compact('manageResumes', 'department', 'type_job'));
    }

    /** Shortlist Candidates */
    public function shortlistCandidatesIndex()
    {
        return view('job.shortlistcandidates');
    }

    /** Interview Questions */
    public function interviewQuestionsIndex()
    {
        $question = DB::table('questions')->get();
        $category = DB::table('categories')->get();
        $department = DB::table('departments')->get();
        $answer = DB::table('answers')->get();

        return view('job.interviewquestions', compact('category', 'department', 'answer', 'question'));
    }

    /** Interview Questions Save */
    public function categorySave(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $save = new Category;
            $save->category = $request->category;
            $save->save();

            DB::commit();
            Toastr::success('Create New Category Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Category Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Save Question */
    public function questionSave(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'questions' => 'required|string|max:255',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'code_snippets' => 'required|string|max:255',
            'answer_explanation' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image_to_question' => 'required',
        ]);

        DB::beginTransaction();

        try {
            /** Upload File */
            $image_to_questions = time().'.'.$request->image_to_question->extension();
            $request->image_to_question->move(public_path('assets/images/question'), $image_to_questions);

            $save = new Question;
            $save->category = $request->category;
            $save->department = $request->department;
            $save->questions = $request->questions;
            $save->option_a = $request->option_a;
            $save->option_b = $request->option_b;
            $save->option_c = $request->option_c;
            $save->option_d = $request->option_d;
            $save->answer = $request->answer;
            $save->code_snippets = $request->code_snippets;
            $save->answer_explanation = $request->answer_explanation;
            $save->video_link = $request->video_link;
            $save->image_to_question = $image_to_questions;
            $save->save();

            DB::commit();
            Toastr::success('Create New Question Success','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Question Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Question Update */
    public function questionsUpdate(Request $request)
    {
        DB::beginTransaction();

        try {
            $update = [
                'id' => $request->id,
                'category' => $request->category,
                'department' => $request->department,
                'questions' => $request->questions,
                'option_a' => $request->option_a,
                'option_b' => $request->option_b,
                'option_c' => $request->option_c,
                'option_d' => $request->option_d,
                'answer' => $request->answer,
                'code_snippets' => $request->code_snippets,
                'answer_explanation' => $request->answer_explanation,
                'video_link' => $request->video_link,
            ];

            Question::where('id',$request->id)
                ->update($update);

            DB::commit();
            Toastr::success('Updated Questions Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Questions Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Question */
    public function questionsDelete(Request $request)
    {
        try {
            Question::destroy($request->id);
            Toastr::success('Question Deleted Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Question Delete Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Offer Approvals */
    public function offerApprovalsIndex()
    {
        return view('job.offerapprovals');
    }

    /** Experience Level */
    public function experienceLevelIndex()
    {
        return view('job.experiencelevel');
    }

    /** Candidates */
    public function candidatesIndex()
    {
        return view('job.candidates');
    }

    /** Schedule Timing */
    public function scheduleTimingIndex()
    {
        return view('job.scheduletiming');
    }
    /** Aptitude Result */

    public function aptituderesultIndex()
    {
        return view('job.aptituderesult');
    }
}
