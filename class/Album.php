<?php
require_once __DIR__ . "/../config/db.php";

class Album {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function tambah($idGenre, $idArtis, $judulAlbum, $harga, $stok, $deskripsi) {
        $stmt = $this->db->prepare(
            "INSERT INTO album (id_genre, id_artis, judul_album, harga, stok, deskripsi)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$idGenre, $idArtis, $judulAlbum, $harga, $stok, $deskripsi]);
    }

    public function semua() {
        $stmt = $this->db->prepare(
            "SELECT a.*, g.nama_genre, r.nama_artis
             FROM album a
             INNER JOIN genre g ON a.id_genre = g.id
             INNER JOIN artis r ON a.id_artis = r.id
             ORDER BY a.id ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function cari($id) {
        $stmt = $this->db->prepare(
            "SELECT a.*, g.nama_genre, r.nama_artis
             FROM album a
             INNER JOIN genre g ON a.id_genre = g.id
             INNER JOIN artis r ON a.id_artis = r.id
             WHERE a.id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function ubah($id, $idGenre, $idArtis, $judulAlbum, $harga, $stok, $deskripsi) {
        $stmt = $this->db->prepare(
            "UPDATE album
             SET id_genre = ?, id_artis = ?, judul_album = ?, harga = ?, stok = ?, deskripsi = ?
             WHERE id = ?"
        );
        return $stmt->execute([$idGenre, $idArtis, $judulAlbum, $harga, $stok, $deskripsi, $id]);
    }

    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM album WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
