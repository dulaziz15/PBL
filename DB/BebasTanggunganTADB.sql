CREATE DATABASE BebasTanggunganDB;

USE BebasTanggunganDB;

CREATE TABLE Users (
	user_id INT PRIMARY KEY IDENTITY(1,1),
	email VARCHAR(100) UNIQUE NOT NULL, 
	username BIGINT UNIQUE NOT NULL,
	password VARCHAR(100) NOT NULL, 
	role INT
)
GO

CREATE TABLE Log_activity (
	log_id INT PRIMARY KEY IDENTITY(1,1),
	user_id INT,
	action VARCHAR(100) NOT NULL, 
	waktu DATETIME DEFAULT GETDATE(),
	FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
)
GO 

CREATE TABLE Mahasiswa (
	mahasiswa_id INT PRIMARY KEY IDENTITY(1,1),
	user_id INT UNIQUE,
	NIM BIGINT UNIQUE,
	nama VARCHAR(100),
	kelas VARCHAR(100),
	telp BIGINT, 
	temp_lahir VARCHAR(50),
	tgl_lahir DATE, 
	alamat VARCHAR(255),
	img VARCHAR(255)
	FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE ON UPDATE CASCADE 
)
GO 

CREATE TABLE Bebas_tanggungan (
    bebas_tanggungan_id INT PRIMARY KEY IDENTITY(1,1),
    mahasiswa_id INT UNIQUE,
    no_surat VARCHAR(100),
    status_bebas_tanggungan VARCHAR(20) CHECK (status_bebas_tanggungan IN ('Pending', 'Approved')),
    FOREIGN KEY (mahasiswa_id) REFERENCES Mahasiswa(mahasiswa_id) ON DELETE CASCADE ON UPDATE CASCADE
)
GO

CREATE TABLE Tugas_akhir (
	tugas_akhir_id INT PRIMARY KEY IDENTITY(1,1),
	mahasiswa_id INT UNIQUE, 
	judul VARCHAR(255) NOT NULL,
	file_project VARCHAR(100) NOT NULL, 
	status_tugas_akhir VARCHAR(20) CHECK (status_tugas_akhir IN ('Pending', 'Approved')), 
	FOREIGN KEY (mahasiswa_id) REFERENCES Mahasiswa(mahasiswa_id) ON DELETE CASCADE ON UPDATE CASCADE 
)
GO

CREATE TABLE Dokumen_tugas_akhir (
	dokumen_id INT PRIMARY KEY IDENTITY(1,1),
	tugas_akhir_id INT,
	nama_file VARCHAR(100),
	bagian VARCHAR(100),
	status_dokumen_ta VARCHAR(20) CHECK (status_dokumen_ta IN ('Pending', 'Approved')), 
	FOREIGN KEY (tugas_akhir_id) REFERENCES Tugas_akhir(tugas_akhir_id) ON DELETE CASCADE ON UPDATE CASCADE
)
GO

CREATE TABLE Catatan_TA (
    catatan_id INT PRIMARY KEY IDENTITY(1,1),
    dokumen_id INT,
    user_id INT,
    catatan VARCHAR(255) NOT NULL,
    tanggal DATE,
    status_catatan_ta VARCHAR(20) CHECK (status_catatan_ta IN ('Pending', 'Approved', 'Submit')),
    FOREIGN KEY (dokumen_id) REFERENCES Dokumen_tugas_akhir(dokumen_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) 
)
GO

CREATE TABLE Dokumen_pendukung (
	dokumen_pendukung_id INT PRIMARY KEY IDENTITY(1,1),
	tugas_akhir_id INT UNIQUE,
	tanda_terima_ta VARCHAR(100) NOT NULL,
	tanda_terima_pkl VARCHAR(100) NOT NULL,
	bebas_kompen VARCHAR(100) NOT NULL,
	status_dokumen_pendukung VARCHAR(20) CHECK (status_dokumen_pendukung IN ('Pending', 'Approved')),
	FOREIGN KEY (tugas_akhir_id) REFERENCES Tugas_akhir(tugas_akhir_id) ON DELETE CASCADE ON UPDATE CASCADE 
)
GO 

