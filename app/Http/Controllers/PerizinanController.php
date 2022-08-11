<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\Facade\Pdf as PDF;
use PDF;
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
    public function index(Request $request)
    {
        $filter = $request->input('filter');


        $Query = Perizinan::with('santri.detail.kamar.gedung')->whereNotNull('id_santri');
        if ($filter == 'not-verify') {
            $Query->where('status', '0');
        } elseif ($filter == 'verify') {
            $Query->where('status', '1');
        } elseif ($filter == 'back') {
            $Query->where('status', '2');
        }

        switch (auth()->user()->is_admin) {
            case 0:
                $perizinan = $Query->get();
                $masterSantri = DetailSantri::with('santri')->get();
                break;
            case 1:
                // $perizinan = $Query->whereHas('santri', function ($query) {
                //     $query->where('kampus', 'Kampus 1');
                // })->get();
                 $perizinan = $Query->get();
                $masterSantri = DetailSantri::with('santri')->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 1');
                })->get();
                break;
            case 2:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 2');
                })->get();
                $masterSantri = DetailSantri::with('santri')->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 2');
                })->get();
                break;
            case 3:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 3');
                })->get();
                $masterSantri = DetailSantri::with('santri')->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 3');
                })->get();
                break;
            case 4:
                $perizinan = $Query->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 4');
                })->get();
                $masterSantri = DetailSantri::with('santri')->whereHas('santri', function ($query) {
                    $query->where('kampus', 'Kampus 4');
                })->get();
                break;
            default:
                $perizinan = $Query->get();
                $masterSantri = DetailSantri::with('santri')->get();
                break;
        }
        // dd($perizinan);
        return view('perizinan.index', [
            'perizinan' => $perizinan,
            'masterSantri' => $masterSantri
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
        return view('perizinan.detail', [
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
    public function update(PerizinanRequest $request, Perizinan $perizinan)
    {
        $validator = $request->all();
        $perizinan->update($validator);
        return redirect()->route('perizinan.index')
            ->with('success_message', 'Berhasil mengubah data perizinan');
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

    public function verify(Perizinan $perizinan)
    {
        $perizinan->update(['status' => '1']);
        return redirect()->route('perizinan.index')
            ->with('success_message', 'Berhasil menverifikasi data perizinan');
    }

    public function back(Perizinan $perizinan)
    {
        $perizinan->update(['status' => '2']);
        return redirect()->route('perizinan.index')
            ->with('success_message', 'Status perizinan santri telah kembali');
    }

    public function suratPengantar($id)
    {
         $data = Perizinan::with('santri.detail.kamar.gedung')->where('id', $id)->first();
         $pdf = PDF::loadView('perizinan.print_surekom', ['data' => $data])->setPaper('a6', 'patroit');

        return $pdf->stream();
    }
    public function suratIzin($id)
    {
        $data = Perizinan::with('santri.detail.kamar.gedung')->where('id', $id)->first();
        $pdf = PDF::loadView('perizinan.print_suizin', ['data' => $data])->setPaper('a6', 'patroit');

        return $pdf->stream();
    }
}
