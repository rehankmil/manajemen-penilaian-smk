<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin-bottom: 5px;
        }
        .header p {
            margin: 2px 0;
        }
        .siswa-info {
            margin-bottom: 20px;
        }
        .siswa-info table {
            width: 50%;
        }
        .siswa-info td {
            padding: 3px;
        }
        table.nilai {
            width: 100%;
            border-collapse: collapse;
        }
        table.nilai th, table.nilai td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        table.nilai th {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
        }
        .ttd {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN HASIL BELAJAR SISWA</h2>
        <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</p>
    </div>
    
    <div class="siswa-info">
        <table>
            <tr>
                <td width="120">Nama Siswa</td>
                <td width="10">:</td>
                <td>{{ $murid->nama }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $murid->nis }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $murid->kelas->kode ?? '-' }}</td>
            </tr>
            <tr>
                <td>Semester</td>
                <td>:</td>
                <td>{{ $semester }}</td>
            </tr>
        </table>
    </div>
    
    <table class="nilai">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Pelajaran</th>
                <th>Guru</th>
                <th>Nilai</th>
                <th>Predikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilaiList as $index => $nilai)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $nilai->mapel->nama }}</td>
                <td>{{ $nilai->guru->nama }}</td>
                <td>{{ $nilai->nilai }}</td>
                <td>{{ $nilai->predikat }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center">Tidak ada data nilai yang tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>{{ date('d F Y') }}</p>
        <p>Kepala Sekolah,</p>
        <div class="ttd">
            <p>__________________</p>
            <p>NIP.</p>
        </div>
    </div>
</body>
</html>