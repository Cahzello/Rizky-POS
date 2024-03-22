<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_summary extends Model
{   
    protected $table = 'sales_summary';
    protected $guarded = ['id'];
    
    use HasFactory;
}
