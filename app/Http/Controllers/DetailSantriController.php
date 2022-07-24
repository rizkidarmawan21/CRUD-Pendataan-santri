<?php

namespace App\Http\Controllers;

use App\Models\DataSantri;
use App\Models\DetailSantri;
use App\Models\Kamar;
use Illuminate\Http\Request;

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
        $validation =  $request->validate([
            'id_santri' => 'required|unique:detail_santris',
            'id_kamar' => 'required',
        ], [
            'id_santri.required' => "Anda harus memilih santri !",
            'id_santri.unique' => "Santri sudah terdaftar pada kamar tertentu !",
            'id_kamar.required' => "Anda harus memilih kamar !",
        ]);

        DetailSantri::create($validation);
        $kamar = Kamar::find($request->id_kamar);
        $santri = DataSantri::find($request->id_santri);
        return redirect('/kamar/santri')->with('success_message', "Santri $santri->nama berhasil ditambahkan ke kamar $kamar->kamar");
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
        DetailSantri::where('id',$id)->delete();
        try {
            return redirect('/kamar/santri')->with('success_message', "Data berhasil di hapus");
        } catch (\Exception $e) {
            return redirect('/kamar/santri')->with('error_message', "Gagal menghapus data");
        }

    }
}
