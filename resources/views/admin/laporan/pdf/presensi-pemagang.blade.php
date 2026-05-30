<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>{{ $title . ' ' . $pemagang->nama_lengkap . '.pdf' }}</title>

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

        .identitas-pemagang {
            margin-top: 16px;
            width: auto;
        }

        .identitas-pemagang td {
            padding: 3px 6px;
            vertical-align: top;
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

    {{-- Identitas Pemagang --}}
    <table class="identitas-pemagang">
        <tr>
            <td rowspan="6" style="padding-right: 12px;">
                @if ($pemagang->foto)
                    <img src="{{ public_path('storage/unggah/pemagang/' . $pemagang->foto) }}"
                        alt="foto-pemagang" width="90" height="120" style="border-radius: 4px;" />
                @else
                    <img src="{{ public_path('img/team-2.jpg') }}"
                        alt="foto-pemagang" width="90" height="120" style="border-radius: 4px;" />
                @endif
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $pemagang->nik }}</td>
        </tr>
        <tr>
            <td>Nama Pemagang</td>
            <td>:</td>
            <td>{{ $pemagang->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $pemagang->jabatan ?? '-' }}</td>
        </tr>
        <tr>
            <td>Instansi</td>
            <td>:</td>
            <td>{{ $pemagang->instansi->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Email / Telepon</td>
            <td>:</td>
            <td>{{ $pemagang->email }} / {{ $pemagang->telepon ?? '-' }}</td>
        </tr>
    </table>

    {{-- Tabel Presensi --}}
    <table class="presensi-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto Masuk</th>
                <th>Jam Keluar</th>
                <th>Foto Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatPresensi as $value => $item)
                <tr>
                    <td>{{ $value + 1 }}.</td>
                    <td>{{ \Carbon\Carbon::make($item->tanggal_presensi)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::make($item->jam_masuk)->format('H:i') }}</td>
                    <td>
                        @if ($item->foto_masuk)
                            <img src="{{ public_path('storage/unggah/presensi/' . $item->foto_masuk) }}"
                                alt="foto" width="45" height="45" style="border-radius: 4px;" />
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->jam_keluar)
                            {{ \Carbon\Carbon::make($item->jam_keluar)->format('H:i') }}
                        @else
                            <span>Belum Presensi</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->foto_keluar)
                            <img src="{{ public_path('storage/unggah/presensi/' . $item->foto_keluar) }}"
                                alt="foto" width="45" height="45" style="border-radius: 4px;" />
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->jam_masuk > '08:00:00')
                            @php
                                $masuk   = \Carbon\Carbon::make($item->jam_masuk);
                                $batas   = \Carbon\Carbon::make('08:00:00');
                                $diff    = $batas->diff($masuk);
                                $selisih = $diff->h > 0
                                    ? $diff->format('%h jam %I menit')
                                    : $diff->format('%I menit');
                            @endphp
                            Terlambat {{ $selisih }}
                        @else
                            Tepat Waktu
                        @endif
                    </td>
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
