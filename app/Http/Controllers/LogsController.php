<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logs;

class LogsController extends Controller
{
    public function savings()
    {
        $activity_logs = logs::where('location','savings')
        ->orderBy('id', 'DESC')->paginate(20);

        $activity_logs->setPath('savings');

        return view('pages.logs.savings',compact('activity_logs'));
   
    }
}
