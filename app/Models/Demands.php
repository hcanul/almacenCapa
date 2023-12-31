<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demands extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 'user_id', 'total', 'pfstatus', 'sfstatus', 'status', 'obserMat', 'obserSub', 'actividad', 'boss_id' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
