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
            text-align: center;
        }

        table.laporan th {
            background-color: #f2f2f2;
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
        <img src="http://localhost/E-Absensi-Native/assets/img/logo.png" alt="logo">
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
        <?php if (!empty($namaMapel)): ?>
            <tr>
                <td>Mata Pelajaran</td>
                <td>:</td>
                <td><?= htmlspecialchars($namaMapel) ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td><?= $mulai ?> s/d <?= $akhir ?></td>
        </tr>
    </table>

    <table class="laporan">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpha</th>
                <th>Total Pertemuan</th>
                <th>% Hadir</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)): ?>
                <?php $no = 1;
                foreach ($data as $r): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['Nisn']; ?></td>
                        <td style="text-align: left;"><?= htmlspecialchars($r['nama_siswa']); ?></td>
                        <td><?= $r['total_hadir']; ?></td>
                        <td><?= $r['total_izin']; ?></td>
                        <td><?= $r['total_sakit']; ?></td>
                        <td><?= $r['total_alpha']; ?></td>
                        <td><?= $r['total_pertemuan']; ?></td>
                        <td><?= $r['persen_hadir']; ?>%</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Tidak ada data absensi pada periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <table class="ttd">
        <tr>
            <td>
                Batu Bara, <?= date('d F Y') ?><br>
                Hormat Kami,<br><br><br><br>
                (<?= isset($penandatangan) ? htmlspecialchars($penandatangan) : '________________' ?>)
            </td>
        </tr>
    </table>

</body>

</html>