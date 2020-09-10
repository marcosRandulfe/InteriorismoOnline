DROP DATABASE IF EXISTS CARPINTERIA;
CREATE DATABASE IF NOT EXISTS CARPINTERIA;
USE CARPINTERIA;

CREATE TABLE usuarios(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(20) UNIQUE,
        passwd VARCHAR(20),
        CONSTRAINT U_USUARIOS UNIQUE(nombre,passwd)
);

CREATE TABLE clientes(
        id INT AUTO_INCREMENT PRIMARY KEY,
        dni CHAR(9) UNIQUE,
        nombre_completo VARCHAR(40),
        calle VARCHAR(20),
        numero INT,
        piso CHAR,
        CONSTRAINT FK_CLIENTE_USUARIO FOREIGN KEY (id) REFERENCES usuarios(id)
);

CREATE TABLE admins(
        id INT PRIMARY KEY,
        roles VARCHAR(20),
        CONSTRAINT FK_ADMINS_USUARIOS FOREIGN KEY(id) REFERENCES usuarios(id)
);

CREATE TABLE productores(
        id INT PRIMARY KEY,
        infotpv VARCHAR(20),
        direccion VARCHAR(20),
        CONSTRAINT FK_PRODUCT_USUARIOS FOREIGN KEY(id) REFERENCES usuarios(id)
);

CREATE TABLE pedidos(
        num_pedido INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT,
        id_productor INT,
        nombre VARCHAR(20),
        descripcion VARCHAR(50),
        desing_state BOOLEAN,
        factory_state BOOLEAN,
        ruta_modelo VARCHAR(30),
        precio decimal(15,2),
        CONSTRAINT FK_PEDIDOS_CLIENTES FOREIGN KEY (id_usuario) REFERENCES clientes(id)
);

/*CONSTRAINT FK_PEDIDOS_PRODUCTORES FOREIGN KEY (id_usuario) REFERENCES productores(id)*/

CREATE TABLE fotos_cliente(
        num_pedido INTEGER,
        num_foto INTEGER AUTO_INCREMENT UNIQUE,
        url_foto VARCHAR(30),
        CONSTRAINT pk_fotos_clientes PRIMARY KEY(num_pedido,num_foto),
        CONSTRAINT fk_fotos_clientes FOREIGN KEY(num_pedido) REFERENCES pedidos(num_pedido)
);


INSERT INTO usuarios VALUES(-1,'producer','producer');
INSERT INTO productores VALUES(-1,'xxxxx','varlovento 6');
INSERT INTO usuarios VALUES(1,'admin','admin');
INSERT INTO admins VALUES(1,'general_admin');
INSERT INTO usuarios VALUES(2,'producer_admin','producer_admin');
INSERT INTO admins VALUES(2,'producer_admin');
INSERT INTO usuarios VALUES(3,'user_admin','user_admin');
INSERT INTO admins VALUES(3,'user_admin');