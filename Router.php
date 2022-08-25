<?php

namespace app;
class Router{

    public $getRoutes = [];
    public $postRoutes = [];

    public function get($url,$fn){
        $this->getRoutes[$url]=$fn;
    }

    public function post($url,$fn){
        $this->postRoutes[$url]=$fn;
    }

    public function resolve(){
        $url = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo == "GET"){
            $fn = $this->getRoutes[$url];
        } else {
            $fn = $this->postRoutes[$url];
        }
        if($fn){
            call_user_func($fn, $this);
        } else {
            echo "ERROR 404: Page not found";
        }
    }

    public function RenderView($view){
        include_once "views/$view.php";
    }
}