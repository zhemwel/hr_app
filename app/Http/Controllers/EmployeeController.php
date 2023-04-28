<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;

class EmployeeController extends Controller
{
    // All Employee Card View
    public function cardAllEmployee(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();

        $userList = DB::table('users')
            ->get();

        $permission_lists = DB::table('permission_lists')
            ->get();

        return view('form.allemployeecard', compact('users', 'userList', 'permission_lists'));
    }

    // All Employee List
    public function listAllEmployee()
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();

        $userList = DB::table('users')
            ->get();
        $permission_lists = DB::table('permission_lists')
            ->get();

        return view('form.employeelist', compact('users', 'userList', 'permission_lists'));
    }

    // Save Data Employee
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'birthDate' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'employee_id' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $employees = Employee::where('email', '=', $request->email)
                ->first();

            if ($employees === null) {
                $employee = new Employee;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->birth_date = $request->birthDate;
                $employee->gender = $request->gender;
                $employee->employee_id = $request->employee_id;
                $employee->company = $request->company;
                $employee->save();

                for ($i=0; $i < count($request->id_count); $i++) {
                    $module_permissions = [
                        'employee_id' => $request->employee_id,
                        'module_permission' => $request->permission[$i],
                        'id_count' => $request->id_count[$i],
                        'read' => $request->read[$i],
                        'write' => $request->write[$i],
                        'create' => $request->create[$i],
                        'delete' => $request->delete[$i],
                        'import' => $request->import[$i],
                        'export' => $request->export[$i],
                    ];

                    DB::table('module_permissions')
                        ->insert($module_permissions);
                }

                DB::commit();
                Toastr::success('Add New Employee Success', 'Success');
                return redirect()->route('all/employee/card');
            } else {
                DB::rollback();
                Toastr::error('Employee Exits', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add New Employee Fail', 'Error');
            return redirect()->back();
        }
    }

    // View Edit Record
    public function viewRecord($employee_id)
    {
        $permission = DB::table('employees')
            ->join('module_permissions', 'employees.employee_id', '=', 'module_permissions.employee_id')
            ->select('employees.*', 'module_permissions.*')
            ->where('employees.employee_id', '=', $employee_id)
            ->get();

        $employees = DB::table('employees')
            ->where('employee_id', $employee_id)->get();

        return view('form.edit.editemployee', compact('employees', 'permission'));
    }

    // Update Record Employee
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            // Update Table Employee
            $updateEmployee = [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'employee_id' => $request->employee_id,
                'company' => $request->company,
            ];

            // Update Table User
            $updateUser = [
                'id' => $request->id,
                'name' => $request->name,
                'email' => $request->email,
            ];

            // Update Table module_permissions
            for ($i=0; $i < count($request->id_permission); $i++) {
                $UpdateModule_permissions = [
                    'employee_id' => $request->employee_id,
                    'module_permission' => $request->permission[$i],
                    'id' => $request->id_permission[$i],
                    'read' => $request->read[$i],
                    'write' => $request->write[$i],
                    'create' => $request->create[$i],
                    'delete' => $request->delete[$i],
                    'import' => $request->import[$i],
                    'export' => $request->export[$i],
                ];

                module_permission::where('id',$request->id_permission[$i])
                    ->update($UpdateModule_permissions);
            }

            User::where('id', $request->id)
                ->update($updateUser);
            Employee::where('id', $request->id)
                ->update($updateEmployee);

            DB::commit();
            Toastr::success('Updated Record Success', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Updated Record Fail', 'Error');
            return redirect()->back();
        }
    }

    // Delete Record
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try {
            Employee::where('employee_id', $employee_id)
                ->delete();
            module_permission::where('employee_id', $employee_id)
                ->delete();

            DB::commit();
            Toastr::success('Delete Record Success', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Delete Record Fail', 'Error');
            return redirect()->back();
        }
    }

    // Employee Search
    public function employeeSearch(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();

        $permission_lists = DB::table('permission_lists')
            ->get();

        $userList = DB::table('users')
            ->get();

        // Search By Id
        if ($request->employee_id) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->get();
        }

        // Search By Name
        if ($request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->get();
        }

        // Search By Name
        if ($request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name & Id
        if ($request->employee_id && $request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->get();
        }

        // Search By Position & Id
        if ($request->employee_id && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name & Position
        if ($request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name, Position & Id
        if ($request->employee_id && $request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }
        return view('form.allemployeecard', compact('users', 'userList', 'permission_lists'));
    }

    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();

        $permission_lists = DB::table('permission_lists')
            ->get();

        $userList = DB::table('users')
            ->get();

        // Search By Id
        if ($request->employee_id) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->get();
        }

        // Search By Name
        if ($request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->get();
        }

        // Search By Position
        if ($request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name & Id
        if ($request->employee_id && $request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->get();
        }

        // Search By Position & Id
        if ($request->employee_id && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name & Position
        if ($request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE','%'.$request->name.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        // Search By Name, Position & Id
        if ($request->employee_id && $request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%'.$request->employee_id.'%')
                ->where('users.name', 'LIKE', '%'.$request->name.'%')
                ->where('users.position', 'LIKE', '%'.$request->position.'%')
                ->get();
        }

        return view('form.employeelist', compact('users', 'userList', 'permission_lists'));
    }

    // Employee Profile With All Controller User
    public function profileEmployee($user_id)
    {
        $users = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', 'users.user_id')
            ->leftJoin('profile_information', 'profile_information.user_id', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->first();

        $user = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', 'users.user_id')
            ->leftJoin('profile_information', 'profile_information.user_id', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->get();

        return view('form.employeeprofile', compact('user', 'users'));
    }

    /** Page Departments */
    public function index()
    {
        $departments = DB::table('departments')
            ->get();

        return view('form.departments', compact('departments'));
    }

    /** Save Record Department */
    public function saveRecordDepartment(Request $request)
    {
        $request->validate([
            'department'    =>  'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $department = department::where('department',$request->department)
                ->first();

            if ($department === null) {
                $department = new department;
                $department->department = $request->department;
                $department->save();

                DB::commit();
                Toastr::success('Add New Department Success', 'Success');
                return redirect()->route('form/departments/page');
            } else {
                DB::rollback();
                Toastr::error('Department Exits', 'Error');
                return redirect()->back();
            }

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add New Department Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Update Record Department */
    public function updateRecordDepartment(Request $request)
    {
        DB::beginTransaction();
        try{
            // Update Table Departments
            $department = [
                'id'=>$request->id,
                'department'=>$request->department,
            ];
            department::where('id',$request->id)
                ->update($department);

            DB::commit();
            Toastr::success('Updated Record Success', 'Success');
            return redirect()->route('form/departments/page');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Updated Record Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Record Department */
    public function deleteRecordDepartment(Request $request)
    {
        try {
            department::destroy($request->id);
            Toastr::success('Department Deleted Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Department Delete Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Page Designations */
    public function designationsIndex()
    {
        return view('form.designations');
    }

    /** Page Time Sheet */
    public function timeSheetIndex()
    {
        return view('form.timesheet');
    }

    /** Page Overtime */
    public function overTimeIndex()
    {
        return view('form.overtime');
    }

}
