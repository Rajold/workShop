-- MySQL schema para la aplicación Taller

CREATE DATABASE IF NOT EXISTS taller_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE taller_db;

-- usuarios
CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  usuario VARCHAR(100) NOT NULL UNIQUE,
  contraseña_hash VARCHAR(255) NOT NULL,
  rol ENUM('admin','mecanico') NOT NULL DEFAULT 'mecanico',
  fecha_creacion DATETIME NOT NULL
) ENGINE=InnoDB;

-- vehiculos
CREATE TABLE IF NOT EXISTS vehiculos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  placa VARCHAR(30) NOT NULL UNIQUE,
  marca VARCHAR(100),
  modelo VARCHAR(100),
  color VARCHAR(50),
  propietario VARCHAR(200)
) ENGINE=InnoDB;

-- casos
CREATE TABLE IF NOT EXISTS casos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehiculo_id INT NOT NULL,
  mecanico_id INT,
  fecha_ingreso DATE,
  hora_ingreso TIME,
  causa TEXT,
  observaciones TEXT,
  diagnostico TEXT,
  estado ENUM('abierto','cerrado') DEFAULT 'abierto',
  FOREIGN KEY (vehiculo_id) REFERENCES vehiculos(id) ON DELETE CASCADE,
  FOREIGN KEY (mecanico_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- sesiones_trabajo
CREATE TABLE IF NOT EXISTS sesiones_trabajo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  caso_id INT NOT NULL,
  mecanico_id INT NOT NULL,
  fecha_inicio DATE,
  hora_inicio TIME,
  fecha_fin DATE,
  hora_fin TIME,
  duracion INT DEFAULT 0, -- minutos
  FOREIGN KEY (caso_id) REFERENCES casos(id) ON DELETE CASCADE,
  FOREIGN KEY (mecanico_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE avances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    caso_id INT NOT NULL,
    mecanico_id INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    comentario TEXT NOT NULL,
    FOREIGN KEY (caso_id) REFERENCES casos(id) ON DELETE CASCADE,
    FOREIGN KEY (mecanico_id) REFERENCES usuarios(id) ON DELETE CASCADE
);


-- ==========================================
-- MÓDULO INVENTARIO
-- ==========================================
CREATE TABLE categorias_partes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    descripcion VARCHAR(255) DEFAULT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1
);

INSERT INTO categorias_partes (nombre) VALUES
('Aceites'),
('Filtros'),
('Frenos'),
('Motor'),
('Suspensión'),
('Eléctrico'),
('Consumibles'),
('Otros');

CREATE TABLE partes (
    id INT AUTO_INCREMENT PRIMARY KEY,

    codigo VARCHAR(30) UNIQUE,

    categoria_id INT,

    nombre VARCHAR(120) NOT NULL,

    marca VARCHAR(60),

    unidad VARCHAR(20) NOT NULL DEFAULT 'UND',

    stock_actual DECIMAL(10,2) NOT NULL DEFAULT 0,

    stock_minimo DECIMAL(10,2) NOT NULL DEFAULT 0,

    costo DECIMAL(12,2) NOT NULL DEFAULT 0,

    precio DECIMAL(12,2) NOT NULL DEFAULT 0,

    ubicacion VARCHAR(60),

    activo TINYINT(1) NOT NULL DEFAULT 1,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP NULL DEFAULT NULL
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_partes_categoria
        FOREIGN KEY (categoria_id)
        REFERENCES categorias_partes(id)
);

CREATE TABLE movimientos_inventario (

    id INT AUTO_INCREMENT PRIMARY KEY,

    parte_id INT NOT NULL,

    tipo ENUM('ENTRADA','SALIDA','AJUSTE') NOT NULL,

    origen ENUM('INVENTARIO','CASO','COMPRA','AJUSTE') NOT NULL,

    cantidad DECIMAL(10,2) NOT NULL,

    stock_anterior DECIMAL(10,2) NOT NULL,

    stock_nuevo DECIMAL(10,2) NOT NULL,

    costo_unitario DECIMAL(12,2) DEFAULT 0,

    caso_id INT DEFAULT NULL,

    usuario_id INT DEFAULT NULL,

    observacion TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_movimiento_parte
        FOREIGN KEY (parte_id)
        REFERENCES partes(id),

    CONSTRAINT fk_movimiento_usuario
        FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id),

    CONSTRAINT fk_movimiento_caso
        FOREIGN KEY (caso_id)
        REFERENCES casos(id)
);

CREATE TABLE caso_partes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    caso_id INT NOT NULL,

    parte_id INT NOT NULL,

    cantidad DECIMAL(10,2) NOT NULL,

    costo_unitario DECIMAL(12,2) NOT NULL,

    precio_unitario DECIMAL(12,2) NOT NULL,

    subtotal DECIMAL(12,2) NOT NULL,

    observacion TEXT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_cp_caso
        FOREIGN KEY (caso_id)
        REFERENCES casos(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_cp_parte
        FOREIGN KEY (parte_id)
        REFERENCES partes(id)
);