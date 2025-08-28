<?php include "views/layouts/header.php" ?>
<?php include "views/layouts/sidebar.php" ?>
<?php include "views/layouts/navbar.php" ?>

<h3>Edit Absensi Siswa</h3>

<?php if (!empty($absensi)): ?>
    <?php
    // Hitung selisih waktu antara tanggal absensi dan sekarang
    $selisihJam = (time() - strtotime($absensi['tanggal'])) / 3600;
    $boleh_edit = $selisihJam <= 24;
    ?>

    <?php if ($boleh_edit): ?>
        <form action="index.php?page=absensi&action=update_absensi" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($absensi['id']) ?>" class="form-control">
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <div class="input-group input-group-static mb-4 ">
                        <input type="text" class="form-control" value="<?= htmlspecialchars($absensi['nama_siswa']) ?>" readonly>
                    </div>
                </div>
                <div class="col mb-3">
                    <label class="form-label">Kelas</label>
                    <div class="input-group input-group-static mb-4 ">
                        <input type="text" class="form-control" value="<?= htmlspecialchars($absensi['Kelas']) ?>" readonly>
                    </div>
                </div>
                <div class="col mb-3">
                    <label class="form-label">Tanggal</label>
                    <div class="input-group input-group-static mb-4 ">
                        <input type="text" class="form-control" value="<?= htmlspecialchars($absensi['tanggal']) ?>" readonly>
                    </div>
                </div>

            </div>


            <div class="mb-3">
                <label class="form-label">Status Absensi</label>
                <div class="input-group input-group-static mb-4 ">
                    <select name="status" class="form-control" required>
                        <option value="Hadir" <?= $absensi['status'] == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
                        <option value="Izin" <?= $absensi['status'] == 'Izin' ? 'selected' : '' ?>>Izin</option>
                        <option value="Sakit" <?= $absensi['status'] == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
                        <option value="Alpha" <?= $absensi['status'] == 'Alpha' ? 'selected' : '' ?>>Alpha</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="index.php?page=absensi" class="btn btn-secondary">Batal</a>
        </form>
    <?php else: ?>
        <div class="alert alert-warning">
            Data absensi ini sudah lebih dari 24 jam, sehingga tidak dapat diedit.
        </div>
        <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
    <?php endif; ?>

<?php else: ?>
    <div class="alert alert-danger">
        Data absensi tidak ditemukan.
    </div>
    <a href="index.php?page=absensi" class="btn btn-secondary">Kembali</a>
<?php endif; ?>

<?php include "views/layouts/footer.php" ?>