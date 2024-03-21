<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = ['id'];
    protected $table = 'transactions';

    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactionsItems()
    {
        return $this->hasMany(Transactions_items::class);
    }
}
