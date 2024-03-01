<?php

namespace App\Http\Controllers;
use App\Models\Pemeriksaan;
use App\Models\Pasien;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'rontgen' => Pemeriksaan::with('pasien')->get()
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
            $foto = [];
            $document = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/images', $imageName);
                    $foto[] = $imageName;
                }
            }

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $doc) {
                    $docName = Str::random(20) . '.' . $doc->getClientOriginalExtension();
                    $doc->storeAs('public/dokumen', $docName);
                    $document[] = $docName;
                }
            }

            $pemeriksaan = new Pemeriksaan;
            $pemeriksaan->idpemeriksaan = time();
            $pemeriksaan->idpasien = $request->idpasien;
            $pemeriksaan->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pemeriksaan->jenis_pemeriksaan = $request->jenis_pemeriksaan;
            $pemeriksaan->detail_pemeriksaan = $request->detail_pemeriksaan;
            $pemeriksaan->foto_rontgen = implode(',', $foto);
            $pemeriksaan->dokumen = implode(',', $document);
            $pemeriksaan->save();
            Session::flash('msg', 'Berhasil Menambah Data Pemeriksaan');
            return redirect()->route('admin.rontgen');
        }elseif ($request->proses == 'Update') {
            $pemeriksaan = Pemeriksaan::find($request->idpemeriksaan);
            $pemeriksaan->tgl_pemeriksaan = $request->tgl_pemeriksaan;
            $pemeriksaan->jenis_pemeriksaan = $request->jenis_pemeriksaan;
            $pemeriksaan->detail_pemeriksaan = $request->detail_pemeriksaan;
            $foto = [];
            $document = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/images', $imageName);
                    $foto[] = $imageName;
                }
                $pemeriksaan->foto_rontgen = implode(',', $foto);
            }

            if ($request->hasFile('dokumen')) {
                foreach ($request->file('dokumen') as $doc) {
                    $docName = Str::random(20) . '.' . $doc->getClientOriginalExtension();
                    $doc->storeAs('public/dokumen', $docName);
                    $document[] = $docName;
                }
                $pemeriksaan->dokumen = implode(',', $document);
            }
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
    public function show(Request $request)
    {
        $id = $request->query('id');
        $data = [
            'title' => 'Rontgen',
            'rontgen' => Pemeriksaan::with('pasien')->where('idpemeriksaan', $id)->get()
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
    public function destroy(Request $request){
        $id = $request->query('id');
        $pemeriksaan = Pemeriksaan::find($id);
        $pemeriksaan->delete();
        Session::flash('msg', 'Berhasil Menghapus Data Rontgen');
        return redirect()->route('admin.rontgen');
    }
}
