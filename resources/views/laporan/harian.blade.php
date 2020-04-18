@php
    use Illuminate\Support\Facades\DB;
@endphp
@extends('layouts/main')
@section('title_page','Rekap Data Absen')
@section('judul_halaman','Data Absen')

@section('konten')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-12">

                        <form action="{{action('LaporanController@harian')}}" method="POST">
                            <div class="form-group row">

                                <div class="col-md-4">
                                    <input type="date" class="form-control text-center  " name="tgl"
                                           value="{{date('Y-m-d')}}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success form-control">Lihat</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h6>DAFTAR HADIR</h6>
                            <h6>APARATUR SIPIL NEGARA (ASN)</h6>
                            <h6>UNIT PELAKSANA TEKNIS PENGELOLAAN PENDAPATAN PANAM</h6>
                            <h6>BADAN PENDAPATAN DAERAH PROVINSI RIAU</h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <span>Tanggal : {{ date_indo($tgl) }}</span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table-bordered" style="font-size: 12pt;width: 100%;">

                                <tr class="text-center">
                                    <th rowspan="2">NO</th>
                                    <th rowspan="2">NAMA , NIP</th>
                                    <th rowspan="2">JABATAN</th>
                                    <th colspan="3">PARAF</th>
                                    <th rowspan="2">KETERANGAN</th>
                                </tr>
                                <tr class="text-center">
                                    <th>APEL</th>
                                    <th>PAGI</th>
                                    <th>SIANG</th>
                                </tr>
                                @foreach($pegawai as $item)
                                    @php
                                    $apel = DB::table('data_absen')
                                            ->where('absen_kategori','apel')
                                            ->where('absen_pegawai',$item->pegawai_id)
                                            ->where('absen_tgl',$tgl)
                                            ->first();
                                    $pagi = DB::table('data_absen')
                                            ->where('absen_kategori','pagi')
                                            ->where('absen_pegawai',$item->pegawai_id)
                                            ->where('absen_tgl',$tgl)
                                            ->first();
                                    $siang = DB::table('data_absen')
                                            ->where('absen_kategori','siang')
                                            ->where('absen_pegawai',$item->pegawai_id)
                                            ->where('absen_tgl',$tgl)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$item->pegawai_nama}}<br>{{$item->pegawai_nip}}</td>
                                        <td class="text-center">{{$item->pegawai_jabatan}}</td>
                                        <td class="text-center">
                                            @if($apel != null)
                                                <i class="fas fa-check"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pagi != null)
                                            <i class="fas fa-check"></i>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($siang != null)
                                                <i class="fas fa-check"></i>
                                            @endif
                                        </td>
                                        <td class="text-center"> </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-end">
                        <div class="col-md-4 text-center">
                            <p>Pekanbaru, {{ date_indo(date('Y-m-d')) }}</p>
                            <p>KEPALA UNIT PELAKSANA TEKNIS PENGELOLAAN PENDAPATAN PANAM</p>
                            <p>BADAN PENDAPATAN DAERAH PROVINSI RIAU</p>
                            <br><br><br><br>
                            <p>{{ $kepala->pegawai_nama }}</p>
                        </div>
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


