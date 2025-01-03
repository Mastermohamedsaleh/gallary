<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Prodect extends Model
{
    use HasFactory;



    protected $guarded = [];







    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }



    public function orders()
    {
        return $this->belongsToMany(Order::class, 'product_order');

    }//end of orders

}
