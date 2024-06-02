@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa</h1>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Rapor Siswa</h6>
                </div>

                <div class="card-body">
                    <table style="width: 100%">
                        <tbody>
                            <td style="width: 15%">Nama Sekolah</td>
                            <td style="width: 63%">: SMP IT CENDEKIA SUMBAWA</td>
                            <td>Kelas</td>
                            <td>: {{ $kelas->nama_kelas }}</td>
                        </tbody>
                        <tbody>
                            <td>Alamat</td>
                            <td>: Karang Padak Labuhan Sumbawa</td>
                            <td>Semester</td>
                            <td>: 2 (Dua)</td>
                        </tbody>
                        <tbody>
                            <td>Nama Peserta Didik</td>
                            <td>: {{$data_siswa->nama}}</td>
                            <td>Tahun Pelajaran</td>
                            <td>: {{ $years }}/{{ $nextyears }}</td>
                        </tbody>
                        <tbody>
                            <td>Nomor Induk/NISN</td>
                            <td>: {{$data_siswa->nisn}}</td>

                        </tbody>
                    </table>

                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Surah</th>
                                    <th>KKM</th>
                                    <th>Nilai</th>
                                    <th>Predikat</th>
                                    <th>Deskripsi</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7">
                                        Kelompok A ( Umum )
                                    </td>
                                </tr>
                            </tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data_nilai as $dn)
                            @if ($dn->matpel->kelompok == 'Kelompok A ( Umum )')
                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->matpel->nama}}</td>
                                    <td>{{$dn->matpel->kkm}}</td>
                                    <td>{{$dn->nilai}}</td>
                                    <td>{{$dn->predikat}}</td>
                                    <td>{{$dn->ket}}</td>
                                    <td>@if ($dn->nilai >= $dn->matpel->kkm)
                                        Terpenuhi
                                        @else
                                        Tidak Terpenuhi
                                        @endif</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endif
                            @endforeach
                            <!-- <tbody>
                                <tr>
                                    <td colspan="7">
                                        Kelompok B ( Umum )
                                    </td>
                                </tr>
                            </tbody> -->
                            <!-- @foreach ($data_nilai as $dn)
                            @if ($dn->matpel->kelompok == 'Kelompok B ( Umum )')
                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->matpel->nama}}</td>
                                    <td>{{$dn->matpel->kkm}}</td>
                                    <td>{{$dn->nilai}}</td>
                                    <td>{{$dn->predikat}}</td>
                                    <td>{{$dn->ket}}</td>
                                    <td>@if ($dn->nilai >= $dn->matpel->kkm)
                                        Terpenuhi
                                        @else
                                        Tidak Terpenuhi
                                        @endif</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endif


                            @endforeach -->
                            <!-- <tbody>
                                <tr>
                                    <td colspan="7">
                                        Kelompok C ( Peminatan )
                                    </td>
                                </tr>
                            </tbody>
                            @foreach ($data_nilai as $dn)
                            @if ($dn->matpel->kelompok == 'Kelompok C ( Peminatan )')
                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->matpel->nama}}</td>
                                    <td>{{$dn->matpel->kkm}}</td>
                                    <td>{{$dn->nilai}}</td>
                                    <td>{{$dn->predikat}}</td>
                                    <td>{{$dn->ket}}</td>
                                    <td>@if ($dn->nilai >= $dn->matpel->kkm)
                                        Terpenuhi
                                        @else
                                        Tidak Terpenuhi
                                        @endif</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endif


                            @endforeach -->


                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center" style="width: 100%;">
                    <div class="justify-content-left" style="width: 92%;">
                        <p>Tabel interval predikat berdasarkan KKM</p>
                        <table id="datatablesSimple" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle">KKM</th>
                                    <th colspan="5">Predikat</th>

                                </tr>
                                <tr>

                                    <th>D</th>
                                    <th>C</th>
                                    <th>B</th>
                                    <th>A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>77</th>
                                    <th>Nilai < 77</th>
                                    <th>Nilai <= Nilai < 86</th>
                                    <th>85 <= Nilai < 93</th>
                                    <th>Nilai >= 93</th>

                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->

    <!-- Content Row -->


</div>
<!-- /.container-fluid -->
@endsection