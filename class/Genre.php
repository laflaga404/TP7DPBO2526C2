<?php
require_once __DIR__ . "/../config/db.php";

class Genre {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function tambah($namaGenre, $deskripsi) {
        $stmt = $this->db->prepare(
            "INSERT INTO genre (nama_genre, deskripsi) VALUES (?, ?)"
        );
        return $stmt->execute([$namaGenre, $deskripsi]);
    }

    public function semua() {
        $stmt = $this->db->prepare("SELECT * FROM genre ORDER BY nama_genre ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function cari($id) {
        $stmt = $this->db->prepare("SELECT * FROM genre WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function ubah($id, $namaGenre, $deskripsi) {
        $stmt = $this->db->prepare(
            "UPDATE genre SET nama_genre = ?, deskripsi = ? WHERE id = ?"
        );
        return $stmt->execute([$namaGenre, $deskripsi, $id]);
    }

    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM genre WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
