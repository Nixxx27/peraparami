<?php

namespace App\Helpers;

use App\totals;
use App\logs;

class PeraparamiTotals
{

    public function loanableAmount()
    {
        $savings = totals::where('id', 1)->first();
        if($savings)
        {
            return $savings->total_savings - $savings->total_loans;
        }else {
            return 0;
        }
    }

    public function addSavings($amount)
    {
        $savings = totals::where('id', 1)->first();
        if($savings)
        {
            $new_savings = $savings->total_savings + $amount;
            $savings->update(['total_savings' =>  $new_savings]);
        }else {
            $savings = totals::create(['total_savings'=>$amount]);
        }
    }

    public function deleteSavings($amount)
    {
        $savings = totals::where('id', 1)->first();
        if($savings)
        {
            $new_savings = $savings->total_savings - $amount;
            $savings->update(['total_savings' =>  $new_savings]);
        }else {
            $savings = totals::create(['total_savings'=>$amount]);
        }
    }


       
}
