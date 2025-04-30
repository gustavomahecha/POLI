-- Eliminar base de datos si ya existe
DROP DATABASE IF EXISTS carmesy_db;

-- Crear la base de datos
CREATE DATABASE carmesy_db;
USE carmesy_db;

-- Tabla: tipo_documento
CREATE TABLE tipo_documento (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(50) NOT NULL
);

-- Tabla: tipo_pqrs
CREATE TABLE tipo_pqrs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(50) NOT NULL
);

-- Tabla: estado (para tickets y admins)
CREATE TABLE estado (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descripcion ENUM('pendiente', 'resuelto', 'rechazado') NOT NULL
);

-- Tabla: usuarios_admin
CREATE TABLE usuarios_admin (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    correo VARCHAR(100) NOT NULL UNIQUE,
    numero_documento VARCHAR(20) NOT NULL,
    tipo_documento_id INT NOT NULL,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    direccion VARCHAR(150),
    telefono VARCHAR(20),
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'super_admin') NOT NULL,
    estado_id INT DEFAULT 1,
    FOREIGN KEY (tipo_documento_id) REFERENCES tipo_documento(id),
    FOREIGN KEY (estado_id) REFERENCES estado(id)
);

-- Tabla: tickets_pqrs
CREATE TABLE tickets_pqrs (
    id_ticket VARCHAR(50) PRIMARY KEY ,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NOT NULL,
    tipo_documento_id INT NOT NULL,
    correo VARCHAR(100) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    tipo_pqrs_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado_id INT DEFAULT 1,
    FOREIGN KEY (tipo_documento_id) REFERENCES tipo_documento(id),
    FOREIGN KEY (tipo_pqrs_id) REFERENCES tipo_pqrs(id),
    FOREIGN KEY (estado_id) REFERENCES estado(id)
);

-- Tabla: respuestas_pqrs
CREATE TABLE respuestas_pqrs (
    id_respuesta INT PRIMARY KEY AUTO_INCREMENT,
    id_ticket VARCHAR(50),
    id_admin INT,
    respuesta TEXT NOT NULL,
    fecha_respuesta DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_ticket) REFERENCES tickets_pqrs(id_ticket),
    FOREIGN KEY (id_admin) REFERENCES usuarios_admin(id_admin)
);

-- Insertar valores en tipo_documento
INSERT INTO tipo_documento (descripcion) VALUES 
('Cédula de ciudadanía'),
('Cédula de extranjería'),
('NIT'),
('Tarjeta de identidad'),
('Pasaporte');

-- Insertar valores en tipo_pqrs
INSERT INTO tipo_pqrs (descripcion) VALUES 
('Petición'),
('Queja'),
('Reclamo'),
('Sugerencia'),
('Felicitación');

-- Insertar valores en estado
INSERT INTO estado (descripcion) VALUES 
('pendiente'),
('resuelto'),
('rechazado');

INSERT INTO usuarios_admin (
    correo, numero_documento, tipo_documento_id, nombres, apellidos,
    direccion, telefono, contrasena, rol, estado_id
)
VALUES
-- Admins
('admin1@example.com', '1001', 1, 'Carlos', 'Gomez', 'Calle 1 #123', '3001110001', 'admin123', 'admin', 1),
('admin2@example.com', '1002', 1, 'Lucía', 'Martínez', 'Calle 2 #456', '3001110002', 'admin123', 'admin', 1),
('admin3@example.com', '1003', 1, 'Luis', 'Pérez', 'Calle 3 #789', '3001110003', 'admin123', 'admin', 1),
('admin4@example.com', '1004', 1, 'Ana', 'Ruiz', 'Calle 4 #321', '3001110004', 'admin123', 'admin', 1),
('admin5@example.com', '1005', 1, 'David', 'Torres', 'Calle 5 #654', '3001110005', 'admin123', 'admin', 1),

-- Super Admins
('super1@example.com', '2001', 1, 'Elena', 'Vargas', 'Av. 1 #111', '3002220001', 'super123', 'super_admin', 1),
('super2@example.com', '2002', 1, 'Miguel', 'Santos', 'Av. 2 #222', '3002220002', 'super123', 'super_admin', 1),
('super3@example.com', '2003', 1, 'Paula', 'Ramírez', 'Av. 3 #333', '3002220003', 'super123', 'super_admin', 1),
('super4@example.com', '2004', 1, 'Andrés', 'López', 'Av. 4 #444', '3002220004', 'super123', 'super_admin', 1),
('super5@example.com', '2005', 1, 'Clara', 'Moreno', 'Av. 5 #555', '3002220005', 'super123', 'super_admin', 1);

INSERT INTO tickets_pqrs (
    id_ticket, nombres, apellidos, documento, tipo_documento_id, correo,
    direccion, telefono, tipo_pqrs_id, descripcion, estado_id
)
VALUES
('TICK-001', 'Laura', 'Jiménez', '1234567890', 1, 'laura@example.com', 'Cra 1 #11-11', '3000000001', 1, 'Solicitud de información general', 1),
('TICK-002', 'Daniel', 'Morales', '2345678901', 1, 'daniel@example.com', 'Cra 2 #22-22', '3000000002', 2, 'Petición sobre servicio', 1),
('TICK-003', 'Andrea', 'Ramírez', '3456789012', 1, 'andrea@example.com', 'Cra 3 #33-33', '3000000003', 3, 'Queja por atención al cliente', 1),
('TICK-004', 'Carlos', 'Herrera', '4567890123', 1, 'carlos@example.com', 'Cra 4 #44-44', '3000000004', 4, 'Reclamo por factura errónea', 1),
('TICK-005', 'Valentina', 'López', '5678901234', 1, 'valen@example.com', 'Cra 5 #55-55', '3000000005', 1, 'Solicitud de soporte técnico', 1),
('TICK-006', 'Mario', 'Suárez', '6789012345', 1, 'mario@example.com', 'Cra 6 #66-66', '3000000006', 2, 'Petición de reintegro', 1),
('TICK-007', 'Diana', 'Torres', '7890123456', 1, 'diana@example.com', 'Cra 7 #77-77', '3000000007', 3, 'Queja por mal trato', 1),
('TICK-008', 'Jorge', 'Rojas', '8901234567', 1, 'jorge@example.com', 'Cra 8 #88-88', '3000000008', 4, 'Reclamo por cobro duplicado', 1),
('TICK-009', 'Camila', 'González', '9012345678', 1, 'camila@example.com', 'Cra 9 #99-99', '3000000009', 1, 'Consulta de estado del trámite', 1),
('TICK-010', 'Esteban', 'Mejía', '0123456789', 1, 'esteban@example.com', 'Cra 10 #100-10', '3000000010', 2, 'Petición para actualizar datos', 1);
