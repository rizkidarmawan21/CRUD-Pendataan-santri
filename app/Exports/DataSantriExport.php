<?php

namespace App\Exports;

use App\Models\DataSantri;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSantriExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->is_admin == 0) {
            $data_santris = DataSantri::select('nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel')->get();
        } elseif (Auth::user()->is_admin == 1) {
            $data_santris = DataSantri::select('nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel')->where('kampus', 'Kampus 1')->get();
        } elseif (Auth::user()->is_admin == 2) {
            $data_santris = DataSantri::select('nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel')->where('kampus', 'Kampus 2')->get();
        } elseif (Auth::user()->is_admin == 3) {
            $data_santris = DataSantri::select('nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel')->where('kampus', 'Kampus 3')->get();
        } elseif (Auth::user()->is_admin == 4) {
            $data_santris = DataSantri::select('nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel')->where('kampus', 'Kampus 4')->get();
        } else {
            $data_santris = DataSantri::all();
        }
        return $data_santris;
    }

    public function headings(): array
    {
        return ['nama', 'alamat', 'no_telp', 'nama_ortu', 'jenjang', 'kelas', 'kampus', 'jenkel'];
    }
}
