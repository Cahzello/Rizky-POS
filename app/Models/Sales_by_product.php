<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_by_product extends Model
{
    protected $table = 'sales_by_product';
    protected $guarded = ['id'];
    
    use HasFactory;
}
