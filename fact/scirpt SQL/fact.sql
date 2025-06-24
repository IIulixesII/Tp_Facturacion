-- phpMyAdmin SQL Dump
-- versión 5.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Charset
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de datos: `fact`
-- --------------------------------------------------------

-- Tabla: usuario
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `usuario` (`id`, `nombreUsuario`, `email`, `password`, `rol`, `activo`) VALUES
(1, 'Admin1', 'a@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'admin', 1),
(2, 'Cajero1', 'cajero@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'cajero', 1),
(3, 'Ulises123', 'ulises@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'cliente', 1),
(4, 'Ticiano456', 'ticiano@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'cliente', 1),
(5, 'Dario789', 'dario@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'cliente', 1),
(6, 'Cata001', 'catalina@a.com', '$2a$07$asxx54ahjppf45sd87a5auJRR6foEJ7ynpjisKtbiKJbvJsoQ8VPS', 'cliente', 1);

-- Tabla: cliente
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `consumo_luz` int(11) NOT NULL,
  `dni` int(15) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `telefono`, `fecha_nacimiento`, `saldo`, `consumo_luz`, `dni`, `usuario_id`) VALUES
(1, 'Ulises', 'Martínez', '2954326436', '1998-05-05', 32122.00, 2223, 45109702, 3),
(2, 'Ticiano', 'Gómez', '21314', '2000-01-01', 145.00, 1234, 12345678, 4),
(3, 'Dario', 'Pérez', '2131243', '1995-12-12', 50090.00, 214124, 22333444, 5),
(4, 'Catalina', 'López', '2954326436', '1997-07-13', 124124.00, 123124412, 44777888, 6);

-- Tabla: factura
CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `consumo_luz` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla: turno
CREATE TABLE `turno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `turno` (`id`, `nombre`, `numero`, `estado`) VALUES
(1, 'Dario', '2', 'sinatender'),
(2, 'Catalina', '3', 'sinatender'),
(3, 'Ulises', '4', 'sinatender'),
(4, 'Ticiano', '5', 'sinatender');

-- Tabla: soporte
CREATE TABLE `soporte` (
  `id_soporte` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
  `email` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
  `telefono` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
  `dni` VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
  `mensaje` TEXT NOT NULL COLLATE 'utf8mb4_general_ci',
  `fecha` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `valoracion` INT NULL DEFAULT NULL,
  `estado` VARCHAR(20) NOT NULL DEFAULT 'norecibido',
  PRIMARY KEY (`id_soporte`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `soporte` (`nombre`, `email`, `telefono`, `dni`, `mensaje`, `valoracion`, `estado`) VALUES
('Juan Pérez', 'juan@gmail.com', '123456789', '12345678', 'No puedo ver mi factura.', 3, 'recibido'),
('Ana García', 'ana@gmail.com', '987654321', '87654321', 'El sistema no carga bien.', 5, 'norecibido'),
('Luis Fernández', 'luisf@example.com', '111222333', '45678912', 'Necesito cambiar mi dirección.', NULL, 'norecibido'),
('María López', 'maria.l@example.com', '444555666', '78912345', '¿Cómo puedo obtener una factura detallada?', 4, 'recibido'),
('Carlos Gómez', 'carlos.g@example.com', '777888999', '32165498', 'No me llegó el correo con la factura.', NULL, 'norecibido'),
('Laura Martínez', 'laura.m@example.com', '222333444', '98765432', 'Problemas para iniciar sesión.', 2, 'recibido'),
('Pedro Sánchez', 'pedro.s@example.com', '555666777', '56473829', 'Quiero dar de baja mi servicio.', NULL, 'norecibido'),
('Sofía Torres', 'sofia.t@example.com', '888999000', '27364518', 'Consulta sobre el consumo de luz.', 5, 'recibido'),
('Javier Díaz', 'javier.d@example.com', '333444555', '91827364', '¿Cuándo actualizan los precios?', NULL, 'norecibido'),
('Elena Ruiz', 'elena.r@example.com', '666777888', '18273645', 'Solicito soporte técnico urgente.', 1, 'recibido'),
('Miguel Ángel', 'miguel.a@example.com', '999000111', '56473829', 'No puedo imprimir mi factura.', NULL, 'norecibido'),
('Patricia Soto', 'patricia.s@example.com', '101010101', '12349876', '¿Dónde puedo pagar en persona?', 4, 'recibido'),
('Diego Morales', 'diego.m@example.com', '121212121', '78965412', 'Consulta sobre facturación electrónica.', NULL, 'norecibido'),
('Valentina Cruz', 'valentina.c@example.com', '131313131', '45612378', 'Solicitud de cambio de plan.', 3, 'recibido');

-- Índices y claves foráneas
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

ALTER TABLE `turno`
  ADD PRIMARY KEY (`id`);

-- Auto increment
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `turno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

-- Foreign keys
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
