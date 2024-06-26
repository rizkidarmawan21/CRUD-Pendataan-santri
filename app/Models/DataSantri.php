<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataSantri extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel'];

    public function detail()
    {
        return $this->hasOne(DetailSantri::class, 'id_santri', 'id');
    }

    public function perizinan()
    {
        return $this->hasMany(Perizinan::class, 'id_santri', 'id');
    }
}
