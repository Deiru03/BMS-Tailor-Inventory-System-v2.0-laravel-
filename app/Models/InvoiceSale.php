<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSale extends Model
{
    
    protected $table = 'invoice_sales';

    protected $fillable = [
        'sale_id',
        'invoice_number',
        'total_amount',
        'issued_at',
        'notes',
        'status',
    ];

    /**
     * Get the sale that owns the invoice.
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the sale items for this invoice through the sale.
     */
    public function saleItems()
    {
        return $this->hasManyThrough(SaleItem::class, Sale::class);
    }
    
    /**
     * Get the customer info through the sale.
     */
    public function customersInfo()
    {
        return $this->hasOneThrough(CustomersInfo::class, Sale::class, 'id', 'id', 'sale_id', 'customer_id');
    }
    
    /**
     * Get all returns related to this invoice.
     */
    public function returnSales()
    {
        return $this->hasMany(ReturnSales::class, 'invoice_sale_id');
    }
}
