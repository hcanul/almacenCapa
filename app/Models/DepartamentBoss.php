<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartamentBoss extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'name', 'job_id', 'workarea_id', 'boss_id'];
}
