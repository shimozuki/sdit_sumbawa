<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nilai Siswa</h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Nilai Siswa</h6>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <td>Nama Surah</td>
                            <td>: {{ $data_matpel->nama }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>KKM</td>
                            <td>: {{ $data_matpel->kkm }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive mt-3">
                    <table id="datatableSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Nilai</th>
                                <th>Predikat</th>
                                <th>Deskripsi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data_nilai as $dn)
                            <tbody>
                                <tr>
                                    <td>{{ ($data_nilai->currentPage() - 1) * $data_nilai->perPage() + $loop->iteration }}</td>
                                    <td>{{ $dn->siswa->nama }}</td>
                                    <td>{{ $dn->nilai }}</td>
                                    <td>{{ $dn->predikat }}</td>
                                    <td>{{ $dn->ket }}</td>
                                    <td>
                                        @if ($dn->nilai >= $data_matpel->kkm)
                                            Terpenuhi
                                        @else
                                            Tidak Terpenuhi
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah_siswa{{ $dn->siswa_nisn }}">Ubah</a>
                                        <a href="" class="btn btn-danger btn-sm mt-1" data-toggle="modal" data-target="#hapus_siswa{{ $dn->siswa->nisn }}">Hapus</a>
                                    </td>
                                </tr>
                            </tbody>
                            @php
                                $i++;
                            @endphp
                        @endforeach

                        @foreach ($data_nilai as $dn)
                            <div class="modal fade" id="ubah_siswa{{ $dn->siswa_nisn }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Nilai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('admin/nilai-siswa') }}/{{ $dn->kode_matpel }}/{{ $dn->nisn_siswa }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="number" id="nilai" name="nilai" placeholder="Masukkan Nilai" class="form-control" max="100" min="100" required autocomplete="off" value="{{ $dn->nilai }}">
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" id="ket" name="ket" placeholder="Masukkan Keterangan">{{ $dn->ket }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                <input type="hidden" name="_method" value="PUT">
                                                <button class="btn btn-warning" type="submit">Ubah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="hapus_siswa{{ $dn->siswa->nisn }}" tabindex="-1" role="dialog" aria-labelledby="hapus-siswa" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus data?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus data?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            <form action="{{ url('admin/rapor-detail') }}/{{ $dn->kode_matpel }}/{{ $dn->nisn_siswa }}" method="GET">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method">
                                                <button class="btn btn-danger" type="submit">hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $data_nilai->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
