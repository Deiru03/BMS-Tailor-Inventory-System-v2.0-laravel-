<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\SupplierInfo;
/**
 * Class SupplierType
 *
 * Represents a type of supplier, such as fabric or accessories.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */

class SupplierType extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the suppliers associated with this type.
     */
    public function suppliers()
    {
        return $this->belongsToMany(SupplierInfo::class, 'supplier_supplier_type', 'supplier_type_id', 'supplier_id');
    }
}
