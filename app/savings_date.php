<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class savings_date extends Model
{
    protected $table = 'savings_date';
    protected $guarded =[''];
    protected $dates =['date'];

    public function savings()
    {
        return $this->hasMany('App\savings','id','savings_date_id');
    }
}
