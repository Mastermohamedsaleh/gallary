<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodect;
use App\Models\CashVaultLog;
use Illuminate\Support\Facades\DB;

use App\Models\Gain;


class ReturnOrderController extends Controller
{
  
    public function returnorder()
    {
        return view('dashboard.returnorderclient.returnorderclient');
    }
 
  
    public function fetchProductByCode(Request $request)
    {

        $request->validate(['code' => 'required|string|exists:prodects,barcode']);

        $product = Prodect::where('barcode', $request->code)->first();
        return response()->json(['product' => $product]);
    }

    public function fetchProductByName(Request $request)
{



    $request->validate(['name' => 'required|string']);

    $product = Prodect::where('name', 'like', '%' . $request->name . '%')->first();
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }
    return response()->json(['product' => $product]);
  }



    public function savereturnorder(Request $request)
    {
    


    foreach ($request->products as $productData) {
        $product = Prodect::where('barcode', $productData['barcode'])->first();



        // خصم الكمية المطلوبة
        $product->stock += $productData['quantity'];
        $product->save();


 
        



      



    }
    $amount = CashVaultLog::where('id',1)->first();
    $amount->amount -= $request->totalPrice;
    $amount->update();


    $totalProfit = $request->input('totalProfit');
  

    // حفظ الربح في جدول الأرباح اليومية
      $profit = Gain::where('id',1)->first();
      $profit->profit_amount -= $totalProfit;  
      $profit->update();


    return response()->json(['message' => 'Order saved successfully!']);
}
     
}
