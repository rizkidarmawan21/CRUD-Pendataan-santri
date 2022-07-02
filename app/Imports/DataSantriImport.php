<?php

namespace App\Imports;

use App\Models\DataSantri;
use Maatwebsite\Excel\Concerns\ToModel;

class DataSantriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new DataSantri([
            'nama'     => $row[0],
            'alamat'    => $row[1],
            'no_telp'  =>$row[2],
            'nama_ortu' => $row[3],
            'kampus' => $row[4], 
            'gedung' => $row[5], 
            'kamar' => $row[6], 
            'jenjang' => $row[7], 
            'kelas' => $row[8], 
        ]);
    }
}
