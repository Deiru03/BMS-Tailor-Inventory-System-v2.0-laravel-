<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSale extends Model
{
    
    protected $table = 'invoice_sales';

    protected $fillable = [
        'invoice_id',
        'sale_item_id',
        'quantity',
        'unit_price',
        'subtotal',
        'status',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function saleItem()
    {
        return $this->belongsTo(SaleItem::class, 'sale_item_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function returnSales()
    {
        return $this->hasMany(ReturnSales::class, 'invoice_sale_id');
    }
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
    public function customersInfo()
    {
        return $this->belongsTo(CustomersInfo::class, 'customer_id');
    }
    public function saleItems()
    {
        return $this->hasMany(SaleItem::class, 'sale_item_id');
    }
    public function invoiceSales()
    {
        return $this->hasMany(InvoiceSale::class, 'invoice_id');
    }
}
