<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\DataSantri;
use Illuminate\Http\Request;
use App\Exports\DataSantriExport;
use App\Imports\DataSantriImport;
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

        return view('data.create',[
            'gedung' => Gedung::all(),
            'gedungKampus1' =>Gedung::where('kampus','Kampus 1')->get(),
            'gedungKampus2' =>Gedung::where('kampus','Kampus 2')->get(),
            'gedungKampus3' =>Gedung::where('kampus','Kampus 3')->get(),
            'gedungKampus4' =>Gedung::where('kampus','Kampus 4')->get(),
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
            'kampus'    => 'required',
            'gedung'    => 'required',
            'kamar'     => 'required',
            'jenjang'   => 'required',
            'kelas'     => 'required'
        ]);

        DataSantri::create($data);
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama '.$request->nama.' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function show(DataSantri $datasantri)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSantri $datasantri)
    {
        return view('data.edit',
        [
            'data' => $datasantri,
            'gedungKampus1' =>Gedung::where('kampus','Kampus 1')->get(),
            'gedungKampus2' =>Gedung::where('kampus','Kampus 2')->get(),
            'gedungKampus3' =>Gedung::where('kampus','Kampus 3')->get(),
            'gedungKampus4' =>Gedung::where('kampus','Kampus 4')->get(),
        ]);
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
            'kampus'    => 'required',
            'gedung'    => 'required',
            'kamar'     => 'required',
            'jenjang'   => 'required',
            'kelas'     => 'required'
        ]);

        $datasantri->update($data);
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama '.$request->nama.' berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSantri  $dataSantri
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSantri $datasantri)
    {

        $datasantri->delete();
        return redirect('/datasantri')->with('success_message', 'Data santri dengan nama '.$datasantri->nama.' berhasil dihapus');
    }


    public function exportexcel(){
        return Excel::download(new DataSantriExport, 'datasantri.xlsx');
    }

    public function import(Request $request){
        Excel::import(new DataSantriImport, $request->file('excel'));
        
        return redirect('/datasantri')->with('success_message', 'Data santri  berhasil diimport');
    }

    public function download(){
        return Storage::disk('local')->download('public/download/template_datasantri.xlsx');
    }

}
