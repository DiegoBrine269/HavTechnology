CREATE DATABASE havtechnology;

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
    stock INT,
    idProveedor INT
);

CREATE TABLE ProductoUnico(
	id VARCHAR(20),
    idUnico VARCHAR(30),
    existe BOOLEAN
);

CREATE TABLE Cliente (
	nombre VARCHAR(40),
    RFC CHAR(13),
    dirFiscal VARCHAR(100),
    CP INT(5),
    usoCFDI INT(1),
    correo VARCHAR(30) 
);