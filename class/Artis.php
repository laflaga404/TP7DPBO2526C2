<?php
require_once __DIR__ . "/../config/db.php";

class Artis {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function tambah($namaArtis, $asal) {
        $stmt = $this->db->prepare(
            "INSERT INTO artis (nama_artis, asal) VALUES (?, ?)"
        );
        return $stmt->execute([$namaArtis, $asal]);
    }

    public function semua() {
        $stmt = $this->db->prepare("SELECT * FROM artis ORDER BY nama_artis ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function cari($id) {
        $stmt = $this->db->prepare("SELECT * FROM artis WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function ubah($id, $namaArtis, $asal) {
        $stmt = $this->db->prepare(
            "UPDATE artis SET nama_artis = ?, asal = ? WHERE id = ?"
        );
        return $stmt->execute([$namaArtis, $asal, $id]);
    }

    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM artis WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
