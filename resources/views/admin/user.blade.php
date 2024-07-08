@extends('layouts.app')

@section('title', 'User Management')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Guru Management</h1>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Tambah Guru</a>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table id="datatablesSimple" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_siswa as $sw)
                                <tr>
                                    <td>{{ (($data_siswa->currentPage() - 1) * $data_siswa->perPage() + $loop->iteration) }}</td>
                                    <td>{{ $sw->username }}</td>
                                    <td>{{ $sw->username }}</td>
                                    <td class="d-flex justify-content-left">
                                        <a href="#" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#editUserModal-{{ $sw->id }}"><i class="fa-solid fa-pen-to-square mr-1"></i>Ubah</a>
                                        <form action="{{ route('users.destroy', $sw->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash mr-1"></i>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $data_siswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modals -->
@foreach ($data_siswa as $sw)
<div class="modal fade" id="editUserModal-{{ $sw->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel-{{ $sw->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel-{{ $sw->id }}">Ubah Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', $sw->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username-{{ $sw->id }}">Username</label>
                        <input type="text" name="username" class="form-control" id="username-{{ $sw->id }}" value="{{ $sw->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password-{{ $sw->id }}">Password</label>
                        <input type="password" name="password" class="form-control" id="password-{{ $sw->id }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
