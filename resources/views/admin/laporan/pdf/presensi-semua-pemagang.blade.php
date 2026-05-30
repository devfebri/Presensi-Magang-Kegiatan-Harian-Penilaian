<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $title . '.pdf' }}</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #222;
            padding: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 16px;
        }

        .header-table td {
            vertical-align: middle;
            padding: 4px 8px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            line-height: 1.6;
        }

        .presensi-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .presensi-table th {
            background-color: #f28b82;
            font-weight: bold;
            font-size: 11px;
            padding: 6px;
            border: 1px solid #333;
            text-align: center;
        }

        .presensi-table td {
            font-size: 11px;
            padding: 5px;
            border: 1px solid #333;
            text-align: center;
        }

        .pengesahan-table {
            width: 100%;
            margin-top: 30px;
        }

        .pengesahan-table .tempat td {
            text-align: right;
            padding-bottom: 8px;
        }

        .pengesahan-table .atasan td {
            text-align: center;
            vertical-align: bottom;
            height: 100px;
            padding-top: 8px;
        }

        hr {
            border: none;
            border-top: 2px solid #333;
            margin: 12px 0;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <table class="header-table">
        <tr>
            <td style="width: 80px;">
                <img src="{{ public_path('img/favicon.png') }}" alt="logo" width="70" height="70" />
            </td>
            <td>
                <span class="title">
                    {{ strtoupper($title) }}<br>
                    PERIODE {{ strtoupper(\Carbon\Carbon::make($bulan)->format('F')) }} TAHUN {{ \Carbon\Carbon::make($bulan)->format('Y') }}<br>
                    KANTOR WILAYAH KEMENTERIAN HUKUM PROVINSI JAMBI
                </span>
            </td>
        </tr>
    </table>
    <hr>

    {{-- Tabel Rekap Semua Pemagang --}}
    <table class="presensi-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama Pemagang</th>
                <th>Jabatan</th>
                <th>Instansi</th>
                <th>Jml. Kehadiran</th>
                <th>Jml. Terlambat</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatPresensi as $value => $item)
                <tr>
                    <td>{{ $value + 1 }}.</td>
                    <td>{{ $item->nik }}</td>
                    <td style="text-align: left;">{{ $item->nama_pemagang }}</td>
                    <td>{{ $item->jabatan_pemagang ?? '-' }}</td>
                    <td style="text-align: left;">{{ $item->nama_instansi }}</td>
                    <td>{{ $item->total_kehadiran }} hari</td>
                    <td>{{ $item->total_terlambat ?? 0 }} kali</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding: 12px;">
                        Tidak ada data presensi pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pengesahan --}}
    <table class="pengesahan-table">
        <tr class="tempat">
            <td colspan="2">
                Jambi, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
            </td>
        </tr>
        <tr class="atasan">
            <td>
                <br><br><br>
                <u>___________________________</u><br>
                <b>Pembimbing / HRD</b>
            </td>
            <td>
                <br><br><br>
                <u>___________________________</u><br>
                <b>Kepala Kantor</b>
            </td>
        </tr>
    </table>

</body>

</html>
