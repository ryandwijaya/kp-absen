@php
    use Illuminate\Support\Facades\DB;
@endphp
@extends('layouts/main')
@section('title_page','Rekap Data Absen Bulanan')
@section('judul_halaman','Data Absen Bulanan')

@section('konten')
    <style>
        .p{
            font-size: 10pt;
            font-weight: 800;
            display: block;
        }
        @media print {
            .card-body{
                margin-top: -80px;
            }
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header row d-print-none">
                    <div class="col-md-12">

                        <form action="{{action('LaporanController@bulanan')}}" method="POST" class="float-left" style="width: 80%;">
                            @csrf
                            <div class="form-group row">

                                <div class="col-md-4">
                                    <select name="bulan" class="form-control">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="tahun" class="form-control">
                                        @php
                                            $tahunNow = date('Y');
                                            for($i = $tahunNow ; $i >= 2010; $i--){
                                        @endphp
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @php } @endphp
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary form-control">Lihat</button>
                                </div>

                            </div>
                        </form>
                        <button title="Print" class="btn btn-success float-right" onclick="window.print()"><i class="fas fa-print"></i></button>
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
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <span>Waktu : {{ bulan($bulan)  }} {{ $tahun }}</span>
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
                                                ->whereMonth('absen_tgl',$bulan)
                                                ->whereYear('absen_tgl',$tahun)
                                                ->first();
                                        $pagi = DB::table('data_absen')
                                                ->where('absen_kategori','pagi')
                                                ->where('absen_pegawai',$item->pegawai_id)
                                                ->whereMonth('absen_tgl',$bulan)
                                                ->whereYear('absen_tgl',$tahun)
                                                ->first();
                                        $siang = DB::table('data_absen')
                                                ->where('absen_kategori','siang')
                                                ->where('absen_pegawai',$item->pegawai_id)
                                                ->whereMonth('absen_tgl',$bulan)
                                                ->whereYear('absen_tgl',$tahun)
                                                ->first();
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$item->pegawai_nama}}<br>{{$item->pegawai_nip}}</td>
                                        <td class="text-center">{{$item->pegawai_jabatan}}</td>
                                        <td class="text-center">
                                            @if($apel != null)
                                                @if($apel->absen_status == 'ontime' || $apel->absen_status == 'telat')
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    {{$apel->absen_status}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($pagi != null)
                                                @if($pagi->absen_status == 'ontime' || $pagi->absen_status == 'telat')
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    {{$pagi->absen_status}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($siang != null)
                                                @if($siang->absen_status == 'ontime' || $siang->absen_status == 'telat')
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    {{$siang->absen_status}}
                                                @endif
                                            @endif
                                        </td>
                                        <td class="text-center"> </td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>

                    <div class="row mt-5 justify-content-end">
                        <div class="col-md-6 text-center">
                            <span class="p">Pekanbaru, {{ date_indo(date('Y-m-d')) }}</span>
                            <span class="p">KEPALA UNIT PELAKSANA TEKNIS PENGELOLAAN PENDAPATAN PANAM</span>
                            <span class="p">BADAN PENDAPATAN DAERAH PROVINSI RIAU</span>
                            <br><br><br><br>
                            <span class="p">{{ $kepala->pegawai_nama }}</span>
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


