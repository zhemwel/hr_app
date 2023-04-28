<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolesPermissions;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class SettingController extends Controller
{
    // Company / Settings / Page
    public function companySettings()
    {
        return view('settings.companysettings');
    }

    // Roles & Permissions
    public function rolesPermissions()
    {
        $rolesPermissions = RolesPermissions::All();
        return view('settings.rolespermissions', compact('rolesPermissions'));
    }

    // Add Role Permissions
    public function addRecord(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try{
            $roles = RolesPermissions::where('permissions_name', '=', $request->roleName)
                ->first();

            if ($roles === null) {
                // Roles Name Doesn't Exist
                $role = new RolesPermissions;
                $role->permissions_name = $request->roleName;
                $role->save();
            } else {
                // Roles Name Exits
                DB::rollback();
                Toastr::error('Roles Name Exits', 'Error');
                return redirect()->back();
            }

            DB::commit();
            Toastr::success('Create New Role Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Role Fail', 'Error');
            return redirect()->back();
        }
    }

    // Edit Roles Permissions
    public function editRolesPermissions(Request $request)
    {
        DB::beginTransaction();

        try{
            $id = $request->id;
            $roleName = $request->roleName;

            $update = [
                'id' => $id,
                'permissions_name' => $roleName,
            ];

            RolesPermissions::where('id', $id)
                ->update($update);

            DB::commit();
            Toastr::success('Role Name Updated Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Role Name Update Fail', 'Error');
            return redirect()->back();
        }
    }

    // Delete Roles Permissions
    public function deleteRolesPermissions(Request $request)
    {
        try {
            RolesPermissions::destroy($request->id);
            Toastr::success('Role Name Deleted Success=', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Role Name Delete Fail', 'Error');
            return redirect()->back();
        }
    }
}
