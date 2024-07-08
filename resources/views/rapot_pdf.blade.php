<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header,
        .footer {
            text-align: center;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .header img {
            width: 100px;
            height: auto;
        }

        .header .text {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature div {
            text-align: center;
        }

        .kop {
            text-align: left;
        }

        .kop .kop-title {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('img/SM.png')}}" alt="Logo">
            <div class="text">
                <h1>LAPORAN PENILAIAN TAHSIN DAN TAHFIDZ AL-QUR'AN</h1>
                <p>PENILAIAN TENGAH SEMESTER GENAP<br>TAHUN PELAJARAN 2023-2024<br>SMP IT SAMAWA CENDEKIA SUMBAWA</p>
            </div>
        </div>

        <div class="kop">
            <table>
                <tr>
                    <td class="kop-title">NAMA SISWA:</td>
                    <td>{{$data_siswa->nama}}</td>
                </tr>
                <tr>
                    <td class="kop-title">NIS / NISN:</td>
                    <td>{{$data_siswa->nisn}}</td>
                </tr>
                <tr>
                    <td class="kop-title">KELAS:</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th colspan="3">A. HASIL EVALUASI TAHSIN</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>URAIAN</th>
                    <th>ANGKA</th>
                    <th>HURUF</th>
                </tr>
            </thead>
            @php
            $i=1;
            @endphp
            @foreach ($data_nilaitahsin as $dn)
            <tbody>
                <tr>
                <tr>
                    <td>{{$i}}</td>
                    @if ($dn->tahsin->nama == "Bacaan Terakhir")
                    <td>{{ $dn->tahsin->nama }}</td>
                    <td colspan="2" class="text-center">{{$dn->nilai}}</td>
                    @else
                    <td>{{ $dn->tahsin->nama }}</td>
                    <td>{{$dn->nilai}}</td>
                    <td>{{$dn->predikat}}</td>
                    @endif
                </tr>
                </tr>
            </tbody>
            @php
            $i++;
            @endphp
            @endforeach
        </table>

        <table>
            <thead>
                <tr>
                    <th colspan="4">B. HASIL EVALUASI TAHFIDZ</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>NAMA SURAT</th>
                    <th>ANGKA</th>
                    <th>HURUF</th>
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

        <table>
            <thead>
                <tr>
                    <th colspan="3">C. PERFORMA</th>
                </tr>
                <tr>
                    <th>NO</th>
                    <th>PENILAIAN</th>
                    <th>NILAI</th>
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

        <table>
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

        <div class="footer">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">D. KESIMPULAN</th>
                    </tr>
                    <tr>
                        <th>TAHSIN</th>
                        <th>TAHFIZ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td class="text-center">{{$ket_Tahsin->ket}}</td>
                    <td class="text-center">{{$ket_tahfiz->ket}}</td>
                    </tr>
                    <tr>
                        <th>Pembimbing : Nama Guru S.pd</th>
                        <th>Pembimbing : Guru S.pd</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="signature">
            <div>
                <p>Mengetahui,</p>
                <p>Koordinator Al-Qur'an</p>
                <br><br>
                <p>(Satria Equis Hamdani, S.Pd)</p>
            </div>
            <div>
                <p>Sumbawa, 18 Maret 2024</p>
                <p>Kepala SMP IT Samawa Cendekia Sumbawa</p>
                <br><br>
                <p>(Amang Ilham, S.E.I)</p>
            </div>
        </div>


    </div>
</body>

</html>