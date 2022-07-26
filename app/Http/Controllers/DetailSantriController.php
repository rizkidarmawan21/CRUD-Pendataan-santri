<?php

namespace App\Http\Controllers;

use App\Models\DataSantri;
use App\Models\DetailSantri;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DetailSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $validation =  $request->validate([
            'id_santri' => 'required|unique:detail_santris',
            'id_kamar' => 'required',
        ], [
            'id_santri.required' => "Anda harus memilih santri !",
            'id_santri.unique' => "Ada santri yang sudah terdaftar pada kamar tertentu !",
            'id_kamar.required' => "Anda harus memilih kamar !",
        ]);
        for ($i=0; $i < sizeof($request->id_santri) ; $i++) { 
            $validation['id_santri'] = $request->id_santri[$i];
            DetailSantri::create($validation);
        }
        $kamar = Kamar::find($request->id_kamar);
        Log::info("Plotting data santri", [
            "username" => Auth::user()->name,
            "id_santri" => $request->id_santri,
            "id_kamar" => $request->id_kamar
        ]);
        // $santri = DataSantri::find($request->id_santri);
        return redirect('/kamar/santri')->with('success_message', "Santri berhasil ditambahkan ke kamar $kamar->kamar");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailSantri  $detailSantri
     * @return \Illuminate\Http\Response
     */
    public function show(DetailSantri $detailSantri)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailSantri  $detailSantri
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailSantri $detailSantri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailSantri  $detailSantri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailSantri $detailSantri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailSantri  $detailSantri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info("Delete santri with kamar e", [
            "username" => Auth::user()->name,
            "id_detail" => $id
        ]);
        DetailSantri::where('id',$id)->delete();
        try {
            return back()->with('success_message', "Data berhasil di hapus");
        } catch (\Exception $e) {
            return back()->with('error_message', "Gagal menghapus data");
        }

    }
}
