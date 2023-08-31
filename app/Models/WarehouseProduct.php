<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'warehouse_entries_id', 'inventory_id', 'numInv', 'catidad', 'measurementunits_id', 'descripcion', 'pUnit', 'total', 'ordenCompra' ];

    public function measurementunits()
    {
        return $this->belongsTo(Measurementunits::class);
    }
}
