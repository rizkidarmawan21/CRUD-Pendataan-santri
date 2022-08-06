<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Perizinan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function santri()
    {
        return $this->belongsTo(DataSantri::class, 'id_santri', 'id');
    }
}
