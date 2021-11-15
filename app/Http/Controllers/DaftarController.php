<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Spb;
use App\Models\Sbbk;
use App\Models\Daftarspb;
use App\Models\Barang;
use App\Models\Kartustok;

use PDF;

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
        $daftaraju = Daftarspb::orderBy('epoch_spb', 'desc')->paginate(10);
        if(count($daftaraju)) 
        {
            $pemesan = DB::table('spbs')
                    ->join('pemesans', 'spbs.pemesan_id', 'pemesans.id')
                    ->where('spbs.nomor_spb', '=', $daftaraju[0]->nomor_spb)
                    ->select('pemesans.poksi')
                    ->first();
        return view('pages.daftarpengajuan', ['daftaraju' => $daftaraju, 'pemesan' => $pemesan]);
        }
        else
        {
            return view('pages.daftarpengajuan', ['daftaraju' => null, 'pemesan' => null]);
        }
        
    }

    public function viewstok()
    {
        $daftarstok = Barang::select('barangs.nomor_kartu', 'barangs.nama_barang', 'barangs.satuan', 'stok.masuk', 'stok.keluar', 'stok.sisa')
                                ->leftJoin(
                                    DB::raw(
                                            '(SELECT nomor_kartu, SUM(masuk) AS masuk, SUM(keluar) AS keluar, 
                                                SUM(masuk)-SUM(keluar) AS sisa FROM kartustoks 
                                                GROUP BY nomor_kartu 
                                                ORDER BY nomor_kartu ASC) as stok'
                                            ), 'barangs.nomor_kartu', 'stok.nomor_kartu')
                                ->paginate(10);
        return view('pages.kartustok', ['daftarstok' => $daftarstok]);
    }

    public function viewtambahitemstok()
    {
         if(! Gate::allows('superadmin'))
        {
            abort(403);
        }
        else
        {
            $barangs = Barang::orderBy('nama_barang', 'asc')->paginate(10);
            $max_id = rand(10000,20000);
            return view('pages.tambahitemstok', ['barangs' => $barangs, 'max_id' => $max_id]);
        }
        
    }

    public function tambahitemstok(Request $request)
    {
        if(! Gate::allows('superadmin'))
        {
            abort(403);
        }
        else
        {
            $barangbaru = new Barang;
            $barangbaru->nomor_kartu = $request->input('nomor_kartu');
            $barangbaru->nama_barang = $request->input('nama_barang');
            $barangbaru->satuan = $request->input('satuan_barang');
            $barangbaru->save();
            return redirect()->route('form.stok.item.tambah');
        }
    }

    public function hapusitemstok(Request $request)
    {
        if(! Gate::allows('superadmin'))
        {
            abort(403);
        }
        else 
        {
            Barang::where('id', $request->item_id)->delete();
            return redirect()->route('form.stok.item.tambah');
        }   
    }

    public function updateSpbIsApproved(Request $request)
    {

        if(! Gate::allows('admin'))
        {
            abort(403);
        }
        else
        {
            if($request->input('setuju'))
            {
                Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                        ->update(['isApproved' => 't', 'epoch_approved' => time()]);
            }
            else
            {
                 Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                        ->update(['isApproved' => 'f']);
            }

            return redirect()->route('daftar.ajus');
        }
    }

    public function viewsbbk($nomor_spb)
    {
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
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
                                    )
                            // ->get();
                            ->paginate(10);

        $stok = Kartustok::select('nomor_kartu', 'masuk', 'keluar')->where('nomor_spb', '=', $nomor_spb)->get();
        // dd($stok);
        return view('pages.sbbk', [
                                        'detailaju' => $detailaju,
                                        'stok' => $stok
                                    ]);
    }

    public function show($nomor_spb)
    {
        //
        $ajuApproval = Daftarspb::where('nomor_spb', '=', $nomor_spb)->first();
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
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
                                    )
                            // ->get();
                            ->paginate(10);
        // dd($detailaju);
        return view('pages.detailaju', [
                                        'detailaju' => $detailaju,
                                        'ajuApproval' => $ajuApproval
                                    ]);
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
        if(! Gate::allows('admin'))
        {
            abort(403);
        }
        else
        {
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
               Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))->update(['isRealisasi' => true, 'epoch_realisasi' => time()]);
            }

            return redirect()->route('daftar.ajus');
        }
    }

    public function buatsbbk(Request $request)
    {
        if(! Gate::allows('admin'))
        {
            abort(403);
        }
        $sbbk = new Sbbk;
        $sbbk->nomor_spb = $request->input('nomor_spb');
        $sbbk->nip_penerima = $request->input('nip_penerima');
        $sbbk->epoch_sbbk = time();
        $sbbk->nomor_sbbk = 'SBBK/WASDAR/'.date("d/m/y", time());

        if($sbbk->save())
        {
            // update kartustok
            $data = $request->except('_token');
            foreach($data as $key=>$value)
            {
                if($key !== "nomor_spb" && $key !== "nip_penerima")
                {
                    Kartustok::where('nomor_spb', '=',  $request->input('nomor_spb'))
                                ->where('nomor_kartu', '=', $key)
                                ->update(['keluar' => $value, 'nomor_sbbk' => $sbbk->nomor_sbbk]);
                }
            }

            Daftarspb::where('nomor_spb', '=', $request->input('nomor_spb'))
                        ->update(['isSbbk' => 't', 'epoch_sbbk' => $sbbk->epoch_sbbk]);
        }

        return redirect()->route('daftar.ajus');
    }

    public function cetakspb($nomor_spb)
    {
        $ajuApproval = Daftarspb::where('nomor_spb', '=', $nomor_spb)->first();
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
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
                                    )
                            ->get();
        $pdf = PDF::loadView('pages.printspb', ['detailaju' => $detailaju, 'ajuApproval' => $ajuApproval]);
        return $pdf->stream();                    
        // return view('pages.printspb', ['detailaju' => $detailaju, 'ajuApproval' => $ajuApproval]);
    }

    public function printspb(Request $request)
    {
        //
        $nomor_spb = $request->input('nomor_spb');
        $ajuApproval = Daftarspb::where('nomor_spb', '=', $nomor_spb)->first();
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
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
                                    )
                            ->get();
        // dd($detailaju);
        $pdf = PDF::loadView('pages.printspb', [
                                        'detailaju' => $detailaju,
                                        'ajuApproval' => $ajuApproval
                                    ]);
        return $pdf->stream();
        // return view('pages.detailaju', [
    //                                     'detailaju' => $detailaju,
    //                                     'ajuApproval' => $ajuApproval
    //                                 ]);
    }

    public function printsbbk(Request $request)
    {
        //
        $nomor_spb = $request->input('nomor_spb');
        $ajuApproval = Daftarspb::where('nomor_spb', '=', $nomor_spb)->first();
        $detailaju = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
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
                                    )
                            ->get();
        // dd($detailaju);
        $pdf = PDF::loadView('pages.printsbbk', [
                                        'detailaju' => $detailaju,
                                        'ajuApproval' => $ajuApproval
                                    ]);
        return $pdf->stream();
    }
}
