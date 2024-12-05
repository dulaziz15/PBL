<?php
namespace Pbl\Config;
use PDO;

class Koneksi {

    public function KoneksiDB() {
        $conn = new PDO("sqlsrv:server=NOF\SQLEXPRESS;database=BebasTanggunganDB");
        return $conn;
    }
}

?>
