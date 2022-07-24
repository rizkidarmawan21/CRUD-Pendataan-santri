<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSantri extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function santri() 
    {
        return $this->belongsTo(DataSantri::class,'id_santri','id');
    }

    public function kamar() 
    {
        return $this->belongsTo(Kamar::class,'id_kamar','id');
    }
}
