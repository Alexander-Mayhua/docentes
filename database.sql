-- Crea base de datos (opcional)
CREATE DATABASE IF NOT EXISTS docentes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE docentes;

-- Tabla de docentes
CREATE TABLE IF NOT EXISTS docentes (
    id_docente INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(15) NOT NULL UNIQUE,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE,
    telefono VARCHAR(20),
    especialidad VARCHAR(100),
    grado_academico ENUM('Bachiller', 'Licenciado', 'Magister', 'Doctor') DEFAULT 'Licenciado',
    estado ENUM('Activo', 'Inactivo') DEFAULT 'Activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('admin','docente') DEFAULT 'docente',
    estado ENUM('Activo','Inactivo') DEFAULT 'Activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Usuario admin de prueba (usuario=71771181, clave=71771181)
INSERT INTO usuarios (usuario, clave, rol, estado)
VALUES ('71771181', MD5('71771181'), 'admin', 'Activo')
ON DUPLICATE KEY UPDATE usuario=VALUES(usuario);

-- Datos de ejemplo para docentes
INSERT INTO docentes (dni, nombres, apellidos, correo, telefono, especialidad, grado_academico, estado) VALUES
('12345678', 'Juan',  'Pérez Gómez',      'juan.perez@universidad.com',  '987654321', 'Matemáticas',               'Magister',  'Activo'),
('87654321', 'María', 'Ramírez Torres',    'maria.ramirez@universidad.com','912345678','Ingeniería de Sistemas',   'Doctor',    'Activo'),
('45678912', 'Luis',  'Castillo Vega',     'luis.castillo@universidad.com','934567890','Física',                   'Licenciado','Inactivo'),
('56781234', 'Ana',   'Fernández López',   'ana.fernandez@universidad.com','945612378','Química',                  'Bachiller', 'Activo'),
('78912345', 'Carlos','García Ruiz',       'carlos.garcia@universidad.com','978456321','Biología',                 'Magister',  'Activo'),
('89123456', 'Laura', 'Torres Díaz',       'laura.torres@universidad.com', '981234567','Educación',                'Licenciado','Activo');
