<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'numInv', 'descripcion', 'family_id', 'measurementunits_id', 'existencia', 'exisInicial', 'costo' ];

    public function measurementunits()
    {
        return $this->belongsTo(Measurementunits::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
