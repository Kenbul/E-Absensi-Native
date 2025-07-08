<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Siswa</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }

        .kop {
            text-align: center;
            border-bottom: 2px solid black;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .kop img {
            float: left;
            width: 70px;
            height: auto;
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
            line-height: 1.4;
        }

        .judul-surat {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
            text-decoration: underline;
        }

        .info {
            margin: 15px 0;
        }

        .info td {
            padding: 4px 8px;
        }

        table.laporan {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.laporan th,
        table.laporan td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd td {
            text-align: right;
            padding-right: 50px;
        }
    </style>
</head>

<body>

    <div class="kop">
        <img src="assets/img/logo.png" alt="logo">
        <h2>BALAI PENDIDIKAN</h2>
        <h3>PONDOK MODERN BAITUSSALAM</h3>
        <p>Jl. Imam Bonjol Lingkungan V Kel. Labuhan Ruku Kec. Talawi Kab. Batu Bara 21254</p>
    </div>

    <div class="judul-surat">LAPORAN ABSENSI SISWA</div>

    <table class="info">
        <tr>
            <td>Nama Guru</td>
            <td>:</td>
            <td><?= htmlspecialchars($namaGuru) ?></td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td><?= htmlspecialchars($namaKelas) ?></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td><?= $mulai ?> s/d <?= $akhir ?></td>
        </tr>
    </table>

    <table class="laporan">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $r): ?>
                <tr>
                    <td><?= $r['tanggal']; ?></td>
                    <td><?= $r['Nisn']; ?></td>
                    <td><?= htmlspecialchars($r['nama_siswa']); ?></td>
                    <td><?= $r['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="ttd">
        <tr>
            <td>
                Batu Bara, <?= date('d F Y') ?><br>
                Hormat Kami,<br><br><br><br>
                (_____________________)
            </td>
        </tr>
    </table>

</body>

</html>