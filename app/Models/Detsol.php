<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detsol extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'demand_id', 'inventory_id', 'cantidad', 'costo', 'total' ];
}
