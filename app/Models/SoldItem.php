<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldItem extends Model
{
    //
    protected $table = 'sold_items';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount_percentage',
        'item_total',
    ];
}
