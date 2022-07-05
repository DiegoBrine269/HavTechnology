DROP DATABASE havtechnology;
CREATE DATABASE havtechnology;

USE havtechnology;

  

CREATE TABLE Producto (
	id VARCHAR(20),
    nombre VARCHAR(40),
    descripcion TEXT,
    color VARCHAR(20),
    lote INT,
    stock INT
);

ALTER TABLE Producto
ADD CONSTRAINT pk_producto PRIMARY KEY (id);

INSERT INTO Producto VALUES('123', 'Producto', 'Bla bla bla', 'azul', 1, 1);

CREATE TABLE ProductoUnico(
	id VARCHAR(20),
    idUnico VARCHAR(30),
    existe BOOLEAN,
	idProveedor INT(10)
);

ALTER TABLE ProductoUnico
ADD CONSTRAINT pk_producto_unico PRIMARY KEY (idUnico);

ALTER TABLE ProductoUnico
ADD CONSTRAINT fk_producto_unico FOREIGN KEY (id) REFERENCES Producto(id);

ALTER TABLE ProductoUnico
ADD CONSTRAINT fk_producto_unico_proveedor FOREIGN KEY (idProveedor) REFERENCES Proveedor(id);

CREATE TABLE Proveedor (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    telefono CHAR(10),
    correo VARCHAR(30)
);

CREATE TABLE Cliente (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    RFC CHAR(13),
    dirFiscal VARCHAR(100),
    CP CHAR(5),
    usoCFDI INT(1),
    correo VARCHAR(30)
);

/*ALTER TABLE Cliente
ADD CONSTRAINT pk_cliente PRIMARY KEY (id);*/


CREATE TABLE Venta (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    idCliente INT(10),
    fecha DATE,
	total DECIMAL(10, 2)
);

/*ALTER TABLE Venta
ADD CONSTRAINT pk_venta PRIMARY KEY (id);*/

ALTER TABLE Venta
ADD CONSTRAINT fk_venta_cliente FOREIGN KEY (idCliente) REFERENCES Cliente(id);

DROP TABLE VentaProducto;
CREATE TABLE VentaProducto (
	idVenta INT(10),
    idProducto VARCHAR(20), /*idUnico*/
    cantidad INT(3)
);

ALTER TABLE VentaProducto
ADD CONSTRAINT pk_venta_producto PRIMARY KEY (idVenta, idProducto);

ALTER TABLE VentaProducto
ADD CONSTRAINT fk_venta_producto_venta FOREIGN KEY (idVenta) REFERENCES Venta(id);

ALTER TABLE sales_products
ADD CONSTRAINT fk_venta_producto_producto FOREIGN KEY (idProducto) REFERENCES unique_products(idUnico);


CREATE TABLE Devolucion (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    idVenta INT(10),
    perdidaTotal BOOLEAN
);

/*ALTER TABLE Devolucion
ADD CONSTRAINT pk_devolucion PRIMARY KEY (id);*/

ALTER TABLE Devolucion
ADD CONSTRAINT fk_devolucion_venta FOREIGN KEY (idVenta) REFERENCES Venta(id);

CREATE TABLE uso_cfdi (
	id CHAR(3),
    descripcion VARCHAR (100)
);

ALTER TABLE Customers
ADD CONSTRAINT fk_uso_cfdi FOREIGN KEY (usoCFDI) REFERENCES uso_cfdi(id);

