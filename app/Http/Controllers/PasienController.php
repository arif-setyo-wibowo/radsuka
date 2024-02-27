<?php

namespace App\Http\Controllers;
use App\Models\Pasien;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Pasien',
            'pasien' => Pasien::all(),
        ];
        return view('admin_pasien',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUpdate(Request $request){
        if ($request->proses == 'Tambah') {
            $request->validate([
                'idpasien' => 'unique:pasiens,idpasien'
            ]);
            $pasien = new Pasien;
            $pasien->idpasien = $request->idpasien;
            $pasien->nama_pasien = $request->nama_pasien;
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->tgl_lahir = $request->tgl_lahir;
            $pasien->alamat = $request->alamat;
            $datepasien = date('dmY', strtotime($request->tgl_lahir));
            $pasien->password =  Hash::make(str_replace('-', '', $datepasien));
            $pasien->save();
            Session::flash('msg', 'Berhasil Menambah Data Pasien');
            return redirect()->route('admin.pasien');
        }elseif ($request->proses == 'Update') {
            $pasien = Pasien::find($request->idpasien);
            $pasien->nama_pasien = $request->nama_pasien;
            $pasien->jenis_kelamin = $request->jenis_kelamin;
            $pasien->tgl_lahir = $request->tgl_lahir;
            $datepasien = date('dmY', strtotime($request->tgl_lahir));
            $pasien->password =  Hash::make(str_replace('-', '', $datepasien));
            $pasien->alamat = $request->alamat;
            $pasien->save();
            Session::flash('msg', 'Berhasil Mengubah Data Pasien');
            return redirect()->route('admin.pasien');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $id = $request->query('id');
        $pasien = Pasien::find($id);
        $pasien->delete();
        Session::flash('msg', 'Berhasil Menghapus Data Pasien');
        return redirect()->route('admin.pasien');
    }
}
