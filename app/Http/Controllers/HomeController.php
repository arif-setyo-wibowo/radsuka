<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\Session;
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
            'title' => 'Petugas',
            'hasil' => Pemeriksaan::where('idpasien', Session::get('pasien.idpasien'))->get()
        ];
        return view('pasien',$data);
    }

    function detail(Request $request){
        $id = $request->query('id');
        $token = $request->query('token');
        
        if (!$token) {
            $data = [
                'title' => 'Petugas',
                'rontgen' => Pemeriksaan::with('pasien')->where('idpemeriksaan', $id)->get()
            ];

            if ($data['rontgen'][0]['idpasien'] != Session::get('pasien.idpasien')) {
                return redirect()->route('pasien');
            }else{
                return view('pasien_detail_pemeriksaan',$data);
            }
        }else{
            $pasien = Pasien::where('token', $token)->first();
            session(['pasien' => true]);
            session(['pasien.nama' => $pasien->nama_pasien]);
            session(['pasien.idpasien' => $pasien->idpasien]);    
            session(['pasien.tgl_lahir' => $pasien->tgl_lahir]);
            session(['pasien.alamat' => $pasien->alamat]);    
            session(['pasien.jenis_k' => $pasien->jenis_kelamin]);                              
            return redirect()->route('detail.pemeriksaan', ['id' => $id]);
        }
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
