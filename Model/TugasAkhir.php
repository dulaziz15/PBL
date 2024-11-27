<?php

namespace Pbl\Model;

use Pbl\Config\koneksi;
use Pbl\Enums\tugas_akhir;
use PDOException;

class TugasAkhir
{
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = new koneksi();
    }

    public function getAll()
    {
        $query = "select * from Tugas_akhir as ta inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id order by ta.tugas_akhir_id desc";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getOne($id) {
        $query = "SELECT * from Tugas_akhir as ta inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id WHERE tugas_akhir_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function add($file, $mahasiswa, $judul, $status) {
        try {
            $query = "INSERT INTO Tugas_akhir (mahasiswa_id, judul, file_project, status) VALUES
                    ('$mahasiswa', '$judul', '" . $_FILES['fileproject']['name'] . "', '$status')";
            $data = $this->koneksi->KoneksiDB();
            $data->query($query);
            $tugas_akhir_id = $data->lastInsertId();
            $query_dokumen = "INSERT INTO Dokumen_tugas_akhir (tugas_akhir_id, nama_file, bagian, status) VALUES
                        ('$tugas_akhir_id', '" . $file["pendahuluan"]["name"] . "', '" . tugas_akhir::PENDAHULUAN->value . "', 0),
                        ('$tugas_akhir_id', '" . $file["abstrak"]["name"] . "', '" . tugas_akhir::ABSTRAK->value . "', 0),
                        ('$tugas_akhir_id', '" . $file["isi"]["name"] . "', '" . tugas_akhir::ISI->value . "', 0),
                        ('$tugas_akhir_id', '" . $file["daftarpustaka"]["name"] . "', '" . tugas_akhir::DAFTAR_PUSTAKA->value . "', 0),
                        ('$tugas_akhir_id', '" . $file["lampiran"]["name"] . "', '" . tugas_akhir::LAMPIRAN->value . "', 0)";
            $dataDokumen = $this->koneksi->KoneksiDB()->query($query_dokumen);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getDokumen($id) {
        $query = "SELECT * FROM Dokumen_tugas_akhir WHERE tugas_akhir_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getOneDokumen($id) {
        $query = "SELECT * FROM Dokumen_tugas_akhir as dta inner join Tugas_akhir as ta on ta.tugas_akhir_id = dta.tugas_akhir_id
                    inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id WHERE dokumen_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function addCatatan($id, $catatan, $tanggal) {
        var_dump($tanggal);
        $query = "INSERT INTO Catatan_TA (dokumen_id, user_id, catatan, tanggal, status) VALUES ($id, )";
    }

    public function hapus($id)
    {
        try {
            $query = "DELETE FROM Tugas_akhir WHERE tugas_akhir_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
