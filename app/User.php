<?php

namespace App;

use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function is_admin()
     {
         if($this->is_admin == 1)
         {
             return true;
         }
 
         return false;
     }


     public function savedAmount($savings_date_id)
     {
         return $this->belongsTo('App\savings','id','user_id')
         ->where('savings_date_id',$savings_date_id)
         ->first();
     }

     public function totalSavings($user_id)
     {
        return DB::table('savings')->where('user_id',$user_id)
        ->sum('amount');
     }
 
     
}
