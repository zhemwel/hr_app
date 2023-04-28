<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Staff;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class FormController extends Controller
{
    // View Form
    public function index()
    {
        return view('form.form');
    }

    // View Record
    public function viewRecord()
    {
        $data = DB::table('staff')->get();
        return view('view_record.viewrecord', compact('data'));
    }

    // View Detail
    public function viewDetail($id)
    {
        $data = DB::table('staff')->where('id',$id)->get();
        return view('view_record.viewdetail', compact('data'));
    }

    // View Update
    public function viewUpdate(Request $request)
    {
        try{
            $id = $request->id;
            $user_id = $request->user_id;
            $fullName = $request->fullName;
            $sex = $request->sex;
            $emailAddress = $request->emailAddress;
            $phone_number = $request->phone_number;
            $position = $request->position;
            $department = $request->department;
            $salary = $request->salary;

            $update = [
                'id' => $id,
                'user_id' => $user_id,
                'full_name' => $fullName,
                'sex' => $sex,
                'email_address' => $emailAddress,
                'phone_number' => $phone_number,
                'position' => $position,
                'department' => $department,
                'salary' => $salary,
            ];

            Staff::where('id',$request->id)
                ->update($update);

            Toastr::success('Data Updated Success', 'Success');
            return redirect()->route('form/view/detail');
        } catch (\Exception $e) {
            Toastr::error('Data Updated Fail', 'Error');
            return redirect()->route('form/view/detail');
        }
    }

    // Save Record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'sex' => 'required',
            'emailAddress' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric|min:9',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
        ]);

        try {
            $fullName = $request->fullName;
            $sex = $request->sex;
            $emailAddress = $request->emailAddress;
            $phone_number = $request->phone_number;
            $position = $request->position;
            $department = $request->department;
            $salary = $request->salary;

            $Staff = new Staff();
            $Staff->full_name = $fullName;
            $Staff->sex = $sex;
            $Staff->email_address = $emailAddress;
            $Staff->phone_number = $phone_number;
            $Staff->position = $position;
            $Staff->department = $department;
            $Staff->salary = $salary;
            $Staff->save();

            Toastr::success('Data Added Success', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            Toastr::error('Data Added Fail', 'Error');
            return redirect()->back();
        }
    }

    // View Delete
    public function viewDelete($id)
    {
        $delete = Staff::find($id);
        $delete->delete();
        Toastr::success('Data Deleted Success', 'Success');
        return redirect()->route('form/view/detail');
    }
}
