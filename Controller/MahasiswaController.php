<?php

namespace Pbl\Controller;

use Pbl\Model\Mahasiswa;
use Pbl\Enums\view;
use PDOException;

class MahasiswaController
{
    private $mahasiswa;
    public function __construct()
    {
        $this->mahasiswa = new Mahasiswa();
    }

    public function getAll()
    {
        $data = $this->mahasiswa->getAll();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function show($id)
    {
        $data = $this->mahasiswa->getOne($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function addMahasiswa()
    {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $kelas = $_POST['kelas'];
        $telp = $_POST['telp'];
        $temp_lahir = $_POST['temp_lahir'];
        $tgl_lahir = date($_POST['tgl_lahir']);
        $alamat = $_POST['alamat'];
        $user = $_POST['user_id'];
        $path = "../src/img/mahasiswa/";
        $imgNama = $_FILES['img']['tmp_name'];
        $namaImg = $_FILES['img']['name'];
        $data = $this->mahasiswa->addMahasiswa($nama, $nim, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $namaImg, $user);
        if ($data == true) {
            move_uploaded_file($imgNama, $path . $namaImg);
            $_SESSION['sukses'] = "Data Berhasil Disimpan";
            header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
        } else {
            $_SESSION['error'] = "Data Gagal Disimpan";
            header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
        }
    }

    public function edit($id)
    {
        header('location:../view/' . view::MAHASISWA->value . '/edit.php?id=' . $id);
    }

    public function getOne($id)
    {
        $data = $this->mahasiswa->getWithUser($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function getByUser($id) {
        $data = $this->mahasiswa->getOneByUser($id);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo false;
        }
    }

    public function update($id)
    {
        $user = $_POST['user_id'];
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $telp = $_POST['telp'];
        $temp_lahir = $_POST['temp_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $img = $_FILES['img']['name'];
        if (empty($img)) {
            // var_dump("cek");
            $data = $this->mahasiswa->update($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat,  $id);
            if ($data == true) {
                $_SESSION['sukses'] = "data berhasil di Update";
                header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
            } else {
                $_SESSION['error'] = "data gagal di Update";
                header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
            }
        } else {
            $_SESSION['sukses'] = "data berhasil di Update";
            $path = "../src/img/mahasiswa/";
            $imgNama = $_FILES['img']['tmp_name'];
            $namaImg = $_FILES['img']['name'];
            move_uploaded_file($imgNama, $path . $namaImg);
            $data = $this->mahasiswa->updateImg($user, $nim, $nama, $kelas, $telp, $temp_lahir, $tgl_lahir, $alamat, $namaImg, $id);
            if ($data == true) {
                $_SESSION['sukses'] = "data berhasil di Update";
                header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
            } else {
                $_SESSION['error'] = "data gagal di Update";
                header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
            }
        }
    }

    public function hapus($id) {
        $data = $this->mahasiswa->hapus($id);
        if ($data == true) {
            $_SESSION['sukses'] = "data berhasil di Hapus";
            header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
        } else {
            $_SESSION['error'] = "data gagal di Hapus";
            header('location:../routes/route.php?page=mahasiswa&sub=managemahasiswa');
        }
    }
}
