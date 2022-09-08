<?php

namespace app;

use app\models\Producto;
use PDO;

class Database {
    public $pdo = null;
    public static ?Database $db = null;

    public function __construct(){
        $connectionString = "mysql:host=localhost; port=3306; dbname=crud_productos";
        $user = "root";
        $pass = "";
        $this->pdo = new PDO($connectionString, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProductos($buscar = '') {
        if ($buscar) {
            $consulta = $this->pdo->prepare("SELECT * FROM productos WHERE nombre LIKE :nombre");
            $consulta->bindValue(':nombre', "%$buscar%");
        } else {
            $consulta = $this->pdo->prepare("SELECT * FROM productos ORDER BY id DESC");
        }
        $consulta->execute();

        return $consulta->fetchAll(pdo::FETCH_ASSOC);
    }

    public function getProductoPorId($id)
    {
        $consulta = $this->pdo->prepare('SELECT * FROM productos WHERE id = :id');
        $consulta->bindValue(':id', $id);
        $consulta->execute();

        return $consulta->fetch(pdo::FETCH_ASSOC);
    }

    public function borrarProducto($id)
    {
        $consulta = $this->pdo->prepare('DELETE FROM productos WHERE id = :id');
        $consulta->bindValue(':id', $id);

        return $consulta->execute();
    }

    public function actualizarProducto(Producto $producto)
    {
        $consulta = $this->pdo->prepare("UPDATE productos SET nombre = :nombre, 
                                        imagen = :imagen, 
                                        description = :description, 
                                        price = :price WHERE id = :id");
        $consulta->bindValue(':nombre', $producto->nombre);
        $consulta->bindValue(':imagen', $producto->rutaImagen);
        $consulta->bindValue(':precio', $producto->precio);
        $consulta->bindValue(':descripcion', $producto->descripcion);
        $consulta->bindValue(':id', $producto->id);

        $consulta->execute();
    }

    public function crearProducto(Producto $producto){
        $consulta = $this->pdo->prepare("INSERT INTO productos(nombre, imagen, precio, descripcion)
        VALUE(:nombre, :imagen, :precio, :descripcion)");
        $consulta->bindValue(":nombre", $producto->nombre);
        $consulta->bindValue(":imagen", $producto->rutaImagen);
        $consulta->bindValue(":precio", $producto->precio);
        $consulta->bindValue(":descripcion", $producto->descripcion);
        $consulta->execute();
    }
}


