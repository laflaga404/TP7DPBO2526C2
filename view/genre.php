<?php $isEdit = !empty($editGenre); ?>
<h3><?= $isEdit ? 'Edit Genre' : 'Tambah Genre' ?></h3>

<form action="?page=genre" method="POST">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$editGenre['id'] ?>">
    <?php endif; ?>

    <label>Nama Genre:</label><br>
    <input type="text" name="nama_genre" maxlength="100" required
           value="<?= htmlspecialchars($editGenre['nama_genre'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"><?= htmlspecialchars($editGenre['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <button type="submit" name="<?= $isEdit ? 'ubah_genre' : 'tambah_genre' ?>">
        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Genre' ?>
    </button>
    <?php if ($isEdit): ?> <a href="?page=genre">Batal</a><?php endif; ?>
</form>

<hr>
<h3>Daftar Genre</h3>
<table border="1">
    <tr><th>ID</th><th>Genre</th><th>Deskripsi</th><th>Aksi</th></tr>
    <?php foreach ($genre->semua() as $g): ?>
    <tr>
        <td><?= (int)$g['id'] ?></td>
        <td><?= htmlspecialchars($g['nama_genre']) ?></td>
        <td><?= htmlspecialchars($g['deskripsi'] ?? '') ?></td>
        <td>
            <a href="?page=genre&edit_genre=<?= (int)$g['id'] ?>">Edit</a>
            <form action="?page=genre" method="POST" style="display:inline"
                  onsubmit="return confirm('Yakin ingin menghapus genre ini?')">
                <input type="hidden" name="id" value="<?= (int)$g['id'] ?>">
                <button type="submit" name="hapus_genre">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
