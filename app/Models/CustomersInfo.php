<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomersInfo extends Model
{
    use HasFactory;
    protected $table = 'customers_infos';
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'address',
        'sex',
        'notes',
        'purchased_amount',
        'amount_paid',
        'balance',
    ];
}
