@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tahsin</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Tahsin</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-plus"></i> Tambah Tahsin</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Tahsin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('tahsin.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" id="kode" name="kode_tahsin" placeholder="Masukkan nomor Kode Tahsin" class="form-control" required autocomplete="off" pattern="[0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Tahsin" class="form-control" required autocomplete="off">
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
                                    <th>Kode Tahsin</th>
                                    <th>Nama Tahsin</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahsin as $row)
                                <tr>
                                    <td>{{($tahsin->currentPage() - 1) * $tahsin->perPage() + $loop->iteration}}</td>
                                    <td>{{$row->kode_tahsin}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td class="d-flex justify-content-left">
                                        <a href="" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#ubah_tahsin{{$row->kode_tahsin}}"><i class="fa-solid fa-pen to-square mr-1"></i>Ubah</a>
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_tahsin{{$row->kode_tahsin}}"><i class="fa-solid fa-trash to-square mr-1"></i>Hapus</a>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach ($tahsin as $mp)
                                <!-- Modal Hapus -->
                                <div class="modal fade" id="hapus_tahsin{{$mp->kode_tahsin}}" tabindex="-1" role="dialog" aria-labelledby="hapus-tahsin" aria-hidden="true">
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
                                                <form action="{{ route('tahsin.destroy', $mp->kode_tahsin) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Ubah -->
                                <div class="modal fade" id="ubah_tahsin{{$mp->kode_tahsin}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Tahsin</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('tahsin.update', $mp->kode_tahsin) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" id="kode" name="kode" placeholder="Masukkan nomor Kode Tahsin" class="form-control" pattern="[0-9]+" required autocomplete="off" value="{{$mp->kode_tahsin}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Tahsin" class="form-control" required autocomplete="off" value="{{$mp->nama}}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button class="btn btn-warning" type="submit">Ubah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
                <div class="card-footer">

                    {{$tahsin->links()}}

                </div>

            </div>
        </div>
    </div>

    <!-- Content Row -->


</div>
<!-- /.container-fluid -->
@endsection