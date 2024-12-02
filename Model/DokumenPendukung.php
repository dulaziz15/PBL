<?php

namespace Pbl\Model;

use Pbl\Config\Koneksi;
use PDOException;

class DokumenPendukung
{
    private $koneksi;

    public function __construct()
    {
        $this->koneksi = new Koneksi();
    }

    public function getAll()
    {
        $query = "SELECT * FROM Dokumen_pendukung as dok inner join Tugas_akhir as ta on ta.tugas_akhir_id = dok.tugas_akhir_id inner join mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function add($tugas_akhir, $file)
    {
        try {
            var_dump($file['bebas_kompen']['name']);
            $status = 0;
            $query = "INSERT INTO Dokumen_pendukung (tugas_akhir_id, tanda_terima_ta, tanda_terima_pkl, bebas_kompen, status) VALUES 
                    ('$tugas_akhir','" .
                $file["tanda_terima_ta"]["name"] . "', '" .
                $file["tanda_terima_pkl"]["name"] . "', '" .
                $file["bebas_kompen"]["name"] . "', 0)";
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


    public function addCatatan($id, $user, $catatan, $tanggal)
    {
        try {
            $query = "INSERT INTO Catatan_pendukung (dokumen_pendukung_id, user_id, catatan, tanggal, status) VALUES ('$id', '$user', '$catatan', '$tanggal', '0')";
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

    public function verifikasiCatatan($id) {
        try{
            $query = "UPDATE Catatan_pendukung SET status = 1 WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
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
}
