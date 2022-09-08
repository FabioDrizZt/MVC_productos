<?php
namespace app;
class Router{

    public $getRoutes = [];
    public $postRoutes = [];
    public ?Database $database = null;

    public function __construct(Database $database){
        $this->database = $database;
    }

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
        if(!$fn){
            echo "ERROR 404: Page not found";
            exit;
        }
        call_user_func($fn, $this);

    }

    public function renderView($view, $params = []){ 
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once "views/$view.php";
        $contenido = ob_get_clean();
        include_once "views/_layout.php";
    }
}