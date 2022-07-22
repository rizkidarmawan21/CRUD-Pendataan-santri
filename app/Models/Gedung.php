<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gedung extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function kamar() 
    {
        return $this->hasMany(Kamar::class,'id_gedung','id');
    }
}
