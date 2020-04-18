<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function harian(Request $request)
    {
        $tgl = $request->tgl;
        if ($tgl == null || $tgl == ''){
            $data['tgl'] = date('Y-m-d');
        }else{
            $data['tgl'] = $tgl;
        }
        $data['pegawai'] = DB::table('pegawai')
                ->orderBy('pegawai_nama')
                ->get();
        $data['kepala'] = DB::table('pegawai')
            ->leftJoin('users' ,'users.id_pegawai','=','pegawai.pegawai_id')
            ->where('users.level' ,'=','kepala')
            ->first();
        return view('laporan/harian',$data);
    }
}
