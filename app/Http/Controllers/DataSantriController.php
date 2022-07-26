<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\DataSantri;
use Illuminate\Http\Request;
use App\Exports\DataSantriExport;
use App\Imports\DataSantriImport;
use App\Models\DetailSantri;
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
        $data_santris = DataSantri::all();
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
            'kampus'     => 'required'
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
        $dataSantriWithKamar = Datasantri::where('id',$datasantri->id)->with('detail.kamar.gedung')->first();
        // dd($dataSantriWithKamar);
        return view('data.details',[
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
            'kampus'     => 'required'
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
        return Excel::download(new DataSantriExport, 'datasantri.xlsx');
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
        Log::info("Download template excel", [
            "username" => Auth::user()->name
        ]);
        return Storage::disk('local')->download('public/download/template_datasantri.xlsx');
    }
}
