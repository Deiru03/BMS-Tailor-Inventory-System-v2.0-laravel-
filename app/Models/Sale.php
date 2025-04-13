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
        'custom_id',
        'customer_id',
        'total_amount',
        'amount_paid',  
        'change_due',   
        'balance',      
        'payment_status',
        'status',
    ];
    public function customer()
    {
        return $this->belongsTo(CustomersInfo::class, 'customer_id', 'id');
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
    public function invoiceSales()
    {
        return $this->hasOne(InvoiceSale::class, 'sale_id', 'id');
    }
}
