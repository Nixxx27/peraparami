<?php

namespace App\Helpers;

use Auth;
use App\logs;

class Peraparamilogs
{
    public function write($actions,$location)
    {
        logs::create([
            'user_id' => Auth::user()->id,
            'actions' => $actions,
            'location' => $location
        ]);
    }
}
