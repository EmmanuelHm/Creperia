<?php 

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    // Constructor
    public function __construct(){
        $this->db = Database::connect();
    }

    // Getters & Setters
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword(){
        return password_hash( $this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4] );
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    // Methods
    public function save(){
        $result = false;

        // Comprobar si existe el email
        $email = $this->email;
        $sql = "SELECT * FROM usuarios WHERE email = '$email' ";
        $verify_email = $this->db->query($sql);

        if($verify_email && $verify_email->num_rows == 1){
            return false;
        }
        else{
            // Insertar 
            $sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user'";

            if($this->getImagen() != null){
                $sql.=", '{$this->getImagen()}');";
            }
            else{
                $sql.=", null);";
            }

            // printf($sql);
            // die();

            $save = $this->db->query($sql);

            if($save){
                $result = true;
            }
            return $result;
        }

    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email' ";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            // Verificar la contraseña
            $verify = password_verify($password, $usuario->password);

            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }

    public function getAll(){
        $usuarios = $this->db->query("SELECT * FROM usuarios ORDER BY id DESC LIMIT 12");
        return $usuarios;
    }

    public function getOne(){
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE id = {$this->getId()}");
        return $usuario->fetch_object();
    }

    public function edit(){
        $sql = "UPDATE usuarios SET nombre = '{$this->getNombre()}', apellidos = '{$this->getApellidos()}', email = '{$this->getEmail()}', password = '{$this->getPassword()}', rol = '{$this->getRol()}'";

        if($this->getImagen() != null){
            $sql.=", imagen = '{$this->getImagen()}'";
        }
        $sql.=" WHERE id = {$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM usuarios WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}