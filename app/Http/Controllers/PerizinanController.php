<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use Illuminate\Http\Request;

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
                $perizinan =Perizinan::with('santri.detail.kamar.gedung')->get();
                break;
            case 1:
                $perizinan = $Query->whereHas('santri',function($query) {
                    $query->where('kampus','Kampus 1');
                })->get();
                break;
            case 2:
                $perizinan = $Query->whereHas('santri',function($query) {
                    $query->where('kampus','Kampus 2');
                })->get();
                break;
            case 3:
                $perizinan = $Query->whereHas('santri',function($query) {
                    $query->where('kampus','Kampus 3');
                })->get();
                break;
            case 4:
                $perizinan = $Query->whereHas('santri',function($query) {
                    $query->where('kampus','Kampus 4');
                })->get();
                break;
            default:
                $perizinan = Perizinan::with('santri.detail.kamar.gedung')->get();
                break;
            }
        return view('perizinan.index',compact('perizinan'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function show(Perizinan $perizinan)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perizinan  $perizinan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perizinan $perizinan)
    {
        //
    }
}
