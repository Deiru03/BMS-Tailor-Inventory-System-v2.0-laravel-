<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
        'status',
    ];
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function returnSales()
    {
        return $this->hasMany(ReturnSales::class, 'sale_item_id');
    }
    public function invoiceSales()
    {
        return $this->hasMany(InvoiceSale::class, 'sale_item_id');
    }
}
