<?php
require_once 'models/producto.php';

class inicioController{
    public function index(){
        // Crear Modelo Producto
        $producto = new Producto();
        $productos = $producto->getRandom(8);
        
        require_once 'views/inicio/index.php'; 
    }
}
