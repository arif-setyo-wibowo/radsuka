<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'idpasien' => 'required',
            'password' => 'required',
        ],[
            'idpasien.required' => 'idpasien harus diisi.',
            'idpasien.idpasien' => 'idpasien tidak valid.',
            'password.required' => 'password harus diisi.',
        ]);

        $pasien = Pasien::where('idpasien', $request->idpasien)->first();

        if ($pasien) {
            if (password_verify($request->password, $pasien->password)) {
                    session(['pasien' => true]);
                    session(['pasien.nama' => $pasien->nama_pasien]);
                    session(['pasien.idpasien' => $pasien->idpasien]);    
                    session(['pasien.tgl_lahir' => $pasien->tgl_lahir]);
                    session(['pasien.alamat' => $pasien->alamat]);    
                    session(['pasien.jenis_k' => $pasien->jenis_kelamin]);                              
                    return redirect()->route('pasien');
            } else {
                return redirect()->route('home')->withErrors(['error' => 'Tgl Lahir salah'])->withInput();
            }
        } else {
            return redirect()->route('home')->withErrors(['error' => 'ID Pasien tidak ditemukan'])->withInput();
        }
    }
    

    function pasien(){
        $data = [
            'title' => 'Petugas'
        ];
        return view('pasien',$data);
    }

    function detail(){
        $data = [
            'title' => 'Petugas'
        ];
        return view('pasien_detail_pemeriksaan',$data);
    }

    public function logout (){
        session()->forget(['pasien']);
        session()->forget(['pasien.nama']);
        session()->forget(['pasien.idpasien']);    
        session()->forget(['pasien.tgl_lahir']);
        session()->forget(['pasien.alamat']);    
        session()->forget(['pasien.jenis_k']);  
        return redirect()->route('home');
    }
}
