DROP DATABASE havtechnology;
CREATE DATABASE havtechnology;

USE havtechnology;

CREATE TABLE products (
	id VARCHAR(20),
    nombre VARCHAR(40),
    descripcion TEXT,
    color VARCHAR(20),
    stock INT,
    precioVenta DECIMAL(5, 2)
);
ALTER TABLE products
ADD COLUMN imagen VARCHAR(100) AFTER id;

ALTER TABLE products
ADD CONSTRAINT pk_product PRIMARY KEY (id);

DROP TABLE unique_products;
CREATE TABLE unique_products (
	id VARCHAR(20),
    idUnico VARCHAR(30),
    existe BOOLEAN,
	idProveedor INT(10),
    lote INT(4)
);

ALTER TABLE unique_products
ADD CONSTRAINT pk_unique_products PRIMARY KEY (idUnico);

ALTER TABLE unique_products
ADD CONSTRAINT fk_unique_product FOREIGN KEY (id) REFERENCES products(id);

ALTER TABLE unique_products
ADD CONSTRAINT fk_unique_product_provider FOREIGN KEY (idProveedor) REFERENCES providers(id);

DROP TABLE providers;
CREATE TABLE providers (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    telefono CHAR(10),
    correo VARCHAR(100)
);

CREATE TABLE customers (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40),
    RFC CHAR(13),
    dirFiscal VARCHAR(200),
    CP CHAR(5),
    usoCFDI CHAR(3),
    correo VARCHAR(100)
);

/*ALTER TABLE Cliente
ADD CONSTRAINT pk_cliente PRIMARY KEY (id);*/

CREATE TABLE sales (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    idCliente INT(10),
    fecha DATE,
	total DECIMAL(10, 2)
);

ALTER TABLE sales
ADD CONSTRAINT fk_sales_customers FOREIGN KEY (idCliente) REFERENCES customers(id);

DROP TABLE sales_products;
CREATE TABLE sales_products(
	idVenta INT(10),
    idProducto VARCHAR(30), /*idUnico*/
    cantidad INT(3)
);

ALTER TABLE sales_products
ADD CONSTRAINT pk_sales_products PRIMARY KEY (idVenta, idProducto);

ALTER TABLE sales_products
ADD CONSTRAINT fk_sales_products_sale FOREIGN KEY (idVenta) REFERENCES sales(id);

ALTER TABLE sales_products
ADD CONSTRAINT fk_sales_products_product FOREIGN KEY (idProducto) REFERENCES unique_products(idUnico);

DROP TABLE refunds;
CREATE TABLE refunds (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    idProducto VARCHAR(30),
    fecha DATE,
    perdidaTotal BOOLEAN
);

ALTER TABLE refunds
ADD CONSTRAINT fk_refund_product FOREIGN KEY (idProducto) REFERENCES unique_products(idUnico);

DROP TABLE uso_cfdi;
CREATE TABLE uso_cfdi (
	id CHAR(3) PRIMARY KEY,
    descripcion VARCHAR (100)
);

ALTER TABLE customers
ADD CONSTRAINT fk_uso_cfdi FOREIGN KEY (usoCFDI) REFERENCES uso_cfdi(id);

