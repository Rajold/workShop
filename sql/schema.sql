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

