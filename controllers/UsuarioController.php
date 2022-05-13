<?php 
// Cargar el Modelo de Usuarios
require_once 'models/usuario.php';

class usuarioController{

    public function index(){
        // Verificamos si es admin
        Utils::isAdmin();
        // Creamos un Modelo Usuario
        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once 'views/usuario/index.php';
    }

    public function sesion(){
        require_once 'views/usuario/sesion.php';
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){

        if( isset($_POST) ){

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if($nombre && $apellidos && $email && $password){

                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                if(isset($_FILES['imagen']))
                {
                    // Guardar la Imagen
                    $file = $_FILES['imagen'];  //Nombre puesto al input 'imagen'
                    $filename = $file['name'];  // Guardar el nombre del archivo
                    $mimetype = $file['type'];  // Guardar el tipo de archivo

                    // Validar
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){

                        // Validar si hay formulario para guardar imagen
                        if(!is_dir('uploads/users')){
                            // Crear directorio
                            mkdir('uploads/users', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/users/'.$filename);
                        // Guardar nombre en instancia
                        $usuario->setImagen($filename);
                    }
                }

                if(isset($_GET['id'])){
                    // Actualizar producto
                    $id = $_GET['id'];
                    $usuario->setId($id);
                    $rol = isset($_POST['rol']) ? $_POST['rol'] : false;
                    $usuario->setRol($rol);
                    $save = $usuario->edit();
                }
                else{
                    // Guardar usuario
                    $save = $usuario->save();
                }

                if($save){
                    $_SESSION['register'] = "Complete";

                    if( Utils::isAdmin() ){
                        header("Location:".base_url.'usuario/index');
                        Utils::deleteSession('register');
                    }
                    else{
                        header("Location:".base_url.'usuario/sesion');
                    }
                }
                else{
                    $_SESSION['register'] = "Failed";
                    header("Location:".base_url.'usuario/registro');
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

    public function login(){

        if( isset($_POST) ){
            // Identificar al usuario
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            // Consulta a la base de datos
            $identity = $usuario->login();

            // Crear una sesion
            if( $identity && is_object($identity) ){
                $_SESSION['identity'] = $identity;

                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
                header('Location:'.base_url.'usuario/index');
            }
            else{
                $_SESSION['error_login'] = "Identificación Fallida.";
                header('Location:'.base_url.'usuario/sesion');
            }
        }
    }

    public function logout(){
        if( isset($_SESSION['identity']) ){
            unset($_SESSION['identity']);
        }
        if( isset($_SESSION['admin']) ){
            unset($_SESSION['admin']);
        }
        header('Location:'.base_url);
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
            $usuario = new Usuario();
            $usuario->setId($id);

            $user = $usuario->getOne();
            // Cargar Vista
            require_once 'views/usuario/registro.php';
        }
        else{
            header('Location:'.base_url.'usuario/index');
        }
    }

    public function eliminar(){
        // Verificar ser admin
        Utils::isAdmin();

        if( isset($_GET['id']) ){
            // Obtener id
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $delete = $usuario->delete();

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
        header('Location:'.base_url.'usuario/index');
    }
}