<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class savings extends Model
{
    protected $table = 'savings';
    protected $guarded =[''];
    protected $dates =['date'];

    public function savings_date()
    {
        return $this->belongsTo('App\savings_date','savings_date_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function encoder()
    {
        return $this->belongsTo('App\User','encoded_by');
    }

}
