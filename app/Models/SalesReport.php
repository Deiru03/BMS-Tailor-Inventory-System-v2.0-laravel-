<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    protected $table = 'sales_reports';

    protected $fillable = [
        'sale_id',
        'customer_name',
        'total_amount',
        'payment_status',
        'sale_date',
    ];
}