@extends('layouts/main')

@section('title_page','Data Pegawai')
@section('judul_halaman','Pegawai')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data Pegawai
                    </h4>
                    <button class="btn btn-primary float-right btn-sm"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Data Pegawai</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;font-size: 13px;">
                            <thead>
                            <tr class="text-center">
                                <th class="text-center" width="50">No</th>
                                <th>Nama</th>
                                <th>Nip</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Nomor Hp</th>
                                @if(Auth::user()->level == 'admin')
                                    <th class="text-center"><i class="fa fa-cogs"></i></th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pegawai as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai_nama }}</td>
                                    <td >{{ $item->pegawai_nip }}</td>
                                    <td>{{ $item->pegawai_email }}</td>
                                    <td class="text-center">{{ $item->pegawai_jabatan }}</td>
                                    <td class="text-center">{{ $item->pegawai_hp }}</td>
{{--                                    <td><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $item->Pegawai_no }}" alt=""></td>--}}
                                    @if(Auth::user()->level == 'admin')
                                        <td class="text-center">
                                            <a href="{{ route('pegawai.edit',[$item->pegawai_id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a> |
                                            <a href="{{ url('pegawai/delete',[$item->pegawai_id]) }}" onclick="confirm('Tekan Ok untuk melanjutkan aksi ini !')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


<!-- Modal with form -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ action('PegawaiController@store')  }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Masukkan nama pegawai">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required placeholder="Masukkan email pegawai">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" placeholder="Masukkan Nip">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jabatan">
                    </div>
                    <div class="form-group">
                        <label>Nomor Hp</label>
                        <input type="text" class="form-control" name="hp" placeholder="Masukkan Nomor Handphone">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Mulai Kerja</label>
                            <input type="date" class="form-control" name="mulai_kerja" >
                        </div>
                        <div class="col-md-6">
                            <label>Level Akun</label>
                            <select name="level" class="form-control">
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




