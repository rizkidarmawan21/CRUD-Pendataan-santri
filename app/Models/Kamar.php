<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kamar extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung', 'id');
    }

    public function detail()
    {
        return $this->hasOne(DetailSantri::class, 'id_kamar', 'id');
    }
}
