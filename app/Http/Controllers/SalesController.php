<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estimates;
use App\Models\EstimatesAdd;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class SalesController extends Controller
{
    /** page estimates */
    public function estimatesIndex()
    {
        $estimates     = DB::table('estimates')->get();
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->get();

        return view('sales.estimates',compact('estimates','estimatesJoin'));
    }

    /** page create estimates */
    public function createEstimateIndex()
    {
        return view('sales.createestimate');
    }

    /** page edit estimates */
    public function editEstimateIndex($estimate_number)
    {
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->where('estimates_adds.estimate_number',$estimate_number)
            ->get();
        return view('sales.editestimate',compact('estimatesJoin'));
    }

    /** view page estimate */
    public function viewEstimateIndex($estimate_number)
    {
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->where('estimates_adds.estimate_number',$estimate_number)
            ->get();
        return view('sales.estimateview',compact('estimatesJoin'));
    }

    /** save record create estimate */
    public function createEstimateSaveRecord(Request $request)
    {
        $request->validate([
            'client'   => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $estimates = new Estimates;
            $estimates->client = $request->client;
            $estimates->project= $request->project;
            $estimates->email  = $request->email;
            $estimates->tax    = $request->tax;
            $estimates->client_address = $request->client_address;
            $estimates->billing_address= $request->billing_address;
            $estimates->estimate_date = $request->estimate_date;
            $estimates->expiry_date   = $request->expiry_date;
            $estimates->total = $request->total;
            $estimates->tax_1 = $request->tax_1;
            $estimates->discount    = $request->discount;
            $estimates->grand_total = $request->grand_total;
            $estimates->other_information = $request->other_information;
            $estimates->save();

            $estimate_number = DB::table('estimates')->orderBy('estimate_number','DESC')->select('estimate_number')->first();
            $estimate_number = $estimate_number->estimate_number;

            foreach($request->item as $key => $items)
            {
                $estimatesAdd['item']            = $items;
                $estimatesAdd['estimate_number'] = $estimate_number;
                $estimatesAdd['description']     = $request->description[$key];
                $estimatesAdd['unit_cost']       = $request->unit_cost[$key];
                $estimatesAdd['qty']             = $request->qty[$key];
                $estimatesAdd['amount']          = $request->amount[$key];

                EstimatesAdd::create($estimatesAdd);
            }

            DB::commit();
            Toastr::success('Create new Estimates successfully :)','Success');
            return redirect()->route('form/estimates/page');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Estimates fail :)','Error');
            return redirect()->back();
        }
    }
}
