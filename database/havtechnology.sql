-- MySQL dump 10.13  Distrib 5.7.35, for Win64 (x86_64)
--
-- Host: localhost    Database: havtechnology
-- ------------------------------------------------------
-- Server version	5.7.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RFC` char(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dirFiscal` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CP` int(11) DEFAULT NULL,
  `usoCFDI` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_uso_cfdi` (`usoCFDI`),
  CONSTRAINT `fk_uso_cfdi` FOREIGN KEY (`usoCFDI`) REFERENCES `uso_cfdi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'David Sánchez','OZO1234567890','Ozo #200',6789,'P01','ozo.guardian@gmail.commmm'),(3,'Juan López','JLO55554545','45454',23423,'D01','FDGDFG DF FD G');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2022_06_30_191029_create_customers_table',1),(3,'2022_06_30_191029_create_products_table',1),(4,'2022_06_30_191029_create_providers_table',1),(5,'2022_06_30_191029_create_returns_table',1),(6,'2022_06_30_191029_create_sells_table',1),(7,'2022_06_30_191029_create_sellsproducts_table',1),(8,'2022_06_30_191029_create_uniqueproducts_table',1),(9,'2022_06_30_191030_add_foreign_keys_to_returns_table',1),(10,'2022_06_30_191030_add_foreign_keys_to_sells_table',1),(11,'2022_06_30_191030_add_foreign_keys_to_sellsproducts_table',1),(12,'2022_06_30_191030_add_foreign_keys_to_uniqueproducts_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `precioVenta` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('A1A2A3','Producto 1','To remove the last 2 characters from a string, call the slice() method, passing it 0 for the start index and -2 for the end index as parameters. The slice method will return a new string containing the extracted section of the original string.','Negro',18,150.00),('B1B2B3','Producto 3','Okay so, I recently started learning about async JS and APIs and fetch and am just creating a small project for practice and I want to add 2 more features to it','Azul',5,456.00),('C1C2C3','Pruebaaaaaa 3','La función por defecto sencillamente concatena las partes para formar una única cadena de caracteres. Si hay una expresión antes de la plantilla literal (aquí indicada mediante etiqueta), se le conoce como \"plantilla etiquetada\". En este caso, la expresión de etiqueta (típicamente una función) es llamada con la plantilla literal como parámetro, que luego puede ser manipulada antes de ser devuelta.','Verde',22,3.00),('D1D2D3','Pruebaaaaa','La función de etiqueta puede ejecutar cualesquiera operaciones deseadas con estos argumentos, y luego devolver la cadena manipulada. (También puede devolver algo totalmente distinto, como se muestra en uno de los siguientes ejemplos.)','Rojo',5,450.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'Rodrigo Rodríguez','5544336611','rodrigordz@gmail.co'),(2,'Saúl Sanick','556789076','sssss.ccc.comasdasd');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `returns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idVenta` int(11) DEFAULT NULL,
  `perdidaTotal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_devolucion_venta` (`idVenta`),
  CONSTRAINT `fk_devolucion_venta` FOREIGN KEY (`idVenta`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returns`
--

