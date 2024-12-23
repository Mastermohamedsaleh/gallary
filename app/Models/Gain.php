<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gain extends Model
{
    use HasFactory;

    protected $fillable = ['profit_date','profit_amount'];
    
}
