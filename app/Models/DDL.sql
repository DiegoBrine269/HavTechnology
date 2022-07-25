DROP DATABASE havtechnology;
CREATE DATABASE havtechnology;

USE havtechnology;

CREATE TABLE products (
	id VARCHAR(20),
    nombre VARCHAR(200),
    descripcion TEXT,
    color VARCHAR(20),
    stock INT,
    precioVenta DECIMAL(5, 2)
);
ALTER TABLE products
ADD COLUMN imagen VARCHAR(100) AFTER id;

ALTER TABLE products
ADD COLUMN costo DECIMAL(5, 2) AFTER precioVenta;

ALTER TABLE products
ADD COLUMN cantidadMinima INT AFTER stock;


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

SHOW CREATE TABLE users;

CREATE TABLE `users` (
   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `email_verified_at` timestamp NULL DEFAULT NULL,
   `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `is_admin` tinyint(1) NOT NULL DEFAULT '0',
   `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   UNIQUE KEY `users_email_unique` (`email`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
 
CREATE TABLE `password_resets` (
   `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   KEY `password_resets_email_index` (`email`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE estimates;
CREATE TABLE estimates (
	id CHAR(16) PRIMARY KEY,
    nombreCliente VARCHAR(200),
    correo VARCHAR(100),
    fechaValidez DATE,
    envio BOOL
);

DROP TABLE estimates_products;
CREATE TABLE estimates_products (
	idPresupuesto CHAR(16) NULL,
    idProducto VARCHAR(20) NULL,
    cantidad INT
);

ALTER TABLE estimates_products
ADD CONSTRAINT pk_estimates_products PRIMARY KEY (idPresupuesto, idProducto);

ALTER TABLE estimates_products
ADD CONSTRAINT fk_estimates FOREIGN KEY (idPresupuesto) REFERENCES estimates(id);

ALTER TABLE estimates_products
ADD CONSTRAINT fk_estimates_products FOREIGN KEY (idProducto) REFERENCES products(id);


