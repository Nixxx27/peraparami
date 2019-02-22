<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    protected $table = 'logs';
    protected $guarded =[''];
 
   
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
