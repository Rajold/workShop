-- ==========================================
-- WorkShop
-- Migración v1.1 - Módulo de Inventario
-- ==========================================

START TRANSACTION;

--
-- Tabla: categorias_partes
--

CREATE TABLE IF NOT EXISTS `categorias_partes` (

    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `descripcion` TEXT DEFAULT NULL,
    `activo` TINYINT(1) NOT NULL DEFAULT 1,

    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    `updated_at` DATETIME NOT NULL
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uk_categoria_nombre` (`nombre`)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;





--
-- Tabla: partes
--

CREATE TABLE IF NOT EXISTS `partes` (

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

    `updated_at` DATETIME NOT NULL
        DEFAULT CURRENT_TIMESTAMP
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

CREATE TABLE IF NOT EXISTS `movimientos_inventario` (

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

    `stock_resultante` DECIMAL(12,2) NOT NULL DEFAULT 0,

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

COMMIT;