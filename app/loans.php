<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    protected $table = 'loans';
    protected $guarded =[''];
    protected $dates =['loan_date','loan_needed_date','approval_date','maturity_date'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function approver()
    {
        return $this->belongsTo('App\User','approved_by');
    }
}
