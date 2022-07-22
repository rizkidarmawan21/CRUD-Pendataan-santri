<?php

namespace App\Exports;

use App\Models\DataSantri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataSantriExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DataSantri::select('nama','alamat','no_telp','nama_ortu','jenjang','kelas')->get();
    }

    public function headings(): array
    {
        return ['nama','alamat','no_telp','nama_ortu','jenjang','kelas'];
    }

}
