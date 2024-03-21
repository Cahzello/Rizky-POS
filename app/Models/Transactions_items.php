<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions_items extends Model
{   
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'transactions_items';
    
    public function transactions()
    {
        return $this->belongsTo(Transactions::class);
    }    

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
