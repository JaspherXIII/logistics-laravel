<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'address_id',
        'return_purchase_order_no',
        'shipping_date',
        'return_note',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
