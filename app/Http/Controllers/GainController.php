<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gain;

class GainController extends Controller
{
    public function gain() 
    {
        $amount = Gain::where('id',1)->first();       
        $amount =  $amount->profit_amount ;
        return  view('dashboard.gain.gain',compact('amount')) ;
    }

    public function zerogain()
    {
        $amount = Gain::where('id',1)->first();
        $amount->profit_amount = 0.00 ;
        $amount->update();
         return redirect()->back();
    }
}
