<?php

class Pedido{
    private $id;
    private $direccion;
    private $colonia;
    private $municipio;
    private $telefono;
    private $total;
    private $estatus;
    private $fecha;
    private $hora;
    private $usuario_id;
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

    public function getDireccion(){
        return $this->direccion;
    }
    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function getColonia(){
        return $this->colonia;
    }
    public function setColonia($colonia){
        $this->colonia = $this->db->real_escape_string($colonia);
    }

    public function getMunicipio(){
        return $this->municipio;
    }
    public function setMunicipío($municipio){
        $this->municipio = $this->db->real_escape_string($municipio);
    }

    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono = $this->db->real_escape_string($telefono);
    }

    public function getTotal(){
        return $this->total;
    }
    public function setTotal($total){
        $this->total = $total;
    }

    public function getEstatus(){
        return $this->estatus;
    }
    public function setEstatus($estatus){
        $this->estatus = $estatus;
    }

    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getHora(){
        return $this->hora;
    }
    public function setHora($hora){
        $this->hora = $hora;
    }

    public function getUsuarioId(){
        return $this->usuario_id;
    }
    public function setUsuarioId($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    // Methods
    public function getAll(){
        $productos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC;");
        return $productos;
    }

    public function getOne(){
        $producto = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()};");
        return $producto->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.total FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC LIMIT 1";

        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
                //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
                . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY id DESC";

        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductosByPedido($id){
        // $sql = "SELECT * FROM productos WHERE id IN "
        //         . "(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id} )";

        $sql = "SELECT pr.*, f.cantidad FROM productos pr "
                . "INNER JOIN facturas f ON pr.id = f.producto_id "
                . "WHERE f.pedido_id = {$id}";
    
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(null, '{$this->getDireccion()}', '{$this->getColonia()}', '{$this->getMunicipio()}','{$this->getTelefono()}', {$this->getTotal()}, 'confirm', CURDATE(), CURTIME(), {$this->getUsuarioId()} )";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];

            $insert = "INSERT INTO facturas VALUES(null, {$elemento['unidades']}, {$pedido_id}, {$producto->id} )";
            $save = $this->db->query($insert);
        }

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE pedidos SET estatus='{$this->getEstatus()}' ";
        $sql .= " WHERE id = {$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
}