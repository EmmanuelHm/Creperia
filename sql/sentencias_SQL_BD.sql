CREATE DATABASE creperia;

USE crepería;

-- USUARIOS
CREATE TABLE usuarios(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20),
    imagen VARCHAR(255),

    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)

)ENGINE=InnoDb;

-- CATEGORIAS
CREATE TABLE categorias(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    imagen VARCHAR(255),

    CONsTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

-- PRODUCTOS
CREATE TABLE productos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion MEDIUMTEXT,
    precio FLOAT(100,2) NOT NULL,
    fecha DATE NOT NULL,
    imagen VARCHAR(255),
    categoria_id INT(255) NOT NULL,

    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)

)ENGINE=InnoDb;

-- PEDIDOS
CREATE TABLE pedidos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    colonia VARCHAR(100) NOT NULL,
    municipio VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    total FLOAT(100,2) NOT NULL,
    estatus VARCHAR(45),
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    usuario_id INT(255) NOT NULL,

    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)

)ENGINE=InnoDb;

-- FACTURAS
CREATE TABLE facturas(
    id INT(255) AUTO_INCREMENT NOT NULL,
    cantidad INT(255)NOT NULL,
    pedido_id INT(255) NOT NULL,
    producto_id INT(255) NOT NULL,

    CONSTRAINT pk_facturas PRIMARY KEY(id),
    CONSTRAINT fk_facturas_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_facturas_producto FOREIGN KEY(producto_id) REFERENCES productos(id)

)ENGINE=InnoDb;