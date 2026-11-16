-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: taller_db
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `categoria` enum('alimentacion','operativo','herramientas','transporte','imprevisto','otro') NOT NULL DEFAULT 'otro',
  `valor` decimal(12,2) NOT NULL,
  `fecha_gasto` datetime NOT NULL DEFAULT current_timestamp(),
  `registrado_por` int(11) NOT NULL,
  `autorizado_por` int(11) DEFAULT NULL,
  `estado` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente',
  `estado_pago` enum('pendiente','pagado','reembolsado') NOT NULL DEFAULT 'pendiente',
  `forma_pago` enum('caja','transferencia','dinero_personal') NOT NULL DEFAULT 'caja',
  `proveedor` varchar(255) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_gastos_registrado_por` (`registrado_por`),
  KEY `fk_gastos_autorizado_por` (`autorizado_por`),
  KEY `idx_gastos_fecha` (`fecha_gasto`),
  KEY `idx_gastos_estado` (`estado`),
  KEY `idx_gastos_categoria` (`categoria`),
  KEY `idx_gastos_pago` (`estado_pago`),
  CONSTRAINT `fk_gastos_autorizado_por` FOREIGN KEY (`autorizado_por`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_gastos_registrado_por` FOREIGN KEY (`registrado_por`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (1,'Compra de agua para el taller.','alimentacion',5000.00,'2026-10-11 21:59:00',3,3,'aprobado','reembolsado','dinero_personal','Imaginario','No se observó nada.','2026-10-11 10:01:07','2026-10-11 10:08:40');
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos_financieros`
--

DROP TABLE IF EXISTS `movimientos_financieros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos_financieros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cuenta_id` int(11) NOT NULL,
  `tipo` enum('ingreso','egreso','apertura','transferencia','ajuste') NOT NULL,
  `sentido` enum('entrada','salida') NOT NULL,
  `monto` decimal(14,2) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha_movimiento` datetime NOT NULL DEFAULT current_timestamp(),
  `registrado_por` int(11) NOT NULL,
  `caso_id` int(11) DEFAULT NULL,
  `caso_referencia` varchar(255) DEFAULT NULL,
  `gasto_id` int(11) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_mf_cuenta_fecha` (`cuenta_id`,`fecha_movimiento`,`id`),
  KEY `idx_mf_caso` (`caso_id`),
  KEY `idx_mf_gasto` (`gasto_id`),
  KEY `idx_mf_fecha` (`fecha_movimiento`),
  KEY `fk_mf_usuario` (`registrado_por`),
  CONSTRAINT `fk_mf_caso` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_mf_cuenta` FOREIGN KEY (`cuenta_id`) REFERENCES `cuentas_financieras` (`id`),
  CONSTRAINT `fk_mf_usuario` FOREIGN KEY (`registrado_por`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos_financieros`
--

LOCK TABLES `movimientos_financieros` WRITE;
/*!40000 ALTER TABLE `movimientos_financieros` DISABLE KEYS */;
INSERT INTO `movimientos_financieros` VALUES (1,2,'ingreso','entrada',50000.00,'Abono de reparación #180','2026-11-14 13:22:47',3,180,'Caso #180',NULL,'PAGO-a4a173c2332b0bb1416da6f692e60451'),(2,2,'ingreso','entrada',200000.00,'Abono de reparación #180','2026-11-14 13:23:38',3,180,'Caso #180',NULL,'PAGO-b2a0da9eb9b0625e9519af7ad3309bf8'),(3,1,'ingreso','entrada',200000.00,'Abono de reparación #180','2026-11-14 13:24:05',3,180,'Caso #180',NULL,'PAGO-19886dc33095b5c27791384d92f998a5'),(4,1,'ingreso','entrada',305000.00,'Abono de reparación #247','2026-11-14 18:16:59',3,247,'Caso #247',NULL,'PAGO-93646dcbd30087ec455944e8fa959570'),(5,1,'ingreso','entrada',10000.00,'Abono de reparación #235','2026-11-15 00:32:44',3,235,'Caso #235',NULL,'PAGO-3ebb5a5bfdb9066a46fc76783f0fb40d'),(6,2,'ingreso','entrada',5000.00,'Abono de reparación #235','2026-11-15 00:36:09',3,235,'Caso #235',NULL,'PAGO-26764d8e07a73e294e252a15847f38d1'),(7,1,'ingreso','entrada',472500.00,'Abono de reparación #235','2026-11-15 00:38:42',3,235,'Caso #235',NULL,'PAGO-cd6e101faa04c61fd951b048239ff800');
/*!40000 ALTER TABLE `movimientos_financieros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentas_financieras`
--

DROP TABLE IF EXISTS `cuentas_financieras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentas_financieras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `tipo` enum('caja','banco') NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cuenta_nombre` (`nombre`),
  UNIQUE KEY `uq_cuenta_tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentas_financieras`
--

LOCK TABLES `cuentas_financieras` WRITE;
/*!40000 ALTER TABLE `cuentas_financieras` DISABLE KEYS */;
INSERT INTO `cuentas_financieras` VALUES (1,'Caja','caja',1,'2026-10-13 15:32:56'),(2,'Banco','banco',1,'2026-10-13 15:32:56');
/*!40000 ALTER TABLE `cuentas_financieras` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-15 14:50:29
