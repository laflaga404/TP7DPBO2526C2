<?php
require_once 'class/Genre.php';
require_once 'class/Artis.php';
require_once 'class/Album.php';

$genre = new Genre();
$artis = new Artis();
$album = new Album();
$pesan = '';

// Proses CRUD.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // GENRE
        if (isset($_POST['tambah_genre'])) {
            $nama = trim($_POST['nama_genre'] ?? '');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            if ($nama === '') {
                throw new Exception('Nama genre wajib diisi.');
            }
            $genre->tambah($nama, $deskripsi);
            header('Location: index.php?page=genre&status=tambah');
            exit;
        }

        if (isset($_POST['ubah_genre'])) {
            $genre->ubah(
                (int)($_POST['id'] ?? 0),
                trim($_POST['nama_genre'] ?? ''),
                trim($_POST['deskripsi'] ?? '')
            );
            header('Location: index.php?page=genre&status=ubah');
            exit;
        }

        if (isset($_POST['hapus_genre'])) {
            $genre->hapus((int)($_POST['id'] ?? 0));
            header('Location: index.php?page=genre&status=hapus');
            exit;
        }

        // ARTIS
        if (isset($_POST['tambah_artis'])) {
            $nama = trim($_POST['nama_artis'] ?? '');
            $asal = trim($_POST['asal'] ?? '');
            if ($nama === '' || $asal === '') {
                throw new Exception('Nama artis dan asal wajib diisi.');
            }
            $artis->tambah($nama, $asal);
            header('Location: index.php?page=artis&status=tambah');
            exit;
        }

        if (isset($_POST['ubah_artis'])) {
            $artis->ubah(
                (int)($_POST['id'] ?? 0),
                trim($_POST['nama_artis'] ?? ''),
                trim($_POST['asal'] ?? '')
            );
            header('Location: index.php?page=artis&status=ubah');
            exit;
        }

        if (isset($_POST['hapus_artis'])) {
            $artis->hapus((int)($_POST['id'] ?? 0));
            header('Location: index.php?page=artis&status=hapus');
            exit;
        }

        // ALBUM
        if (isset($_POST['tambah_album'])) {
            $judul = trim($_POST['judul_album'] ?? '');
            $idGenre = (int)($_POST['id_genre'] ?? 0);
            $idArtis = (int)($_POST['id_artis'] ?? 0);
            $harga = (float)($_POST['harga'] ?? 0);
            $stok = (int)($_POST['stok'] ?? 0);
            $deskripsi = trim($_POST['deskripsi'] ?? '');

            if ($judul === '' || $idGenre < 1 || $idArtis < 1 || $harga < 0 || $stok < 0) {
                throw new Exception('Data album tidak valid. Periksa kembali seluruh input.');
            }

            $album->tambah($idGenre, $idArtis, $judul, $harga, $stok, $deskripsi);
            header('Location: index.php?page=album&status=tambah');
            exit;
        }

        if (isset($_POST['ubah_album'])) {
            $id = (int)($_POST['id'] ?? 0);
            $judul = trim($_POST['judul_album'] ?? '');
            $idGenre = (int)($_POST['id_genre'] ?? 0);
            $idArtis = (int)($_POST['id_artis'] ?? 0);
            $harga = (float)($_POST['harga'] ?? 0);
            $stok = (int)($_POST['stok'] ?? 0);
            $deskripsi = trim($_POST['deskripsi'] ?? '');

            if ($judul === '' || $idGenre < 1 || $idArtis < 1 || $harga < 0 || $stok < 0) {
                throw new Exception('Data album tidak valid. Periksa kembali seluruh input.');
            }

            $album->ubah($id, $idGenre, $idArtis, $judul, $harga, $stok, $deskripsi);
            header('Location: index.php?page=album&status=ubah');
            exit;
        }

        if (isset($_POST['hapus_album'])) {
            $album->hapus((int)($_POST['id'] ?? 0));
            header('Location: index.php?page=album&status=hapus');
            exit;
        }
    } catch (PDOException $e) {
        $pesan = 'Operasi gagal. Data mungkin masih digunakan oleh album lain.';
    } catch (Throwable $e) {
        $pesan = $e->getMessage();
    }
}

$status = $_GET['status'] ?? '';
$statusText = [
    'tambah' => 'Data berhasil ditambahkan.',
    'ubah' => 'Data berhasil diperbarui.',
    'hapus' => 'Data berhasil dihapus.'
];
if ($pesan === '' && isset($statusText[$status])) {
    $pesan = $statusText[$status];
}

$editGenre = isset($_GET['edit_genre']) ? $genre->cari((int)$_GET['edit_genre']) : null;
$editArtis = isset($_GET['edit_artis']) ? $artis->cari((int)$_GET['edit_artis']) : null;
$editAlbum = isset($_GET['edit_album']) ? $album->cari((int)$_GET['edit_album']) : null;

$pages = [
    'genre' => 'view/genre.php',
    'artis' => 'view/artis.php',
    'album' => 'view/album.php'
];
$page = $_GET['page'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J-Pop Album Catalog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <main>
        <h2>J-Pop Album Catalog</h2>
        <p>Database koleksi album dan rilisan musik Jepang.</p>

        <nav>
            <a href="?page=genre">Genre</a> |
            <a href="?page=artis">Artis</a> |
            <a href="?page=album">Album</a>
        </nav>

        <?php if ($pesan !== ''): ?>
            <p class="notice"><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <?php
        if (isset($pages[$page])) {
            include $pages[$page];
        } elseif ($page !== '') {
            echo '<p>Halaman tidak ditemukan.</p>';
        } else {
            echo '<h3>Selamat datang!</h3>';
            echo '<p>Pilih menu Genre, Artis, atau Album untuk mengelola katalog.</p>';
        }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>
