<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurementunits extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'abbr'];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}
