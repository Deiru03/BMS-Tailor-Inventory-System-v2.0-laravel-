<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierInfo extends Model
{
    //
    protected $table = 'supplier_infos';

    protected $fillable = [
        'supplier_id',
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'tin',
        'supplier_type',
        'is_active',
        'notes',
    ];

    public function types()
    {
        return $this->belongsToMany(SupplierType::class, 'supplier_supplier_type', 'supplier_id', 'supplier_type_id');
    }
}
