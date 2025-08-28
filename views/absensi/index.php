<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>

<h3><?= $title ?></h3>

<!-- Filter Form -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<form method="GET" action="">
    <input type="hidden" name="page" value="absensi">
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group input-group-static mb-4 ">
                <select name="kelas_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelasList as $k): ?>
                        <option value="<?= $k['id'] ?>" <?= ($kelas_id == $k['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($k['Kelas']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group input-group-static mb-4 ">
                <select name="mapel_id" class="form-control" required>
                    <option value="">-- Pilih Mapel --</option>
                    <?php foreach ($mapelList as $m): ?>
                        <option value="<?= $m['id'] ?>" <?= ($mapel_id == $m['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($m['Mapel']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </div>
</form>

<div class="card">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-center">Kelas</th>
                    <th>Nama Siswa</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Status Absensi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($absensi)): ?>
                    <?php foreach ($absensi as $a): ?>
                        <tr>
                            <td class="text-center"><?= htmlspecialchars($a['Kelas']) ?></td>
                            <td><?= htmlspecialchars($a['nama_siswa']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($a['tanggal']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($a['status']) ?></td>
                            <td class="text-center">
                                <?php if ($a['boleh_edit']): ?>
                                    <a href="index.php?page=absensi&action=edit&id=<?= $a['id'] ?>"
                                        class="btn btn-sm btn-warning">Edit</a>
                                <?php else: ?>
                                    <span class="text-muted">Tidak dapat diedit</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Pilih kelas dan mapel untuk menampilkan absensi</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "views/layouts/footer.php" ?>