-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2026 at 03:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taller_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `avances`
--

CREATE TABLE `avances` (
  `id` int(11) NOT NULL,
  `caso_id` int(11) NOT NULL,
  `mecanico_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` enum('Repuesto','Mano de obra') NOT NULL,
  `valor` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `mecanico_id` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `hora_ingreso` time DEFAULT NULL,
  `causa` text DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `diagnostico` text DEFAULT NULL,
  `estado` enum('abierto','cerrado') DEFAULT 'abierto',
  `fecha_cierre` datetime DEFAULT NULL,
  `cerrado_por` int(11) DEFAULT NULL,
  `precio_cobrado` DECIMAL(10,2) DEFAULT NULL,
  `descuento` DECIMAL(10,2) DEFAULT 0,
  `utilidad` DECIMAL(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sesiones_trabajo`
--

CREATE TABLE `sesiones_trabajo` (
  `id` int(11) NOT NULL,
  `caso_id` int(11) NOT NULL,
  `mecanico_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `duracion` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contrasena_hash` varchar(255) NOT NULL,
  `rol` enum('admin','mecanico') NOT NULL DEFAULT 'mecanico',
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `placa` varchar(30) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `propietario` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `mecanico_id` (`mecanico_id`);

--
-- Indexes for table `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`),
  ADD KEY `mecanico_id` (`mecanico_id`);

--
-- Indexes for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `mecanico_id` (`mecanico_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avances`
--
ALTER TABLE `avances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `avances_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `avances_ibfk_2` FOREIGN KEY (`mecanico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `casos`
--
ALTER TABLE `casos`
  ADD CONSTRAINT `casos_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `casos_ibfk_2` FOREIGN KEY (`mecanico_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  ADD CONSTRAINT `sesiones_trabajo_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesiones_trabajo_ibfk_2` FOREIGN KEY (`mecanico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
  --
-- Tabla: categorias_partes
--

CREATE TABLE `categorias_partes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT DEFAULT NULL,
    `activo` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_categoria_nombre` (`nombre`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: partes
--
CREATE TABLE `partes` (

    `id` INT NOT NULL AUTO_INCREMENT,

    `codigo` VARCHAR(60) NOT NULL,

    `categoria_id` INT DEFAULT NULL,

    `tipo` ENUM(
        'repuesto',
        'insumo',
        'herramienta'
    ) NOT NULL DEFAULT 'repuesto',

    `nombre` VARCHAR(150) NOT NULL,

    `marca` VARCHAR(100) DEFAULT NULL,

    `created_by` INT DEFAULT NULL,

    `unidad` ENUM(
        'Unidad',
        'Juego',
        'Par',
        'Litro',
        'Mililitro',
        'Kilogramo',
        'Gramo',
        'Metro',
        'Centimetro'
    ) NOT NULL DEFAULT 'Unidad',

    `stock_actual` DECIMAL(12,2) NOT NULL DEFAULT 0,

    `stock_reservado` DECIMAL(12,2) NOT NULL DEFAULT 0,

    `stock_minimo` DECIMAL(12,2) NOT NULL DEFAULT 0,

    `costo` DECIMAL(10,2) NOT NULL DEFAULT 0,

    `precio_venta` DECIMAL(10,2) NOT NULL DEFAULT 0,

    `ubicacion` VARCHAR(120) DEFAULT NULL,

    `codigo_barras` VARCHAR(100) DEFAULT NULL,

    `imagen` VARCHAR(255) DEFAULT NULL,

    `activo` TINYINT(1) NOT NULL DEFAULT 1,

    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uk_codigo` (`codigo`),

    KEY `idx_categoria` (`categoria_id`),

    KEY `idx_nombre` (`nombre`),

    KEY `idx_tipo` (`tipo`),

    KEY `idx_codigo_barras` (`codigo_barras`),

    KEY `idx_created_by` (`created_by`),

    CONSTRAINT `fk_partes_categoria`
        FOREIGN KEY (`categoria_id`)
        REFERENCES `categorias_partes` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL,

    CONSTRAINT `fk_partes_created_by`
        FOREIGN KEY (`created_by`)
        REFERENCES `usuarios` (`id`)
        ON UPDATE CASCADE
        ON DELETE SET NULL

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

--
-- Tabla: movimientos_inventario
--

CREATE TABLE `movimientos_inventario` (

    `id` INT NOT NULL AUTO_INCREMENT,

    `parte_id` INT NOT NULL,

    `usuario_id` INT NOT NULL,

    `caso_id` INT DEFAULT NULL,

    `tipo` ENUM(
        'compra',
        'consumo',
        'ajuste_entrada',
        'ajuste_salida'
    ) NOT NULL,
    `motivo` VARCHAR(255) DEFAULT NULL,

    `cantidad` DECIMAL(12,2) NOT NULL,
    
    `stock_resultante` DECIMAL(12,2),

    `costo_unitario` DECIMAL(10,2) DEFAULT NULL,

    `observacion` TEXT DEFAULT NULL,

    `fecha` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    KEY `idx_parte` (`parte_id`),

    KEY `idx_usuario` (`usuario_id`),

    KEY `idx_caso` (`caso_id`),

    KEY `idx_fecha` (`fecha`),

    CONSTRAINT `fk_movimiento_parte`
    FOREIGN KEY (`parte_id`)
    REFERENCES `partes` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,

    CONSTRAINT `fk_movimiento_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `usuarios` (`id`)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,

CONSTRAINT `fk_movimiento_caso`
    FOREIGN KEY (`caso_id`)
    REFERENCES `casos` (`id`)
    ON UPDATE CASCADE
    ON DELETE SET NULL

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE marcas_moto (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    activo TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT uk_marcas_moto_nombre
        UNIQUE (nombre)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE tipos_moto (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    activo TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT uk_tipos_moto_nombre
        UNIQUE (nombre)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE fabricante_repuesto (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    descripcion TEXT DEFAULT NULL,

    activo TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT uk_fabricante_nombre
        UNIQUE (nombre)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE modelos_moto (

    id INT AUTO_INCREMENT PRIMARY KEY,

    marca_moto_id INT NOT NULL,

    tipo_moto_id INT NOT NULL,

    linea VARCHAR(30) NOT NULL,

    cilindrada SMALLINT UNSIGNED DEFAULT NULL,

    activo TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    KEY idx_marca (marca_moto_id),

    KEY idx_tipo (tipo_moto_id),

    KEY idx_linea (linea),

    KEY idx_cilindrada (cilindrada),

    CONSTRAINT fk_modelo_marca
        FOREIGN KEY (marca_moto_id)
        REFERENCES marcas_moto(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_modelo_tipo
        FOREIGN KEY (tipo_moto_id)
        REFERENCES tipos_moto(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT uk_modelo_moto
        UNIQUE (
            marca_moto_id,
            tipo_moto_id,
            linea,
            cilindrada
        )

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE aplicacion_parte (

    id INT AUTO_INCREMENT PRIMARY KEY,

    parte_id INT NOT NULL,

    modelo_moto_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    KEY idx_parte (parte_id),

    KEY idx_modelo (modelo_moto_id),

    CONSTRAINT fk_aplicacion_parte
        FOREIGN KEY (parte_id)
        REFERENCES partes(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT fk_aplicacion_modelo
        FOREIGN KEY (modelo_moto_id)
        REFERENCES modelos_moto(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT uk_aplicacion
        UNIQUE (
            parte_id,
            modelo_moto_id
        )

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
