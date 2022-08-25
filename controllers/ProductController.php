<?php

namespace app\controllers;
use app\Router;

class ProductController{
    public static function index(Router $router){
        $productos = $router->db->getProductos();
        echo "<pre>";
        var_dump($productos);
        echo "</pre>";
        $router->RenderView('index');
    }

    public static function crear(){
        echo "estoy en el crear";
    }

    public static function editar(){
        echo "estoy en el editar";
    }

    public static function borrar(){
        echo "estoy en el borrar";
    }

}