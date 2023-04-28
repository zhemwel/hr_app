<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Expense;
use App\Models\Estimates;
use App\Models\EstimatesAdd;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SalesController extends Controller
{
    /** Page Estimates */
    public function estimatesIndex()
    {
        $estimates = DB::table('estimates')->get();
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->get();

        return view('sales.estimates', compact('estimates', 'estimatesJoin'));
    }

    /** Page Create Estimates */
    public function createEstimateIndex()
    {
        return view('sales.createestimate');
    }

    /** Page Edit Estimates */
    public function editEstimateIndex($estimate_number)
    {
        $estimates = DB::table('estimates')
            ->where('estimate_number', $estimate_number)
            ->first();
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->where('estimates_adds.estimate_number', $estimate_number)
            ->get();

        return view('sales.editestimate', compact('estimates', 'estimatesJoin'));
    }

    /** View Page Estimate */
    public function viewEstimateIndex($estimate_number)
    {
        $estimatesJoin = DB::table('estimates')
            ->join('estimates_adds', 'estimates.estimate_number', '=', 'estimates_adds.estimate_number')
            ->select('estimates.*', 'estimates_adds.*')
            ->where('estimates_adds.estimate_number', $estimate_number)
            ->get();
        return view('sales.estimateview', compact('estimatesJoin'));
    }

    /** Save Record Create Estimate */
    public function createEstimateSaveRecord(Request $request)
    {
        $request->validate([
            'client' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $estimates = new Estimates;
            $estimates->client = $request->client;
            $estimates->project= $request->project;
            $estimates->email = $request->email;
            $estimates->tax = $request->tax;
            $estimates->client_address = $request->client_address;
            $estimates->billing_address = $request->billing_address;
            $estimates->estimate_date = $request->estimate_date;
            $estimates->expiry_date = $request->expiry_date;
            $estimates->total = $request->total;
            $estimates->tax_1 = $request->tax_1;
            $estimates->discount = $request->discount;
            $estimates->grand_total = $request->grand_total;
            $estimates->other_information = $request->other_information;
            $estimates->save();

            $estimate_number = DB::table('estimates')
                ->orderBy('estimate_number','DESC')
                ->select('estimate_number')
                ->first();

            $estimate_number = $estimate_number->estimate_number;

            foreach ($request->item as $key => $items)
            {
                $estimatesAdd['item'] = $items;
                $estimatesAdd['estimate_number'] = $estimate_number;
                $estimatesAdd['description'] = $request->description[$key];
                $estimatesAdd['unit_cost'] = $request->unit_cost[$key];
                $estimatesAdd['qty'] = $request->qty[$key];
                $estimatesAdd['amount'] = $request->amount[$key];

                EstimatesAdd::create($estimatesAdd);
            }

            DB::commit();
            Toastr::success('Create New Estimates Success', 'Success');
            return redirect()->route('form/estimates/page');
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Estimates Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Update Record Estimate */
    public function EstimateUpdateRecord(Request $request)
    {
        DB::beginTransaction();

        try {
            $update = [
                'id' => $request->id,
                'client' => $request->client,
                'project' => $request->project,
                'email' => $request->email,
                'tax' => $request->tax,
                'client_address' => $request->client_address,
                'billing_address' => $request->billing_address,
                'estimate_date' => $request->estimate_date,
                'expiry_date' => $request->expiry_date,
                'total' => $request->total,
                'tax_1' => $request->tax_1,
                'discount' => $request->discount,
                'grand_total' => $request->grand_total,
                'other_information' => $request->other_information,
            ];

            Estimates::where('id',$request->id)
                ->update($update);

            /** Delete Record */
            foreach ($request->estimates_adds as $key => $items) {
                DB::table('estimates_adds')
                    ->where('id', $request->estimates_adds[$key])
                    ->delete();
            }

            /** Insert New Record */
            foreach($request->item as $key => $item)
            {
                $estimatesAdd['estimate_number'] = $request->estimate_number;
                $estimatesAdd['item'] = $request->item[$key];
                $estimatesAdd['description'] = $request->description[$key];
                $estimatesAdd['unit_cost'] = $request->unit_cost[$key];
                $estimatesAdd['qty'] = $request->qty[$key];
                $estimatesAdd['amount'] = $request->amount[$key];

                EstimatesAdd::create($estimatesAdd);
            }

            DB::commit();
            Toastr::success('Updated Estimates Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Estimates Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Record Estimate Add */
    public function EstimateAddDeleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            EstimatesAdd::destroy($request->id);
            DB::commit();
            Toastr::success('Estimates Deleted Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Estimates Deleted Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Delete Record Estimate */
    public function EstimateDeleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            /** Delete Record Table Estimates_Adds */
            $estimate_number = DB::table('estimates_adds')
                ->where('estimate_number',$request->estimate_number)
                ->get();

            foreach ($estimate_number as $key => $id_estimate_number) {
                DB::table('estimates_adds')
                    ->where('id', $id_estimate_number->id)
                    ->delete();
            }

            /** Delete Record Table Estimates */
            Estimates::destroy($request->id);

            DB::commit();
            Toastr::success('Estimates Deleted Success', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Estimates Deleted Fail', 'Error');
            return redirect()->back();
        }
    }

    /** View Payments Page */
    public function Payments()
    {
        return view('sales.payments');
    }

    /** Expenses Page Index */
    public function Expenses()
    {
        /** Get Data Show Data On Table Page Expenses */
        $data = DB::table('expenses')
            ->get();

        return view('sales.expenses', compact('data'));
    }

    // Save Record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'purchase_from' => 'required|string|max:255',
            'purchase_date' => 'required|string|max:255',
            'purchased_by' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'paid_by' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'attachments' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $attachments = time().'.'.$request->attachments->extension();
            $request->attachments->move(public_path('assets/images'), $attachments);

            $expense = new Expense;
            $expense->item_name = $request->item_name;
            $expense->purchase_from = $request->purchase_from;
            $expense->purchase_date = $request->purchase_date;
            $expense->purchased_by = $request->purchased_by;
            $expense->amount = $request->amount;
            $expense->paid_by = $request->paid_by;
            $expense->status = $request->status;
            $expense->attachments = $attachments;
            $expense->save();

            DB::commit();
            Toastr::success('Create New Expense Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Expense Fail', 'Error');
            return redirect()->back();
        }
    }

    // Update
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $attachments = $request->hidden_attachments;
            $attachment = $request->file('attachments');

            if ($attachment != '') {
                unlink('assets/images/'.$attachments);
                $attachments = time().'.'.$attachment->getClientOriginalExtension();
                $attachment->move(public_path('assets/images'), $attachments);
            } else {
                $attachments;
            }

            $update = [
                'id' => $request->id,
                'item_name' => $request->item_name,
                'purchase_from' => $request->purchase_from,
                'purchase_date' => $request->purchase_date,
                'purchased_by' => $request->purchased_by,
                'amount' => $request->amount,
                'paid_by' => $request->paid_by,
                'status' => $request->status,
                'attachments' => $attachments,
            ];

            Expense::where('id',$request->id)
                ->update($update);
            DB::commit();
            Toastr::success('Expense Updated Success', 'Success');

            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Expense Update Fail', 'Error');
            return redirect()->back();
        }
    }

    // Delete
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            Expense::destroy($request->id);
            unlink('assets/images/'.$request->attachments);
            DB::commit();
            Toastr::success('Expense Deleted Success', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Expense Deleted Fail', 'Error');
            return redirect()->back();
        }
    }

    /** Search Record */
    public function searchRecord(Request $request)
    {
        $data = DB::table('expenses')->get();

        // Search By Item Name
        if (
            !empty($request->item_name) &&
            empty($request->from_date) &&
            empty($request->to_data)
        ) {
            $data = Expense::where('item_name','LIKE','%'.$request->item_name.'%')
                ->get();
        }

        // Search By From Date To Date
        if (
            empty($request->item_name) &&
            !empty($request->from_date) &&
            !empty($request->to_date)
        ) {
            $data = Expense::whereBetween('purchase_date',[$request->from_date, $request->to_date])
                ->get();
        }

        // Search By Item Name & From Date To Date
        if (
            !empty($request->item_name) &&
            !empty($request->from_date) &&
            !empty($request->to_date)
        ) {
            $data = Expense::where('item_name', 'LIKE','%'.$request->item_name.'%')
                ->whereBetween('purchase_date', [$request->from_date, $request->to_date])
                ->get();
        }

        return view('sales.expenses', compact('data'));
    }
}
