<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\DataSantri;
use Illuminate\Http\Request;
use App\Exports\DataSantriExport;
use App\Imports\DataSantriImport;
use App\Models\DetailSantri;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DataSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info("call function index datasantri", [
            "username" => Auth::user()->name
        ]);

        if (Auth::user()->is_admin == 0) {
            $data_santris = DataSantri::all();
        } elseif (Auth::user()->is_admin == 1) {
            $data_santris = DataSantri::where('kampus', 'Kampus 1')->get();
        } elseif (Auth::user()->is_admin == 2) {
            $data_santris = DataSantri::where('kampus', 'Kampus 2')->get();
        } elseif (Auth::user()->is_admin == 3) {
            $data_santris = DataSantri::where('kampus', 'Kampus 3')->get();
        } elseif (Auth::user()->is_admin == 4) {
            $data_santris = DataSantri::where('kampus', 'Kampus 4')->get();
        } else {
            $data_santris = DataSantri::all();
        }

        return view('data.index', [
            'data_santris' => $data_santris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('data.create', [
            'gedung' => Gedung::all(),
            'gedungKampus1' => Gedung::where('kampus', 'Kampus 1')->get(),
            'gedungKampus2' => Gedung::where('kampus', 'Kampus 2')->get(),
            'gedungKampus3' => Gedung::where('kampus', 'Kampus 3')->get(),
            'gedungKampus4' => Gedung::where('kampus', 'Kampus 4')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_telp'   => 'required',
            'nama_ortu' => 'required',
            'jenjang'   => 'required',
            'kelas'     => 'required',
            'kampus'     => 'required',
            'jenkel'     => 'required',
        ]);

        $data = DataSantri::create($data);
        Log::info("Create data santri", [
            "username" => Auth::user()->name,
            "id_datasantri" => $data->id
        ]);
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama ' . $request->nama . ' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function show(DataSantri $datasantri)
    {
        $dataSantriWithKamar = Datasantri::where('id', $datasantri->id)->with('detail.kamar.gedung')->first();
        // dd($dataSantriWithKamar);
        return view('data.details', [
            'data_santri' => $dataSantriWithKamar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSantri $datasantri)
    {
        Log::info("call function edit datasantri", [
            "username" => Auth::user()->name
        ]);
        return view(
            'data.edit',
            [
                'data' => $datasantri,
                'gedungKampus1' => Gedung::where('kampus', 'Kampus 1')->get(),
                'gedungKampus2' => Gedung::where('kampus', 'Kampus 2')->get(),
                'gedungKampus3' => Gedung::where('kampus', 'Kampus 3')->get(),
                'gedungKampus4' => Gedung::where('kampus', 'Kampus 4')->get(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataSantri $datasantri)
    {

        $data = $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'no_telp'   => 'required',
            'nama_ortu' => 'required',
            'jenjang'   => 'required',
            'kelas'     => 'required',
            'kampus'     => 'required',
            'jenkel'     => 'required'
        ]);

        $datasantri->update($data);
        Log::info("Edit data santri", [
            "username" => Auth::user()->name,
            "id_datasantri" => $datasantri->id
        ]);
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama ' . $request->nama . ' berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSantri $datasantri)
    {

        DetailSantri::where('id_santri', $datasantri->id)->delete();

        Perizinan::where('id_santri',$datasantri->id)->delete();

        $datasantri->delete();
        Log::info("Delete data santri", [
            "username" => Auth::user()->name,
            "id_datasantri" => $datasantri->id
        ]);
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama ' . $datasantri->nama . ' berhasil dihapus');
    }


    public function exportexcel()
    {
        Log::info("Export data santri", [
            "username" => Auth::user()->name
        ]);

        if (Auth::user()->is_admin == 0) {
            $filename = 'datasantri-all.xlsx';
        } elseif (Auth::user()->is_admin == 1) {
            $filename = 'datasantri-kampus-1.xlsx';
        } elseif (Auth::user()->is_admin == 2) {
            $filename = 'datasantri-kampus-2.xlsx';
        } elseif (Auth::user()->is_admin == 3) {
            $filename = 'datasantri-kampus-3.xlsx';
        } elseif (Auth::user()->is_admin == 4) {
            $filename = 'datasantri-kampus-4.xlsx';
        } else {
        }

        return Excel::download(new DataSantriExport, $filename);
    }

    public function import(Request $request)
    {
        Log::info("Import data santri", [
            "username" => Auth::user()->name
        ]);
        Excel::import(new DataSantriImport, $request->file('excel'));

        return redirect('/datasantri')->with('success_message', 'Data santri  berhasil diimport');
    }

    public function download()
    {
        return Storage::disk('local')->download('public/download/template_datasantri.xlsx');
    }
}
