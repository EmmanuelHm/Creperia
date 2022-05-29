<?php 
// Cargar el modelo 'Producto'
require_once 'models/producto.php';

class buscadorController{

    public function index(){

        if( isset($_POST) && !empty($_POST) ){
            $search = isset($_POST['search']) ? $_POST['search'] : false;
            if($search){
                // Crear Modelo
                $producto = new Producto();
                $producto->setNombre($search);
                $productos = $producto->search();
            }
        }
        require_once 'views/buscador/index.php';
    }
}