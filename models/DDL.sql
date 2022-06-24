CREATE DATABASE havtechnology;

USE havtechnology;

CREATE TABLE Admin (
	usuario VARCHAR(30) PRIMARY KEY,
    password char(60),
    rol INT(1) /*1 si es root, 0 si es Adrián*/
);

CREATE TABLE Producto (
	id VARCHAR(20),
    nombre VARCHAR(40),
    descripcion TEXT,
    color VARCHAR(20),
    lote INT,
    stock INT
);

ALTER TABLE Producto
ADD CONSTRAINT fk_producto_unico FOREIGN KEY (id) REFERENCES ProductoUnico(id);

CREATE TABLE ProductoUnico(
	id VARCHAR(20),
    idUnico VARCHAR(30),
    existe BOOLEAN,
	idProveedor INT(10)
);

ALTER TABLE ProductoUnico
ADD CONSTRAINT pk_producto_unico PRIMARY KEY (id);

CREATE TABLE Proveedor (
	id INT(10),
    nombre VARCHAR(40),
    telefono CHAR(10),
    correo VARCHAR(30)
);

CREATE TABLE Cliente (
    id INT(10),
    nombre VARCHAR(40),
    RFC CHAR(13),
    dirFiscal VARCHAR(100),
    CP INT(5),
    usoCFDI INT(1),
    correo VARCHAR(30)
);

ALTER TABLE Cliente
ADD CONSTRAINT pk_cliente PRIMARY KEY (id);


CREATE TABLE Venta (
	id INT(10),
    idCliente INT(10),
    fecha DATE,
	total DECIMAL(10, 2)
);

ALTER TABLE Venta
ADD CONSTRAINT pk_venta PRIMARY KEY (id);

ALTER TABLE Venta
ADD CONSTRAINT fk_venta_cliente FOREIGN KEY (idCliente) REFERENCES Cliente(id);

CREATE TABLE VentaProducto (
	idVenta INT(10),
    idProducto VARCHAR(20),
    cantidad INT(3)
);

ALTER TABLE VentaProducto
ADD CONSTRAINT pk_venta_producto PRIMARY KEY (idVenta, idProducto);

ALTER TABLE VentaProducto
ADD CONSTRAINT fk_venta_producto_venta FOREIGN KEY (idVenta) REFERENCES Venta(id);

ALTER TABLE VentaProducto
ADD CONSTRAINT fk_venta_producto_producto FOREIGN KEY (idProducto) REFERENCES Producto(id);


CREATE TABLE Devolucion (
	id INT(10),
    idVenta INT(10),
    perdidaTotal BOOLEAN
);

ALTER TABLE Devolucion
ADD CONSTRAINT pk_devolucion PRIMARY KEY (id);

ALTER TABLE VentaProducto
ADD CONSTRAINT fk_devolucion_venta FOREIGN KEY (idVenta) REFERENCES Devolucion(id);
