<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\TrainingType;
use Session;
use Auth;

class TrainingTypeController extends Controller
{
    /** Index Page Training Type */
    public function index()
    {
        $show = DB::table('training_types')
            ->get();

        return view('trainingtype.trainingtype', compact('show'));
    }

    /** Save Record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $training_type = new TrainingType;
            $training_type->type = $request->type;
            $training_type->description = $request->description;
            $training_type->status = $request->status;
            $training_type->save();

            DB::commit();
            Toastr::success('Create New Training Type Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Training Type Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Update Record Trainers */
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();

        try {
            $update = [
                'id' => $request->id,
                'type' => $request->type,
                'description' => $request->description,
                'status' => $request->status,
            ];

            TrainingType::where('id', $request->id)
                ->update($update);
            DB::commit();

            Toastr::success('Updated Training Type Success','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Training Type Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Record Training Type */
    public function deleteTrainingType(Request $request)
    {
        try {
            TrainingType::destroy($request->id);
            Toastr::success('Training Type Deleted Ssuccess', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Training Type Delete Fail', 'Error');
            return redirect()->back();
        }
    }
}
