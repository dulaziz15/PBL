CREATE DATABASE BebasTanggunganDB;

USE BebasTanggunganDB;

CREATE TABLE Users (
	user_id INT PRIMARY KEY IDENTITY(1,1),
	email VARCHAR(100) NOT NULL,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	role INT
)
GO

CREATE TABLE Log_activity (
	log_id INT PRIMARY KEY IDENTITY(1,1),
	user_id INT,
	action VARCHAR,
	date VARCHAR(100)
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
)
GO

CREATE TABLE Mahasiswa (
	mahasiswa_id INT PRIMARY KEY IDENTITY(1,1),
	user_id INT UNIQUE,
	NIM INT,
	nama VARCHAR(100) NOT NULL,
	kelas VARCHAR(100) NOT NULL,
	telp INT,
	temp_lahir VARCHAR(50) NOT NULL,
	alamat VARCHAR(255) NOT NULL,
	tgl_lahir DATE
	FOREIGN KEY (user_id) REFERENCES Users(user_id)
)
GO

CREATE TABLE Bebas_tanggungan (
	bebas_tanggungan_id INT PRIMARY KEY IDENTITY(1,1),
	mahasiswa_id INT UNIQUE,
	no_surat VARCHAR(100),
	status INT
	FOREIGN KEY (mahasiswa_id) REFERENCES Mahasiswa(mahasiswa_id)
)
GO

CREATE TABLE Tugas_akhir (
	tugas_akhir_id INT PRIMARY KEY IDENTITY(1,1),
	mahasiswa_id INT,
	judul VARCHAR,
	file_project VARCHAR(100) NOT NULL,
	status INT
	FOREIGN KEY (mahasiswa_id) REFERENCES Mahasiswa(mahasiswa_id)
)
GO

CREATE TABLE Dokumen_tugas_akhir (
	dokumen_id INT PRIMARY KEY IDENTITY(1,1),
	tugas_akhir_id INT,
	nama_file VARCHAR,
	bagian VARCHAR(100),
	status INT
	FOREIGN KEY (tugas_akhir_id) REFERENCES Tugas_akhir(tugas_akhir_id)
)
GO

CREATE TABLE Catatan_TA (
	catatan_id INT PRIMARY KEY IDENTITY(1,1),
	dokumen_id INT,
	catatan VARCHAR(255) NOT NULL,
	tanggal VARCHAR,
	status VARCHAR(100)
	FOREIGN KEY (dokumen_id) REFERENCES Dokumen_tugas_akhir(dokumen_id)
)
GO 

CREATE TABLE Dokumen_pendukung (
	dokumen_pendukung_id INT PRIMARY KEY IDENTITY(1,1),
	tugas_akhir_id INT UNIQUE,
	tanda_terima_ta VARCHAR(100) NOT NULL,
	tanda_terima_pkl VARCHAR(100) NOT NULL,
	bebas_kompen VARCHAR(100) NOT NULL,
	status INT
	FOREIGN KEY (tugas_akhir_id) REFERENCES Tugas_akhir(tugas_akhir_id)
)
GO 

CREATE TABLE Catatan_pendukung (
	catatan_id INT PRIMARY KEY IDENTITY(1,1),
	dokumen_pendukung_id INT,
	catatan VARCHAR(255) NOT NULL,
	tanggal VARCHAR,
	status VARCHAR(100) NOT NULL
	FOREIGN KEY (dokumen_pendukung_id) REFERENCES Dokumen_pendukung(dokumen_pendukung_id)
)
GO 