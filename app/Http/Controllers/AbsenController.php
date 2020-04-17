<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AbsenController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function absen($jenis){
        if ($jenis == 'apel'){
            return view('absen/index');
        }elseif ($jenis == 'pagi'){
            return view('absen/pagi');
        }elseif ($jenis == 'siang'){
            return view('absen/siang');
        }

    }

    public function absenApel($id){
//        var_dump(date('H:m:s')  <=  $this->cekWaktu('apel'));exit();
        $pegawai = DB::table('pegawai')
            ->where('pegawai_nip', '=', $id)
            ->first();
        $cek_absen = $this->cekAbsen($pegawai->pegawai_id,date('Y-m-d'),'apel');
        if ($cek_absen == 0){
            if (date('H:m:s')  <=  $this->cekWaktu('apel') ){
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'apel',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }else{
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'apel',
                    'absen_status' => 'telat',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }

            Session::flash('alert-absen', 'Berhasil Absen');
            return redirect('/');
        }else{
            Session::flash('sudah-absen', 'Gagal Absen');
            return redirect('/');
        }
    }
    public function absenPagi($id){
        $pegawai = DB::table('pegawai')
            ->where('pegawai_nip', '=', $id)
            ->first();
        $cek_absen = $this->cekAbsen($pegawai->pegawai_id,date('Y-m-d'),'pagi');
        if ($cek_absen == 0){
            if (date('H:m:s')  <=  $this->cekWaktu('pagi')) {
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'pagi',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }else{
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'pagi',
                    'absen_status' => 'telat',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }
            Session::flash('alert-absen', 'Berhasil Absen');
            return redirect('/');
        }else{
            Session::flash('sudah-absen', 'Gagal Absen');
            return redirect('/');
        }
    }
    public function absenSiang($id){
        $pegawai = DB::table('pegawai')
            ->where('pegawai_nip', '=', $id)
            ->first();
        $cek_absen = $this->cekAbsen($pegawai->pegawai_id,date('Y-m-d'),'siang');
        if ($cek_absen == 0){
            if (date('H:m:s')  <=  $this->cekWaktu('siang')) {
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'siang',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }else{
                DB::table('data_absen')->insert([
                    'absen_pegawai' => $pegawai->pegawai_id,
                    'absen_kategori' => 'siang',
                    'absen_status' => 'telat',
                    'absen_tgl' => date('Y-m-d'),
                ]);
            }
            Session::flash('alert-absen', 'Berhasil Absen');
            return redirect('/');
        }else{
            Session::flash('sudah-absen', 'Gagal Absen');
            return redirect('/');
        }
    }
    public function cekAbsen($id,$tgl,$kategori){
        $data = DB::table('data_absen')
            ->where('absen_pegawai', '=', $id)
            ->where('absen_tgl', '=', $tgl)
            ->where('absen_kategori', '=', $kategori)
            ->first();
        if ($data == NULL){
            return 0;
        }else{
            return 1;
        }
    }
    public function cekWaktu($kategori){
        $data = DB::table('waktu_absen')
            ->where('waktu_id', '=', 1)
            ->first();
        if ($kategori == 'apel'){
            return $data->waktu_apel;
        }elseif ($kategori == 'pagi'){
            return $data->waktu_pagi;
        }elseif ($kategori == 'siang'){
            return $data->waktu_siang;
        }
    }
}
