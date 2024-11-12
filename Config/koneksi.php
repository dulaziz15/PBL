<?php
namespace Pbl\Config;
use PDO;

class koneksi {

    public function KoneksiDB() {
        $conn = new PDO("sqlsrv:server=LAPTOP-60DUFOCJ\SQLEXPRESS;database=BebasTanggunganDB");
        return $conn;
    }

}

?>