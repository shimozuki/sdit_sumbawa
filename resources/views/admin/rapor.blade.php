@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rapor</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input tahsin</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1"><i class="fa-solid fa-plus"></i> Tambah Nilai</button>

                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai Tahsin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('nilaiTahsin.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="nisn" id="nisn" required>
                                                <option selected disabled value="">Pilih Siswa</option>
                                                @foreach ($data_siswa as $item)
                                                @if ($item->nama == 'admin' )
                                                @continue
                                                @endif
                                                <option value="{{ $item->nisn}}">{{$item->nisn}} - {{ $item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="kode_tahsin" id="kode_tahsin" required>
                                                <option selected disabled value="">Pilih Tahsin</option>
                                                @foreach ($data_tahsin as $item)
                                                @php
                                                $isBacaanTerakhir = ($item->kode_tahsin == '1730' || $item->nama == 'Bacaan Terakhir');
                                                @endphp
                                                <option value="{{ $item->kode_tahsin }}" data-bacaan="{{ $isBacaanTerakhir ? 'true' : 'false' }}">
                                                    {{ $item->kode_tahsin }} - {{ $item->nama }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" id="nilai" name="nilai" placeholder="Masukkan Nilai" class="form-control" required autocomplete="off" max="100" min="0">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="ket" name="ket" placeholder="Masukkan Keterangan"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input Tahfiz</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-plus"></i> Tambah Nilai</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rapor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('rapor.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="nisn" id="nisnT" required>
                                                <option selected disabled value="">Pilih Siswa</option>
                                                @foreach ($data_siswa as $item)
                                                @if ($item->nama == 'admin' )
                                                @continue
                                                @endif
                                                <option value="{{ $item->nisn}}">{{$item->nisn}} - {{ $item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="kode_matpel" id="kode_matpel" required>
                                                <option selected disabled value="">Pilih Surah</option>
                                                @foreach ($data_matpel as $item)
                                                <option value="{{ $item->kode}}">{{$item->kode}} - {{ $item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" id="nilai" name="nilai" placeholder="Masukkan Nilai" class="form-control" required autocomplete="off" max="100" min="0">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan Kesimpulan"></textarea>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input Peforma</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2"><i class="fa-solid fa-plus"></i> Tambah Nilai</button>

                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nilai Peforma</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{route('nilaiPeforma.store')}}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="nisn" id="nisn" required>
                                                <option selected disabled value="">Pilih Siswa</option>
                                                @foreach ($data_siswa as $item)
                                                @if ($item->nama == 'admin' )
                                                @continue
                                                @endif
                                                <option value="{{ $item->nisn}}">{{$item->nisn}} - {{ $item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select2" style="width: 100%" name="kode_peforma" id="kode_peforma" required>
                                                <option selected disabled value="">Pilih Peforma</option>
                                                @foreach ($data_peforma as $item)
                                                <option value="{{ $item->kode_peforma}}">{{$item->kode_peforma}} - {{ $item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select id="predik" name="predik" class="form-control" required>
                                                <option value="Sangat Baik">Sangat Baik</option>
                                                <option value="Baik">Baik</option>
                                                <option value="Cukup">Cukup</option>
                                                <option value="Kurang">Kurang</option>
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
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Berdasarkan Siswa</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('rapor-detail.index')}}">
                        <div class="form-group">
                            <select class="form-control select2 mx-auto" style="width: 100%" name="id" id="id">
                                <option selected disabled value="">Pilih Siswa</option>
                                @foreach ($data_siswa as $item)
                                @if ($item->nama == 'admin' )
                                @continue
                                @endif
                                <option value="{{ $item->nisn}}">{{$item->nisn}} - {{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">
                            Tampilkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Berdasarkan Surah</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('nilai-siswa.index')}}">
                        <div class="form-group">
                            <select class="form-control select2 mx-auto" style="width: 100%" name="kode" id="kode">
                                <option selected disabled value="">Pilih Surah</option>
                                @foreach ($data_matpel as $item)
                                <option value="{{ $item->kode}}">{{$item->kode}} - {{ $item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">
                            Tampilkan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->


</div>
<!-- /.container-fluid -->
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#nisn').change(function() {
            var nisn = $(this).val();
            if (nisn) {
                $.ajax({
                    url: `{{ route('check-keterangan', ['nisn' => ':nisn']) }}`.replace(':nisn', nisn),
                    type: 'GET',
                    success: function(response) {
                        if (response.ket) {
                            $('#ket').val(response.ket).prop('readonly', true);
                        } else {
                            $('#ket').val('').prop('readonly', false);
                        }
                    }
                });
            } else {
                $('#ket').val('').prop('readonly', false);
            }
        });

      
    });
</script>
<script>
    $(document).ready(function() {
        $('#nisnT').change(function() {
            var nisn = $(this).val();
            if (nisn) {
                $.ajax({
                    url: `{{ route('check-nilai', ['nisn' => ':nisn']) }}`.replace(':nisn', nisn),
                    type: 'GET',
                    success: function(response) {
                        if (response.keterangan) {
                            $('#keterangan').val(response.keterangan).prop('readonly', true);
                        } else {
                            $('#keterangan').val('').prop('readonly', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            } else {
                $('#keterangan').val('').prop('readonly', false);
            }
        });
    });
</script>

<script>
    // JavaScript to conditionally change input type based on select option
    document.addEventListener('DOMContentLoaded', function() {
        const kodeTahsinSelect = document.getElementById('kode_tahsin');
        const nilaiInput = document.getElementById('nilai');
        const keteranganField = document.getElementById('keteranganField');

        kodeTahsinSelect.addEventListener('change', function() {
            const selectedOption = kodeTahsinSelect.options[kodeTahsinSelect.selectedIndex];
            const isBacaanTerakhir = selectedOption.getAttribute('data-bacaan') === 'true';

            if (isBacaanTerakhir) {
                nilaiInput.setAttribute('type', 'text');
                nilaiInput.setAttribute('placeholder', 'Masukkan Bacaan Terakhir');
                keteranganField.style.display = 'none';
            } else {
                nilaiInput.setAttribute('type', 'number');
                nilaiInput.setAttribute('placeholder', 'Masukkan Nilai');
                keteranganField.style.display = 'block';
            }
        });
    });
</script>