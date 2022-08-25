<?php

namespace app\models;

class Producto{
    public $id = null;
    public $nombre = null;
    public $descripcion = null;
    public $precio = null;
    public $imagen = null;
    public $RutaImagen = null;

    public function cargar($datos){
        $this->id = $datos['id'] ?? null;
        $this->nombre = $datos['nombre'];
        $this->descripcion = $datos['descripcion'] ?? '';
        $this->precio = $datos['precio'];
        $this->imagen = $datos['imagen'] ?? null;
        $this->RutaImagen = $datos['RutaImagen'] ?? null;
    }

    public function guardar($datos){
        
    }
}