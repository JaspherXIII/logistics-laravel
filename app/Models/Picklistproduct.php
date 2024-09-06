<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picklistproduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'picklist_id',
        'product_id',
        'quantity',

    ];

    public function picklist()
    {
        return $this->belongsTo(Picklist::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
