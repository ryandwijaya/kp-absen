@extends('layouts/main')
@section('title_page','Edit Pegawai')
@section('judul_halaman','Form Edit Pegawai')

@section('konten')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-muted text-light">
                    <h4 class="card-title float-left">Edit Data Pegawai</h4></div>
                <div class="card-body">
                    <form action="{{ action('PegawaiController@update',$pegawai->pegawai_id)  }}" method="post">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group">
                            <label>Nama Pegawai</label>
                            <input type="text" class="form-control" value="{{ $pegawai->pegawai_nama }}" name="nama" required placeholder="Masukkan nama pegawai">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $pegawai->pegawai_email }}"  name="email" required placeholder="Masukkan email pegawai">
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" class="form-control"  value="{{ $pegawai->pegawai_nip }}"  name="nip" placeholder="Masukkan Nip">
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control"  value="{{ $pegawai->pegawai_jabatan }}"  name="jabatan" placeholder="Masukkan Jabatan">
                        </div>
                        <div class="form-group">
                            <label>Nomor Hp</label>
                            <input type="text" class="form-control" value="{{ $pegawai->pegawai_hp }}"  name="hp" placeholder="Masukkan Nomor Handphone">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Mulai Kerja</label>
                                <input type="date"  value="{{ $pegawai->pegawai_mulai_kerja }}"  class="form-control" name="mulai_kerja" >
                            </div>
                            <div class="col-md-6">
                                <label>Level Akun</label>
                                <select name="level" class="form-control">
                                    <option value="{{ $pegawai->level }}">Pilih Level Akun</option>
                                    <option value="pegawai">Pegawai</option>
                                    <option value="kepala">Kepala</option>
                                    <option value="kasubbag">Kasubbag</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-success float-right">Simpan</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
