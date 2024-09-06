<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryreceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryreceipt_no',
        'picklist_id',
    ];

    public function picklist()
    {
        return $this->belongsTo(Picklist::class);
    }

    public function drproducts()
    {
        return $this->hasMany(Drproduct::class, 'deliveryreceipt_id');
    }
}
