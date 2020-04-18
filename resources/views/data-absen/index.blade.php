@extends('layouts/main')
@section('title_page','Rekap Data Absen')
@section('judul_halaman','Data Absen')

@section('konten')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        Data Absen
                    </h4>
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


