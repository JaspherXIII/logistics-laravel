<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'unit',
        'image',
        'price',
        'supplier_id',
        'status',


    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderproducts()
    {
        return $this->hasMany(Orderproduct::class, 'product_id');
    }
}
