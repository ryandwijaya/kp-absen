<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }


    public function index()
    {
        $data['pegawai'] = Pegawai::all();
        return view('pegawai/index',$data);
    }

    public function profil(Request $request)
    {
        $id = $request->user()->id_pegawai;
        $data['pegawai'] = Pegawai::find($id);
        return view('profil/index',$data);
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
//        $pegawai = new Pegawai;
//        $pegawai->pegawai_nama = $request->nama;
//        $pegawai->pegawai_email = $request->email;
//        $pegawai->pegawai_no = $request->no;
//        $pegawai->save();
        $id_pegawai = DB::table('pegawai')->insertGetId([
            'pegawai_nama' => $request->nama,
            'pegawai_email' => $request->email,
            'pegawai_nip' => $request->nip,
            'pegawai_hp' => $request->hp,
            'pegawai_mulai_kerja' => $request->mulai_kerja,
            'pegawai_jabatan' => $request->jabatan
        ]);

        DB::table('users')->insert([
            'name' => $request->nama,
            'id_pegawai' => $id_pegawai,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make('password'),
        ]);

        Session::flash('alert', 'Manyimpan Data');
        return redirect('pegawai');
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
        $data['pegawai'] = DB::table('pegawai')
            ->where('pegawai_id','=',$id)
            ->leftJoin('users','users.id_pegawai','=','pegawai.pegawai_id')
            ->first();
        return view('pegawai/edit',$data);
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
        DB::table('pegawai')->where('pegawai_id','=',$id)
            ->update([
                'pegawai_nama' => $request->nama,
                'pegawai_email' => $request->email,
                'pegawai_nip' => $request->nip,
                'pegawai_hp' => $request->hp,
                'pegawai_mulai_kerja' => $request->mulai_kerja,
                'pegawai_jabatan' => $request->jabatan
            ]);

        DB::table('users')->where('id_pegawai','=',$id)
            ->update([
                'name' => $request->nama,
                'id_pegawai' => $id,
                'email' => $request->email,
                'level' => $request->level
            ]);
        $request->session()->flash('alert', ' Menyimpan Data');
        return redirect('/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        DB::table('users')->where('id_pegawai', '=', $id)->delete();
        DB::table('pegawai')->where('pegawai_id', '=', $id)->delete();
        DB::table('data_absen')->where('absen_pegawai', '=', $id)->delete();
        $request->session()->flash('alert', ' Delete Data');
        return redirect('/pegawai');
    }
}
