<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Models\User;
use App\Models\Employee;
use App\Models\Form;
use App\Models\ProfileInformation;
use App\Models\PersonalInformation;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_name == 'Admin') {
            $result = DB::table('users')->get();
            $role_name = DB::table('role_type_users')->get();
            $position = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();

            return view('usermanagement.user_control', compact('result', 'role_name', 'position', 'department', 'status_user'));
        } else {
            return redirect()->route('home');
        }

    }

    // Search User
    public function searchUser(Request $request)
    {
        if (Auth::user()->role_name == 'Admin') {
            $users = DB::table('users')->get();
            $result = DB::table('users')->get();
            $role_name = DB::table('role_type_users')->get();
            $position = DB::table('position_types')->get();
            $department = DB::table('departments')->get();
            $status_user = DB::table('user_types')->get();

            // Search By Name
            if ($request->name) {
                $result = User::where('name', 'LIKE', '%'.$request->name.'%')
                    ->get();
            }

            // Search By Role Name
            if ($request->role_name) {
                $result = User::where('role_name', 'LIKE', '%'.$request->role_name.'%')
                    ->get();
            }

            // Search By Status
            if ($request->status) {
                $result = User::where('status', 'LIKE', '%'.$request->status.'%')
                    ->get();
            }

            // Search By Name & Role Name
            if ($request->name && $request->role_name) {
                $result = User::where('name', 'LIKE', '%'.$request->name.'%')
                    ->where('role_name', 'LIKE', '%'.$request->role_name.'%')
                    ->get();
            }

            // Search By Role Name & Status
            if ($request->role_name && $request->status) {
                $result = User::where('role_name', 'LIKE', '%'.$request->role_name.'%')
                    ->where('status', 'LIKE', '%'.$request->status.'%')
                    ->get();
            }

            // Search By Name & Status
            if ($request->name && $request->status) {
                $result = User::where('name', 'LIKE', '%'.$request->name.'%')
                    ->where('status', 'LIKE', '%'.$request->status.'%')
                    ->get();
            }

            // Search By Name, Role Name & Status
            if ($request->name && $request->role_name && $request->status) {
                $result = User::where('name', 'LIKE', '%'.$request->name.'%')
                    ->where('role_name', 'LIKE', '%'.$request->role_name.'%')
                    ->where('status', 'LIKE', '%'.$request->status.'%')
                    ->get();
            }

            return view('usermanagement.user_control', compact('users', 'role_name', 'position', 'department', 'status_user', 'result'));
        } else {
            return redirect()->route('home');
        }
    }

    // Use Activity Log
    public function activityLog()
    {
        $activityLog = DB::table('user_activity_logs')
            ->get();

        return view('usermanagement.user_activity_log', compact('activityLog'));
    }

    // Activity Log
    public function activityLogInLogOut()
    {
        $activityLog = DB::table('activity_logs')
            ->get();

        return view('usermanagement.activity_log', compact('activityLog'));
    }

    // Profile User
    public function profile()
    {
        $profile = Session::get('user_id'); // Get User_Id Session
        $userInformation = PersonalInformation::where('user_id', $profile)
            ->first(); // User Information
        $user = DB::table('users')
            ->get();
        $employees = DB::table('profile_information')
            ->where('user_id', $profile)
            ->first();

        if (empty($employees)) {
            $information = DB::table('profile_information')
                ->where('user_id', $profile)
                ->first();

            return view('usermanagement.profile_user', compact('information', 'user', 'userInformation'));
        } else {
            $user_id = $employees->user_id;
            if ($user_id == $profile) {
                $information = DB::table('profile_information')
                    ->where('user_id', $profile)
                    ->first();

                return view('usermanagement.profile_user', compact('information', 'user', 'userInformation'));
            } else {
                $information = ProfileInformation::all();
                return view('usermanagement.profile_user', compact('information', 'user', 'userInformation'));
            }
        }
    }

    // Save Profile Information
    public function profileInformation(Request $request)
    {
        try {
            if (!empty($request->images)) {
                $image_name = $request->hidden_image;
                $image = $request->file('images');

                if ($image_name =='photo_defaults.jpg') {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                    }
                } else {
                    if ($image != '') {
                        $image_name = rand() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('/assets/images/'), $image_name);
                        unlink('assets/images/'.Auth::user()->avatar);
                    }
                }

                $update = [
                    'user_id' => $request->user_id,
                    'name' => $request->name,
                    'avatar' => $image_name,
                ];

                User::where('user_id', $request->user_id)
                    ->update($update);
            }

            $information = ProfileInformation::updateOrCreate(['user_id' => $request->user_id]);
            $information->name = $request->name;
            $information->user_id = $request->user_id;
            $information->email = $request->email;
            $information->birth_date = $request->birthDate;
            $information->gender = $request->gender;
            $information->address = $request->address;
            $information->state = $request->state;
            $information->country = $request->country;
            $information->pin_code = $request->pin_code;
            $information->phone_number = $request->phone_number;
            $information->department = $request->department;
            $information->designation = $request->designation;
            $information->reports_to = $request->reports_to;
            $information->save();

            DB::commit();
            Toastr::success('Profile Information Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Profile Information Fail', 'Error');
            return redirect()->back();
        }
    }

    // Save New User
    public function addNewUserSave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|min:11|numeric',
            'role_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'required|image',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('assets/images'), $image);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->join_date = $todayDate;
            $user->phone_number = $request->phone;
            $user->role_name = $request->role_name;
            $user->position = $request->position;
            $user->department = $request->department;
            $user->status = $request->status;
            $user->avatar = $image;
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
            Toastr::success('Create New Account Success', 'Success');

            return redirect()->route('userManagement');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('User Add New Account Fail', 'Error');
            return redirect()->back();
        }
    }

    // Update
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $user_id = $request->user_id;
            $name = $request->name;
            $email = $request->email;
            $role_name = $request->role_name;
            $position = $request->position;
            $phone = $request->phone;
            $department = $request->department;
            $status = $request->status;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();
            $image_name = $request->hidden_image;
            $image = $request->file('images');

            if ($image_name == 'photo_defaults.jpg') {
                if ($image != '') {
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            } else {
                if ($image != '') {
                    unlink('assets/images/'.$image_name);
                    $image_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/assets/images/'), $image_name);
                }
            }

            $update = [
                'user_id' => $user_id,
                'name' => $name,
                'role_name'    => $role_name,
                'email' => $email,
                'position' => $position,
                'phone_number' => $phone,
                'department' => $department,
                'status' => $status,
                'avatar' => $image_name,
            ];

            $activityLog = [
                'user_name' => $name,
                'email' => $email,
                'phone_number' => $phone,
                'status' => $status,
                'role_name' => $role_name,
                'modify_user' => 'Update',
                'date_time' => $todayDate,
            ];

            DB::table('user_activity_logs')
                ->insert($activityLog);

            User::where('user_id', $request->user_id)
                ->update($update);

            DB::commit();
            Toastr::success('User Updated Success', 'Success');
            return redirect()->route('userManagement');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('User Update Fail', 'Error');
            return redirect()->back();
        }
    }

    // Delete
    public function delete(Request $request)
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user=Session::get('user');
        DB::beginTransaction();

        try {
            $fullName = $user->name;
            $email = $user->email;
            $phone_number = $user->phone_number;
            $status = $user->status;
            $role_name = $user->role_name;

            $dt = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            $activityLog = [
                'user_name' => $fullName,
                'email' => $email,
                'phone_number' => $phone_number,
                'status' => $status,
                'role_name' => $role_name,
                'modify_user' => 'Delete',
                'date_time' => $todayDate,
            ];

            DB::table('user_activity_logs')
                ->insert($activityLog);

            if ($request->avatar =='photo_defaults.jpg') {
                User::destroy($request->id);
            } else {
                User::destroy($request->id);
                unlink('assets/images/'.$request->avatar);
            }

            DB::commit();
            Toastr::success('User Deleted Success', 'Success');
            return redirect()->route('userManagement');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('User Deleted Fail', 'Error');
            return redirect()->back();
        }
    }

    // View Change Password
    public function changePasswordView()
    {
        return view('settings.changepassword');
    }

    // Change Password In DB
    public function changePasswordDB(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)
            ->update(['password'=> Hash::make($request->new_password)]);
        DB::commit();
        Toastr::success('User Change Success','Success');
        return redirect()->intended('home');
    }
}









