<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomersInfo;
use App\Models\SaleItem;
use App\Models\ReturnSales;
use App\Models\Product;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'total_amount',
        'payment_status',
        'status',
    ];
    public function customer()
    {
        return $this->belongsTo(CustomersInfo::class, 'customer_id');
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }
    public function returnSales()
    {
        return $this->hasMany(ReturnSales::class, 'sale_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
