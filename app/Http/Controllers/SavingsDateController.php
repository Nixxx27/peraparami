<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\savings_date;

class SavingsDateController extends Controller
{
   
    public function displaySavingsDate()
    {
        $savings_date = savings_date::all();

        return view('pages.savings.savings_date',compact('savings_date'));
    }

    public function storeSavingsDate(Request $request)
    {
        $this->validate($request,
            [
                'date'       => 'required',
            ],
                $messages = array('date.required' => 'Savings Collection Date is required!')
            );
        
        savings_date::create($request->all());

        return back()->with([
            'flash_message' => "Date Successfully Added!"
       ]);
    }

    public function editSavingsDate(Request $request,$id)
    {
        $this->validate($request,
            [
                'date'       => 'required',
            ],
                $messages = array('date.required' => 'Savings Collection Date is required!')
            );
        
            $savings_date = savings_date::findorfail($id);
            $savings_date->update($request->all());
       
        return back()->with([
            'flash_message' => "Date Successfully Updated!"
       ]);
    }

    public function destroySavingsDate($id)
    {
        $savings_date = savings_date::findorfail($id);
        $savings_date->delete();
        
        return back()->with([
            'flash_message' => "Date Successfully Deleted!"
       ]);
    }
}
