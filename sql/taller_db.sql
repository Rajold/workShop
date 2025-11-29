-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2025 at 06:36 AM
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
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avances`
--

INSERT INTO `avances` (`id`, `caso_id`, `mecanico_id`, `descripcion`, `fecha`) VALUES
(12, 5, 3, 'Mantenimiento mando pito y direccionales.', '2025-10-24 15:11:56'),
(13, 5, 3, 'cambio de pito', '2025-10-24 15:54:41'),
(14, 5, 3, 'Cambio de cristal y  lubricación de guaya de velocímetro', '2025-10-24 16:03:16'),
(15, 5, 3, 'lubricar y tensionar cadena', '2025-10-24 16:27:21'),
(16, 4, 3, 'Drenado de aceite', '2025-10-24 19:09:03'),
(17, 5, 3, 'instalación guardabarro delantero, cubierta frontal, direccionales, gato lateral, cabeza de luces', '2025-10-24 21:08:42'),
(18, 6, 3, 'desmontaje', '2025-10-25 15:59:42'),
(19, 3, 3, '✅ Caso cerrado por el mecánico.', '2025-10-26 20:54:41'),
(20, 8, 3, 'leto', '2025-10-27 16:02:58'),
(21, 8, 3, '✅ Caso cerrado por el mecánico.', '2025-10-27 16:03:06'),
(22, 9, 3, 'Masa general arrancada.', '2025-10-27 16:54:40'),
(23, 9, 3, 'Se reconectò masa general pero aùn no se activa el arranque.', '2025-10-27 16:55:19'),
(24, 10, 3, 'Desmontando suspensiòn', '2025-10-27 17:02:51'),
(25, 10, 3, 'Reinstalaciòn de barras', '2025-10-27 21:30:05'),
(26, 11, 3, 'Sistema eléctrico con linea abierto a nivel de la dirección.', '2025-10-28 20:04:41'),
(27, 11, 3, 'Ajuste de Switch.', '2025-10-28 20:04:53'),
(28, 11, 3, 'Rearmar rueda trasera mantenimiento sistema de freno', '2025-10-28 21:54:39'),
(29, 12, 3, 'Correcciòn de la posiciòn de los pines de tablero y mandos en el ramal nuevo.', '2025-10-28 22:19:14'),
(30, 12, 3, 'cambio de manguera y mantenimiento a carburador, gasolina se desborda.', '2025-10-29 15:52:08'),
(31, 13, 3, 'se deja baterìa para carga, probablemente se deba cambiar corona de bobinas.', '2025-10-29 16:24:44'),
(32, 12, 3, 'Baterìa se pone en carga', '2025-10-29 16:25:21'),
(33, 12, 3, 'Baterìa se pone en carga', '2025-10-29 16:25:21'),
(34, 12, 3, 'enrutado de cableado', '2025-10-29 17:36:47'),
(35, 12, 3, 'Conexionado', '2025-10-29 19:22:30'),
(36, 14, 3, 'aceitar y tensionar cadena, ajustar freno trasero. \r\nAjuste marcha mínima después de revisión técnico mecánica.\r\nPendiente Cambio de barras.', '2025-10-29 19:36:05'),
(37, 15, 3, 'Ajuste de válvulas, Cambio empaque culatín, Fisura en carcaza eje salida, debe aplicar soldadura.', '2025-10-29 21:39:17'),
(38, 15, 3, '✅ Caso cerrado por el mecánico.', '2025-10-29 22:56:02'),
(39, 12, 3, 'solo enciende con pedal.', '2025-10-29 22:56:32'),
(40, 12, 3, 'Primera rodada sin problema pero aún no enciende con arranque eléctrico.', '2025-10-29 23:27:25'),
(41, 12, 3, 'Holgura de bobina pulsora fuera de lìmite,', '2025-10-30 17:52:12'),
(42, 16, 3, 'Dejar enfriar, drenar aceite abrir cubierta àrbol de levas para revisar', '2025-10-30 17:55:15'),
(43, 12, 3, 'Falla de encendido solucionada.', '2025-10-30 19:48:47'),
(44, 12, 3, 'Cambio de pines Direccionales traseras y delanteras.', '2025-10-30 22:49:15'),
(45, 12, 3, 'ya mucho. Me voy pa la casa.', '2025-10-31 01:16:50'),
(46, 12, 4, 'Se fue por fin.', '2025-11-01 01:02:32'),
(47, 12, 4, '✅ Caso cerrado por el mecánico.', '2025-11-01 01:02:44'),
(48, 13, 4, 'Batería se puso a cargar pero no mantiene carga.', '2025-11-01 16:22:48'),
(49, 13, 4, 'Ajuste de válvulas, cambio de oRings tapas de válvulas.', '2025-11-01 17:06:44'),
(50, 13, 4, 'Cambio de cadena, cambio de llanta y neumàtico, cambio de bandas.\r\nPendiente empaque tapa y cambio de retenes volante.', '2025-11-02 00:41:30'),
(51, 12, 4, '✅ Caso cerrado por el mecánico.', '2025-11-04 13:42:26'),
(52, 17, 4, 'Se cambia el mando por el de segunda, el soporte del botón start está rota pero aún así funciona sin problemas.', '2025-11-04 21:35:01'),
(53, 18, 4, 'Bomba no se escucha, Comprobar voltages hacia la bomba', '2025-11-04 23:07:07'),
(54, 18, 4, 'La bomba está alimentada correctamente, Desmontar la bomba para revisión', '2025-11-04 23:07:41'),
(55, 18, 4, 'Bomba atascada con suciedad y gasolina envejecida, limbiar y despegar.\r\nLa bomba ahora funciona correctamente pero sale combustible negro', '2025-11-04 23:08:48'),
(56, 18, 4, 'Limpieza de conductos y montaje.\r\nMoto enciende correctamente, re armar y probar.', '2025-11-04 23:09:40'),
(57, 18, 4, '✅ Caso cerrado por el mecánico.', '2025-11-04 23:09:48'),
(58, 19, 4, 'Cambiar escobillas y hacer mantenimiento.', '2025-11-05 15:06:31'),
(59, 19, 4, '✅ Caso cerrado por el mecánico.', '2025-11-05 15:06:37'),
(60, 21, 4, 'Pendiente a hacer mantenimiento general.', '2025-11-05 15:55:35'),
(61, 20, 4, 'Rearmar mando derecho, limar imperfecciones en la base del carburador.', '2025-11-05 19:55:12'),
(62, 20, 4, '✅ Caso cerrado por el mecánico.', '2025-11-05 19:55:19'),
(63, 22, 4, 'Baterìa en carga.', '2025-11-05 20:04:06'),
(64, 22, 4, 'Pedal de arranque se queda abajo. A desmontar!', '2025-11-05 20:12:31'),
(65, 22, 4, 'Ajuste de vàlvulas', '2025-11-06 19:03:33'),
(66, 22, 4, 'Vàlvulas fuera de ajuste, Cortina y aguja de carburador dañados.', '2025-11-06 20:13:51'),
(67, 22, 4, 'Pendiente a cambio de empaque de culatìn.', '2025-11-06 20:14:12'),
(68, 23, 4, 'Cambio de bobina de carga y luces.\r\ncambio regulador.\r\ncambio de batería.\r\nOrganizar cableado.', '2025-11-07 14:21:19'),
(69, 23, 4, 'Buscar rodamiento que falta.', '2025-11-07 15:16:33'),
(70, 23, 4, 'Rodamiento 36000', '2025-11-07 15:16:46'),
(71, 22, 4, 'cadenilla sedida, guías gastadas.\r\nVariador dañado, se debe cambiar.', '2025-11-07 22:25:40'),
(72, 22, 4, 'Cambio de pastilla de freno trasero.', '2025-11-10 19:35:46'),
(73, 23, 4, 'Aplicar removedor de pintura a las carcazas centrales.', '2025-11-10 19:36:53'),
(74, 24, 4, 'Cambio de terminales de bobinas de carga y luces.\r\nDiafragma perforado.', '2025-11-11 16:14:07'),
(75, 24, 4, 'Aplicado t7000 al diafragma para tapar perforación.', '2025-11-11 16:31:04'),
(76, 21, 4, 'Freno trasero grita.\r\nFreno delantero se atasca.', '2025-11-11 16:32:05'),
(77, 21, 4, 'Mantenimientp freno delantero .', '2025-11-12 14:54:03'),
(78, 21, 4, '✅ Caso cerrado por el mecánico.', '2025-11-12 14:54:10'),
(79, 22, 4, 'desarmar cabeza de fuerza para cambio de cadena y guías', '2025-11-12 14:55:07'),
(80, 25, 4, 'Guaya de ascelerador dañada, Diafragma de carburador en mal estado.', '2025-11-12 16:11:23'),
(81, 25, 4, 'Se Cambia la guaya de ascelerador\r\nreparar diafragma\r\ndesmontar carburador para mantenimiento\r\nfiltro de gasolina\r\narmado y ajuste de carburador', '2025-11-13 00:05:38'),
(82, 25, 4, 'no Hay luces', '2025-11-13 14:51:05'),
(83, 25, 4, 'Corrección de cableado en unidad de control de luces y cambio de bombillo.', '2025-11-13 15:28:58'),
(84, 25, 4, 'cambio bombillo Stop', '2025-11-13 15:37:04'),
(85, 26, 4, 'Rodamientos 6004-6202-6202', '2025-11-13 17:13:12'),
(86, 26, 4, 'Cambio de rodamientos rueda delantela 6202, 6202\r\nPendiente autorización para cambiar pastillas.', '2025-11-13 20:13:07'),
(87, 26, 4, 'pastillas no autorizadas. Nota: Disco de freno está torcido.', '2025-11-13 20:39:40'),
(88, 25, 4, 'Abrir tapa cluth para revisar resorte de crank', '2025-11-13 20:40:23'),
(89, 25, 4, 'resorte de crank roto.', '2025-11-13 21:18:20'),
(90, 25, 4, '✅ Caso cerrado por el mecánico.', '2025-11-14 15:44:52'),
(91, 27, 4, 'Motor desmontado', '2025-11-14 17:26:04'),
(92, 28, 4, '🆕 Caso creado a partir del caso anterior #20', '2025-11-14 21:15:41'),
(93, 28, 4, 'Cambiar guaya de embrague.', '2025-11-14 21:16:07'),
(94, 27, 4, 'motor desarmado.', '2025-11-14 21:45:09'),
(95, 27, 4, 'hacer rosca para tapón de aceite', '2025-11-15 19:14:15'),
(96, 27, 4, 'Pista de rodamiento de cigüeñal gastada, se lleva para rectificadora', '2025-11-15 22:24:15'),
(97, 30, 4, '✅ Caso cerrado por el mecánico.', '2025-11-17 19:09:09'),
(98, 27, 4, 'Cambio de barras, pendiente poner aceite.', '2025-11-19 00:09:17'),
(99, 27, 4, 'Cargar aceite en la suspensión delantera.', '2025-11-27 15:00:58'),
(100, 27, 4, 'Terminar de cerrar motor.', '2025-11-27 15:01:36'),
(101, 27, 4, 'Motor no enciende o se apaga después de un rato. Se pierde la corriente.', '2025-11-27 15:02:06'),
(102, 27, 4, 'falla de encendido:\r\nCdi bien.', '2025-11-28 21:41:07');

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
  `estado` enum('abierto','cerrado') DEFAULT 'abierto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `casos`
--

INSERT INTO `casos` (`id`, `vehiculo_id`, `mecanico_id`, `fecha_ingreso`, `hora_ingreso`, `causa`, `observaciones`, `diagnostico`, `estado`) VALUES
(3, 6, 3, '2025-10-24', '09:01:13', 'Vehículo llega con motor desarmado. Se solicita instalar caja de seis velocidades e instalar cilindro y culata para aumentar cilindrada a 200cc', NULL, NULL, 'cerrado'),
(4, 7, 3, '2025-10-24', '09:27:53', 'Motor llega con fugas de aceite y exploradoras dejaron de funcionar', NULL, NULL, 'abierto'),
(5, 8, 3, '2025-10-24', '10:11:25', 'Cambiar cubiertas recién pintadas + cubierta frontal nueva', NULL, NULL, 'cerrado'),
(6, 9, 3, '2025-10-25', '09:57:59', 'Cambiar bujes de tijera y cadena.', NULL, NULL, 'abierto'),
(7, 10, 3, '2025-10-25', '12:11:04', 'cambiar rodamientos manzana trasera, portaplaca', NULL, NULL, 'abierto'),
(8, 11, 3, '2025-10-27', '10:46:16', 'Cambiar pastillas freno trasero', NULL, NULL, 'cerrado'),
(9, 12, 3, '2025-10-27', '11:15:11', 'Arranque muerto', NULL, NULL, 'abierto'),
(10, 13, 3, '2025-10-27', '11:57:08', 'se instalaron barras nuevas pero la suspensiòn està muy dura.', NULL, NULL, 'abierto'),
(11, 14, 3, '2025-10-28', '15:04:02', 'Sistema eléctrico Batería aislada\r\nRueda trasera frenada mal armada', NULL, NULL, 'abierto'),
(12, 15, 3, '2025-10-28', '16:56:52', 'No enciende tras cambiar ramal elèctrico', NULL, NULL, 'cerrado'),
(13, 16, 3, '2025-10-29', '10:54:33', 'Freno trasero se pega, Motor gotea aceite, freno delandero agarrotado, tensionar cadena.', NULL, NULL, 'abierto'),
(14, 17, 3, '2025-10-29', '14:26:55', 'Tensionar freno trasero y cadena', NULL, NULL, 'abierto'),
(15, 18, 3, '2025-10-29', '16:10:33', 'Pierde aceite por empaque culatín.', NULL, NULL, 'cerrado'),
(16, 19, 3, '2025-10-30', '12:54:25', 'Motor suena mal', NULL, NULL, 'abierto'),
(17, 20, 4, '2025-11-04', '16:33:34', 'Cambiar mando derecho por mando de segunda, el mando de cambio tiene defecto en base de botón start.', NULL, NULL, 'abierto'),
(18, 21, 4, '2025-11-04', '18:06:00', 'Un mes en patios ahora no enciende', NULL, NULL, 'cerrado'),
(19, 22, 4, '2025-11-05', '09:28:42', 'No da arranque', NULL, NULL, 'cerrado'),
(20, 23, 4, '2025-11-05', '10:20:07', 'Mando derecho abierto, Acelerador no funciona.', NULL, NULL, 'cerrado'),
(21, 24, 4, '2025-11-05', '10:47:13', 'Cambio de baterìa.', NULL, NULL, 'cerrado'),
(22, 25, 4, '2025-11-05', '14:56:47', 'No enciende y si llega a hacerlo se ahoga, se recibe sin cubiertas de parte frontal.', NULL, NULL, 'abierto'),
(23, 26, 4, '2025-11-07', '09:20:06', 'Ajustar sistema eléctrico a 12v.', NULL, NULL, 'abierto'),
(24, 27, 4, '2025-11-11', '11:13:32', 'Descarga la batería, se ahoga', NULL, NULL, 'abierto'),
(25, 28, 4, '2025-11-12', '11:10:46', 'Se ahoga, Motor ascelerado, Alto consumo.', NULL, NULL, 'cerrado'),
(26, 29, 4, '2025-11-13', '11:46:52', 'Rodamientos rueda trasera', NULL, NULL, 'abierto'),
(27, 30, 4, '2025-11-14', '10:46:16', 'Motor trabajó sin aceite, suema mal, desmontar para revisar.', NULL, NULL, 'abierto'),
(28, 23, 4, '2025-11-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #20', '', 'abierto'),
(29, 31, 4, '2025-11-15', '09:10:46', 'Cambiar Guardabarro delantero, cambio de aceite, Cambiar Palanca de cambios.', NULL, NULL, 'abierto'),
(30, 32, 4, '2025-11-15', '18:29:58', 'Cambio de batería', NULL, NULL, 'cerrado');

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

--
-- Dumping data for table `sesiones_trabajo`
--

INSERT INTO `sesiones_trabajo` (`id`, `caso_id`, `mecanico_id`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `duracion`) VALUES
(23, 5, 3, '2025-10-24', '10:11:29', '2025-10-24', '12:04:10', 533),
(24, 4, 3, '2025-10-24', '14:01:26', '2025-10-24', '14:09:06', 428),
(25, 5, 3, '2025-10-24', '14:09:35', '2025-10-24', '14:15:28', 426),
(26, 5, 3, '2025-10-24', '14:34:38', '2025-10-24', '16:10:05', 515),
(27, 4, 3, '2025-10-24', '16:10:17', '2025-10-24', '17:11:32', 481),
(28, 5, 3, '2025-10-24', '17:11:45', '2025-10-24', '17:35:37', 444),
(29, 5, 3, '2025-10-24', '18:13:33', '2025-10-24', '18:54:15', 461),
(30, 5, 3, '2025-10-25', '08:40:10', '2025-10-25', '08:40:21', 420),
(31, 6, 3, '2025-10-25', '09:58:04', '2025-10-25', '10:59:45', 482),
(32, 6, 3, '2025-10-25', '11:45:06', NULL, NULL, 0),
(33, 7, 3, '2025-10-25', '12:11:17', '2025-10-25', '12:42:07', 451),
(34, 7, 3, '2025-10-25', '12:44:27', '2025-10-25', '13:59:50', 495),
(35, 8, 3, '2025-10-27', '10:46:19', '2025-10-27', '11:03:03', 377),
(36, 9, 3, '2025-10-27', '11:15:15', '2025-10-27', '11:55:26', 400),
(37, 10, 3, '2025-10-27', '11:57:12', '2025-10-27', '12:02:55', 366),
(38, 10, 3, '2025-10-27', '16:24:37', '2025-10-27', '16:30:10', 366),
(39, 11, 3, '2025-10-28', '15:04:05', '2025-10-28', '16:54:44', 471),
(40, 12, 3, '2025-10-28', '16:56:56', '2025-10-28', '17:19:18', 382),
(41, 12, 3, '2025-10-29', '09:54:38', '2025-10-29', '10:52:12', 418),
(42, 13, 3, '2025-10-29', '10:54:35', '2025-10-29', '11:24:47', 390),
(43, 12, 3, '2025-10-29', '11:25:06', '2025-10-29', '12:36:54', 432),
(44, 12, 3, '2025-10-29', '14:16:52', '2025-10-29', '14:22:34', 366),
(45, 14, 3, '2025-10-29', '14:26:57', NULL, NULL, 0),
(46, 12, 3, '2025-10-29', '14:36:41', '2025-10-29', '15:23:44', 407),
(47, 12, 3, '2025-10-29', '15:51:22', '2025-10-29', '16:02:11', 371),
(48, 15, 3, '2025-10-29', '16:10:35', '2025-10-29', '16:39:21', 389),
(49, 12, 3, '2025-10-29', '17:56:13', '2025-10-29', '18:38:18', 402),
(50, 12, 3, '2025-10-30', '10:43:44', '2025-10-30', '14:48:55', 605),
(51, 16, 3, '2025-10-30', '12:54:33', '2025-10-30', '12:55:29', 361),
(52, 12, 3, '2025-10-30', '17:48:42', '2025-10-30', '20:16:54', 508),
(53, 12, 4, '2025-10-31', '12:58:00', '2025-10-31', '20:02:37', 785),
(54, 13, 4, '2025-11-01', '11:22:17', '2025-11-01', '19:41:33', 859),
(55, 12, 4, '2025-11-01', '19:41:50', '2025-11-01', '21:32:18', 470),
(56, 17, 4, '2025-11-04', '16:33:38', '2025-11-04', '18:01:43', 448),
(57, 18, 4, '2025-11-04', '18:06:03', '2025-11-04', '18:09:45', 364),
(58, 19, 4, '2025-11-05', '09:28:45', '2025-11-05', '10:06:34', 398),
(59, 20, 4, '2025-11-05', '10:20:10', '2025-11-05', '10:46:09', 386),
(60, 21, 4, '2025-11-05', '10:47:14', '2025-11-05', '10:55:38', 368),
(61, 20, 4, '2025-11-05', '10:56:04', '2025-11-05', '14:55:16', 599),
(62, 22, 4, '2025-11-05', '14:56:49', '2025-11-06', '14:03:17', 1746),
(63, 22, 4, '2025-11-05', '14:56:49', '2025-11-06', '14:03:13', 1746),
(64, 22, 4, '2025-11-06', '14:03:21', '2025-11-06', '15:14:15', 431),
(65, 21, 4, '2025-11-06', '15:15:27', '2025-11-06', '16:28:46', 433),
(66, 23, 4, '2025-11-07', '09:20:10', '2025-11-07', '10:53:08', 453),
(67, 22, 4, '2025-11-07', '17:07:06', '2025-11-08', '17:08:43', 1802),
(68, 22, 4, '2025-11-10', '14:35:24', '2025-11-10', '14:35:50', 360),
(69, 23, 4, '2025-11-10', '14:36:22', '2025-11-14', '17:20:00', 6284),
(70, 24, 4, '2025-11-11', '11:13:37', '2025-11-11', '11:31:07', 378),
(71, 21, 4, '2025-11-11', '11:31:43', '2025-11-11', '12:10:12', 398),
(72, 21, 4, '2025-11-12', '09:53:43', '2025-11-12', '09:54:06', 360),
(73, 22, 4, '2025-11-12', '09:54:37', '2025-11-12', '11:09:05', 434),
(74, 25, 4, '2025-11-12', '11:10:49', '2025-11-12', '19:05:41', 835),
(75, 25, 4, '2025-11-13', '09:50:56', '2025-11-13', '11:05:32', 435),
(76, 26, 4, '2025-11-13', '11:46:55', '2025-11-13', '15:13:10', 566),
(77, 26, 4, '2025-11-13', '15:39:02', '2025-11-13', '15:39:44', 361),
(78, 25, 4, '2025-11-13', '15:40:05', '2025-11-13', '16:18:24', 398),
(79, 27, 4, '2025-11-14', '10:46:19', '2025-11-14', '12:26:08', 460),
(80, 27, 4, '2025-11-14', '15:49:30', '2025-11-14', '16:45:13', 416),
(81, 28, 4, '2025-11-14', '16:15:45', '2025-11-14', '16:44:10', 388),
(82, 23, 4, '2025-11-14', '17:20:04', '2025-11-14', '17:20:11', 360),
(83, 27, 4, '2025-11-15', '08:35:43', '2025-11-15', '09:09:22', 394),
(84, 29, 4, '2025-11-15', '09:10:49', '2025-11-15', '10:04:43', 414),
(85, 27, 4, '2025-11-15', '14:13:54', '2025-11-15', '18:14:06', 600),
(86, 30, 4, '2025-11-15', '18:30:00', '2025-11-17', '14:09:06', 2979),
(87, 27, 4, '2025-11-17', '14:55:50', '2025-11-18', '13:56:14', 1740),
(88, 27, 4, '2025-11-18', '13:56:20', '2025-11-18', '19:09:20', 673),
(89, 27, 4, '2025-11-27', '10:00:15', '2025-11-28', '14:05:53', 2046),
(90, 27, 4, '2025-11-28', '16:40:18', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contraseña_hash` varchar(255) NOT NULL,
  `rol` enum('admin','mecanico') NOT NULL DEFAULT 'mecanico',
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `contraseña_hash`, `rol`, `fecha_creacion`) VALUES
(3, 'Max Power', 'Max Power', '$2y$10$nt/Txex/5Cn289LMX27vbesaVUgdk.jE1kDCl6KMnyYbIkiX.efB6', 'admin', '2025-10-24 08:49:25'),
(4, 'Yotas', 'Mech1', '$2y$10$.rXtHAHRQI/q5q73FsLlAucx4sPPb6GqanSXo/oSgV7cgMTQwaGpi', 'mecanico', '2025-10-24 08:50:10');

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
  `propietario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `marca`, `modelo`, `color`, `propietario`) VALUES
(6, 'KNF36', 'Honda', 'XL185', 'Azul', 'Yo'),
(7, 'NQS51A', 'Suzuki', 'GN125h', 'Red', 'Arnulfo Pintor'),
(8, 'MEQ60E', 'Yamaha', 'Cripton Fi', 'Rojo negro', 'Eibar'),
(9, 'BGQ86E', 'Akt', 'Flex125', 'Blanco', 'Doña'),
(10, 'IDB77B', 'Suzuki', 'Viva X', 'Negra', 'Doña'),
(11, 'BXG49H', 'Bajaj', '200Ns', 'Negra', 'Don'),
(12, 'RIY59F', '', 'Victory', 'Negro', 'Manuel'),
(13, 'OLO64B', 'Akt', 'Sl', 'Rojo', 'Cami||o'),
(14, 'OQO88E', 'Victory', 'One', 'Negro', 'Maduros'),
(15, 'RKT70C', 'Bajaj', 'Pulsar 135', 'Negro', 'Senador Cristian'),
(16, 'MEE17B', 'Kymco', 'Active 110', 'Rojo/ Negro', 'Yolanda Tkd'),
(17, 'JYI69E', 'Honda', 'Cb110', 'Rojo', 'GustavoYerno'),
(18, 'QMV60C', 'Akt', 'Evo', 'Negro', ''),
(19, 'AML67', 'Yamaha', 'Xt225', 'Azul', 'Nelson Borbòn'),
(20, 'WAG02F', 'Akt', 'Nkd', 'Negro', 'Don'),
(21, 'SYD47E', 'Yamaha', 'Fz2', 'Azul', 'Diana Marido'),
(22, 'RCQ54D', 'Bajaj', 'Discover100m', 'Negro', 'Victor'),
(23, 'JMB43C', 'Akt', 'Evo150', 'Rojo', 'Leonel Publicidad'),
(24, 'MKB89C', 'Suzuki', 'Viva X', 'Negro', 'Jesùs vecino taller'),
(25, 'JHW47F', 'Victory', 'Life', 'Negro', 'Diana Cuñado'),
(26, 'FVB22A', 'Suzuki', 'Ax115', 'Rojo', 'Camilo Muñóz'),
(27, 'QRB81C', 'Kymco', 'Agility', 'Rojo', 'VecinoJoseManuelCuellarHurtado'),
(28, 'THZ82D', 'Bajaj', 'Discover125', 'Negro', 'Costeño Maduros'),
(29, 'TBE70C', 'Yamaha', 'Fz16', 'Blanco', 'Vecino'),
(30, 'JYN56E', 'Akt', 'Nkd', 'Negro', 'Mauricio Quintero'),
(31, 'IWO76E', 'Yamaha', 'Xtz125', 'Azul', 'William'),
(32, 'KKH08C', 'Yamaha', 'Cripton 115', 'Negro', 'Miguel Malavides');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
