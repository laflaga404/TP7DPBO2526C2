-- J-Pop Album Catalog System
-- Import file ini melalui phpMyAdmin.
-- Script ini membuat ulang tabel dalam database db_jpop_album.

CREATE DATABASE IF NOT EXISTS db_jpop_album
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_jpop_album;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS album;
DROP TABLE IF EXISTS artis;
DROP TABLE IF EXISTS genre;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE genre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_genre VARCHAR(100) NOT NULL,
    deskripsi TEXT
) ENGINE=InnoDB;

CREATE TABLE artis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_artis VARCHAR(100) NOT NULL,
    asal VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE album (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_genre INT NOT NULL,
    id_artis INT NOT NULL,
    judul_album VARCHAR(100) NOT NULL,
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    CONSTRAINT fk_album_genre FOREIGN KEY (id_genre) REFERENCES genre(id),
    CONSTRAINT fk_album_artis FOREIGN KEY (id_artis) REFERENCES artis(id)
) ENGINE=InnoDB;

INSERT INTO genre (nama_genre, deskripsi) VALUES
('J-Pop', 'Musik pop Jepang.'),
('J-Rock', 'Musik rock Jepang.'),
('Anime Soundtrack', 'Album soundtrack anime dan film animasi.'),
('Pop Eksperimental', 'Musik pop dengan eksplorasi gaya dan produksi.'),
('Vocaloid', 'Musik yang berkaitan dengan kultur Vocaloid.');

INSERT INTO artis (nama_artis, asal) VALUES
('RADWIMPS', 'Jepang'),
('YOASOBI', 'Jepang'),
('Ado', 'Jepang'),
('See-Saw', 'Jepang'),
('Kalafina', 'Jepang'),
('FictionJunction', 'Jepang'),
('Kenshi Yonezu', 'Jepang'),
('Utada Hikaru', 'Jepang'),
('Hanyuu Maigo', 'Jepang');

-- Harga dan stok merupakan data simulasi untuk keperluan tugas.
INSERT INTO album (id_genre, id_artis, judul_album, harga, stok, deskripsi) VALUES
(3, 1, 'Kimi no Na wa. (Your Name.)', 250000, 8, 'Album soundtrack film animasi Your Name.'),
(2, 1, 'Ningen Kaika', 280000, 5, 'Album RADWIMPS.'),
(1, 2, 'THE BOOK', 220000, 10, 'Album mini pertama YOASOBI.'),
(1, 2, 'THE BOOK 2', 230000, 7, 'Album mini kedua YOASOBI.'),
(1, 2, 'THE BOOK 3', 240000, 6, 'Album mini ketiga YOASOBI.'),
(1, 3, 'Kyogen', 260000, 9, 'Album studio pertama Ado.'),
(1, 3, 'Zanmu', 270000, 5, 'Album studio kedua Ado.'),
(3, 4, 'Dream Field', 250000, 4, 'Album See-Saw.'),
(3, 5, 'Seventh Heaven', 260000, 5, 'Album studio Kalafina.'),
(3, 5, 'Red Moon', 260000, 4, 'Album studio Kalafina.'),
(3, 5, 'After Eden', 270000, 3, 'Album studio Kalafina.'),
(3, 6, 'Everlasting Songs', 250000, 4, 'Album FictionJunction.'),
(3, 6, 'elemental', 260000, 3, 'Album FictionJunction.'),
(1, 7, 'BOOTLEG', 280000, 6, 'Album studio Kenshi Yonezu.'),
(1, 7, 'STRAY SHEEP', 290000, 8, 'Album studio Kenshi Yonezu.'),
(1, 7, 'LOST CORNER', 300000, 4, 'Album studio Kenshi Yonezu.'),
(1, 8, 'Fantome', 280000, 5, 'Album studio Utada Hikaru.'),
(1, 8, 'BAD Mode', 290000, 5, 'Album studio Utada Hikaru.'),
(1, 8, 'SCIENCE FICTION', 320000, 3, 'Album kompilasi Utada Hikaru.'),
(5, 9, 'Ukiyo Meguri (浮世巡り)', 240000, 5, 'Album Hanyuu Maigo.'),
(5, 9, 'Mashou no Kamatoto (魔性のカマトト)', 250000, 4, 'Album Hanyuu Maigo.');

