<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Spb;
use App\Models\Daftarspb;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.form');
    }

    public function viewspb()
    {
        $barangs = Barang::select('id', 'nama_barang', 'satuan')
                    ->orderBy('nama_barang', 'asc')->get();
        $current_spb = DB::table('spbs')
                            ->join('barangs', 'spbs.barang_id', '=', 'barangs.id')
                            ->join('pemesans', 'spbs.pemesan_id', '=', 'pemesans.id')
                            ->where('spbs.pemesan_id', '=',  Auth::user()->nip)
                            ->where('spbs.isAju', '=', 'f')
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

         // dd($barangs);

        return view('pages.spb', 
            [
                'barangs' => $barangs, 
                'current_spbs' => $current_spb,
                'nomor_spb' => session('nomor_spb')
        ]);
       
    }

    public function viewsbbk()
    {
        return view('pages.sbbk');
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
    public function storesbb(Request $request)
    {   

        if(!$request->session()->has('nomor_spb'))
        {
            $request->session()->put('nomor_spb', rand(10000, 20000)."-".date("d-m-Y"));
        }

        $item_spb = new Spb;
        $item_spb->barang_id = $request->input('nama_barang');
        $item_spb->pemesan_id = $request->user()->nip;
        $item_spb->jumlah_pesanan = $request->input('jumlah_barang');
        $item_spb->nomor_spb = $request->session()->get('nomor_spb');
        $item_spb->epoch_entry = strtotime(date("Y/m/d"));
        $item_spb->peruntukan = $request->input('peruntukan');
        $item_spb->save();


        
        return redirect()->route('form.spb');
    }

    public function storeallsbb(Request $request)
    {
        $check_nomor_spb = Spb::where('nomor_spb', '=', $request->session()->get('nomor_spb'))->first();
        if(isset($check_nomor_spb))
        {
            $daftarspb = new Daftarspb;
            $daftarspb->nomor_spb = $request->session()->get('nomor_spb');
            $daftarspb->epoch_spb = strtotime(date("Y/m/d"));
            $daftarspb->isApproved = false;
            $daftarspb->epoch_approved = 0;

            if($daftarspb->save())
            {
                Spb::where('isAju', '=', 'f')
                    ->where('nomor_spb', '=', $request->session()->get('nomor_spb'))
                    ->update(['isAju'=>'t']);
            }
            
            $request->session()->forget('nomor_spb');

            return redirect()->route('form.spb');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function deleteItem(Request $request)
    {
        Spb::where('id', '=', $request->input('item_id'))->delete();

        return redirect()->route('form.spb');
    }
}
