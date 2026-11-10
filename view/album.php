<?php $isEdit = !empty($editAlbum); ?>
<h3><?= $isEdit ? 'Edit Album' : 'Tambah Album' ?></h3>

<form action="?page=album" method="POST">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= (int)$editAlbum['id'] ?>">
    <?php endif; ?>

    <label>Judul Album:</label><br>
    <input type="text" name="judul_album" maxlength="100" required
           value="<?= htmlspecialchars($editAlbum['judul_album'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <label>Genre:</label><br>
    <select name="id_genre" required>
        <option value="">-- Pilih Genre --</option>
        <?php foreach ($genre->semua() as $g): ?>
            <option value="<?= (int)$g['id'] ?>"
                <?= ($isEdit && $editAlbum['id_genre'] == $g['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($g['nama_genre']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Artis / Grup:</label><br>
    <select name="id_artis" required>
        <option value="">-- Pilih Artis --</option>
        <?php foreach ($artis->semua() as $a): ?>
            <option value="<?= (int)$a['id'] ?>"
                <?= ($isEdit && $editAlbum['id_artis'] == $a['id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($a['nama_artis']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Harga Album (Rp):</label><br>
    <input type="number" name="harga" min="0" step="1000" required
           value="<?= htmlspecialchars($editAlbum['harga'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <label>Stok:</label><br>
    <input type="number" name="stok" min="0" required
           value="<?= htmlspecialchars($editAlbum['stok'] ?? '0', ENT_QUOTES, 'UTF-8') ?>"><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"><?= htmlspecialchars($editAlbum['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <button type="submit" name="<?= $isEdit ? 'ubah_album' : 'tambah_album' ?>">
        <?= $isEdit ? 'Simpan Perubahan' : 'Tambah Album' ?>
    </button>
    <?php if ($isEdit): ?> <a href="?page=album">Batal</a><?php endif; ?>
</form>

<hr>
<h3>Daftar Album</h3>
<table border="1">
    <tr>
        <th>ID</th><th>Judul Album</th><th>Artis / Grup</th>
        <th>Genre</th><th>Harga</th><th>Stok</th><th>Deskripsi</th><th>Aksi</th>
    </tr>
    <?php foreach ($album->semua() as $a): ?>
    <tr>
        <td><?= (int)$a['id'] ?></td>
        <td><?= htmlspecialchars($a['judul_album']) ?></td>
        <td><?= htmlspecialchars($a['nama_artis']) ?></td>
        <td><?= htmlspecialchars($a['nama_genre']) ?></td>
        <td>Rp <?= number_format((float)$a['harga'], 0, ',', '.') ?></td>
        <td><?= (int)$a['stok'] ?></td>
        <td><?= htmlspecialchars($a['deskripsi'] ?? '') ?></td>
        <td>
            <a href="?page=album&edit_album=<?= (int)$a['id'] ?>">Edit</a>
            <form action="?page=album" method="POST" style="display:inline"
                  onsubmit="return confirm('Yakin ingin menghapus album ini?')">
                <input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
                <button type="submit" name="hapus_album">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
