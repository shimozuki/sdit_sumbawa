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
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-plus"></i> Tambah Siswa</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('siswa.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" id="nisn" name="nisn" placeholder="Masukkan nomor NISN" class="form-control" maxlength="10" required autocomplete="off" pattern="[0-9]+">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama" class="form-control" required autocomplete="off" pattern="[a-zA-Z' ]+">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="nama" name="nama_wali" placeholder="Masukkan nama Wali" class="form-control" required autocomplete="off" pattern="[a-zA-Z' ]+">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" id="username" name="no_tlpn_wali" placeholder="Masukkan no tlpn wali" class="form-control" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" id="kelas" name="kelas_id" required>
                                                <option value="" disabled selected>Pilih Kelas</option>
                                                @foreach ($kelas as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            {{-- <label for="alamat" class="col-form-label" name="alamat" id="alamat">Alamat:</label> --}}
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat"></textarea>
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
                                    <th>NISN</th>
                                    <th>Nama siswa</th>
                                    <th>Nama wali</th>
                                    <th>Nama tlpn wali</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($data_siswa as $sw)
                                @if ($sw->username == 'admin' )
                                @continue
                                @endif
                                <tr>
                                    <td>{{(($data_siswa->currentPage() - 1) * $data_siswa->perPage() + $loop->iteration)-1}}</td>
                                    <td>{{$sw->siswa->nisn}}</td>
                                    <td>{{$sw->siswa->nama}}</td>
                                    <td>{{$sw->siswa->nama_wali}}</td>
                                    <td>{{ $sw->username }}</td>
                                    <td>{{$sw->siswa->alamat}}</td>
                                    <td class="d-flex justify-content-left"><a href="{{ route('send.whatsapp', ['username' => $sw->username]) }}" class="btn btn-success btn-sm mr-1"><i class="fa-solid fa-phone to-square mr-1"></i>kirim</a>
                                        <a href="" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#ubah_siswa{{$sw->siswa->nisn}}"><i class="fa-solid fa-pen to-square mr-1"></i>Ubah</a>
                                        <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_siswa{{$sw->siswa->nisn}}"><i class="fa-solid fa-trash to-square mr-1"></i>Hapus</a>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach ($data_siswa as $sw)
                                <div class="modal fade" id="hapus_siswa{{$sw->siswa->nisn}}" tabindex="-1" role="dialog" aria-labelledby="hapus-siswa" aria-hidden="true">
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
                                                <form action="{{url('admin/siswa', $sw->siswa->nisn)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">hapus</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="ubah_siswa{{$sw->siswa->nisn}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('admin/siswa')}}/{{$sw->siswa->nisn}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" id="nisn" name="nisn" placeholder="Masukkan nomor NISN" class="form-control" maxlength="10" required autocomplete="off" pattern="[0-9]+" value="{{$sw->siswa->nisn}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="username" name="username" placeholder="Masukkan username" class="form-control" required autocomplete="off" value="{{$sw->username}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama" class="form-control" required autocomplete="off" value="{{$sw->siswa->nama}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="nama_wali" name="nama_wali" placeholder="Masukkan nama_wali" class="form-control" required autocomplete="off" value="{{$sw->siswa->nama_wali}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" id="no_tlpn_wali" name="no_tlpn_wali" placeholder="Masukkan no_tlpn_wali" class="form-control" required autocomplete="off" value="{{$sw->username}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control" id="kelas" name="kelas_id" required>
                                                            <option value="" disabled>Pilih Kelas</option>
                                                            @foreach ($kelas as $row)
                                                            <option value="{{ $kelas->kode_kelas }}" @if ($kelas->kode_kelas == $siswa->kelas_id) selected @endif>{{ $kelas->nama_kelas }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        {{-- <label for="alamat" class="col-form-label" name="alamat" id="alamat">Alamat:</label> --}}
                                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat">{{$sw->siswa->alamat}}</textarea>
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
                    <div class="card-footer">
                        {{$data_siswa->links()}}
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