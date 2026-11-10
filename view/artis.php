<?php $isEdit = !empty($editArtis); ?>
<h3><?= $isEdit ? 'Edit Artis' : 'Tambah Artis' ?></h3>

<form action="?page=artis" method="POST">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$editArtis['id'] ?>">
    <?php endif; ?>

    <label>Nama Artis / Grup:</label><br>
    <input type="text" name="nama_artis" maxlength="100" required
           value="<?= htmlspecialchars($editArtis['nama_artis'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <label>Asal:</label><br>
    <input type="text" name="asal" maxlength="50" required
           value="<?= htmlspecialchars($editArtis['asal'] ?? 'Jepang', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <button type="submit" name="<?= $isEdit ? 'ubah_artis' : 'tambah_artis' ?>">
        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Artis' ?>
    </button>
    <?php if ($isEdit): ?> <a href="?page=artis">Batal</a><?php endif; ?>
</form>

<hr>
<h3>Daftar Artis J-Pop</h3>
<table border="1">
    <tr><th>ID</th><th>Nama Artis / Grup</th><th>Asal</th><th>Aksi</th></tr>
    <?php foreach ($artis->semua() as $a): ?>
    <tr>
        <td><?= (int)$a['id'] ?></td>
        <td><?= htmlspecialchars($a['nama_artis']) ?></td>
        <td><?= htmlspecialchars($a['asal']) ?></td>
        <td>
            <a href="?page=artis&edit_artis=<?= (int)$a['id'] ?>">Edit</a>
            <form action="?page=artis" method="POST" style="display:inline"
                  onsubmit="return confirm('Hapus artis ini? Pastikan belum memiliki data album.')">
                <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                <button type="submit" name="hapus_artis">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
