<?php

class Categoria{
    private $id;
    private $nombre;
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

    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    // Methods
    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()};");
        return $categoria->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}'";
        if($this->getImagen() != null){
            $sql.=", '{$this->getImagen()}');";
            // printf($sql);
            // die();
        }else{
            $sql.=", null);";
            // printf($sql);
            // die();
        }
        // printf($sql);
        // die();
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE categorias SET nombre = '{$this->getNombre()}'";

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
        $sql = "DELETE FROM categorias WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}