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

        
    }
}