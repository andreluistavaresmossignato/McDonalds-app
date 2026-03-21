<?php
namespace App\Model;

use App\Database\Connection;
use PDO;

class Lista {
    public function listarIngredientes() {
        $sql = "SELECT * FROM ingredientes";
        $stmt = Connection::getConn()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}