CREATE TABLE Catatan_pendukung (
	catatan_id INT PRIMARY KEY IDENTITY(1,1),
	dokumen_pendukung_id INT,
	user_id INT,
	catatan VARCHAR(255) NOT NULL,
	tanggal DATE,
	status_catatan_pendukung VARCHAR(20) CHECK (status_catatan_pendukung IN ('Pending', 'Approved', 'Submit')),
	FOREIGN KEY (dokumen_pendukung_id) REFERENCES Dokumen_pendukung(dokumen_pendukung_id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (user_id) REFERENCES Users(user_id) 
)
GO

-- PENGISIAN TABEL 
INSERT INTO Users (email, username, password, role)
VALUES
    ('gerialfian@gmail.com', 1234567890, 'password123', 2),
    ('dindakamalia@gmail.com', 1234567891, 'password123', 2),
    ('rainimorgan@gmail.com', 1234567892, 'password123', 2),
    ('jianggraeni@gmail.com', 1234567893, 'password123', 2),
    ('budipratama@gmail.com', 1234567894, 'password123', 2),
    ('aditirzan@gmail.com', 1234567895, 'password123', 2),
    ('kiaraliora@gmail.com', 1234567896, 'password123', 2),
    ('jazzyalvare@gmail.com', 1234567897, 'password123', 2),
    ('rioadwinata@gmail.com', 1234567898, 'password123', 2),
    ('attalaodan@gmail.com', 1234567899, 'password123', 2),
    ('admin123@admin.com', 9876543210, 'admin123', 1);

GO 

INSERT INTO Log_activity (user_id, action, waktu)
VALUES
    (1, 'Login', '2024-11-12 08:00:00'),
    (2, 'Logout', '2024-11-12 08:05:00'),
    (3, 'Upload Task', '2024-11-12 09:00:00'),
    (4, 'Update Profile', '2024-11-12 09:15:00'),
    (5, 'Login', '2024-11-12 10:00:00'),
    (6, 'Logout', '2024-11-12 10:30:00'),
    (7, 'Submit Document', '2024-11-12 11:00:00'),
    (8, 'Login', '2024-11-12 11:30:00'),
    (9, 'Logout', '2024-11-12 12:00:00'),
    (10, 'Update Document', '2024-11-12 12:30:00'),
    (11, 'Login', '2024-11-12 13:00:00');

GO 

INSERT INTO Mahasiswa (user_id, NIM, nama, kelas, telp, temp_lahir, tgl_lahir, alamat, img)
VALUES
    (1, 20200101, 'Geri Alfian Putra', 'TI-4A', 81234567890, 'Bandung', '2000-01-01', 'Jl. Kebon Jeruk', 'Geri_Alfian_Putra.jpg'),
    (2, 20200102, 'Dinda Kamalia Putri', 'TI-4A', 81234567891, 'Jakarta', '2000-02-02', 'Jl. Merdeka', 'Dinda_Kamalia_Putri.jpg'),
    (3, 20200103, 'Raini Morgana', 'TI-4A', 81234567892, 'Surabaya', '2000-03-03', 'Jl. Melati', 'Raini_Morgana.jpg'),
    (4, 20200104, 'Jia Anggraeni', 'TI-4A', 81234567893, 'Medan', '2000-04-04', 'Jl. Cendana', 'Jia_Anggraeni.jpg'),
    (5, 20200105, 'Budi Pratama Wijaya', 'TI-4A', 81234567894, 'Denpasar', '2000-05-05', 'Jl. Raya Kuta', 'Budi_Pratama_Wijaya.jpg'),
    (6, 20200106, 'Adit Irzan Kurniawan', 'TI-4A', 81234567895, 'Yogyakarta', '2000-06-06', 'Jl. Pahlawan', 'Adit_Irza_Kurniawan.jpg'),
    (7, 20200107, 'Kiara Liora Faye', 'TI-4A', 81234567896, 'Bandung', '2000-07-07', 'Jl. Sisingmangraja', 'Kiara_Liora_Faye.jpg'),
    (8, 20200108, 'Jazzy Elvareta', 'TI-4A', 81234567897, 'Bandung', '2000-08-08', 'Jl. Anggrek', 'Jazzy_Elvareta.jpg'),
    (9, 20200109, 'Rio Adwinata', 'TI-4A', 81234567898, 'Makassar', '2000-09-09', 'Jl. Gunung', 'Rio_Adwinata.jpg'),
    (10, 20200110, 'Attala Odan', 'TI-4A', 81234567899, 'Bekasi', '2000-10-10', 'Jl. Raya No.10', 'Attala_Odan.jpg');

GO 

INSERT INTO Bebas_tanggungan (mahasiswa_id, no_surat, status_bebas_tanggungan)
VALUES
    (1, 'BT-001', 'Pending'),
    (2, 'BT-002', 'Pending'),
    (3, 'BT-003', 'Approved'),
    (4, 'BT-004', 'Approved'),
    (5, 'BT-005', 'Approved'),
    (6, 'BT-006', 'Pending'),
    (7, 'BT-007', 'Approved'),
    (8, 'BT-008', 'Pending'),
    (9, 'BT-009', 'Pending'),
    (10, 'BT-010', 'Approved');

GO 

INSERT INTO Tugas_akhir (mahasiswa_id, judul, file_project, status_tugas_akhir)
VALUES 
	(1, 'Analisis Keamanan Jaringan', 'keamanan_jaringan.zip', 'Pending'),
	(2, 'Optimasi Algoritma Pencarian Data', 'optimasi_algoritma.zip', 'Approved'),
	(3, 'Keamanan Data dalam Cloud Computing ', 'keamanan_data_cloud.zip', 'Pending'),
	(4, 'Aplikasi Monitoring Jaringan Berbasis Android', 'monitoring_jaringan.zip', 'Approved'),
	(5, 'Penerapan IOT pada Smart Home', 'iot_smart_home.zip', 'Pending'),
	(6, 'Keamanan pada Jaringan Wireless', 'keamanan_jaringan_wireless.zip', 'Approved'),
	(7, 'Penerapan Machine Learning dalam Dagnosa penyakit', 'machine_learning_diagnosa.zip', 'Pending'),
	(8, 'Sistem Rekomendasi Film Menggunakan Collaborative Filtering', 'rekomendasi_film.zip', 'Approved'),
	(9, 'Sistem Rekomendasi Musik Berdasrkan Prefernsi', 'rekomendasi_musik.zip', 'Pending'),
	(10, 'Penerapan Game-based Learning dalam Pendidikan', 'game_based_learning.zip', 'Approved');

GO

INSERT INTO Dokumen_tugas_akhir (tugas_akhir_id, nama_file, bagian, status_dokumen_ta)
VALUES 
	(1, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(1, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(1, 'bab3.pdf', 'Metodologi', 'Pending'),
	(2, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(2, 'bab2.pdf', 'Kajian Pustaka', 'Pending'),
	(2, 'bab3.pdf', 'Metodologi', 'Pending'),
	(3, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(3, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(3, 'bab3.pdf', 'Metodologi', 'Approved'),
	(4, 'bab1.pdf', 'Pendahuluan', 'Pending'),
	(4, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(4, 'bab3.pdf', 'Metodologi', 'Approved'),
	(5, 'bab1.pdf', 'Pendahuluan', 'Pending'),
	(5, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(5, 'bab3.pdf', 'Metodologi', 'Approved'),
	(6, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(6, 'bab2.pdf', 'Kajian Pustaka', 'Pending'),
	(6, 'bab3.pdf', 'Metodologi', 'Approved'),
	(7, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(7, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(7, 'bab3.pdf', 'Metodologi', 'Approved'),
	(8, 'bab1.pdf', 'Pendahuluan', 'Pending'),
	(8, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(8, 'bab3.pdf', 'Metodologi', 'Approved'),
	(9, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(9, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(9, 'bab3.pdf', 'Metodologi', 'Approved'),
	(10, 'bab1.pdf', 'Pendahuluan', 'Approved'),
	(10, 'bab2.pdf', 'Kajian Pustaka', 'Approved'),
	(10, 'bab3.pdf', 'Metodologi', 'Approved');

GO

INSERT INTO Catatan_TA (dokumen_id, user_id, catatan, tanggal, status_catatan_ta)
VALUES 
    (1, 1, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (2, 1, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (3, 1, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (4, 2, 'Dokumen bab Pendahuluan perlu perbaikan referensi.', '2024-11-12', 'Pending'),
    (5, 2, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (6, 2, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (7, 3, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Submit'),
    (8, 3, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (9, 3, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (10, 4, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (11, 4, 'Dokumen bab Kajian Pustaka perlu revisi pada metode analisis.', '2024-11-12', 'Pending'),
    (12, 4, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Submit'),
    (13, 5, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (14, 5, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (15, 5, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (16, 6, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (17, 6, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Submit'),
    (18, 6, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (19, 7, 'Dokumen bab Pendahuluan perlu perbaikan sumber pustaka.', '2024-11-12', 'Pending'),
    (20, 7, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (21, 7, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (22, 8, 'Dokumen bab Pendahuluan membutuhkan klarifikasi tambahan.', '2024-11-12', 'Pending'),
    (23, 8, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Submit'),
    (24, 8, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (25, 9, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (26, 9, 'Dokumen bab Kajian Pustaka membutuhkan penambahan referensi terbaru.', '2024-11-12', 'Pending'),
    (27, 9, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Submit'),
    (28, 10, 'Dokumen bab Pendahuluan disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (29, 10, 'Dokumen bab Kajian Pustaka disetujui tanpa revisi.', '2024-11-12', 'Approved'),
    (30, 10, 'Dokumen bab Metodologi disetujui tanpa revisi.', '2024-11-12', 'Submit');

GO

INSERT INTO Dokumen_pendukung (tugas_akhir_id, tanda_terima_ta, tanda_terima_pkl, bebas_kompen, status_dokumen_pendukung)
VALUES 
	(1, 'tanda_TA_1.pdf', 'tanda_PKL_1.pdf', 'bebas_kompen_1.pdf', 'Approved'),
	(2, 'tanda_TA_2.pdf', 'tanda_PKL_2.pdf', 'bebas_kompen_2.pdf', 'Approved'),
	(3, 'tanda_TA_3.pdf', 'tanda_PKL_3.pdf', 'bebas_kompen_3.pdf', 'Approved'),
	(4, 'tanda_TA_4.pdf', 'tanda_PKL_4.pdf', 'bebas_kompen_4.pdf', 'Approved'),
	(5, 'tanda_TA_5.pdf', 'tanda_PKL_5.pdf', 'bebas_kompen_5.pdf', 'Pending'),
	(6, 'tanda_TA_6.pdf', 'tanda_PKL_6.pdf', 'bebas_kompen_6.pdf', 'Approved'),
	(7, 'tanda_TA_7.pdf', 'tanda_PKL_7.pdf', 'bebas_kompen_7.pdf', 'Approved'),
	(8, 'tanda_TA_8.pdf', 'tanda_PKL_8.pdf', 'bebas_kompen_8.pdf', 'Pending'),
	(9, 'tanda_TA_9.pdf', 'tanda_PKL_9.pdf', 'bebas_kompen_9.pdf', 'Approved'),
	(10, 'tanda_TA_10.pdf', 'tanda_PKL_10.pdf', 'bebas_kompen_10.pdf', 'Pending');

GO

INSERT INTO Catatan_pendukung (dokumen_pendukung_id, user_id, catatan, tanggal, status_catatan_pendukung)
VALUES 
	(1, 1, 'Dokumen tanda terima TA diterima tanpa revisi.', '2024-11-12', 'Approved'),
	(2, 2, 'Dokumen tanda terima PKL membutuhkan klarifikasi tambahan.', '2024-11-12', 'Pending'),
	(3, 3, 'Dokumen bebas kompen disetujui tanpa revisi.', '2024-11-12', 'Submit'),
	(4, 4, 'Dokumen tanda terima TA diterima tanpa revisi.', '2024-11-12', 'Approved'),
	(5, 5, 'Dokumen tanda terima PKL membutuhkan tanda tangan tambahan.', '2024-11-12', 'Pending'),
	(6, 6, 'Dokumen bebas kompen disetujui tanpa revisi.', '2024-11-12', 'Submit'),
	(7, 7, 'Dokumen tanda terima TA disetujui tanpa revisi.', '2024-11-12', 'Approved'),
	(8, 8, 'Dokumen tanda terima PKL memerlukan verifikasi lebih lanjut.', '2024-11-12', 'Pending'),
	(9, 9, 'Dokumen bebas kompen disetujui tanpa revisi.', '2024-11-12', 'Submit'),
	(10, 10, 'Dokumen tanda terima TA diterima tanpa revisi.', '2024-11-12', 'Approved');

GO

