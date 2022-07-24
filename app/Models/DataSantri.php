<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSantri extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas'];

    public function detail()
    {
        return $this->hasOne(DetailSantri::class, 'id_santri', 'id');
    }
}
