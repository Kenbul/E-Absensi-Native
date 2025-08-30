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
                                    <button
                                        class="btn btn-sm btn-warning btn-edit"
                                        data-id="<?= $a['id'] ?>"
                                        data-nama="<?= htmlspecialchars($a['nama_siswa']) ?>"
                                        data-tanggal="<?= htmlspecialchars($a['tanggal']) ?>"
                                        data-status="<?= htmlspecialchars($a['status']) ?>">
                                        Edit
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">Tidak dapat diedit</span>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Data absensi tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>