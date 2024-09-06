<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'picklist_no',
        'order_from',
        'address_id',
        'status'

    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function picklistproducts()
    {
        return $this->hasMany(Picklistproduct::class, 'picklist_id');
    }
}
