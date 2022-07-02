<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_gedung = Gedung::all();
        return view('gedung.index', [
            'data_gedung' => $data_gedung
        ]);
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
        $data = $request->validate([
            'kampus' => 'required',
            'gedung' => 'required'
        ]);

        Gedung::create($data);
        return redirect('/gedung')->with('success_message', 'Gedung '.$request->gedung.' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function show(Gedung $gedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function edit(Gedung $gedung)
    {
        return view('gedung.edit',
        [
            'data' => $gedung
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gedung $gedung)
    {
        $data = $request->validate([
            'kampus' => 'required',
            'gedung' => 'required'
        ]);

        $gedung->update($data);
        return redirect('/gedung')->with('success_message', 'Gedung '.$request->gedung.' berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gedung $gedung)
    {
        $gedung->delete();
        return redirect('/gedung')->with('success_message', 'Gedung '.$gedung->gedung.' berhasil dihapus');
    }
}
