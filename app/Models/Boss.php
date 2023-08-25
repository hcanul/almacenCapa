<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boss extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'name', 'job_id', 'workarea_id' ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function workarea()
    {
        return $this->belongsTo(Workarea::class);
    }
}
