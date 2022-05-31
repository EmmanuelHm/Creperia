<?php 
// Cargar el Modelo de Usuarios
require_once 'models/producto.php';

class productoController{

    public function index(){
        // Verificamos si es admin
        Utils::isAdmin();
        // Creamos un Modelo Usuario
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/index.php';
    }

    public function form(){
        // Verificamos si es admin
        Utils::isAdmin();
        require_once 'views/producto/form.php';
    }

    public function info(){
        // Verificamos si es admin
        Utils::isAdmin();
        $productos = Utils::countProducts();
        require_once 'views/producto/info.php';
    }

    public function save(){

        if( isset($_POST) ){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;

            if($nombre && $descripcion && $precio && $categoria_id){

                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setCategoriaId($categoria_id);

                if(isset($_FILES['imagen']))
                {
                    // Guardar la Imagen
                    $file = $_FILES['imagen'];  //Nombre puesto al input 'imagen'
                    $filename = $file['name'];  // Guardar el nombre del archivo
                    $mimetype = $file['type'];  // Guardar el tipo de archivo

                    // Validar
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                        // Validar si hay formulario para guardar imagen
                        if(!is_dir('uploads/products')){
                            // Crear directorio
                            mkdir('uploads/products', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/products/'.$filename);
                        // Guardar nombre en instancia
                        $producto->setImagen($filename);
                    }
                }

                if(isset($_GET['id'])){
                    // Actualizar producto
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                }
                else{
                    // Guardar producto
                    $save = $producto->save();
                }

                if($save){
                    $_SESSION['register'] = "Complete";

                    if( Utils::isAdmin() ){
                        //header("Location:".base_url.'producto/index');
                        echo "<script>window.location='".base_url."producto/index';</script>";
                        Utils::deleteSession('register');
                    }
                    else{
                        //header("Location:".base_url.'usuario/sesion');
                        echo "<script>window.location='".base_url."usuario/sesion';</script>";
                    }
                }
                else{
                    $_SESSION['register'] = "Failed";
                    //header("Location:".base_url.'usuario/registro');
                    echo "<script>window.location='".base_url."usuario/registro';</script>";
                }
            }
            else{
                $_SESSION['register'] = "Failed";
            }       
        }
        else{
            $_SESSION['register'] = "Failed";
        }
    }

    public function editar(){
        // Verificar ser admin
        Utils::isAdmin();
        // Comprobar si llega el id por la URL
        if(isset($_GET['id'])){
            // Crear variable id
            $id = $_GET['id'];
            // Crear variable edit
            $edit = true;

            // Crear Instancia
            $producto = new Producto();
            $producto->setId($id);

            $prod = $producto->getOne();
            // Cargar Vista
            require_once 'views/producto/form.php';
        }
        else{
            //header('Location:'.base_url.'producto/index');
            echo "<script>window.location='".base_url."producto/index';</script>";
        }
    }

    public function eliminar(){
        // Verificar ser admin
        Utils::isAdmin();

        if( isset($_GET['id']) ){
            // Obtener id
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();

            if($delete){
                $_SESSION['delete'] = 'Completed';
            }
            else{
                $_SESSION['delete'] = 'Failed';
            }
        }
        else{
            $_SESSION['delete'] = 'Failed';

        }
        //header('Location:'.base_url.'producto/index');
        echo "<script>window.location='".base_url."producto/index';</script>";
    }
}