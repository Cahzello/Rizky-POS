<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function transactionsItems()
    {
        return $this->belongsTo(Transactions_items::class);
    }
}
