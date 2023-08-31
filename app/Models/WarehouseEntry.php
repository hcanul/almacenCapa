<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseEntry extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['proveedor','nomComer', 'fol_entrada', 'fecha','factura','nFactura','ordenCompra','workarea_id','nReq','oSolicitante','tCompraContrato','total','observaciones','nombrerecibe'];

    public function workarea()
    {
        return $this->belongsTo(Workarea::class);
    }
}
