@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Surah</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Surah</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-plus"></i> Tambah Surah</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('matpel.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" id="kode" name="kode" placeholder="Masukkan nomor Kode Surah" class="form-control" required autocomplete="off" pattern="[0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Surah" class="form-control" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" id="kkm" name="kkm" placeholder="Masukkan KKM" class="form-control" required autocomplete="off" max="100" min="0">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="kelompok" id="kelompok" required>
                                                <option selected disabled value="">Pilih Kelompok</option>
                                                <option value="Kelompok A ( Umum )">Kelompok A ( Umum )</option>
                                                <option value="Kelompok B ( Umum )">Kelompok B ( Umum )</option>
                                                <option value="Kelompok C ( Peminatan )">Kelompok C ( Peminatan )</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                            </div>
                            </form>

                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Surah</th>
                                    <th>Nama Surah</th>
                                    <th>KKM</th>
                                    <th>Kelompok</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matpel as $mp)
                                <tr>
                                    <td>{{($matpel->currentPage() - 1) * $matpel->perPage() + $loop->iteration}}</td>
                                    <td>{{$mp->kode}}</td>
                                    <td>{{$mp->nama}}</td>
                                    <td>{{$mp->kkm}}</td>
                                    <td>{{$mp->kelompok}}</td>
                                    <td class="d-flex justify-content-left"><a href="" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#ubah_siswa{{$mp->kode}}"><i class="fa-solid fa-pen to-square mr-1"></i>Ubah</a>
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_siswa{{$mp->kode}}"><i class="fa-solid fa-trash to-square mr-1"></i>Hapus</a>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach ($matpel as $mp)
                                <div class="modal fade" id="hapus_siswa{{$mp->kode}}" tabindex="-1" role="dialog" aria-labelledby="hapus-siswa" aria-hidden="true">
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
                                                <form action="{{url('admin/matpel', $mp->kode)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="ubah_siswa{{$mp->kode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Surah</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('admin/matpel')}}/{{$mp->kode}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" id="kode" name="kode" placeholder="Masukkan nomor Kode Surah" class="form-control" pattern="[0-9]+" required autocomplete="off" value="{{$mp->kode}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama matpel" class="form-control" required autocomplete="off" value="{{$mp->nama}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="number" id="kkm" name="kkm" placeholder="Masukkan nilai KKM" class="form-control" max="100" min="0" required autocomplete="off" value="{{$mp->kkm}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control select2" style="width: 100%" name="kelompok" id="kelompok" required>
                                                            <option selected disabled value="">Pilih Kelompok</option>
                                                            <option @if ($mp->kelompok == "Kelompok A ( Umum )") @selected(true) @endif value="Kelompok A ( Umum )">Kelompok A ( Umum )</option>
                                                            <option @if ($mp->kelompok == "Kelompok B ( Umum )") @selected(true) @endif value="Kelompok B ( Umum )">Kelompok B ( Umum )</option>
                                                            <option @if ($mp->kelompok == "Kelompok C ( Peminatan )") @selected(true) @endif value="Kelompok C ( Peminatan )">Kelompok C ( Peminatan )</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <button class="btn btn-warning" type="submit">Ubah</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>


                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">

                    {{$matpel->links()}}

                </div>

            </div>
        </div>
    </div>

    <!-- Content Row -->


</div>
<!-- /.container-fluid -->

@endsection