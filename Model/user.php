<?php
namespace Pbl\Model;
use Pbl\Config\koneksi;
session_start();

class user {
    private $koneksi;

    public function __construct(){
        $this->koneksi = new Koneksi();
    }

    public function validasi_nim($nim, $password) {
        $query = "select * from dbo.Users where username = '$nim' and password = '$password'";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        if(empty($result) == true) {
            $_SESSION['error'] = "Nim atau Password salah";
            return false;
        } else {
            $_SESSION['user'] = $result;
            return true;
        }
    }

    public function addUser($username, $email, $password, $role) {
        $query = "INSERT INTO Users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";
        $data = $this->koneksi->KoneksiDB()->query($query);
        if($data == true) {
            return true;
        } else {
            return false;
        }
    }

    public function getAll() {
        $query = "SELECT * FROM Users";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetchAll();
        return $result;
    }

    public function getOne($id) {
        $query = "SELECT * FROM Users WHERE user_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        $result = $data->fetch();
        return $result;
    }

    public function update($id, $username, $email, $password, $role) {
        $query = "UPDATE Users SET username = '$username', email = '$email', password = '$password', role = '$role' WHERE user_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        if($data == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $query = "DELETE FROM Users WHERE user_id = $id";
        $data = $this->koneksi->KoneksiDB()->query($query);
        if($data == true) {
            return true;
        } else {
            return false;
        }
    }
}