<?php

namespace App\Http\Controllers;

use App\Models\DataSantri;
use App\Models\DetailSantri;
use App\Models\Gedung;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info("Call function index kamar", [
            "username" => Auth::user()->name,
        ]);
        return view('kamar.index', [
            'kamars'         => Kamar::with(['gedung'])->get(),
            'gedungKampus1' => Gedung::where('kampus', 'Kampus 1')->get(),
            'gedungKampus2' => Gedung::where('kampus', 'Kampus 2')->get(),
            'gedungKampus3' => Gedung::where('kampus', 'Kampus 3')->get(),
            'gedungKampus4' => Gedung::where('kampus', 'Kampus 4')->get(),
        ]);
    }

    public function kamarSantri(Request $request)
    {
        Log::info("Get data kamar for menu", [
            "username" => Auth::user()->name
        ]);
        $kampus = $request->input('kampus');
        $gedung = $request->input('gedung');
        $kamar = $request->input('kamar');

        if (Auth::user()->is_admin == 0) {
            if ($kampus) {
                $dataGedungBasedOnKampus = Gedung::with(['kamar'])->where('kampus', $kampus)->get();
            } else {
                $dataGedungBasedOnKampus = Gedung::with(['kamar'])->orderBy('kampus')->get();
            }


            $dataSantri = DetailSantri::with(['santri', 'kamar.gedung']);
            if ($gedung && $kamar) {
                $getGedung = Gedung::where('gedung', $gedung)->firstOrFail();
                $getKamar = Kamar::where(['id_gedung' => $getGedung->id, 'kamar' => $kamar])->firstOrFail();
                $dataSantri = $dataSantri->where('id_kamar', $getKamar->id);
            }

            if ($kampus) {
                // data santri by kampus
                $dataSantri = $dataSantri->whereHas('kamar.gedung', function ($query) use ($kampus) {
                    $query->where('kampus', '=', $kampus);
                });
            }
        } elseif (Auth::user()->is_admin == 1) {
            $dataGedungBasedOnKampus = Gedung::with(['kamar'])->where('kampus', 'Kampus 1')->get();

            $dataSantri = DetailSantri::with(['santri', 'kamar.gedung'])->whereHas('kamar.gedung', function ($query) use ($kampus) {
                $query->where('kampus', '=', 'Kampus 1');
            });
            if ($gedung && $kamar) {
                $getGedung = Gedung::where('gedung', $gedung)->firstOrFail();
                $getKamar = Kamar::where(['id_gedung' => $getGedung->id, 'kamar' => $kamar])->firstOrFail();
                $dataSantri = $dataSantri->where('id_kamar', $getKamar->id);
            }
        } elseif (Auth::user()->is_admin == 2) {
            $dataGedungBasedOnKampus = Gedung::with(['kamar'])->where('kampus', 'Kampus 2')->get();

            $dataSantri = DetailSantri::with(['santri', 'kamar.gedung'])->whereHas('kamar.gedung', function ($query) use ($kampus) {
                $query->where('kampus', '=', 'Kampus 2');
            });
            if ($gedung && $kamar) {
                $getGedung = Gedung::where('gedung', $gedung)->firstOrFail();
                $getKamar = Kamar::where(['id_gedung' => $getGedung->id, 'kamar' => $kamar])->firstOrFail();
                $dataSantri = $dataSantri->where('id_kamar', $getKamar->id);
            }
        }

        return view('kamar.santri', [
            'kampus' => $kampus,
            'gedung' => $gedung,
            'kamar' => $kamar,
            'dataSantri' => $dataSantri->get(),
            'masterSantri' => DataSantri::all(),
            'masterKamar' => Gedung::with(['kamar'])->orderBy('kampus')->get(),
            'gedungKampus' => $dataGedungBasedOnKampus
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
            'id_gedung' => 'required',
            'kamar'     => 'required|integer'
        ]);

        $data = Kamar::create($data);
        Log::info("Create data kamar", [
            "username" => Auth::user()->name,
            "id_kamar" => $data->id
        ]);
        return redirect('/kamar')->with('success_message', 'Data kamar dengan nama ' . $request->kamar . ' berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kamar $kamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        Log::info("Delete data gkamar", [
            "username" => Auth::user()->name,
            "id_kamar" => $kamar->id
        ]);
        $kamar->delete();
        DetailSantri::where('id_kamar', $kamar->id)->delete();
        return redirect('/kamar')->with('success_message', "Data kamar $kamar->kamar  berhasil dihapus");
    }
}
