<?php

namespace Pbl\Model;

use Pbl\Core\Model;
use Pbl\Enums\status;
use PDOException;

class BebasTanggungan extends Model
{

    public function getAll()
    {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getAllVerify()
    {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where status_bebas_tanggungan = 'Approved' order by bebas_tanggungan_id desc";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getOne($id)
    {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id inner join Dokumen_pendukung as dok on dok.tugas_akhir_id = ta.tugas_akhir_id WHERE bebas_tanggungan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function add($tugas_akhir, $no_surat)
    {
        try {
            $query = "INSERT INTO Bebas_tanggungan (tugas_akhir_id, no_surat, status_bebas_tanggungan) VALUES ('$tugas_akhir', '$no_surat', '" . status::PENDING->value . "')";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateStatus($id)
    {
        try {
            $query = "UPDATE Bebas_tanggungan SET status_bebas_tanggungan = '" . status::APPROVED->value . "' WHERE bebas_tanggungan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getOneMahasiswa($id) {
        $query = "SELECT * FROM Bebas_tanggungan as bt inner join Tugas_akhir as ta on ta.tugas_akhir_id = bt.tugas_akhir_id inner join Dokumen_pendukung as dok on dok.tugas_akhir_id = ta.tugas_akhir_id  inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where mhs.mahasiswa_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function hapus($id) {
        try {
            $query = "DELETE FROM Bebas_tanggungan WHERE bebas_tanggungan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
