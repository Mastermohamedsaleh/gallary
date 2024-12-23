<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CashVaultLog;


class CashController extends Controller
{ 
    public function cash() 
    {
        $amount = CashVaultLog::where('id',1)->first();       
        $amount =  $amount->amount ;
        return  view('dashboard.cash.cash',compact('amount')) ;
    }

    public function withdraw()
    {
        $amount = CashVaultLog::where('id',1)->first();
        $amount->amount = 0.00 ;
        $amount->update();
         return redirect()->back();
    }
}
