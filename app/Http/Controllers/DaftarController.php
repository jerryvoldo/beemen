<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Daftarspb;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewajus()
    {
        //
        $daftaraju = Daftarspb::orderBy('epoch_spb', 'desc')->get();
        return view('pages.daftarpengajuan', ['daftaraju' => $daftaraju]);
    }

    public function updateSpbIsApproved(Request $request)
    {
        if($request->input('setuju'))
        {
            Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                    ->update(['isApproved' => 't']);
        }
        else
        {
             Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                    ->update(['isApproved' => 'f']);
        }

        return redirect()->route('daftar.ajus');
        
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nomor_spb)
    {
        //
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
                            ->where('nomor_spb', '=',  $nomor_spb)
                            ->select(
                                        'spbs.id as id_spbs',
                                        'spbs.barang_id',
                                        'spbs.pemesan_id',
                                        'spbs.jumlah_pesanan',
                                        'spbs.nomor_spb',
                                        'spbs.peruntukan',
                                        'spbs.epoch_entry',
                                        'spbs.isAju',
                                        'barangs.*', 
                                        'pemesans.poksi')
                            ->get();
        // dd($detailaju);
        return view('pages.detailaju', ['detailaju' => $detailaju]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
