<?php
namespace Dulaz\Config;
use PDO;

class koneksi {

    public function KoneksiDB() {
        $conn = new PDO("sqlsrv:server=LAPTOP-60DUFOCJ\SQLEXPRESS;database=BebasTanggunganTADB");
        return $conn;
    }

}

?>