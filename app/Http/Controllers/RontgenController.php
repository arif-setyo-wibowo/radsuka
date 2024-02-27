<?php

namespace App\Http\Controllers;
use App\Models\Pemeriksaan;
use App\Models\Pasien;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class RontgenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Rontgen',
            'pasien' => Pasien::all(),
            'rontgen' => Pemeriksaan::all()
        ];
        return view('admin_rontgen',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUpdate(Request $request){
        if ($request->proses == 'Tambah') {
            $pemeriksaan = new Pemeriksaan;
            $pemeriksaan->idpasien = $request->idpasien;
            $pemeriksaan->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pemeriksaan->jenis_pemeriksaan = $request->jenis_pemeriksaan;
            $pemeriksaan->detail_pemeriksaan = $request->detail_pemeriksaan;
            $pemeriksaan->save();
            Session::flash('msg', 'Berhasil Menambah Data Pemeriksaan');
            return redirect()->route('admin.rontgen');
        }elseif ($request->proses == 'Update') {
            $pemeriksaan = Pasien::find($request->idpasien);
            $pemeriksaan->idpasien = $request->idpasien;
            $pemeriksaan->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pemeriksaan->jenis_pemeriksaan = $request->jenis_pemeriksaan;
            $pemeriksaan->detail_pemeriksaan = $request->detail_pemeriksaan;
            $pemeriksaan->save();
            Session::flash('msg', 'Berhasil Mengubah Data Pemeriksaan');
            return redirect()->route('admin.rontgen');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = [
            'title' => 'Rontgen'
        ];
        return view('admin_rontgen_detail',$data);
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
