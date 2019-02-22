<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\savings;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $savings = savings::get();
        $last_entered_savings = savings::latest()->first();
        $total_savings = $savings->sum('amount');
        $nikko = "ako si nikko";
        return view('home',compact('total_savings','last_entered_savings'));
    }
}
