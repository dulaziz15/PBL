<?php

namespace Pbl\Model;

use Pbl\Config\koneksi;
use Pbl\Core\Model;
use Pbl\Enums\status;
use Pbl\Enums\tugas_akhir;
use PDOException;

class TugasAkhir extends Model
{

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

    public function getAllVerify()
    {
        $query = "SELECT * from Tugas_akhir as ta inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where status_tugas_akhir = '" . status::APPROVED->value . "' order by ta.tugas_akhir_id desc";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function add($file, $mahasiswa, $judul) {
        try {
            $query = "INSERT INTO Tugas_akhir (mahasiswa_id, judul, file_project, status_tugas_akhir) VALUES
                    ('$mahasiswa', '$judul', '" . $_FILES['fileproject']['name'] . "', '" . status::PENDING->value . "')";
            $data = $this->koneksi->KoneksiDB();
            $data->query($query);
            $tugas_akhir_id = $data->lastInsertId();
            $query_dokumen = "INSERT INTO Dokumen_tugas_akhir (tugas_akhir_id, nama_file, bagian, status_dokumen_ta) VALUES
                        ('$tugas_akhir_id', '" . $file["pendahuluan"]["name"] . "', '" . tugas_akhir::PENDAHULUAN->value . "', '" . status::PENDING->value . "'),
                        ('$tugas_akhir_id', '" . $file["abstrak"]["name"] . "', '" . tugas_akhir::ABSTRAK->value . "', '" . status::PENDING->value . "'),
                        ('$tugas_akhir_id', '" . $file["isi"]["name"] . "', '" . tugas_akhir::ISI->value . "', '" . status::PENDING->value . "'),
                        ('$tugas_akhir_id', '" . $file["daftarpustaka"]["name"] . "', '" . tugas_akhir::DAFTAR_PUSTAKA->value . "', '" . status::PENDING->value . "'),
                        ('$tugas_akhir_id', '" . $file["lampiran"]["name"] . "', '" . tugas_akhir::LAMPIRAN->value . "', '" . status::PENDING->value . "')";
            $dataDokumen = $this->koneksi->KoneksiDB()->query($query_dokumen);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function update($id) {
        $judul = $_POST['judul'];
        try {
            $query = "UPDATE Tugas_akhir SET judul = '$judul'";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getNIMbyDokumen($id) {
        $query = "select NIM, ta.tugas_akhir_id from Dokumen_tugas_akhir as dok inner join Tugas_akhir as ta on ta.tugas_akhir_id = dok.tugas_akhir_id inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id where dok.dokumen_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function updateDokumenTA($id, $file) {
        try {
            $query = "UPDATE Dokumen_tugas_akhir SET nama_file = '" . $file['name'] . "'WHERE dokumen_id = $id";
            $this->koneksi->KoneksiDB()->query($query);
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

    public function getOneCatatan($id) {
        $query = "SELECT * FROM Catatan_TA WHERE catatan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getOneDokumen($id) {
        $query = "SELECT * FROM Dokumen_tugas_akhir as dta inner join Tugas_akhir as ta on ta.tugas_akhir_id = dta.tugas_akhir_id
                    inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id WHERE dokumen_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function addCatatan($id, $user, $catatan, $tanggal) {
        try {
            $query = "INSERT INTO Catatan_TA (dokumen_id, user_id, catatan, tanggal, status_catatan_ta) VALUES ('$id', '$user', '$catatan', '$tanggal', '" . status::PENDING->value . "')";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
        

    }

    public function rejectedTA($id) {
        try {
            $sql = "UPDATE Dokumen_tugas_akhir SET status_dokumen_ta = '" . status::REJECTED->value . "' Where dokumen_id = '$id'";
            $data = $this->koneksi->KoneksiDB()->query($sql);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getCatatanTA($id) {
        $query = "SELECT * FROM Catatan_TA where dokumen_id = '$id'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }


    public function updateCatatan($id, $catatan) {
        $query = "UPDATE Catatan_TA SET catatan = '$catatan' WHERE catatan_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        return true;
    }

    public function validateCatatan($id) {
        $query = "SELECT * FROM Catatan_TA WHERE dokumen_id = $id AND status_catatan_ta != '" . status::APPROVED->value . "'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function validateCatatanPending($id) {
        $query = "SELECT * FROM Catatan_TA WHERE dokumen_id = $id AND status_catatan_ta = '" . status::PENDING->value . "'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function validateTA($id) {
        $query = "SELECT * FROM Dokumen_tugas_akhir WHERE tugas_akhir_id = $id AND status_dokumen_ta != '" . status::APPROVED->value . "'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function verifikasiCatatan($id): bool {
        try{
            $query = "UPDATE Catatan_TA SET status_catatan_ta = '" . status::APPROVED->value ."' WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function pengajuanCatatan($id) {
        try{
            $query = "UPDATE Catatan_TA SET status_catatan_ta = '" . status::PENGAJUAN->value ."' WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function hapusCatatan($id) {
        try {
            $query = "DELETE FROM Catatan_TA WHERE catatan_id = $id";
            $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function changePending($id) {
        try{
            $query = "UPDATE Catatan_TA SET status_catatan_ta = '" . status::PENDING->value ."' WHERE catatan_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function verifikasi($id) {
        try {
            $query = "UPDATE Dokumen_tugas_akhir SET status_dokumen_ta = '" . status::APPROVED->value . "' WHERE dokumen_id = $id";
            $data = $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function updateStatusTA($id) {
        try {
            $query = "UPDATE Tugas_akhir SET status_tugas_akhir = '" . status::APPROVED->value . "' WHERE tugas_akhir_id = $id";
            $this->koneksi->KoneksiDB()->query($query);
            return true;
        } catch(PDOException $e) {
            return false;
        }
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

    public function getOneMahasiswa($id) {
        $query = "SELECT * FROM Tugas_akhir as ta inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id Where ta.mahasiswa_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function getTAMahasiswa($id) {
        $query = "SELECT * FROM Tugas_akhir as ta inner join Mahasiswa as mhs on mhs.mahasiswa_id = ta.mahasiswa_id inner join Users as usr on usr.user_id = mhs.user_id Where usr.user_id = '$id'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }
}
