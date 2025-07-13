<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi PKL</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #222;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        .subtitle {
            text-align: center;
            font-size: 16px;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 20mm;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            table {
                page-break-inside: avoid;
            }

            img {
                max-width: 100%;
                height: auto;
            }

        }
    </style>
    <script>
        window.print()
    </script>
</head>

<body>

    <h3 colspan="5" class="title">Rekap Absensi PKL</h3>

    <h3 colspan="5" class="subtitle">SMK ISLAM 1 DURENAN</h3>

    <table>
        <tr>
            <th>NO</th>
            <th>NAMA</th>
            <th>TAANGGAL</th>
            <th>PRESENSI</th>
            <th>BUKTI</th>
        </tr>
        @forelse ($presensiPKLModel as $item)
            <tr
                style="
                    @if ($item->presensi == 'Hadir') background-color: #d4edda;
                    @elseif($item->presensi == 'Sakit') background-color: #fff3cd;
                    @elseif($item->presensi == 'Alfa') background-color: #f8d7da;
                    @elseif($item->presensi == 'Izin') background-color: #cce5ff; @endif
                ">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->siswa->name }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>
                    {{ $item->presensi }}
                </td>
                <td><img src="{{ asset('storage/buktiPresensiPKL') . '/' . $item->bukti }}" alt="" srcset=""
                        width="250">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Data Kosong</td>
            </tr>
        @endforelse
    </table>
</body>

</html>
