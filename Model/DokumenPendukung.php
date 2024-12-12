<?php

namespace Pbl\Model;

use Pbl\Config\Koneksi;
use Pbl\Core\Model;
use Pbl\Enums\status;
use PDOException;

class DokumenPendukung extends Model
{

    public function getAll()
    {
        $query = "SELECT * FROM Dokumen_pendukung as dok inner join Tugas_akhir as ta on ta.tugas_akhir_id = dok.tugas_akhir_id inner join mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id order by dokumen_pendukung_id desc";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function add($tugas_akhir, $file)
    {
        try {
            $query = "INSERT INTO Dokumen_pendukung (tugas_akhir_id, tanda_terima_ta, tanda_terima_pkl, bebas_kompen, status_dokumen_pendukung) VALUES 
                    ('$tugas_akhir','" .
                $file["tanda_terima_ta"]["name"] . "', '" .
                $file["tanda_terima_pkl"]["name"] . "', '" .
                $file["bebas_kompen"]["name"] . "', '" . status::PENDING->value . "')";
            $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOne($id)
    {
        $query = "SELECT * FROM Dokumen_pendukung as dok inner join Tugas_akhir as ta on ta.tugas_akhir_id = dok.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id  WHERE dokumen_pendukung_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getOneByTugasAkhir($id)
    {
        $query = "SELECT * FROM Dokumen_pendukung as dok inner join Tugas_akhir as ta on ta.tugas_akhir_id = dok.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id  WHERE dok.tugas_akhir_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function updateDokumen($id, $dokumen, $bagian) {
        // try {
            $query = "UPDATE Dokumen_pendukung SET $bagian = '" . $dokumen['name'] . "' WHERE dokumen_pendukung_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        // } catch(PDOException $e) {
        //     return false;
        // }
    }

    public function getNIMbyDokumen($id) {
        $query = "select NIM from Dokumen_pendukung as pen inner join Tugas_akhir as ta on ta.tugas_akhir_id = pen.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where pen.dokumen_pendukung_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }


    public function verifikasi($id) {
        try {
            $query = "UPDATE Dokumen_pendukung SET status_dokumen_pendukung = '" . status::APPROVED->value . "' WHERE dokumen_pendukung_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }


    public function addCatatan($id, $user, $catatan, $tanggal)
    {
        try {
            $query = "INSERT INTO Catatan_pendukung (dokumen_pendukung_id, user_id, catatan, tanggal, status_catatan_pendukung) VALUES ('$id', '$user', '$catatan', '$tanggal', '" . status::PENDING->value . "')";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCatatan($id)
    {
        $query = "SELECT * FROM Catatan_pendukung WHERE dokumen_pendukung_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getOneCatatan($id)
    {
        $query = "SELECT * FROM Catatan_pendukung WHERE catatan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function updateCatatan($id, $catatan) {
        $query = "UPDATE Catatan_pendukung SET catatan = '$catatan' WHERE catatan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        return true;
    }

    public function pengajuanCatatan($id) {
        try{
            $query = "UPDATE Catatan_pendukung SET status_catatan_pendukung = '" . status::PENGAJUAN->value ."' WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function verifikasiCatatan($id) {
        try{
            $query = "UPDATE Catatan_pendukung SET status_catatan_pendukung = '" . status::APPROVED->value . "' WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function hapusCatatan($id) {
        try{
            $query = "DELETE FROM Catatan_pendukung WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function validateCatatan($id) {
        // var_dump($id);
        $query = "SELECT * FROM Catatan_pendukung WHERE dokumen_pendukung_id = $id AND status_catatan_pendukung != '" . status::APPROVED->value . "'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function hapus($id) {
        try {
            $query = "DELETE FROM Dokumen_pendukung WHERE dokumen_pendukung_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getOneMahasiswa($id) {
        $query = "SELECT * FROM Dokumen_pendukung as dp inner join Tugas_akhir as ta on ta.tugas_akhir_id = dp.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where ta.mahasiswa_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }
}
