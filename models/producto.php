<?php

class Producto{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $fecha;
    private $imagen;
    private $categoria_id;
    private $db;

    // Constructor
    public function __construct(){
        $this->db = Database::connect();
    }

    // Getters && Setters
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

    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getPrecio(){
        return $this->precio;
    }
    public function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getImagen(){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getCategoriaId(){
        return $this->categoria_id;
    }
    public function setCategoriaId($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    // Methods
    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
        return $productos;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoriaId()} "
                . "ORDER BY id ASC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne(){
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()};");
        return $producto->fetch_object();
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO productos VALUES(null, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, CURDATE()";
        if($this->getImagen() != null){
            $sql.=", '{$this->getImagen()}'";
        }
        else{
            $sql.=", null";
        }
        $sql.=", {$this->getCategoriaId()} );";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE productos SET nombre = '{$this->getNombre()}', descripcion = '{$this->getDescripcion()}', precio = {$this->getPrecio()}, categoria_id ={$this->getCategoriaId()}";

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
        $sql = "DELETE FROM productos WHERE id = {$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    public function search(){
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$this->getNombre()}%' ORDER BY id DESC";
        $res = $this->db->query($sql);
        return $res;
    }
}