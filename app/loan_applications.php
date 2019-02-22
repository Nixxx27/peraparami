<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan_applications extends Model
{
    protected $table = 'loan_applications';
    protected $guarded =[''];
    protected $dates =['needed_date'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function encoder()
    {
        return $this->belongsTo('App\User','approved_by');
    }

}
