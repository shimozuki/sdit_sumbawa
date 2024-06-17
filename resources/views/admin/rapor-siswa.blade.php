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
                        <p><Strong>A. Hasil Evaluasi Tahsin :</Strong></p>
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Uraian</th>
                                    <th>Nilai</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data_nilaitahsin as $dn)
                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->tahsin->nama}}</td>
                                    <td>{{$dn->nilai}}</td>
                                    <td>{{$dn->predikat}}</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <p><Strong>B. Hasil Evaluasi Tahfiz :</Strong></p>
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Surah</th>
                                    <th>KKM</th>
                                    <th>Nilai</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data_nilai as $dn)

                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->matpel->nama}}</td>
                                    <td>{{$dn->matpel->kkm}}</td>
                                    <td>{{$dn->nilai}}</td>
                                    <td>{{$dn->predikat}}</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <p><Strong>C. Peforma :</Strong></p>
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Penilaian</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data_peforma as $dn)

                            <tbody>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$dn->peforma->nama}}</td>
                                    <td>{{$dn->predikat}}</td>
                                </tr>
                            </tbody>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="justify-content-left">
                        <table id="datatablesSimple" class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="align-middle">KKM</th>
                                    <th>Keterangan Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="4" class="align-middle">77</td>
                                    <td>90-95 = A</td>
                                </tr>
                                <tr>
                                    <td>80-89 = B</td>
                                </tr>
                                <tr>
                                    <td>70-79 = C</td>
                                </tr>
                                <tr>
                                    <td>60-69 = D</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <p><Strong>D. Kesimpulan :</Strong></p>
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tahsin</th>
                                    <th>Tahfiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$ket_Tahsin->ket}}</td>
                                    <td class="text-center">{{$ket_tahfiz->ket}}</td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th class="text-center">Pembimbing: {{ Auth::user()->username }}</th>
                                    <th class="text-center">Pembimbing: {{ Auth::user()->username }}</th>
                                </tr>
                            </thead>
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