<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Spb;
use App\Models\Daftarspb;
use App\Models\Barang;
use App\Models\Kartustok;

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
        $daftaraju = Daftarspb::orderBy('epoch_spb', 'desc')
                    ->get()->toArray();
        // dd($daftaraju);
        return view('pages.daftarpengajuan', ['daftaraju' => $daftaraju]);
    }

    public function viewstok()
    {
         $daftarstok = Barang::orderBy('nama_barang', 'desc')
                        ->get();
        dd($daftarstok);
        return view('pages.kartustok', ['daftarstok' => $daftarstok]);
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
        $ajuApproval = Daftarspb::where('nomor_spb', '=', $nomor_spb)->first();
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
                            ->join('kartustoks', 'barangs.nomor_kartu', 'kartustoks.nomor_kartu')
                            ->where('spbs.nomor_spb', '=',  $nomor_spb)
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
                                        'pemesans.poksi',
                                        'kartustoks.masuk',
                                    )
                            ->get();
        // dd($detailaju);
        return view('pages.detailaju', [
                                        'detailaju' => $detailaju,
                                        'ajuApproval' => $ajuApproval
                                    ]);
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

    public function realisasispb($nomor_spb)
    {
        $dataspb = Spb::where('nomor_spb', '=', $nomor_spb)
                        ->join('barangs', 'spbs.barang_id', 'barangs.id')
                        ->select('barangs.*', 'spbs.*')
                        ->get();
        return view('pages.realisasispb', ['dataspb' => $dataspb]);
    }

    public function storerealisasispb(Request $request)
    {
        // dd($data = $request->except('_token'));

        $kartustok = new Kartustok;
        $data = $request->except('_token');
        foreach($data as $key=>$value)
        {
            if($key !== "nomor_spb")
            {
                $tampungan[] = array('nomor_kartu' => $key,
                                        'masuk' => $value,
                                        'keluar' => 0,
                                        'sisa' => (int) $kartustok->masuk - (int) $kartustok->keluar,
                                        'nomor_spb' => $request->input('nomor_spb'),
                                        'epoch' => time()
                                    );
            }
        }
        if(DB::table('kartustoks')->insert($tampungan))
        {
           Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                        ->update(['isRealisasi' => true, 'epoch_realisasi' => time()]);
        }

        return redirect()->route('daftar.ajus');
    }
}
