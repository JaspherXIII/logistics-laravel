<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'address_id',
        'purchase_order_no',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function orderproducts()
    {
        return $this->hasMany(Orderproduct::class, 'order_id');
    }
}
