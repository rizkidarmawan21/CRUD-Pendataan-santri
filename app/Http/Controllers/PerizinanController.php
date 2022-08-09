<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerizinanRequest;
use App\Models\DetailSantri;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Query = Perizinan::with('santri.detail.kamar.gedung');

        switch (auth()->user()->is_admin) {
            case 0:
                $perizinan = Perizinan::with('santri.detail.kamar.gedung')->get();
                break;
            case 1:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 1');
                })->get();
                break;
            case 2:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 2');
                })->get();
                break;
            case 3:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 3');
                })->get();
                break;
            case 4:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 4');
                })->get();
                break;
            default:
                $perizinan = Perizinan::with('santri.detail.kamar.gedung')->get();
                break;
        }
        return view('perizinan.index', [
            'perizinan' => $perizinan,
            'masterSantri' => DetailSantri::with('santri')->get()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerizinanRequest $request)
    {
        $data = $request->all();
        $data['tanggal_perizinan'] = Date('Y-m-d');
        $data['status'] = '0';
        
        Perizinan::create($data);
        return redirect()->route('perizinan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function show(Perizinan $perizinan)
    {
        $query = Perizinan::with('santri.detail.kamar.gedung');
        $data = $query->where('id', $perizinan->id)->first();
        return view('perizinan.detail',[
            'perizinan' => $data,
            'historyIzin' => $query->where('id_santri', $data->santri->id)->get(),
            'masterSantri' => DetailSantri::with('santri')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perizinan $perizinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perizinan $perizinan)
    {
        echo 'update izin' ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perizinan $perizinan)
    {
        $perizinan->delete();
        return redirect()->back();
    }

    public function verify($id) {

    }

    public function back($id) {

    }

    public function suratPengantar($id) {

    }
    public function suratIzin($id) {

    }

}
