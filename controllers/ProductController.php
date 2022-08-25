<?php

namespace app\controllers;
use app\Router;

class ProductController{
    public static function index(Router $router){
        $buscar = $_GET['buscar'];
        $productos = $router->db->getProductos($buscar);
        $router->RenderView('index',[
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router){
        $errores = [];
        $datosProducto = [
            'nombre' => '',
            'descripcion' => '',
            'imagen' => '',
            'precio' => ''
        ];
        
        if ($_SERVER["REQUEST_METHOD"]=='POST'){
            $datosProducto['nombre'] = $_POST['nombre'];
            $datosProducto['descripcion'] = $_POST['descripcion'];
            $datosProducto['imagen'] = $_POST['imagen'];
            $datosProducto['precio'] = $_POST['precio'];
        } else {
            $router->RenderView('crear',[
                'producto' => $datosProducto,
                'errores' => $errores
            ]);
        }
    }

    public static function editar(){
        echo "estoy en el editar";
    }

    public static function borrar(){
        echo "estoy en el borrar";
    }

}