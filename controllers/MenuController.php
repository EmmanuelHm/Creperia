<?php

// Cargar el modelo Categoria
require_once 'models/categoria.php';
// Cargar modelo de Productos;
require_once 'models/producto.php';

class menuController{
    public function index(){
        // Cargar categorias
        $categorias = Utils::showCategorias();
        require_once 'views/menu/index.php'; 
    }

    public function listar(){
        if(isset($_GET['id'])){

            // Conseguir la categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getOne();

            // Conseguir Productos
            $producto = new Producto();
            $producto->setCategoriaId($id);
            $productos = $producto->getAllCategory();

        }
        require_once 'views/menu/listar.php';
    }
}