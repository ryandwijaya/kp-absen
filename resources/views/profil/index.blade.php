@extends('layouts/main')
@section('judul_halaman','Profil')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-print-none">
                    <h4 class="card-title float-left">
                        Profil Pegawai
                    </h4>
                    <div class="float-right">
                        <button class="btn btn-info" onclick="window.print()"><i class="fas fa-print"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row p-4 justify-content-center">
                        <div class="col-md-4 p-4 border">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $pegawai->pegawai_nip }}" alt="Error image" width="100%;">
                        </div>
                        <div class="col-md-5 p-4 border">
                            <h4>Kartu Absen</h4>
                            <hr>
                            <table cellpadding="6" style="font-size: 14pt;">
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $pegawai->pegawai_nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>:</td>
                                    <td>{{ $pegawai->pegawai_nip }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>:</td>
                                    <td>{{ $pegawai->pegawai_email }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Hp</th>
                                    <td>:</td>
                                    <td>{{ $pegawai->pegawai_hp }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection






