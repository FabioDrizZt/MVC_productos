<?php

namespace app\models;
use app\Database;
use app\helpers\UtilHelper;

class Producto{
    public ?int $id = null;
    public string $nombre;
    public string $descripcion;
    public float $precio;
    public array $imagen;
    public ?string $rutaImagen = null;

    public function cargar($datos){
        $this->id = $datos['id'] ?? null;
        $this->nombre = $datos['nombre'];
        $this->descripcion = $datos['descripcion'];
        $this->precio = $datos['precio'];
        $this->imagen = $datos['imagen'];
        $this->rutaImagen = $datos['RutaImagen'] ?? null;
    }

    public function guardar(){
        $errores = [];
        if (!is_dir('img')) { // Si no existe la carpeta img se la crea
            mkdir('img');
        }
        if (!$_POST['nombre']) {
            $errores[] = "El nombre del producto es obligatorio";
        }

        if (!$_POST['precio'] or $_POST['precio'] < 0) {
            $errores[] = "El precio del producto es obligatorio y debe ser positivo";
        }


        if ($this->imagen && $this->imagen['tmp_name']) {
            if ($this->rutaImagen) {
                unlink(__DIR__ . '/../public/' . $this->rutaImagen);
            }
            $this->rutaImagen = 'img/' . UtilHelper::randomString(8) . '/' . $this->imagen["name"]; #ruta aleatoria de la imagen
            mkdir(dirname($this->rutaImagen));
            move_uploaded_file($this->imagen['tmp_name'], $this->rutaImagen);
        }

        $db = Database::$db;
        if($this->id){
            $db->actualizarProducto($this);
        }else{
            $db->crearProducto($this);
        }        
    }
}