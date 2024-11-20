<?php

namespace Pbl\Model;

use Pbl\Config\koneksi;
use PDOException;

class Mahasiswa
{
    private $koneksi;
    public function __construct()
    {
        $this->koneksi = new koneksi();
    }

    public function getOne($id)
    {
        $query = "SELECT * FROM Mahasiswa WHERE mahasiswa_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getWithUser($id)
    {
        $query = "SELECT * 
                FROM Mahasiswa as mhs
                inner join Users as usr on usr.user_id = mhs.user_id
                where mhs.mahasiswa_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getOneByUser($user_id) {
        $query = "SELECT * FROM Mahasiswa where user_id = $user_id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getAll()
    {
        $query = "SELECT * FROM Mahasiswa";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function addMahasiswa($nama, $nim, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $nameImg, $user)
    {
        try {
            $query = "INSERT INTO Mahasiswa (user_id, nama, NIM, kelas, telp, temp_lahir, tgl_lahir, alamat, img) VALUES ('$user', '$nama', $nim, '$kelas', $telp, '$temp_lahir', '$tgl_lahir', '$alamat', '$nameImg')";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $id)
    {
        try {
            $query = "UPDATE Mahasiswa SET 
                        user_id = $user,
                        NIM = '$nim', 
                        nama = '$nama', 
                        kelas = '$kelas', 
                        telp = '$telp', 
                        temp_lahir = '$temp_lahir',
                        tgl_lahir = '$tgl_lahir',
                        alamat = '$alamat'
                        WHERE mahasiswa_id = '$id'";
            $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateImg($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $img, $id) {
        try {
            $query = "UPDATE Mahasiswa SET 
                        user_id = $user,
                        NIM = $nim, 
                        nama = $nama, 
                        kelas = $kelas, 
                        telp = $telp, 
                        temp_lahir = $temp_lahir,
                        tgl_lahir = $tgl_lahir,
                        alamat = $alamat,
                        img = $img
                        WHERE mahasiswa_id = $id";
            $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function hapus($id) {
        try {
            $query = "DELETE Mahasiswa WHERE mahasiswa_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return $e;
        }
    }
}