LOCK TABLES `returns` WRITE;
/*!40000 ALTER TABLE `returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_venta_cliente` (`idCliente`),
  CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idCliente`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (21,3,'2022-07-12',65.50),(22,3,'2022-07-04',13.00);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_products`
--

DROP TABLE IF EXISTS `sales_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_products` (
  `idVenta` int(11) NOT NULL,
  `idProducto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`idVenta`,`idProducto`),
  KEY `fk_venta_producto_producto` (`idProducto`),
  CONSTRAINT `fk_venta_producto_producto` FOREIGN KEY (`idProducto`) REFERENCES `unique_products` (`idUnico`),
  CONSTRAINT `fk_venta_producto_venta` FOREIGN KEY (`idVenta`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_products`
--

LOCK TABLES `sales_products` WRITE;
/*!40000 ALTER TABLE `sales_products` DISABLE KEYS */;
INSERT INTO `sales_products` VALUES (21,'C1C2C300002',1),(21,'C1C2C300003',1),(22,'C1C2C300004',1);
/*!40000 ALTER TABLE `sales_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unique_products`
--

DROP TABLE IF EXISTS `unique_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unique_products` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idUnico` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `existe` tinyint(1) DEFAULT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `lote` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUnico`),
  KEY `fk_producto_unico` (`id`),
  KEY `fk_producto_unico_proveedor` (`idProveedor`),
  CONSTRAINT `fk_producto_unico` FOREIGN KEY (`id`) REFERENCES `products` (`id`),
  CONSTRAINT `fk_producto_unico_proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `providers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unique_products`
--

LOCK TABLES `unique_products` WRITE;
/*!40000 ALTER TABLE `unique_products` DISABLE KEYS */;
INSERT INTO `unique_products` VALUES ('A1A2A3','A1A2A300001',1,1,1),('A1A2A3','A1A2A300002',1,1,1),('A1A2A3','A1A2A300003',1,1,1),('A1A2A3','A1A2A300004',1,1,1),('A1A2A3','A1A2A300005',1,1,1),('A1A2A3','A1A2A300006',1,1,1),('A1A2A3','A1A2A300007',1,1,1),('A1A2A3','A1A2A300008',1,1,1),('A1A2A3','A1A2A300009',1,1,1),('A1A2A3','A1A2A300010',1,1,1),('A1A2A3','A1A2A300011',1,1,1),('A1A2A3','A1A2A300012',1,1,1),('A1A2A3','A1A2A300013',1,1,1),('A1A2A3','A1A2A300014',1,1,1),('A1A2A3','A1A2A300015',1,1,1),('A1A2A3','A1A2A300016',1,2,2),('A1A2A3','A1A2A300017',1,2,2),('A1A2A3','A1A2A300018',1,2,2),('B1B2B3','B1B2B300001',1,2,1),('B1B2B3','B1B2B300002',1,2,1),('B1B2B3','B1B2B300003',1,2,1),('B1B2B3','B1B2B300004',1,2,1),('B1B2B3','B1B2B300005',1,2,1),('C1C2C3','C1C2C300001',0,1,5),('C1C2C3','C1C2C300002',0,1,5),('C1C2C3','C1C2C300003',0,1,5),('C1C2C3','C1C2C300004',0,1,5),('C1C2C3','C1C2C300005',1,1,5),('C1C2C3','C1C2C300006',1,1,3),('C1C2C3','C1C2C300007',1,1,3),('C1C2C3','C1C2C300008',1,1,3),('C1C2C3','C1C2C300009',1,1,3),('C1C2C3','C1C2C300010',1,1,3),('C1C2C3','C1C2C300011',1,2,4),('C1C2C3','C1C2C300012',1,2,4),('C1C2C3','C1C2C300013',1,2,4),('C1C2C3','C1C2C300014',1,1,7),('C1C2C3','C1C2C300015',1,1,7),('C1C2C3','C1C2C300016',1,1,7),('C1C2C3','C1C2C300017',1,1,7),('C1C2C3','C1C2C300018',1,1,7),('C1C2C3','C1C2C300019',1,1,7),('C1C2C3','C1C2C300020',1,1,4),('C1C2C3','C1C2C300021',1,2,1),('C1C2C3','C1C2C300022',1,2,1),('D1D2D3','D1D2D300001',1,2,4),('D1D2D3','D1D2D300002',1,2,4),('D1D2D3','D1D2D300003',1,2,4),('D1D2D3','D1D2D300004',1,2,4),('D1D2D3','D1D2D300005',1,2,4);
/*!40000 ALTER TABLE `unique_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uso_cfdi`
--

DROP TABLE IF EXISTS `uso_cfdi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uso_cfdi` (
  `id` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uso_cfdi`
--

LOCK TABLES `uso_cfdi` WRITE;
/*!40000 ALTER TABLE `uso_cfdi` DISABLE KEYS */;
INSERT INTO `uso_cfdi` VALUES ('D01','Honorarios médicos, dentales y gastos hospitalarios'),('D02','Gastos médicos por incapacidad o discapacidad'),('D03','Gastos funerales'),('D04','Donativos'),('D05','Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)'),('D06','Aportaciones voluntarias al SAR'),('D07','Primas por seguros de gastos médicos'),('D08','Gastos de transportación escolar obligatoria'),('D09','Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones'),('D10','Pagos por servicios educativos (colegiaturas)'),('G01','Adquisición de mercancías'),('G02','Devoluciones, descuentos o bonificaciones'),('G03','Gastos en general'),('I01','Construcciones'),('I02','Mobiliario y equipo de oficina por inversiones'),('I03','Equipo de transporte'),('I04','Equipo de cómputo y accesorios'),('I05','Dados, troqueles, moldes, matrices y herramental'),('I06','Comunicaciones telefónicas'),('I07','Comunicaciones satelitales'),('I08','Otra maquinaria y equipo'),('P01','Por definir');
/*!40000 ALTER TABLE `uso_cfdi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-05  9:06:23
