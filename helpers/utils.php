<?php
class Utils{

    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            //header('Location:'.base_url);
            echo "<script>window.location='".base_url."';</script>";
        }
        else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            //header('Location:'.base_url);
            echo "<script>window.location='".base_url."';</script>";
        }
        else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }
        return $stats;
    }

    public static function showStatus($status){
        $value = 'Pendiente';

        if($status == 'confirm'){
            $value = 'Pendiente';
        }
        else if($status == 'preparation'){
            $value = 'En preparación';
        }
        else if($status == 'ready'){
            $value = 'Preparado para envío';
        }
        else if($status == 'sended'){
            $value = 'Enviado';
        }

        return $value;
    }

    public static function countProducts(){
        // Obtener Conexion DB
        $db = Database::connect();
        // Consulta
        $sql = "SELECT f.producto_id, p.nombre AS 'producto', SUM(f.cantidad) AS 'cantidad' FROM facturas f, productos p WHERE f.producto_id = p.id GROUP BY f.producto_id ORDER BY cantidad DESC LIMIT 10;";

        $productos = $db->query($sql);
        return $productos;
    }
}