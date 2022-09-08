<?php

namespace app\controllers;
use app\Router;
use app\models\Producto;

class ProductController{
    public static function index(Router $router){
        $buscar = $_GET['buscar'];
        $productos = $router->database->getProductos($buscar);
        $router->RenderView('productos/index',[
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router){
        $datosProducto = [
            'imagen' => '',
        ];
        
        if ($_SERVER["REQUEST_METHOD"]=='POST'){
            $datosProducto['nombre'] = $_POST['nombre'];
            $datosProducto['descripcion'] = $_POST['descripcion'];
            $datosProducto['imagen'] = $_POST['imagen'];
            $datosProducto['precio'] = $_POST['precio'];

            $producto = new Producto();
            $producto->cargar($datosProducto);
            $producto->guardar();
            header('Location: /productos');
            exit;
        }
        $router->RenderView('productos/crear',[
            'producto' => $datosProducto,
        ]);
    }

    public static function actualizar(Router $router){
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /productos');
            exit;
        }
        $datosProducto = $router->database->getProductoPorId($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datosProducto['nombre'] = $_POST['nombre'];
            $datosProducto['descripcion'] = $_POST['descripcion'];
            $datosProducto['precio'] = $_POST['precio'];
            $datosProducto['imagen'] = $_FILES['image'] ?? null;

            $producto = new Producto();
            $producto->cargar($datosProducto);
            $producto->guardar();
            header('Location: /productos');
            exit;
        }

        $router->renderView('productos/actualizar', [
            'producto' => $datosProducto
        ]);    
    }

    public static function borrar(Router $router){
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /productos');
            exit;
        }

        if ($router->database->borrarProducto($id)) {
            header('Location: /productos');
            exit;
        }
    }

}