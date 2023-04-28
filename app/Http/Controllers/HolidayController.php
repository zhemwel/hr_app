<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Holiday;
use DB;

class HolidayController extends Controller
{
    // Holidays View
    public function holiday()
    {
        $holiday = Holiday::all();
        return view('form.holidays', compact('holiday'));
    }

    // Save Record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'nameHoliday' => 'required|string|max:255',
            'holidayDate' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $holiday = new Holiday;
            $holiday->name_holiday = $request->nameHoliday;
            $holiday->date_holiday = $request->holidayDate;
            $holiday->save();

            DB::commit();
            Toastr::success('Create New Holiday Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Holiday Fail', 'Error');
            return redirect()->back();
        }
    }

    // Update
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try{
            $id = $request->id;
            $holidayName = $request->holidayName;
            $holidayDate = $request->holidayDate;

            $update = [
                'id' => $id,
                'name_holiday' => $holidayName,
                'date_holiday' => $holidayDate,
            ];

            Holiday::where('id',$request->id)
                ->update($update);
            DB::commit();
            Toastr::success('Holiday Updated Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Holiday Update Fail', 'Error');
            return redirect()->back();
        }
    }
}
