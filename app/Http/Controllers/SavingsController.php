<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\savings_date;
use App\savings;
use App\User;
use App\logs;

class SavingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "wauup";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function displayGroupSavings()
    {
        $users = User::orderBy('name','ASC')->get();
        $savings_date = savings_date::orderBy('date','ASC')->get();
        $savings = savings::all();
        $total_savings = $savings->sum('amount');
        $activity_logs = logs::where('location','savings')
        ->orderBy('id', 'DESC')->limit(10)->get();
               

       return view('pages.savings.group_savings',compact('users','savings_date','savings','activity_logs','total_savings'));
    }


    public function storeSavings(Request $request, $id)
    {

       $this->validate($request,
            [
                'amount'       => 'required',
            ],
                $messages = array('amount.required' => 'Amount is required!')
            );

        $request['user_id'] = $id;
        $request['encoded_by'] = Auth::user()->id;
        $savings = savings::create($request->all());

        #Add to Totals
        $this->_PeraparamiTotals->addSavings($savings->amount);
          
        #Add Activity Logs
        $member = User::findorfail($id);
        $savings_date = savings_date::findorfail($request['savings_date_id']);
        $actions = strtoupper(Auth::user()->name) . " added P" . $request['amount'] ." savings to " . strtoupper($member->name) . " for date " . $savings_date->date->format('M/d/Y');
        $location = 'savings';
        $this->_Peraparamilogs->write($actions,$location);
       
       
        if($savings){return 1;}
        // return back()->with([
        //     'flash_message' => " Successfully Added savings for " . strtoupper($savings->user->name) 
        // ]);
    
    }

    public function editSavings(Request $request, $id)
    {
        
       $this->validate($request,
            [
                'amount'       => 'required',
            ],
                $messages = array('amount.required' => 'Amount is required!')
            );

        $savings = savings::findorfail($id);
        

        #Delete to Totals
        $this->_PeraparamiTotals->deleteSavings($savings->amount);
        
        #Add Activity Logs
         $member = User::findorfail($savings->user_id);
         $savings_date = savings_date::findorfail($savings->savings_date_id);
         $actions = strtoupper(Auth::user()->name) . " Edited Savings of " . strtoupper($member->name) . " From P". $savings->amount. " to " . $request['amount'] . " for date " . $savings_date->date->format('M/d/Y');
         $location = 'savings';
         $this->_Peraparamilogs->write($actions,$location);

         $savings->update([
            'amount' => $request['amount']
        ]);

        #Add to Totals
        $this->_PeraparamiTotals->addSavings($savings->amount);

    
        return back()->with([
            'flash_message' => " Successfully Edited savings of " . strtoupper($savings->user->name) 
        ]);
    
    }

    public function destroySavings($id)
    {
        $savings = savings::findorfail($id);
        
        #Delete to Totals
        $this->_PeraparamiTotals->deleteSavings($savings->amount);
        
        #Add Activity Logs
        $member = User::findorfail($savings->user_id);
        $savings_date = savings_date::findorfail($savings->savings_date_id);
        $actions = strtoupper(Auth::user()->name) . " Deleted Savings of " . strtoupper($member->name) . " Amounting to P". $savings->amount. " for date " . $savings_date->date->format('M/d/Y');
        $location = 'savings';
        $this->_Peraparamilogs->write($actions,$location);
        
         $savings->delete();

        return back()->with([
            'flash_message' => " Successfully Delete savings of " . strtoupper($savings->user->name) 
        ]);
    
    }

    
}
