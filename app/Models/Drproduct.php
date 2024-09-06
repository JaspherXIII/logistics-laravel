<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryreceipt_id',
        'product_id',
        'quantity',
    ];

    public function deliveryreceipt()
    {
        return $this->belongsTo(Deliveryreceipt::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
