<?php
namespace Pbl\Config;
use PDO;

class Koneksi {

    public function KoneksiDB() {
        $conn = new PDO("sqlsrv:server=LAPTOP-60DUFOCJ\SQLEXPRESS;database=BebasTanggunganDB");
        return $conn;
    }

}

?>