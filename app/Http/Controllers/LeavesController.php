<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeavesAdmin;
use DB;
use DateTime;

class LeavesController extends Controller
{
    // Leaves
    public function leaves()
    {
        $leaves = DB::table('leaves_admins')
            ->join('users', 'users.user_id', '=', 'leaves_admins.user_id')
            ->select('leaves_admins.*', 'users.position','users.name','users.avatar')
            ->get();

        return view('form.leaves', compact('leaves'));
    }

    // Save Record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string|max:255',
            'from_date' => 'required|string|max:255',
            'to_date' => 'required|string|max:255',
            'leave_reason' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day = $from_date->diff($to_date);
            $days = $day->d;

            $leaves = new LeavesAdmin;
            $leaves->user_id = $request->user_id;
            $leaves->leave_type = $request->leave_type;
            $leaves->from_date = $request->from_date;
            $leaves->to_date = $request->to_date;
            $leaves->day = $days;
            $leaves->leave_reason = $request->leave_reason;
            $leaves->save();

            DB::commit();
            Toastr::success('Create New Leaves Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Leaves Fail', 'Error');
            return redirect()->back();
        }
    }

    // Edit Record
    public function editRecordLeave(Request $request)
    {
        DB::beginTransaction();

        try {
            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day = $from_date->diff($to_date);
            $days = $day->d;

            $update = [
                'id' => $request->id,
                'leave_type' => $request->leave_type,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'day' => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeavesAdmin::where('id',$request->id)
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

    // Delete Record
    public function deleteLeave(Request $request)
    {
        try {
            LeavesAdmin::destroy($request->id);
            Toastr::success('Leaves Admin Deleted Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Leaves Admin Delete Fail', 'Error');
            return redirect()->back();
        }
    }

    // Leave Settings
    public function leaveSettings()
    {
        return view('form.leavesettings');
    }

    // Attendance Admin
    public function attendanceIndex()
    {
        return view('form.attendance');
    }

    // Attendance Employee
    public function AttendanceEmployee()
    {
        return view('form.attendanceemployee');
    }

    // Leaves Employee
    public function leavesEmployee()
    {
        return view('form.leavesemployee');
    }

    // Shift Scheduling
    public function shiftScheduLing()
    {
        return view('form.shiftscheduling');
    }

    // Shift List
    public function shiftList()
    {
        return view('form.shiftlist');
    }
}
