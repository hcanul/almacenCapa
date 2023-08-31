<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workarea extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function boss()
    {
        return $this->hasMany(Boss::class);
    }

    public function warehouseentry()
    {
        return $this->hasMany(WarehouseEntry::class);
    }
}
