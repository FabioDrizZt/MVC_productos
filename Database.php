<?php

namespace app;

use PDO;

class Database {
    public $connectionString = "mysql:host=localhost; port=3306; dbname=crud_productos";
    public $user = "root";
    public $pass = "";
    public $pdo = null;

    public function __construct(){
        $this->PDO = new PDO($this->connectionString, $this->user, $this->pass);
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getProductos($buscar = '') {
    if ($buscar) {
        $consulta = $this->PDO->prepare("SELECT * FROM productos WHERE nombre LIKE :nombre");
        $consulta->bindValue(':nombre', "%$buscar%");
    } else {
        $consulta = $this->PDO->prepare("SELECT * FROM productos ORDER BY id DESC");
    }
    $consulta->execute();
    return $consulta->fetchAll(pdo::FETCH_ASSOC);
    }
}


