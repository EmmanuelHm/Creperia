<?php 
// Cargar el Modelo de Usuarios
require_once 'models/categoria.php';

class categoriaController{

    public function index(){
        // Verificamos si es admin
        Utils::isAdmin();
        // Creamos un Modelo Categoria
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function form(){
        // Verificamos si es admin
        Utils::isAdmin();
        require_once 'views/categoria/form.php';
    }

    public function save(){

        if( isset($_POST) ){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;

            if($nombre){

                $categoria = new Categoria();
                $categoria->setNombre($nombre);

                if(isset($_FILES['imagen']))
                {
                    // Guardar la Imagen
                    $file = $_FILES['imagen'];  //Nombre puesto al input 'imagen'
                    $filename = $file['name'];  // Guardar el nombre del archivo
                    $mimetype = $file['type'];  // Guardar el tipo de archivo

                    // Validar
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                        // Validar si hay formulario para guardar imagen
                        if(!is_dir('uploads/categories')){
                            // Crear directorio
                            mkdir('uploads/categories', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/categories/'.$filename);
                        // Guardar nombre en instancia
                        $categoria->setImagen($filename);
                    }
                }

                if(isset($_GET['id'])){
                    // Actualizar categoria
                    $id = $_GET['id'];
                    $categoria->setId($id);
                    $save = $categoria->edit();
                }
                else{
                    // Guardar usuario
                    $save = $categoria->save();
                }

                if($save){
                    $_SESSION['register'] = "Complete";

                    if( Utils::isAdmin() ){
                        //header("Location:".base_url.'categoria/index');
                        echo "<script>window.location='".base_url."categoria/index';</script>";
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
            $categoria = new Categoria();
            $categoria->setId($id);

            $cat = $categoria->getOne();
            // Cargar Vista
            require_once 'views/categoria/form.php';
        }
        else{
            //header('Location:'.base_url.'categoria/index');
            echo "<script>window.location='".base_url."categoria/index';</script>";
        }
    }

    public function eliminar(){
        // Verificar ser admin
        Utils::isAdmin();

        if( isset($_GET['id']) ){
            // Obtener id
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);

            $delete = $categoria->delete();

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
        //header('Location:'.base_url.'categoria/index');
        echo "<script>window.location='".base_url."categoria/index';</script>";
    }
}