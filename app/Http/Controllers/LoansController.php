<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use App\savings;
use App\loans;
use App\loan_applications;
use App\interest;

class LoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function approvedLoanApplication(Request $request,$application_id)
    {
        #Retrieve loan application
        $loan_applications = loan_applications::findorfail($application_id);

        $this->validate($request,
        [
            'approved_amount'       => 'required',
        ],
            $messages = array('amount.required' => 'Approved Amount is required!')
        );

        $approved_amount = $request['approved_amount']; 

     

        #Retrieve Interest rate ATM.
        $interest_rate =  interest::find(1);

        #Add to loan
        $loans = loans::create([
            'loan_date' => $loan_applications->created_at,
            'loan_needed_date' => $loan_applications->needed_date,
            'approval_date' => Carbon::now(),
            'maturity_date' =>  Carbon::now()->addMonth(),
            'user_id'       => $loan_applications->user_id,
            'loaned_amount' => $loan_applications->amount,
            'approved_amount' => $approved_amount,
            'balance' => $approved_amount,
            'approved_by' =>   Auth::user()->id,
            'status' => 'active',
            'interest_rate' => $interest_rate->interest,
            'remarks'       => $request['remarks']
        ]);
        
        #Add Activity Logs
        $actions = strtoupper(Auth::user()->name) . " Approved loan of " . ucwords($loan_applications->user->name) ." amounting to " .  $approved_amount;
        $location = 'loans';
        $this->_Peraparamilogs->write($actions,$location);

        #remove loan to loan application table
        $loan_applications->delete();

        return back()->with([
            'flash_message' => ucwords($loan_applications->user->name) ." loan was successfully Approved!"
        ]);
    }


    public function displayActiveLoans()
    {
        $loanbleAmount = $this->_PeraparamiTotals->loanableAmount();

        #Get all active loans.
        $loans = loans::where('status','active')->get();

        return view('pages.loans.active',compact('loanbleAmount','loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loanbleAmount = $this->_PeraparamiTotals->loanableAmount();
        
        return view('pages.loans.apply',compact('loanbleAmount'));
    
    }

    /**
     * New Loan Application
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'needed_date'   => 'required',
            'amount'       => 'required',
        ],
            $messages = array('needed_date.required' => 'Date Needed is required!',
            'amount.required' => 'Amount is required!')
        );

        $request['user_id'] =  Auth::user()->id;

        $loan_applications = loan_applications::create($request->all());

           return back()->with([
            'flash_message' => "You have Successfully Applied for Loan. Please wait for Admin Approval! "
        ]);
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
    


    public function displayLoanApplications()
    {
        $loan_applications = loan_applications::orderBy('id','ASC')
        ->where('status','new')->get();

        #Available cash on hand
        $loanbleAmount = $this->_PeraparamiTotals->loanableAmount();

        return view('pages.loans.loan_applications',compact('loan_applications','loanbleAmount'));
    }
}
