<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSantri extends Model
{
    use HasFactory;

    protected $fillable= ['id','nama','alamat','no_telp','nama_ortu','jenjang','kelas','kampus','gedung','kamar'];
}
