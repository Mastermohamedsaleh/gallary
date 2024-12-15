<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Prodect;
use App\Models\Category;
use File;


class ProdectController extends Controller
{
  
    public function index(Request $request)
    {


         if($request->search){
            $products = Prodect::where('name','like','%' . $request->search . '%' )->paginate(PAGINATE_COUNT);
         }else{
            $products = Prodect::paginate(PAGINATE_COUNT);
         }

     return view('dashboard.prodects.index',compact('products'));
    }

   
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.prodects.create',compact('categories'));
    }


    public function store(Request $request)
    {
             
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'purchase_price' => 'required|min:1',
            'sale_price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock'=>'required',
            'barcode' => 'required|numeric',
        ]);


        $imageName = time().'.'.$request->image->extension(); 
        $products =  new Prodect();
        $products->image =   $imageName;
        $products->category_id = $request->category_id;
        $products->name = $request->name;
        $products->sale_price = $request->sale_price;
        $products->purchase_price = $request->purchase_price;
        $products->stock = $request->stock;
        $products->barcode = $request->barcode;
        $products->save();
        $request->image->move(public_path('uploads/products'), $imageName);
        session()->flash('success', 'تم اضافه بنجاح');
        return redirect()->route('prodects.index');

         
    }

 
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {       

        $product = Prodect::findorfail($id);
        $categories = Category::all();

     return view('dashboard.prodects.edit',compact('product','categories'));

        
    }

 
    public function update(Request $request, $id)
    {
 
        $product = Prodect::findorfail($id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->sale_price = $request->sale_price;
        $product->purchase_price = $request->purchase_price;
        $product->stock = $request->stock;
 
        if($request->hasfile('image')){
            $path = 'uploads/products/'.$request->old_image;
            if(File::exists($path)){
                File::delete($path);
            }
            $imageName = time().'.'.$request->image->extension(); 

            $product->image = $imageName;
             
           $request->image->move(public_path('uploads/products'), $imageName);

        }
        
        $product->update();
 
        session()->flash('success', "تم التعديل بنجاح");
        return redirect()->route('prodects.index');
            

    }


    public function destroy(Request $request , $id)
    {
       $product = Prodect::findorfail($id);
       $product->delete();
        if(File::exists(public_path('uploads/products/'.$request->old_image))){
            File::delete(public_path('uploads/products/'.$request->old_image));
            }
         
            session()->flash('success', "تم الحذف بنجاح");
            return redirect()->route('prodects.index');
     
    }
}
