<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji {{ $gaji->karyawan->nama }} Periode {{ $gaji->periode }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 0;
            font-size: 18px;
            text-transform: uppercase;
        }


        .company-info {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .details,
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .details td {
            padding: 4px 8px;
        }

        .details tr td:nth-child(1) {
            width: 150px;
        }

        .salary-table th,
        .salary-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }

        .salary-table th {
            background-color: #f0f0f0;
        }

        .salary-table tr td:nth-last-child(1) {
            text-align: end;
        }

        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <h2 class="header">SLIP GAJI KARYAWAN</h2>

    <div class="company-info">
        PT SOEGITOS MAJU JAYA<br>
        Jln. Sayuti Melik, No. 15
    </div>

    <table class="details">
        <tr>
            <td><strong>Nama</strong></td>
            <td>: {{ $gaji->karyawan->nama }}</td>
        </tr>
        <tr>
            <td><strong>Jabatan</strong></td>
            <td>: {{ $gaji->karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td><strong>Periode Gaji</strong></td>
            <td>: {{ Carbon\Carbon::create()->month($gaji->periode_bulan)->translatedFormat('F') . " {$gaji->periode_tahun}" }}
            </td>
        </tr>
        <tr>
            <td><strong>Jumlah Hari Kerja</strong></td>
            <td>: {{ $gaji->hari_kerja }} Hari</td>
        </tr>
    </table>

    <table class="salary-table">
        <thead>
            <tr>
                <th style="text-align: center;">Komponen</th>
                <th style="text-align: center;">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Gaji Pokok</td>
                <td>{{ number_format($gaji->gaji_pokok) }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td>{{ number_format($gaji->tunjangan) }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td>{{ number_format(0-$gaji->potongan) }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Diterima</td>
                <td>{{ number_format($gaji->total_gaji) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada 05-07-2025 10:00<br>
        Slip ini dihasilkan secara otomatis oleh sistem
    </div>

</body>

</html>