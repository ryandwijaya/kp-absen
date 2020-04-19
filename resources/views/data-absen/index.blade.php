@extends('layouts/main')
@section('title_page','Rekap Data Absen')
@section('judul_halaman','Data Absen')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">


                            <button style="position: absolute;right: 2%;top:2%;" data-toggle="modal" data-target="#exampleModal" class="btn float-right btn-primary btn-sm"><i class="fas fa-plus"></i> Izin,Cuti,Dinas,Sakit</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr class="text-center">
                                <th class="text-center" width="50">No</th>
                                <th>Nama</th>
                                <th>Nip</th>
                                <th>Kategori Absen</th>
                                <th>Absen Tgl</th>
                                <th>Jam Absen</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($absen as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai_nama }}</td>
                                    <td>{{ $item->pegawai_nip }}</td>
                                    <td>{{ $item->absen_kategori }}</td>
                                    <td>{{ date_indo($item->absen_tgl) }}</td>
                                    <td>{{ $item->absen_jam }}</td>
                                    <td>
                                        @if($item->absen_status == 'ontime')
                                        <span class="badge badge-success">{{ $item->absen_status }}</span>
                                            @elseif($item->absen_status == 'telat')
                                        <span class="badge badge-warning">{{ $item->absen_status }}</span>
                                            @else
                                        <span class="badge badge-danger">{{ $item->absen_status }}</span>
                                        @endif

                                    </td>
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
                <h5 class="modal-title" id="formModal">Tambah Absen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('absen/izin')  }}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <label>Pilih Pegawai</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <select name="pegawai" class="form-control select2" style="width: 100%;">
                                <option disabled selected>- Pilih Pegawai -</option>
                                @foreach($pegawai as $pgw)
                                    <option value="{{$pgw->pegawai_id}}">{{$pgw->pegawai_nama}} - {{$pgw->pegawai_nip}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label>Pilih Status</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <select name="status" class="form-control" style="width: 100%;">
                                <option disabled selected>- Pilih Status -</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                                <option value="cuti">Cuti</option>
                                <option value="dinas">Dinas</option>
                            </select>
                        </div>
                    </div>

                    <button class=" mt-3 btn btn-success float-right">Simpan</button>

                </form>
            </div>
        </div>
    </div>
</div>



@php
    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun;
    }

    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
@endphp


