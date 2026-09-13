-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2026 at 01:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `aplicacion_parte`
--

CREATE TABLE `aplicacion_parte` (
  `id` int(11) NOT NULL,
  `parte_id` int(11) NOT NULL,
  `modelo_moto_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aplicacion_parte`
--

INSERT INTO `aplicacion_parte` (`id`, `parte_id`, `modelo_moto_id`, `created_at`, `updated_at`) VALUES
(1, 1, 8, '2026-07-20 18:45:37', '2026-07-20 18:45:37'),
(2, 1, 5, '2026-07-20 18:45:37', '2026-07-20 18:45:37'),
(3, 1, 1, '2026-07-20 18:45:37', '2026-07-20 18:45:37'),
(4, 1, 3, '2026-07-20 18:45:37', '2026-07-20 18:45:37'),
(5, 1, 7, '2026-07-20 18:45:37', '2026-07-20 18:45:37'),
(32, 4, 11, '2026-07-22 04:29:19', '2026-07-22 04:29:19'),
(33, 4, 10, '2026-07-22 04:29:19', '2026-07-22 04:29:19'),
(34, 4, 12, '2026-07-22 04:29:19', '2026-07-22 04:29:19'),
(35, 9, 9, '2026-07-23 16:14:45', '2026-07-23 16:14:45'),
(36, 9, 8, '2026-07-23 16:14:45', '2026-07-23 16:14:45'),
(41, 12, 18, '2026-07-23 17:02:12', '2026-07-23 17:02:12'),
(42, 12, 20, '2026-07-23 17:02:13', '2026-07-23 17:02:13'),
(43, 12, 15, '2026-07-23 17:02:13', '2026-07-23 17:02:13'),
(44, 12, 16, '2026-07-23 17:02:13', '2026-07-23 17:02:13'),
(45, 12, 19, '2026-07-23 17:02:13', '2026-07-23 17:02:13'),
(46, 14, 20, '2026-07-24 15:24:02', '2026-07-24 15:24:02'),
(47, 2, 9, '2026-07-25 13:49:08', '2026-07-25 13:49:08'),
(48, 2, 8, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(49, 2, 11, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(50, 2, 10, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(51, 2, 12, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(52, 2, 18, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(53, 2, 20, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(54, 2, 15, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(55, 2, 16, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(56, 2, 19, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(57, 2, 1, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(58, 2, 3, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(59, 2, 14, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(60, 2, 7, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(61, 2, 6, '2026-07-25 13:49:09', '2026-07-25 13:49:09'),
(63, 22, 12, '2026-08-07 20:50:04', '2026-08-07 20:50:04'),
(64, 22, 30, '2026-08-07 20:50:04', '2026-08-07 20:50:04'),
(65, 25, 12, '2026-08-07 21:46:17', '2026-08-07 21:46:17'),
(66, 25, 30, '2026-08-07 21:46:17', '2026-08-07 21:46:17'),
(67, 26, 38, '2026-08-08 15:02:44', '2026-08-08 15:02:44'),
(68, 26, 37, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(69, 26, 28, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(70, 26, 11, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(71, 26, 33, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(72, 26, 10, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(73, 26, 12, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(74, 26, 36, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(75, 26, 35, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(76, 26, 32, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(77, 26, 30, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(78, 26, 31, '2026-08-08 15:02:45', '2026-08-08 15:02:45'),
(79, 27, 38, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(80, 27, 37, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(81, 27, 28, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(82, 27, 11, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(83, 27, 33, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(84, 27, 10, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(85, 27, 12, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(86, 27, 36, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(87, 27, 35, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(88, 27, 32, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(89, 27, 30, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(90, 27, 31, '2026-08-08 15:06:02', '2026-08-08 15:06:02'),
(91, 28, 12, '2026-08-08 15:09:51', '2026-08-08 15:09:51'),
(92, 29, 12, '2026-08-08 15:12:11', '2026-08-08 15:12:11'),
(93, 30, 12, '2026-08-08 19:58:01', '2026-08-08 19:58:01'),
(94, 31, 12, '2026-08-10 15:08:55', '2026-08-10 15:08:55'),
(95, 31, 27, '2026-08-10 15:08:55', '2026-08-10 15:08:55'),
(96, 32, 38, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(97, 32, 37, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(98, 32, 28, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(99, 32, 11, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(100, 32, 33, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(101, 32, 10, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(102, 32, 12, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(103, 32, 36, '2026-08-11 20:57:03', '2026-08-11 20:57:03'),
(104, 32, 35, '2026-08-11 20:57:04', '2026-08-11 20:57:04'),
(105, 32, 32, '2026-08-11 20:57:04', '2026-08-11 20:57:04'),
(106, 32, 30, '2026-08-11 20:57:04', '2026-08-11 20:57:04'),
(107, 32, 31, '2026-08-11 20:57:04', '2026-08-11 20:57:04'),
(108, 33, 38, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(109, 33, 37, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(110, 33, 28, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(111, 33, 11, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(112, 33, 33, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(113, 33, 10, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(114, 33, 12, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(115, 33, 36, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(116, 33, 35, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(117, 33, 32, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(118, 33, 30, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(119, 33, 31, '2026-08-11 21:48:03', '2026-08-11 21:48:03'),
(120, 34, 12, '2026-08-11 23:11:39', '2026-08-11 23:11:39'),
(123, 35, 20, '2026-08-12 19:31:42', '2026-08-12 19:31:42'),
(124, 35, 16, '2026-08-12 19:31:42', '2026-08-12 19:31:42'),
(125, 38, 9, '2026-08-12 22:05:12', '2026-08-12 22:05:12'),
(126, 38, 8, '2026-08-12 22:05:12', '2026-08-12 22:05:12'),
(127, 38, 23, '2026-08-12 22:05:12', '2026-08-12 22:05:12'),
(128, 38, 16, '2026-08-12 22:05:12', '2026-08-12 22:05:12'),
(129, 39, 20, '2026-08-13 01:17:01', '2026-08-13 01:17:01'),
(130, 40, 22, '2026-08-29 23:53:44', '2026-08-29 23:53:44'),
(131, 41, 44, '2026-08-31 22:40:36', '2026-08-31 22:40:36'),
(132, 42, 45, '2026-08-31 22:49:51', '2026-08-31 22:49:51'),
(133, 43, 38, '2026-08-31 22:54:29', '2026-08-31 22:54:29'),
(134, 43, 44, '2026-08-31 22:54:29', '2026-08-31 22:54:29'),
(135, 44, 48, '2026-09-04 19:02:04', '2026-09-04 19:02:04'),
(136, 45, 48, '2026-09-04 19:08:30', '2026-09-04 19:08:30'),
(137, 46, 47, '2026-09-04 20:52:11', '2026-09-04 20:52:11'),
(138, 47, 47, '2026-09-04 21:00:28', '2026-09-04 21:00:28'),
(139, 48, 48, '2026-09-04 21:10:20', '2026-09-04 21:10:20'),
(140, 50, 53, '2026-09-08 13:25:14', '2026-09-08 13:25:14'),
(141, 50, 52, '2026-09-08 13:25:14', '2026-09-08 13:25:14'),
(142, 51, 51, '2026-09-08 19:04:42', '2026-09-08 19:04:42'),
(143, 52, 10, '2026-09-10 13:32:27', '2026-09-10 13:32:27'),
(144, 53, 10, '2026-09-10 15:16:03', '2026-09-10 15:16:03'),
(145, 54, 11, '2026-09-10 15:21:56', '2026-09-10 15:21:56'),
(146, 54, 10, '2026-09-10 15:21:56', '2026-09-10 15:21:56'),
(147, 55, 10, '2026-09-10 15:32:28', '2026-09-10 15:32:28'),
(148, 24, 10, '2026-09-10 15:33:54', '2026-09-10 15:33:54'),
(149, 24, 30, '2026-09-10 15:33:54', '2026-09-10 15:33:54'),
(152, 56, 10, '2026-09-10 15:37:38', '2026-09-10 15:37:38'),
(153, 56, 30, '2026-09-10 15:37:38', '2026-09-10 15:37:38'),
(154, 58, 10, '2026-09-10 16:16:29', '2026-09-10 16:16:29'),
(155, 23, 10, '2026-09-10 16:24:50', '2026-09-10 16:24:50'),
(156, 23, 55, '2026-09-10 16:24:50', '2026-09-10 16:24:50'),
(157, 23, 57, '2026-09-10 16:24:50', '2026-09-10 16:24:50'),
(158, 23, 56, '2026-09-10 16:24:50', '2026-09-10 16:24:50'),
(160, 60, 48, '2026-09-12 19:23:23', '2026-09-12 19:23:23'),
(161, 60, 58, '2026-09-12 19:23:23', '2026-09-12 19:23:23');

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

--
-- Dumping data for table `avances`
--

INSERT INTO `avances` (`id`, `caso_id`, `mecanico_id`, `descripcion`, `tipo`, `valor`, `fecha`) VALUES
(12, 5, 3, 'Mantenimiento mando pito y direccionales.', 'Repuesto', 0, '2025-10-24 15:11:56'),
(13, 5, 3, 'cambio de pito', 'Repuesto', 0, '2025-10-24 15:54:41'),
(14, 5, 3, 'Cambio de cristal y  lubricación de guaya de velocímetro', 'Repuesto', 0, '2025-10-24 16:03:16'),
(15, 5, 3, 'lubricar y tensionar cadena', 'Repuesto', 0, '2025-10-24 16:27:21'),
(16, 4, 3, 'Drenado de aceite', 'Repuesto', 0, '2025-10-24 19:09:03'),
(17, 5, 3, 'instalación guardabarro delantero, cubierta frontal, direccionales, gato lateral, cabeza de luces', 'Repuesto', 0, '2025-10-24 21:08:42'),
(18, 6, 3, 'desmontaje', 'Repuesto', 0, '2025-10-25 15:59:42'),
(19, 3, 3, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-10-26 20:54:41'),
(20, 8, 3, 'leto', 'Repuesto', 0, '2025-10-27 16:02:58'),
(21, 8, 3, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-10-27 16:03:06'),
(22, 9, 3, 'Masa general arrancada.', 'Repuesto', 0, '2025-10-27 16:54:40'),
(23, 9, 3, 'Se reconectò masa general pero aùn no se activa el arranque.', 'Repuesto', 0, '2025-10-27 16:55:19'),
(24, 10, 3, 'Desmontando suspensiòn', 'Repuesto', 0, '2025-10-27 17:02:51'),
(25, 10, 3, 'Reinstalaciòn de barras', 'Repuesto', 0, '2025-10-27 21:30:05'),
(26, 11, 3, 'Sistema eléctrico con linea abierto a nivel de la dirección.', 'Repuesto', 0, '2025-10-28 20:04:41'),
(27, 11, 3, 'Ajuste de Switch.', 'Repuesto', 0, '2025-10-28 20:04:53'),
(28, 11, 3, 'Rearmar rueda trasera mantenimiento sistema de freno', 'Repuesto', 0, '2025-10-28 21:54:39'),
(29, 12, 3, 'Correcciòn de la posiciòn de los pines de tablero y mandos en el ramal nuevo.', 'Repuesto', 0, '2025-10-28 22:19:14'),
(30, 12, 3, 'cambio de manguera y mantenimiento a carburador, gasolina se desborda.', 'Repuesto', 0, '2025-10-29 15:52:08'),
(31, 13, 3, 'se deja baterìa para carga, probablemente se deba cambiar corona de bobinas.', 'Repuesto', 0, '2025-10-29 16:24:44'),
(32, 12, 3, 'Baterìa se pone en carga', 'Repuesto', 0, '2025-10-29 16:25:21'),
(33, 12, 3, 'Baterìa se pone en carga', 'Repuesto', 0, '2025-10-29 16:25:21'),
(34, 12, 3, 'enrutado de cableado', 'Repuesto', 0, '2025-10-29 17:36:47'),
(35, 12, 3, 'Conexionado', 'Repuesto', 0, '2025-10-29 19:22:30'),
(36, 14, 3, 'aceitar y tensionar cadena, ajustar freno trasero. \r\nAjuste marcha mínima después de revisión técnico mecánica.\r\nPendiente Cambio de barras.', 'Repuesto', 0, '2025-10-29 19:36:05'),
(37, 15, 3, 'Ajuste de válvulas, Cambio empaque culatín, Fisura en carcaza eje salida, debe aplicar soldadura.', 'Repuesto', 0, '2025-10-29 21:39:17'),
(38, 15, 3, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-10-29 22:56:02'),
(39, 12, 3, 'solo enciende con pedal.', 'Repuesto', 0, '2025-10-29 22:56:32'),
(40, 12, 3, 'Primera rodada sin problema pero aún no enciende con arranque eléctrico.', 'Repuesto', 0, '2025-10-29 23:27:25'),
(41, 12, 3, 'Holgura de bobina pulsora fuera de lìmite,', 'Repuesto', 0, '2025-10-30 17:52:12'),
(42, 16, 3, 'Dejar enfriar, drenar aceite abrir cubierta àrbol de levas para revisar', 'Repuesto', 0, '2025-10-30 17:55:15'),
(43, 12, 3, 'Falla de encendido solucionada.', 'Repuesto', 0, '2025-10-30 19:48:47'),
(44, 12, 3, 'Cambio de pines Direccionales traseras y delanteras.', 'Repuesto', 0, '2025-10-30 22:49:15'),
(45, 12, 3, 'ya mucho. Me voy pa la casa.', 'Repuesto', 0, '2025-10-31 01:16:50'),
(191, 53, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:23:33'),
(192, 44, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:46:42'),
(193, 45, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:47:09'),
(194, 48, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:47:30'),
(195, 50, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:48:26'),
(196, 51, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:48:43'),
(197, 60, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:51:29'),
(198, 57, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:51:54'),
(199, 56, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:52:10'),
(200, 54, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:52:48'),
(201, 47, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:53:00'),
(202, 4, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:53:33'),
(203, 9, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:54:05'),
(204, 6, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:54:39'),
(205, 7, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:55:11'),
(206, 10, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:55:51'),
(207, 11, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:56:03'),
(208, 13, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:56:19'),
(209, 14, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:56:36'),
(210, 16, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:56:57'),
(211, 17, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:57:13'),
(212, 22, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:57:40'),
(213, 23, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:57:55'),
(214, 24, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:58:13'),
(215, 26, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:58:31'),
(216, 27, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:58:52'),
(217, 31, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:59:38'),
(218, 29, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 03:59:54'),
(220, 34, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:01:18'),
(221, 28, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:01:48'),
(222, 36, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:02:16'),
(223, 37, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:02:35'),
(224, 35, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:02:51'),
(225, 38, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:03:05'),
(226, 39, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:03:20'),
(227, 40, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:03:40'),
(229, 42, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:11:55'),
(230, 43, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:12:24'),
(231, 46, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:12:44'),
(232, 49, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:13:03'),
(233, 52, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:13:27'),
(244, 70, 3, '🆕 Caso creado a partir del caso anterior #16', 'Mano de obra', 0, '2026-07-07 02:31:28'),
(245, 70, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 02:32:37'),
(261, 72, 3, 'Recibido, pendiente llevar al taller.', 'Mano de obra', 0, '2026-07-08 05:19:30'),
(304, 86, 3, 'Cambio guayas acelerador.', 'Mano de obra', 20000, '2026-07-12 01:50:15'),
(305, 33, 3, 'Instalación guardabarro delantero y carenado para pintura.', 'Mano de obra', 10000, '2026-07-13 20:14:32'),
(307, 33, 3, 'Bujes.', 'Repuesto', 2000, '2026-07-13 20:15:00'),
(308, 87, 3, 'Repuesto: Cunas de dirección.', 'Repuesto', 34000, '2026-07-13 22:57:41'),
(309, 87, 3, 'Lubricar y ajustar cadena.\r\nLubricar guaya de embrague, posapies, pedal de arranque y de freno trasero.', 'Mano de obra', 10000, '2026-07-14 18:34:29'),
(310, 87, 3, 'Cambio de cunas de dirección.', 'Mano de obra', 40000, '2026-07-14 18:35:16'),
(311, 87, 3, 'Reconstruir gato lateral y porta placa.', 'Mano de obra', 40000, '2026-07-14 18:37:37'),
(312, 88, 3, 'Enderezar posapié delantero derecho.', 'Mano de obra', 5000, '2026-07-14 18:44:44'),
(313, 89, 3, '🆕 Caso creado a partir del caso anterior #30', 'Mano de obra', 0, '2026-07-14 20:49:23'),
(314, 89, 3, 'Reconstruir gato lateral.', 'Mano de obra', 11000, '2026-07-14 20:50:17'),
(315, 88, 3, 'Cambio guaya embrague.', 'Mano de obra', 5000, '2026-07-15 01:11:18'),
(316, 88, 3, 'Cambio prensa embrague.', 'Mano de obra', 50000, '2026-07-15 01:11:54'),
(317, 88, 3, 'Ajuste de freno delantero.', 'Mano de obra', 5000, '2026-07-15 01:12:16'),
(318, 88, 3, 'Reparar roscas posapié.', 'Mano de obra', 15000, '2026-07-15 01:12:42'),
(319, 88, 3, 'Fresado de campana prensa', 'Mano de obra', 20000, '2026-07-15 01:13:18'),
(320, 88, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-15 15:47:00'),
(321, 90, 3, 'oRing unión de carburador.', 'Repuesto', 4000, '2026-07-15 19:14:24'),
(322, 90, 3, 'Cambio oRing unión de carburador.', 'Mano de obra', 5000, '2026-07-15 19:14:35'),
(323, 90, 3, 'Ajuste palanca de cambios.', 'Mano de obra', 3000, '2026-07-15 19:21:49'),
(324, 91, 3, '🆕 Caso creado a partir del caso anterior #88', 'Mano de obra', 0, '2026-07-15 23:25:36'),
(325, 91, 3, 'Cambio de portaplato.', 'Mano de obra', 20000, '2026-07-15 23:26:28'),
(326, 91, 3, 'Mantenimiento mando y Cambio de direccionales.', 'Mano de obra', 10000, '2026-07-15 23:27:14'),
(327, 91, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-15 23:28:06'),
(328, 92, 3, 'Mantenimiento de mandos.', 'Mano de obra', 20000, '2026-07-17 17:46:32'),
(329, 93, 3, 'Ajuste de guaya Acelerador.', 'Mano de obra', 5000, '2026-07-17 20:11:37'),
(330, 94, 3, '🆕 Caso creado a partir del caso anterior #69', 'Mano de obra', 0, '2026-07-17 23:11:38'),
(331, 94, 3, 'Nivelar aceite, kilometraje 44711, 45329', 'Mano de obra', 0, '2026-07-17 23:12:50'),
(332, 94, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-17 23:17:34'),
(333, 93, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-18 16:53:46'),
(334, 89, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-18 16:54:34'),
(335, 87, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-18 16:55:23'),
(336, 86, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-18 16:55:57'),
(337, 95, 3, 'Ajuste de guaya de acelerador.', 'Mano de obra', 10000, '2026-07-18 16:58:24'),
(338, 92, 3, 'Bombillo stop.', 'Repuesto', 2000, '2026-07-18 20:06:09'),
(340, 92, 3, 'Recuperación sistema eléctrico.', 'Mano de obra', 60000, '2026-07-18 22:56:38'),
(341, 92, 3, 'Socket y bombillo luz piloto.', 'Repuesto', 3000, '2026-07-19 00:04:41'),
(342, 92, 3, 'Cambio de aceite.', 'Mano de obra', 3000, '2026-07-19 00:04:59'),
(343, 92, 3, 'Terminales de batería.', 'Repuesto', 5000, '2026-07-19 00:05:36'),
(344, 92, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-20 19:49:55'),
(346, 101, 3, 'Revisión.', 'Mano de obra', 32000, '2026-07-22 05:37:48'),
(347, 101, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-22 06:00:29'),
(348, 100, 3, 'Ajuste de válvulas.\r\nCambio de terminales de bobinas de alta.', 'Mano de obra', 20000, '2026-07-22 16:26:49'),
(349, 100, 3, 'Cambio de arranque.', 'Mano de obra', 10000, '2026-07-22 19:06:04'),
(350, 102, 3, '🆕 Caso creado a partir del caso anterior #81', 'Mano de obra', 0, '2026-07-22 19:38:44'),
(351, 100, 3, 'Lubricación.', 'Mano de obra', 9000, '2026-07-22 19:53:27'),
(352, 100, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-22 19:54:17'),
(353, 102, 3, 'Cambio aceite.', 'Mano de obra', 5000, '2026-07-22 23:49:56'),
(354, 102, 3, 'Cambio de fuelles de barra.', 'Mano de obra', 20000, '2026-07-22 23:50:12'),
(355, 102, 3, 'Cambio de mangos.', 'Mano de obra', 5000, '2026-07-22 23:50:33'),
(356, 103, 3, 'Cambio de rodmientos.', 'Mano de obra', 10000, '2026-07-23 00:36:26'),
(357, 103, 3, 'Observación: Se le informa al cliente, la manzana trasera bandas y porta plato deben cambiarse. Cliente dice pongamos rodamientos nuevos solamente... después los cambio.', 'Mano de obra', 0, '2026-07-23 03:05:38'),
(358, 103, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 03:07:31'),
(359, 102, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 04:29:54'),
(360, 104, 3, '🆕 Caso creado a partir del caso anterior #102', 'Mano de obra', 0, '2026-07-23 04:31:21'),
(361, 95, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 04:39:11'),
(362, 104, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 05:28:52'),
(363, 105, 3, '🆕 Caso creado a partir del caso anterior #67', 'Mano de obra', 0, '2026-07-23 14:50:13'),
(364, 105, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 14:50:53'),
(365, 106, 3, 'Botón run Oprimido.\r\nBatería descargada.', 'Mano de obra', 7000, '2026-07-23 15:25:43'),
(366, 106, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 16:13:24'),
(367, 107, 3, 'Enderezar alinear tenedor.', 'Mano de obra', 40000, '2026-07-23 17:03:20'),
(368, 108, 3, 'Cambiar varilla de freno.\r\nEnderezar pedal.', 'Mano de obra', 10000, '2026-07-23 18:21:14'),
(369, 108, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 18:22:27'),
(370, 110, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-23 19:56:13'),
(371, 111, 3, 'REeparación completa de motor.\r\nCambio de barras.\r\nRealizado en noviembre 2025, registro retrasado.', 'Mano de obra', 0, '2026-07-24 21:25:55'),
(372, 111, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-24 21:26:07'),
(373, 112, 3, '🆕 Caso creado a partir del caso anterior #111', 'Mano de obra', 0, '2026-07-24 21:26:12'),
(374, 112, 3, 'Ingreso- Difícil de encender, Se ahoga.', 'Mano de obra', 0, '2026-07-24 21:27:14'),
(375, 113, 3, '🆕 Caso creado a partir del caso anterior #31', 'Mano de obra', 0, '2026-07-25 14:13:38'),
(376, 113, 3, 'Completar aceite.', 'Mano de obra', 0, '2026-07-25 14:14:18'),
(377, 113, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-25 14:14:27'),
(378, 114, 3, '🆕 Caso creado a partir del caso anterior #29', 'Mano de obra', 0, '2026-07-25 14:45:26'),
(379, 114, 3, 'Revisar:\r\nDiscos cluth\r\nválvulas\r\nVelocímetro\r\nLuz tablero\r\nLubricar\r\nbandas.', 'Mano de obra', 0, '2026-07-25 14:46:35'),
(380, 114, 3, 'lubricar guaya de embrague, velocímetro y acelerador.', 'Mano de obra', 10000, '2026-07-25 21:14:32'),
(381, 114, 3, 'Cambio de bandas de freno', 'Mano de obra', 15000, '2026-07-25 21:15:08'),
(382, 114, 3, 'revisión de válvulas y discos de embrague.', 'Mano de obra', 20000, '2026-07-25 21:15:50'),
(383, 114, 3, 'Cambio de guaya velocímetro.', 'Mano de obra', 5000, '2026-07-25 21:16:48'),
(384, 33, 3, 'Soldadura escape,', 'Mano de obra', 20000, '2026-07-26 00:36:55'),
(385, 114, 3, 'Intalación de fuelles de barra.', 'Mano de obra', 10000, '2026-07-26 23:34:41'),
(386, 114, 3, 'Cambio de socket bombillo piloto.', 'Mano de obra', 5000, '2026-07-26 23:35:24'),
(387, 114, 3, 'Cambio de manigueta, base y guardamano izquierdos.', 'Mano de obra', 0, '2026-07-27 00:50:17'),
(388, 114, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-27 00:50:53'),
(389, 96, 3, 'Préstamo costo de torno.', 'Mano de obra', 45000, '2026-07-27 00:55:48'),
(390, 96, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-27 00:56:05'),
(391, 33, 3, 'Cojín se mueve de lado a lado, Cambio de soportes de caucho.', 'Mano de obra', 5000, '2026-07-27 00:58:15'),
(392, 33, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-27 00:58:26'),
(393, 116, 3, '🆕 Caso creado a partir del caso anterior #87', 'Mano de obra', 0, '2026-07-27 03:31:07'),
(394, 116, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-27 03:31:37'),
(395, 112, 3, 'Cambio e bujía.', 'Mano de obra', 0, '2026-07-27 23:39:29'),
(396, 112, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-27 23:40:58'),
(397, 118, 3, 'Cambio de prensa.\r\nCambio de retenedor.\r\nLubricación de guaya embrague.', 'Mano de obra', 60000, '2026-07-30 00:57:10'),
(398, 118, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-30 01:23:16'),
(399, 58, 3, 'Hacer plantilla para tapas laterales (por 2a vez)', 'Mano de obra', 10000, '2026-07-30 21:42:36'),
(400, 117, 3, 'Reparación total de cabeza de fuerza.\r\nBalancines de rodamiento.\r\nKit leva Racing.\r\nAnillos standart.', 'Mano de obra', 0, '2026-08-01 14:24:15'),
(401, 117, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-01 14:24:23'),
(402, 120, 3, 'Retirar Gps.\r\nOrganizar cableado.', 'Mano de obra', 40000, '2026-08-01 18:40:12'),
(403, 120, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-01 18:40:26'),
(404, 121, 3, 'Ajuste de cadena.\r\nRetirar soporte colgante dañado.\r\nReponer tornillo buje perdido.\r\nCalibrar aire ambas ruedas.', 'Mano de obra', 10000, '2026-08-01 18:43:02'),
(405, 121, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-01 18:43:09'),
(406, 119, 3, 'Cambio cunas.', 'Mano de obra', 60000, '2026-08-02 00:45:15'),
(407, 119, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-02 00:45:27'),
(408, 122, 3, 'Limpieza  y lubricación sistema de freno combinado.', 'Mano de obra', 15000, '2026-08-05 20:30:13'),
(409, 122, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-05 22:11:40'),
(410, 123, 3, 'Cambio de prensa.', 'Mano de obra', 60000, '2026-08-05 22:13:43'),
(411, 123, 3, 'Cambio de cruceta.\r\nCanbio de retenedor cambios,\r\nCambio aceite reversa', 'Mano de obra', 35000, '2026-08-06 00:42:04'),
(412, 105, 3, 'Instalar bombillo led.\r\nCambiar luces AC a DC.', 'Mano de obra', 20000, '2026-08-06 16:48:40'),
(413, 123, 3, 'Cambio aceite diferencial. (el conductor piensa hacer el cambio en su casa)', 'Mano de obra', 0, '2026-08-06 16:49:34'),
(414, 123, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-06 16:49:45'),
(415, 124, 3, 'Cambio espárragos.', 'Mano de obra', 15000, '2026-08-07 15:46:17'),
(416, 124, 3, 'Enderezar posapiés conductor.', 'Mano de obra', 5000, '2026-08-07 15:46:40'),
(417, 124, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-07 15:50:51'),
(418, 125, 3, '🆕 Caso creado a partir del caso anterior #124', 'Mano de obra', 0, '2026-08-07 15:50:55'),
(419, 125, 3, 'Reparar sistema palanca freno trasero.', 'Mano de obra', 15000, '2026-08-07 15:51:09'),
(420, 109, 3, 'rectificar.', 'Mano de obra', 20000, '2026-08-07 20:23:15'),
(421, 109, 3, 'Cambio de guías de válvula.', 'Mano de obra', 80000, '2026-08-07 20:47:29'),
(422, 109, 3, 'Corte de asientos de válvulas.', 'Mano de obra', 50000, '2026-08-07 20:47:59'),
(423, 125, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-10 15:11:58'),
(424, 128, 3, 'Instalación batería.\r\nInstalación switch Start.\r\nInstalación switch Luces.', 'Mano de obra', 30000, '2026-08-11 20:53:08'),
(425, 128, 3, 'Ajuste cabeza de luces.\r\nAjuste soporte cabrilla torcida.', 'Mano de obra', 20000, '2026-08-11 21:25:17'),
(426, 128, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-12 16:22:01'),
(427, 127, 3, 'Cambiar manguera rota.', 'Mano de obra', 30000, '2026-08-12 16:23:06'),
(428, 127, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-12 16:23:22'),
(429, 126, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-12 16:24:51'),
(431, 109, 3, 'Armado de motor.', 'Mano de obra', 130000, '2026-08-12 16:58:36'),
(432, 109, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-12 20:52:29'),
(433, 129, 3, 'Reconstrucción circuito direccionales y luces.', 'Mano de obra', 40000, '2026-08-13 01:13:08'),
(434, 129, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-13 01:17:30'),
(435, 130, 3, '🆕 Caso creado a partir del caso anterior #108', 'Mano de obra', 0, '2026-08-14 16:47:58'),
(436, 130, 3, 'La manzana paree estar ovalada, revisar cuando vuelva.\r\nSe tensiona freno, movimiento del pedal al frenar se redujo.', 'Mano de obra', 0, '2026-08-14 18:58:04'),
(437, 130, 3, 'Mantenimiento da suspensión delantera.', 'Mano de obra', 60000, '2026-08-14 18:58:35'),
(438, 131, 3, '🆕 Caso creado a partir del caso anterior #78', 'Mano de obra', 0, '2026-08-14 20:36:59'),
(439, 131, 3, 'Cambio de bombillo y ajuste de cubiertas.', 'Mano de obra', 0, '2026-08-14 21:07:55'),
(440, 131, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-14 21:08:53'),
(441, 130, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-17 00:27:18'),
(442, 132, 3, '🆕 Caso creado a partir del caso anterior #21', 'Mano de obra', 0, '2026-08-17 19:13:08'),
(443, 132, 3, 'Cambio terminal nrgativo batería.', 'Mano de obra', 10000, '2026-08-17 19:13:40'),
(444, 132, 3, 'Alinear dirección.\r\nReponer tornillos perdidos.\r\nAjustar cunas.', 'Mano de obra', 20000, '2026-08-17 19:14:38'),
(445, 132, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-17 19:14:50'),
(446, 133, 3, '🆕 Caso creado a partir del caso anterior #84', 'Mano de obra', 0, '2026-08-17 19:15:36'),
(447, 133, 3, 'Cambio de tornillos mordaza freno delantero.', 'Mano de obra', 10000, '2026-08-17 19:16:09'),
(448, 133, 3, 'Motor suena mal, Ajuste de válvulas.', 'Mano de obra', 20000, '2026-08-17 20:10:20'),
(449, 133, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-17 20:10:33'),
(450, 134, 3, 'Cambio de terminal.', 'Mano de obra', 3000, '2026-08-18 15:37:51'),
(451, 134, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-18 15:39:42'),
(452, 135, 3, '🆕 Caso creado a partir del caso anterior #35', 'Mano de obra', 0, '2026-08-18 20:06:51'),
(453, 135, 3, 'Cambiar disco freno trasero.', 'Mano de obra', 20000, '2026-08-18 20:07:17'),
(454, 136, 3, 'Cableado roto sección giro.', 'Mano de obra', 10000, '2026-08-19 20:03:31'),
(455, 136, 3, 'Recablear sistema arranque eléctrico.', 'Mano de obra', 45000, '2026-08-19 20:04:00'),
(456, 136, 3, 'Ajuste válvulas.', 'Mano de obra', 20000, '2026-08-19 20:04:17'),
(457, 136, 3, 'Lubricar cadena y embrague', 'Mano de obra', 5000, '2026-08-19 20:04:42'),
(458, 136, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-08-20 15:07:24'),
(459, 58, 3, 'Cambio Maniguetas', 'Mano de obra', 18000, '2026-08-20 15:11:00'),
(460, 137, 3, 'Rebobinado Ficha bobinados 001.', 'Mano de obra', 299000, '2026-08-21 17:47:02'),
(461, 138, 3, '🆕 Caso creado a partir del caso anterior #109', 'Mano de obra', 0, '2026-08-21 19:21:09'),
(462, 140, 6, '🆕 Caso creado a partir del caso anterior #34', 'Mano de obra', 0, '2026-08-28 19:56:56'),
(463, 139, 6, 'Reparación de cabeza de fuerza. (No incluye árbol de levas ni balnacines, No se rectificó ).', 'Mano de obra', 180000, '2026-08-28 20:00:31'),
(464, 139, 6, 'Corte de asientos y sentado de válvula.', 'Mano de obra', 50000, '2026-08-28 20:01:07'),
(465, 139, 6, 'Cambio de rodillos de variador.', 'Mano de obra', 20000, '2026-08-28 20:01:39'),
(466, 141, 6, '🆕 Caso creado a partir del caso anterior #105', 'Mano de obra', 0, '2026-08-29 21:34:42'),
(467, 141, 6, 'Cambio de regulador, Mantenimiento arranque eléctrico, cambio de guaya acelerador.', 'Mano de obra', 40000, '2026-08-29 21:35:52'),
(468, 141, 6, 'Carga batería.', 'Mano de obra', 7000, '2026-08-29 23:49:44'),
(469, 142, 6, '🆕 Caso creado a partir del caso anterior #79', 'Mano de obra', 0, '2026-08-31 22:50:51'),
(470, 142, 6, 'Ajuste de válvulas.', 'Mano de obra', 30000, '2026-08-31 22:56:49'),
(471, 143, 6, 'Ajuste de válvulas.\r\nLimpieza de bujía.\r\nAjuste de posapiés.', 'Mano de obra', 0, '2026-09-01 00:30:39'),
(472, 143, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-01 00:30:50'),
(473, 142, 3, 'Mantenimiento y ajuste carburador.', 'Mano de obra', 20000, '2026-09-01 14:40:56'),
(474, 141, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-03 13:15:14'),
(475, 107, 6, 'Reparar boca de tanque (Tapa no ajusta).', 'Mano de obra', 10000, '2026-09-03 18:37:57'),
(476, 107, 6, 'Mantenimiento rueda trasera (Cambio de tensores, ajuste de componentes de freno, ajuste de cadena) .', 'Mano de obra', 20000, '2026-09-03 18:39:26'),
(477, 107, 6, 'Cambio de cunas, soporte de guardabarro y barras barras.', 'Mano de obra', 70000, '2026-09-03 18:40:10'),
(478, 107, 6, 'Preparación para alineación de chasis y rearmado.', 'Mano de obra', 50000, '2026-09-03 18:46:47'),
(479, 107, 6, 'Alinear manubrio.', 'Mano de obra', 10000, '2026-09-03 18:47:06'),
(480, 144, 6, 'Mantenimiento carburador, cambio de vàlvula Reed.', 'Mano de obra', 30000, '2026-09-03 19:34:49'),
(481, 144, 6, 'Cambio total de cableado corona de bobinas.', 'Mano de obra', 30000, '2026-09-03 19:35:14'),
(482, 107, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-03 23:56:22'),
(484, 145, 6, 'Ajuste de válvulas y tensor.', 'Mano de obra', 30000, '2026-09-04 18:51:25'),
(485, 146, 6, '🆕 Caso creado a partir del caso anterior #4', 'Mano de obra', 0, '2026-09-04 18:55:37'),
(486, 146, 6, 'Ajuste de carburador.', 'Mano de obra', 30000, '2026-09-04 18:56:01'),
(487, 146, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-04 19:03:46'),
(488, 145, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-04 23:35:19'),
(489, 144, 6, 'Retificadora', 'Mano de obra', 20000, '2026-09-04 23:36:01'),
(490, 144, 6, 'Montar culata.', 'Mano de obra', 20000, '2026-09-04 23:38:10'),
(491, 142, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-05 22:56:43'),
(492, 147, 6, 'Cambio de tren de arrastre.', 'Mano de obra', 20000, '2026-09-05 23:00:49'),
(493, 147, 6, 'Cambio de cúpula.', 'Mano de obra', 20000, '2026-09-05 23:01:15'),
(494, 147, 6, 'Tornillería.', 'Mano de obra', 10000, '2026-09-05 23:01:38'),
(495, 147, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-05 23:01:46'),
(496, 137, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-05 23:03:43'),
(497, 151, 6, '🆕 Caso creado a partir del caso anterior #33', 'Mano de obra', 0, '2026-09-08 13:25:45'),
(498, 148, 6, 'Corte asientos de válvulas.', 'Mano de obra', 50000, '2026-09-10 15:39:21'),
(499, 148, 6, 'Cambio de guías de válvula.', 'Mano de obra', 40000, '2026-09-10 15:39:46'),
(500, 148, 6, 'Rectificar cilindro.', 'Mano de obra', 20000, '2026-09-10 15:40:52'),
(501, 150, 6, 'Ajuste de anillos.', 'Mano de obra', 25000, '2026-09-10 15:42:27'),
(502, 150, 6, 'Corte de asientos de válvulas.', 'Mano de obra', 50000, '2026-09-10 15:42:48'),
(503, 150, 6, 'Reparación cabeza de fuerza.', 'Mano de obra', 200000, '2026-09-10 15:44:14'),
(504, 150, 6, 'Mantenimiento carburador.', 'Mano de obra', 20000, '2026-09-10 15:45:37'),
(505, 148, 6, 'Cambio barras.', 'Mano de obra', 50000, '2026-09-10 23:32:15'),
(506, 148, 6, 'Taller.', 'Mano de obra', 180000, '2026-09-10 23:42:01'),
(507, 148, 6, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-09-11 00:02:57'),
(508, 152, 6, '🆕 Caso creado a partir del caso anterior #131', 'Mano de obra', 0, '2026-09-11 22:52:38'),
(509, 152, 6, 'Tensionar y lubricar cadena.\r\nAbicar fuga de aceite.', 'Mano de obra', 30000, '2026-09-11 22:53:01'),
(510, 151, 6, 'Cambio retenedor selector de cambios.', 'Mano de obra', 15000, '2026-09-11 23:55:02'),
(511, 151, 6, 'Corte y ajuste de cadena.', 'Mano de obra', 10000, '2026-09-11 23:55:18'),
(512, 151, 6, 'Soldadura Escape.', 'Mano de obra', 30000, '2026-09-11 23:55:38'),
(513, 151, 6, 'Reparación de rosca culata-escape.', 'Mano de obra', 20000, '2026-09-11 23:56:06'),
(514, 151, 6, 'Cambio de bendix.', 'Mano de obra', 35000, '2026-09-12 00:01:23'),
(515, 153, 7, 'Cambio Filtro Aire.', 'Mano de obra', 22000, '2026-09-12 19:25:42');

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
  `precio_cobrado` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT 0,
  `utilidad` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `casos`
--

INSERT INTO `casos` (`id`, `vehiculo_id`, `mecanico_id`, `fecha_ingreso`, `hora_ingreso`, `causa`, `observaciones`, `diagnostico`, `estado`, `fecha_cierre`, `cerrado_por`, `precio_cobrado`, `descuento`, `utilidad`) VALUES
(3, 6, 3, '2025-10-24', '09:01:13', 'Vehículo llega con motor desarmado. Se solicita instalar caja de seis velocidades e instalar cilindro y culata para aumentar cilindrada a 200cc', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(4, 7, 3, '2025-10-24', '09:27:53', 'Motor llega con fugas de aceite y exploradoras dejaron de funcionar', NULL, NULL, 'cerrado', '2026-07-05 22:53:33', NULL, 20000, 0, 0.00),
(5, 8, 3, '2025-10-24', '10:11:25', 'Cambiar cubiertas recién pintadas + cubierta frontal nueva', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(6, 9, 3, '2025-10-25', '09:57:59', 'Cambiar bujes de tijera y cadena.', NULL, NULL, 'cerrado', '2026-07-05 22:54:39', NULL, 0, 0, 0.00),
(7, 10, 3, '2025-10-25', '12:11:04', 'cambiar rodamientos manzana trasera, portaplaca', NULL, NULL, 'cerrado', '2026-07-05 22:55:11', NULL, 0, 0, 0.00),
(8, 11, 3, '2025-10-27', '10:46:16', 'Cambiar pastillas freno trasero', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(9, 12, 3, '2025-10-27', '11:15:11', 'Arranque muerto', NULL, NULL, 'cerrado', '2026-07-05 22:54:05', NULL, 0, 0, 0.00),
(10, 13, 3, '2025-10-27', '11:57:08', 'se instalaron barras nuevas pero la suspensiòn està muy dura.', NULL, NULL, 'cerrado', '2026-07-05 22:55:51', NULL, 0, 0, 0.00),
(11, 14, 3, '2025-10-28', '15:04:02', 'Sistema eléctrico Batería aislada\r\nRueda trasera frenada mal armada', NULL, NULL, 'cerrado', '2026-07-05 22:56:03', NULL, 0, 0, 0.00),
(12, 15, 3, '2025-10-28', '16:56:52', 'No enciende tras cambiar ramal elèctrico', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(13, 16, 3, '2025-10-29', '10:54:33', 'Freno trasero se pega, Motor gotea aceite, freno delandero agarrotado, tensionar cadena.', NULL, NULL, 'cerrado', '2026-07-05 22:56:19', NULL, 0, 0, 0.00),
(14, 17, 3, '2025-10-29', '14:26:55', 'Tensionar freno trasero y cadena', NULL, NULL, 'cerrado', '2026-07-05 22:56:36', NULL, 0, 0, 0.00),
(15, 18, 3, '2025-10-29', '16:10:33', 'Pierde aceite por empaque culatín.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(16, 19, 3, '2025-10-30', '12:54:25', 'Motor suena mal', NULL, NULL, 'cerrado', '2026-07-05 22:56:57', NULL, 0, 0, 0.00),
(17, 20, NULL, '2025-11-04', '16:33:34', 'Cambiar mando derecho por mando de segunda, el mando de cambio tiene defecto en base de botón start.', NULL, NULL, 'cerrado', '2026-07-05 22:57:13', NULL, 0, 0, 0.00),
(18, 21, NULL, '2025-11-04', '18:06:00', 'Un mes en patios ahora no enciende', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(19, 22, NULL, '2025-11-05', '09:28:42', 'No da arranque', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(20, 23, NULL, '2025-11-05', '10:20:07', 'Mando derecho abierto, Acelerador no funciona.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(21, 24, NULL, '2025-11-05', '10:47:13', 'Cambio de baterìa.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(22, 25, NULL, '2025-11-05', '14:56:47', 'No enciende y si llega a hacerlo se ahoga, se recibe sin cubiertas de parte frontal.', NULL, NULL, 'cerrado', '2026-07-05 22:57:40', NULL, 0, 0, 0.00),
(23, 26, NULL, '2025-11-07', '09:20:06', 'Ajustar sistema eléctrico a 12v.', NULL, NULL, 'cerrado', '2026-07-05 22:57:55', NULL, 0, 0, 0.00),
(24, 27, NULL, '2025-11-11', '11:13:32', 'Descarga la batería, se ahoga', NULL, NULL, 'cerrado', '2026-07-05 22:58:13', NULL, 0, 0, 0.00),
(25, 28, NULL, '2025-11-12', '11:10:46', 'Se ahoga, Motor ascelerado, Alto consumo.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(26, 29, NULL, '2025-11-13', '11:46:52', 'Rodamientos rueda trasera', NULL, NULL, 'cerrado', '2026-07-05 22:58:31', NULL, 0, 0, 0.00),
(27, 30, NULL, '2025-11-14', '10:46:16', 'Motor trabajó sin aceite, suema mal, desmontar para revisar.', NULL, NULL, 'cerrado', '2026-07-05 22:58:52', NULL, 0, 0, 0.00),
(28, 23, NULL, '2025-11-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #20', '', 'cerrado', '2026-07-05 23:01:48', NULL, 0, 0, 0.00),
(29, 31, NULL, '2025-11-15', '09:10:46', 'Cambiar Guardabarro delantero, cambio de aceite, Cambiar Palanca de cambios.', NULL, NULL, 'cerrado', '2026-07-05 22:59:54', NULL, 0, 0, 0.00),
(30, 32, NULL, '2025-11-15', '18:29:58', 'Cambio de batería', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(31, 33, NULL, '2026-02-06', '10:20:38', 'Escape roto, cambio de automático, revisar sistema de carga.', NULL, NULL, 'cerrado', '2026-07-05 22:59:38', NULL, 0, 0, 0.00),
(33, 35, NULL, '2026-02-20', '16:16:35', 'cambio carcazar headLight.\r\nCambio bombillos Hl\r\nFabricar bujes manubrio\r\nFabricar amortiguadores manubrio\r\ntornillos y chapetas\r\nNivelar aceite', NULL, NULL, 'cerrado', '2026-07-26 19:58:26', NULL, 70000, 0, 0.00),
(34, 36, NULL, '2026-02-24', '13:57:28', 'Embrague duro, cambios golpean.', NULL, NULL, 'cerrado', '2026-07-05 23:01:18', NULL, 0, 0, 0.00),
(35, 37, NULL, '2026-03-12', '09:56:26', 'Reparación completa de motor', NULL, NULL, 'cerrado', '2026-07-05 23:02:51', NULL, 0, 0, 0.00),
(36, 38, NULL, '2026-03-12', '09:59:18', 'Motor de arranque lento. Enciende con Pedal, batería nueva.\r\nCambio de regulador y Cdi quemados.', NULL, NULL, 'cerrado', '2026-07-05 23:02:16', NULL, 0, 0, 0.00),
(37, 39, NULL, '2026-03-12', '10:00:36', 'Motor frenado. Cadena de levas descarrilada.', NULL, NULL, 'cerrado', '2026-07-05 23:02:35', NULL, 0, 0, 0.00),
(38, 40, NULL, '2026-03-29', '12:57:26', 'Pendiente tornillo brazo soporte escape', NULL, NULL, 'cerrado', '2026-07-05 23:03:05', NULL, 0, 0, 0.00),
(39, 41, NULL, '2026-04-01', '09:26:36', 'Acondicionamiento', NULL, NULL, 'cerrado', '2026-07-05 23:03:20', NULL, 0, 0, 0.00),
(40, 42, NULL, '2026-04-01', '09:36:45', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-05 23:03:40', NULL, 0, 0, 0.00),
(42, 44, NULL, '2026-04-11', '16:45:55', 'Refrigerante pasa a cilindro.', NULL, NULL, 'cerrado', '2026-07-05 23:11:55', NULL, 0, 0, 0.00),
(43, 45, NULL, '2026-04-16', '11:38:24', 'No enciende. Ramal dañado. Switch desarmado.', NULL, NULL, 'cerrado', '2026-07-05 23:12:24', NULL, 0, 0, 0.00),
(44, 46, NULL, '2026-04-18', '16:58:09', 'encamisar pista de rueda trasera.', NULL, NULL, 'cerrado', '2026-07-05 22:46:42', NULL, 0, 0, 0.00),
(45, 47, NULL, '2026-04-18', '17:03:26', 'Arranque se desliza.', NULL, NULL, 'cerrado', '2026-07-05 22:47:09', NULL, 0, 0, 0.00),
(46, 48, NULL, '2026-04-18', '17:06:29', 'Se niega a encender.', NULL, NULL, 'cerrado', '2026-07-05 23:12:44', NULL, 0, 0, 0.00),
(47, 49, NULL, '2026-04-20', '09:39:09', 'Se apaga o no enciende. \r\nCompresión baja.', NULL, NULL, 'cerrado', '2026-07-05 22:53:00', NULL, 0, 0, 0.00),
(48, 50, NULL, '2026-04-24', '17:42:59', 'Posapiés Roto. (rehacer rosca).\r\nEmbrague agarrotado.\r\nFaro suelto.\r\nManubrio suelto. (rehacer rosca).\r\nPedal de cambios torcido.', NULL, NULL, 'cerrado', '2026-07-05 22:47:30', NULL, 0, 0, 0.00),
(49, 51, NULL, '2026-05-05', '13:24:34', 'Barras soporte torcidos.', NULL, NULL, 'cerrado', '2026-07-05 23:13:03', NULL, 0, 0, 0.00),
(50, 52, NULL, '2026-05-08', '14:35:43', 'Cambiar tapas', NULL, NULL, 'cerrado', '2026-07-05 22:48:26', NULL, 0, 0, 0.00),
(51, 53, NULL, '2026-05-08', '14:39:32', 'Descuidada.', NULL, NULL, 'cerrado', '2026-07-05 22:48:43', NULL, 0, 0, 0.00),
(52, 54, NULL, '2026-05-25', '13:11:49', 'Moto se recibe con motor desarmado en caja de cartón.', NULL, NULL, 'cerrado', '2026-07-05 23:13:27', NULL, 0, 0, 0.00),
(53, 55, NULL, '2026-05-25', '13:13:23', 'Difícil encender, no se sostiene.', NULL, NULL, 'cerrado', '2026-07-05 22:23:33', NULL, 0, 0, 0.00),
(54, 56, NULL, '2026-05-25', '14:54:36', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-05 22:52:48', NULL, 0, 0, 0.00),
(55, 57, NULL, '2026-06-06', '15:54:32', 'No se sostiene, suena mal, ramal dañado, sin tablero.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(56, 58, NULL, '2026-06-07', '11:44:21', 'No enciende en las mañanas.', NULL, NULL, 'cerrado', '2026-07-05 22:52:10', NULL, 0, 0, 0.00),
(57, 59, NULL, '2026-06-14', '10:47:27', 'Enciende con dols luces rojas destellando rápidamente', NULL, NULL, 'cerrado', '2026-07-05 22:51:54', NULL, 0, 0, 0.00),
(58, 60, NULL, '2026-06-22', '11:28:23', 'Motor suena mal. \r\nHacer Mantenimiento general.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(60, 62, NULL, '2026-06-22', '16:15:29', 'Vibra cuando rápido.\r\nRueda trasera Pinchada.\r\nCambio tren de arrastre.\r\nAjustar Manillar.\r\nCambiar aceite.\r\nRevisar fuga de aceite.\r\nCambiar refrigerante.', NULL, NULL, 'cerrado', '2026-07-05 22:51:29', NULL, 120000, 0, 0.00),
(61, 63, NULL, '2026-07-03', '19:26:45', 'Avandonada. \r\nRevisar.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(62, 64, NULL, '2026-07-04', '10:37:54', 'Resurección.', NULL, NULL, 'cerrado', '2026-07-09 09:14:23', NULL, 55000, 0, 0.00),
(63, 65, NULL, '2026-07-04', '18:26:09', 'No funciona arranque', NULL, NULL, 'cerrado', '2026-07-09 09:14:09', NULL, 77000, 0, 0.00),
(64, 66, NULL, '2026-07-04', '18:44:38', 'Mantenimiento y correción de fallas.', NULL, NULL, 'cerrado', '2026-07-07 14:43:38', NULL, 85000, 0, 0.00),
(66, 68, NULL, '2026-07-06', '12:40:27', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-07 17:27:45', NULL, 30000, 0, 0.00),
(67, 69, NULL, '2026-07-06', '14:42:14', 'Ajustar cunas de dirección.\r\nAjuste de válvulas.\r\nSincronizar carburador.\r\nArranque eléctrico no funciona.', NULL, NULL, 'cerrado', '2026-07-06 19:35:29', NULL, 48000, 0, 0.00),
(68, 70, NULL, '2026-07-06', '15:30:19', 'Guaya embrague rota.', NULL, NULL, 'cerrado', '2026-07-06 16:21:47', NULL, 5000, 0, 0.00),
(69, 9, NULL, '2026-07-06', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #6', '', 'cerrado', '2026-07-07 17:28:07', NULL, 0, 0, 0.00),
(70, 19, 3, '2026-07-06', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #16', '', 'cerrado', '2026-07-06 21:32:37', NULL, 0, 0, 0.00),
(72, 72, 3, '2026-07-06', '22:18:22', 'Motor sin compresión, la falla va y viene.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(73, 73, NULL, '2026-06-04', '10:22:50', 'Caso de Control.', NULL, NULL, 'cerrado', '2026-07-07 10:28:47', NULL, 300000, 0, 0.00),
(74, 73, NULL, '2026-06-13', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #73', '', 'cerrado', '2026-07-07 17:28:54', NULL, 0, 0, 0.00),
(75, 74, NULL, '2026-07-07', '10:44:06', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-07 15:05:38', NULL, 45000, 0, 0.00),
(76, 75, NULL, '2026-07-07', '10:46:52', 'Enciende pero se ahoga. No anda.', NULL, NULL, 'cerrado', '2026-07-07 15:54:39', NULL, 70000, 0, 0.00),
(77, 76, NULL, '2026-07-07', '15:53:42', 'Frente suspención torcido. Hala hacia los lados y golpea cunas.', NULL, NULL, 'cerrado', '2026-07-11 10:02:54', NULL, 73000, 0, 0.00),
(78, 16, NULL, '2026-07-08', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #13', '', 'cerrado', '2026-07-08 17:06:48', NULL, 35000, 0, 0.00),
(79, 39, NULL, '2026-07-09', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #37', '', 'cerrado', '2026-07-09 10:47:01', NULL, 10000, 0, 0.00),
(80, 77, NULL, '2026-07-09', '11:35:33', 'Batería descargada.', NULL, NULL, 'cerrado', '2026-07-09 13:21:27', NULL, 20000, 0, 0.00),
(81, 78, NULL, '2026-07-09', '13:25:26', 'Cambiar guaya velocímetro.', NULL, NULL, 'cerrado', '2026-07-09 14:57:39', NULL, 0, 0, 0.00),
(82, 79, NULL, '2026-07-09', '15:17:30', 'Quemado, rebobinar', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(83, 80, NULL, '2026-07-10', '10:21:21', 'Se ahoga.', NULL, NULL, 'cerrado', '2026-07-11 09:01:25', NULL, 48000, 0, 0.00),
(84, 51, NULL, '2026-07-10', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #49', '', 'cerrado', '2026-07-11 09:06:04', NULL, 33000, 0, 0.00),
(85, 81, NULL, '2026-07-10', '11:41:33', 'Ajustar cunas de dirección.', NULL, NULL, 'cerrado', '2026-07-11 09:04:32', NULL, 9000, 0, 0.00),
(86, 82, 3, '2026-07-11', '15:18:09', 'Acelerador no funciona.', NULL, NULL, 'cerrado', '2026-07-18 11:55:57', NULL, 20000, 0, 0.00),
(87, 83, 3, '2026-07-13', '16:27:53', 'La dirección golpea al frenar o pasar huecos.', NULL, NULL, 'cerrado', '2026-07-18 11:55:22', NULL, 124000, 0, 0.00),
(88, 84, 3, '2026-07-14', '08:53:54', 'Embrague se queda abierto, a veces truena.\r\nCambiar direccionales.\r\nPortaplato se mueve.', NULL, NULL, 'cerrado', '2026-07-15 10:47:00', NULL, 100000, 0, 0.00),
(89, 32, 3, '2026-07-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #30', '', 'cerrado', '2026-07-18 11:54:34', NULL, 11000, 0, 0.00),
(90, 85, 3, '2026-07-15', '11:37:29', 'Sin fuerza, dificil de encender, no se sostiene.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(91, 84, 3, '2026-07-15', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #88', '', 'cerrado', '2026-07-15 18:28:06', NULL, 30000, 0, 0.00),
(92, 86, 3, '2026-07-16', '12:56:01', 'Se incendió ramal en el relay de arranque.', NULL, NULL, 'cerrado', '2026-07-20 14:49:55', NULL, 93000, 0, 0.00),
(93, 87, 3, '2026-07-17', '15:11:12', 'Se acelera solita', NULL, NULL, 'cerrado', '2026-07-18 11:53:46', NULL, 5000, 0, 0.00),
(94, 9, 3, '2026-07-17', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #69', '', 'cerrado', '2026-07-17 18:17:34', NULL, 0, 0, 0.00),
(95, 88, 3, '2026-07-18', '11:57:46', 'Se queda acelerada.', NULL, NULL, 'cerrado', '2026-07-22 23:39:11', NULL, 10000, 0, 0.00),
(96, 89, 3, '2026-07-20', '14:52:23', 'Motor suena mal.', NULL, NULL, 'cerrado', '2026-07-26 19:56:05', NULL, 49300, 0, 0.00),
(100, 93, 3, '2026-07-21', '22:58:25', 'No funciona el arranque eléctrico, a veces pierde fuerza y tironea.', NULL, NULL, 'cerrado', '2026-07-22 14:54:17', NULL, 40400, 0, 0.00),
(101, 94, 3, '2026-07-22', '00:06:14', 'sdfghjkl5678', NULL, NULL, 'cerrado', '2026-07-22 01:00:29', NULL, 36000, 0, 0.00),
(102, 78, 3, '2026-07-22', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #81', '', 'cerrado', '2026-07-22 23:29:54', NULL, 30000, 0, 0.00),
(103, 95, 3, '2026-07-22', '19:35:59', 'Manzana rueda trasera se mueve.', NULL, NULL, 'cerrado', '2026-07-22 22:07:31', NULL, 40000, 0, 0.00),
(104, 78, 3, '2026-07-22', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #102', '', 'cerrado', '2026-07-23 00:28:52', NULL, 0, 0, 0.00),
(105, 69, 3, '2026-07-23', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #67', '', 'cerrado', '2026-07-23 09:50:53', NULL, 0, 0, 0.00),
(106, 96, 3, '2026-07-23', '10:24:12', 'No enciende. Arranque eléctrco no funciona.', NULL, NULL, 'cerrado', '2026-07-23 11:13:24', NULL, 7000, 0, 0.00),
(107, 97, 3, '2026-07-23', '12:01:21', 'Dirección dura.\r\nHala hacia un lado.', NULL, NULL, 'cerrado', '2026-09-03 18:56:22', NULL, 260000, 72000, 0.00),
(108, 98, 3, '2026-07-23', '12:49:46', 'Sin freno trasero. Reventó varilla.', NULL, NULL, 'cerrado', '2026-07-23 13:22:27', NULL, 10000, 0, 0.00),
(109, 99, 3, '2026-07-23', '14:33:39', 'Ruido en el motor y fuga de aceite.', NULL, NULL, 'cerrado', '2026-08-12 15:52:29', NULL, 663900, 0, 0.00),
(110, 100, 3, '2026-07-23', '14:55:17', 'Bloqueada en cuarta marcha.', NULL, NULL, 'cerrado', '2026-07-23 14:56:13', NULL, 0, 0, 0.00),
(111, 101, 3, '2026-07-24', '16:24:18', 'Reparar motor y reacondicionar para revisión.', NULL, NULL, 'cerrado', '2026-07-24 16:26:07', NULL, 0, 0, 0.00),
(112, 101, 3, '2026-07-24', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #111', '', 'cerrado', '2026-07-27 18:40:58', NULL, 0, 0, 0.00),
(113, 33, 3, '2026-07-25', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #31', '', 'cerrado', '2026-07-25 09:14:27', NULL, 0, 0, 0.00),
(114, 31, 3, '2026-07-25', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #29', '', 'cerrado', '2026-07-26 19:50:53', NULL, 65000, 0, 0.00),
(115, 102, 3, '2026-07-26', '20:29:11', 'Entrada de prueba.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(116, 83, 3, '2026-07-26', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #87', '', 'cerrado', '2026-07-26 22:31:37', NULL, 0, 0, 0.00),
(117, 103, 3, '2026-07-28', '11:40:45', 'Motor suena mal.', NULL, NULL, 'cerrado', '2026-08-01 09:24:23', NULL, 0, 0, 0.00),
(118, 104, 3, '2026-07-29', '14:42:21', 'Cambiar discos de embrague.', NULL, NULL, 'cerrado', '2026-07-29 20:23:16', NULL, 60000, 0, 0.00),
(119, 105, 3, '2026-08-01', '10:06:36', 'Cambiar Cunas', NULL, NULL, 'cerrado', '2026-08-01 19:45:27', NULL, 60000, 0, 0.00),
(120, 106, 3, '2026-08-01', '13:39:40', 'Retirar gps.', NULL, NULL, 'cerrado', '2026-08-01 13:40:26', NULL, 40000, 0, 0.00),
(121, 107, 3, '2026-08-01', '13:41:41', 'Ajustar cadena.', NULL, NULL, 'cerrado', '2026-08-01 13:43:08', NULL, 10000, 0, 0.00),
(122, 108, 3, '2026-08-05', '15:29:38', 'Ajustar freno (pegado)', NULL, NULL, 'cerrado', '2026-08-05 17:11:40', NULL, 15000, 0, 0.00),
(123, 109, 3, '2026-08-05', '17:13:24', 'Prensa Patina.\r\nCambiar cruceta.', NULL, NULL, 'cerrado', '2026-08-06 11:49:45', NULL, 95000, 0, 0.00),
(124, 110, 3, '2026-08-07', '10:45:48', 'Escape suena mal.\r\nFreno trasero largo.', NULL, NULL, 'cerrado', '2026-08-07 10:50:51', NULL, 20000, 0, 0.00),
(125, 110, 3, '2026-08-07', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #124', '', 'cerrado', '2026-08-10 10:11:58', NULL, 15000, 0, 0.00),
(126, 111, 3, '2026-08-10', '10:11:05', '0', NULL, NULL, 'cerrado', '2026-08-12 11:24:51', NULL, 0, 0, 0.00),
(127, 112, 3, '2026-08-10', '15:21:34', 'No enciende.', NULL, NULL, 'cerrado', '2026-08-12 11:23:22', NULL, 30000, 0, 0.00),
(128, 113, 3, '2026-08-11', '15:52:00', 'No hay dc', NULL, NULL, 'cerrado', '2026-08-12 11:22:01', NULL, 50000, 0, 0.00),
(129, 114, 3, '2026-08-12', '12:05:08', 'No funcionan direccionales, luces, medidor combustible ni luz de freno.', NULL, NULL, 'cerrado', '2026-08-12 20:17:30', NULL, 56000, 0, 0.00),
(130, 98, 3, '2026-08-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #108', '', 'cerrado', '2026-08-16 19:27:18', NULL, 60000, 0, 0.00),
(131, 16, 3, '2026-08-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #78', '', 'cerrado', '2026-08-14 16:08:53', NULL, 0, 0, 0.00),
(132, 24, 3, '2026-08-17', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #21', '', 'cerrado', '2026-08-17 14:14:50', NULL, 30000, 0, 0.00),
(133, 51, 3, '2026-08-17', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #84', '', 'cerrado', '2026-08-17 15:10:33', NULL, 30000, 0, 0.00),
(134, 115, 3, '2026-08-18', '10:37:07', 'Ventilador no arranca.', NULL, NULL, 'cerrado', '2026-08-18 10:39:42', NULL, 5000, 0, 0.00),
(135, 37, 3, '2026-08-18', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #35', '', 'abierto', NULL, NULL, NULL, 0, 0.00),
(136, 116, 3, '2026-08-19', '10:05:07', 'Sistema eléctrico Dc muerto.', NULL, NULL, 'cerrado', '2026-08-20 10:07:24', NULL, 80000, 0, 0.00),
(137, 117, 3, '2026-08-21', '12:40:50', 'No arranca, Quemado Bobinado de marcha.', NULL, NULL, 'cerrado', '2026-09-05 18:03:43', NULL, 299000, 20000, 0.00),
(138, 99, 3, '2026-08-21', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #109', '', 'abierto', NULL, NULL, NULL, 0, 0.00),
(139, 118, 3, '2026-08-24', '08:14:18', 'No enciende, Baùl trae guìas y tensor de cadena de distribución.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(140, 36, 6, '2026-08-28', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #34', '', 'abierto', NULL, NULL, NULL, 0, 0.00),
(141, 69, 6, '2026-08-29', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #105', '', 'cerrado', '2026-09-03 08:15:14', NULL, 79000, 0, 0.00),
(142, 39, 6, '2026-08-31', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #79', '', 'cerrado', '2026-09-05 17:56:43', NULL, 74000, 0, 0.00),
(143, 119, 6, '2026-08-31', '19:30:07', 'Difícil encender en las mañanas.', NULL, NULL, 'cerrado', '2026-08-31 19:30:50', NULL, 0, 0, 0.00),
(144, 120, 6, '2026-09-03', '14:33:52', 'Falta fuerza al subir.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(145, 121, 6, '2026-09-04', '13:50:02', 'Suena tren de válvulas.', NULL, NULL, 'cerrado', '2026-09-04 18:35:19', NULL, 64000, 0, 0.00),
(146, 7, 6, '2026-09-04', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #4', '', 'cerrado', '2026-09-04 14:03:46', NULL, 70000, 0, 0.00),
(147, 122, 6, '2026-09-05', '18:00:24', 'Cambiar tren de arrastre y cùpula delantera.', NULL, NULL, 'cerrado', '2026-09-05 18:01:46', NULL, 50000, 0, 0.00),
(148, 123, 6, '2026-09-07', '10:58:44', 'Alto consumo de aceite.', NULL, NULL, 'cerrado', '2026-09-10 19:02:57', NULL, 560300, 0, 0.00),
(150, 125, 6, '2026-09-08', '08:13:46', 'Se ahoga, no desvoca.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(151, 35, 6, '2026-09-08', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #33', '', 'abierto', NULL, NULL, NULL, 0, 0.00),
(152, 16, 6, '2026-09-11', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #131', '', 'abierto', NULL, NULL, NULL, 0, 0.00),
(153, 126, 7, '2026-09-12', '14:22:50', 'Perdió velocidad final.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `caso_repuestos`
--

CREATE TABLE `caso_repuestos` (
  `id` int(11) NOT NULL,
  `caso_id` int(11) NOT NULL,
  `parte_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL DEFAULT 1.00,
  `costo_unitario` decimal(10,2) NOT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `caso_repuestos`
--

INSERT INTO `caso_repuestos` (`id`, `caso_id`, `parte_id`, `usuario_id`, `cantidad`, `costo_unitario`, `precio_unitario`, `subtotal`, `created_at`) VALUES
(1, 101, 2, 3, 2.00, 400.00, 1000.00, 2000.00, '2026-07-22 05:57:00'),
(2, 101, 2, 3, 2.00, 400.00, 1000.00, 2000.00, '2026-07-22 05:59:38'),
(3, 100, 5, 3, 2.00, 500.00, 700.00, 1400.00, '2026-07-22 16:53:46'),
(4, 103, 7, 3, 1.00, 3500.00, 9000.00, 9000.00, '2026-07-23 03:00:11'),
(5, 103, 8, 3, 1.00, 2000.00, 5000.00, 5000.00, '2026-07-23 03:03:27'),
(6, 103, 6, 3, 2.00, 3500.00, 8000.00, 16000.00, '2026-07-23 03:07:09'),
(7, 103, 7, 3, 1.00, 3500.00, 9000.00, 9000.00, '2026-07-23 14:48:47'),
(8, 96, 9, 3, 1.00, 3600.00, 4300.00, 4300.00, '2026-07-23 16:14:04'),
(10, 107, 14, 3, 1.00, 28000.00, 36000.00, 36000.00, '2026-07-24 15:27:48'),
(11, 58, 15, 3, 4.00, 500.00, 1000.00, 4000.00, '2026-08-06 21:07:19'),
(12, 58, 16, 3, 1.00, 35000.00, 45000.00, 45000.00, '2026-08-06 21:12:54'),
(13, 58, 17, 3, 2.00, 500.00, 800.00, 1600.00, '2026-08-06 21:15:18'),
(14, 58, 18, 3, 1.00, 5000.00, 10000.00, 10000.00, '2026-08-06 21:19:04'),
(15, 109, 19, 3, 1.00, 9000.00, 9500.00, 9500.00, '2026-08-07 20:26:50'),
(16, 109, 20, 3, 1.00, 16000.00, 18400.00, 18400.00, '2026-08-07 20:30:31'),
(17, 109, 21, 3, 1.00, 65000.00, 74100.00, 74100.00, '2026-08-07 20:34:51'),
(18, 109, 22, 3, 1.00, 22300.00, 45000.00, 45000.00, '2026-08-07 20:39:37'),
(19, 109, 23, 3, 2.00, 42000.00, 42000.00, 84000.00, '2026-08-07 20:52:22'),
(20, 109, 24, 3, 2.00, 10000.00, 11300.00, 22600.00, '2026-08-07 20:54:44'),
(21, 109, 25, 3, 1.00, 10000.00, 20000.00, 20000.00, '2026-08-07 21:04:39'),
(22, 109, 28, 3, 1.00, 14100.00, 16500.00, 16500.00, '2026-08-08 20:09:45'),
(23, 109, 26, 3, 1.00, 4500.00, 6000.00, 6000.00, '2026-08-08 20:10:45'),
(24, 109, 27, 3, 1.00, 5300.00, 6800.00, 6800.00, '2026-08-08 20:12:39'),
(25, 109, 30, 3, 1.00, 14000.00, 18000.00, 18000.00, '2026-08-08 20:14:20'),
(26, 109, 32, 3, 2.00, 9000.00, 11000.00, 22000.00, '2026-08-11 20:59:02'),
(27, 109, 33, 3, 1.00, 16000.00, 18300.00, 18300.00, '2026-08-11 21:48:42'),
(28, 109, 34, 3, 1.00, 14000.00, 16200.00, 16200.00, '2026-08-11 23:12:25'),
(29, 109, 31, 3, 1.00, 5000.00, 6500.00, 6500.00, '2026-08-12 16:57:26'),
(30, 107, 35, 3, 2.00, 5000.00, 12000.00, 24000.00, '2026-08-12 19:32:44'),
(31, 129, 39, 3, 1.00, 13000.00, 16000.00, 16000.00, '2026-08-13 01:17:20'),
(32, 134, 17, 3, 1.00, 500.00, 800.00, 800.00, '2026-08-18 15:38:21'),
(33, 134, 17, 3, 1.00, 500.00, 1000.00, 1000.00, '2026-08-18 15:39:13'),
(34, 141, 40, 6, 1.00, 22000.00, 32000.00, 32000.00, '2026-08-29 23:55:11'),
(35, 142, 41, 6, 1.00, 5000.00, 12000.00, 12000.00, '2026-08-31 22:51:27'),
(36, 142, 43, 6, 1.00, 7500.00, 12000.00, 12000.00, '2026-08-31 22:56:24'),
(37, 146, 44, 6, 1.00, 32000.00, 40000.00, 40000.00, '2026-09-04 19:03:32'),
(38, 145, 45, 6, 2.00, 1000.00, 2000.00, 4000.00, '2026-09-04 19:09:58'),
(39, 144, 46, 6, 1.00, 60000.00, 64000.00, 64000.00, '2026-09-04 20:54:55'),
(40, 144, 47, 6, 1.00, 6000.00, 6500.00, 6500.00, '2026-09-04 21:01:29'),
(41, 145, 48, 6, 1.00, 25000.00, 30000.00, 30000.00, '2026-09-04 21:11:35'),
(42, 150, 51, 6, 1.00, 22000.00, 24800.00, 24800.00, '2026-09-08 19:05:41'),
(43, 148, 52, 6, 1.00, 68000.00, 74000.00, 74000.00, '2026-09-10 15:04:04'),
(44, 148, 53, 6, 1.00, 35000.00, 36400.00, 36400.00, '2026-09-10 15:16:57'),
(45, 148, 24, 6, 1.00, 10000.00, 11300.00, 11300.00, '2026-09-10 15:34:49'),
(46, 148, 56, 6, 1.00, 15000.00, 15800.00, 15800.00, '2026-09-10 15:38:10'),
(47, 148, 54, 6, 1.00, 20000.00, 22500.00, 22500.00, '2026-09-10 15:41:27'),
(48, 150, 57, 6, 30.00, 60.00, 200.00, 6000.00, '2026-09-10 15:49:23'),
(49, 148, 58, 6, 1.00, 15000.00, 15300.00, 15300.00, '2026-09-10 16:17:23'),
(50, 148, 59, 6, 1.00, 21000.00, 45000.00, 45000.00, '2026-09-10 16:25:15'),
(51, 151, 50, 6, 1.00, 15500.00, 25000.00, 25000.00, '2026-09-12 00:00:27'),
(52, 153, 60, 7, 1.00, 12000.00, 18000.00, 18000.00, '2026-09-12 19:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `categorias_partes`
--

CREATE TABLE `categorias_partes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias_partes`
--

INSERT INTO `categorias_partes` (`id`, `nombre`, `descripcion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Aceites', 'Aceites para motor y transmisión', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(2, 'Lubricantes', 'Grasas y lubricantes especiales', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(3, 'Filtros', 'Filtros de aceite, aire y combustible', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(4, 'Motor', 'Repuestos del motor', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(5, 'Transmisión', 'Caja de cambios y transmisión', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(6, 'Embrague', 'Sistema de embrague', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(7, 'Frenos', 'Sistema de frenos', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(8, 'Suspensión', 'Sistema de suspensión', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(9, 'Dirección', 'Sistema de dirección', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(10, 'Sistema eléctrico', 'Componentes eléctricos', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(11, 'Iluminación', 'Luces y accesorios de iluminación', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(12, 'Baterías', 'Baterías y accesorios', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(13, 'Refrigeración', 'Sistema de refrigeración', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(14, 'Combustible', 'Sistema de combustible', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(15, 'Escape', 'Sistema de escape', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(16, 'Rodamientos', 'Rodamientos y balineras', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(17, 'Retenes', 'Retenes y sellos', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(18, 'Correas', 'Correas y cadenas', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(19, 'Tornillería', 'Tornillos, tuercas y arandelas', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(20, 'Consumibles', 'Elementos de consumo frecuente', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(21, 'Limpieza', 'Productos de limpieza', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(22, 'Herramientas', 'Herramientas del taller', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(23, 'Accesorios', 'Accesorios para vehículos', 1, '2026-07-10 09:01:58', '2026-07-10 09:01:58'),
(24, 'Eléctrico', 'Terminales, cables, sockets, bobinasEtc.', 1, '2026-07-10 09:01:58', '2026-07-22 11:47:41'),
(25, 'Empaquetaduras', 'Empaques de motor.', 1, '2026-07-10 09:01:58', '2026-07-22 11:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `fabricante_repuesto`
--

CREATE TABLE `fabricante_repuesto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabricante_repuesto`
--

INSERT INTO `fabricante_repuesto` (`id`, `nombre`, `descripcion`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Choho', 'La fuerza que lo resiste todo', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(2, 'Casarella', '\"¡Dale a tu moto Cassarella!', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(3, 'Sin marca', 'Fabricante desconocido.', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(4, 'Pfi', 'American Engineering Inside', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(5, 'Koyo', 'De experto para expertos!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(6, 'Akt', 'Poder a tu alcance!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(7, 'Rnv', '!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(8, 'Honda', '!The Power of Dreams!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(9, 'Yamaha', 'Revs your Heart!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(10, 'Suzuki', 'By Your Side!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(11, 'Kawasaki', 'Let the good times roll!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(12, 'Tesla', '!!!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(13, 'Magna', '!!!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(14, 'Bajaj', '!!!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(15, 'Tkrj', '!!!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(16, 'Darrow', 'Soluciones para tu moto!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(17, 'Nachi', 'Bearings!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09'),
(18, 'Hibari', 'Joint international quality!!!', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(19, 'Ngk', 'sparkPlugs', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(20, 'Stanley', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(21, 'Forte', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(22, 'Accel', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(23, 'Gx', 'Parts & accessories', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(24, 'Industrias Leo', 'La fuerza que lo resiste todo', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(25, 'Gaviria', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(26, 'Evol', 'You can trust', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(27, 'SukiParts', 'www.igbcolombia.com', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(28, 'Vitrix', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(29, 'UyusTools', '', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(30, 'Inoki', '\r\n\r\n', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39'),
(31, 'Dma', 'dma@dmagroup.com', 1, '2026-07-22 04:25:39', '2026-09-10 13:28:40'),
(32, 'Guivaim', 'Gvi', 1, '2026-07-22 04:25:39', '2026-07-22 04:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `marcas_moto`
--

CREATE TABLE `marcas_moto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marcas_moto`
--

INSERT INTO `marcas_moto` (`id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Honda', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(2, 'Suzuki', 1, '2026-07-20 02:07:32', '2026-07-20 02:07:32'),
(3, 'Kawasaki', 1, '2026-07-20 02:07:40', '2026-07-20 02:07:40'),
(4, 'Yamaha', 1, '2026-07-20 02:07:47', '2026-07-20 02:07:47'),
(5, 'Jialing', 1, '2026-07-20 02:08:04', '2026-07-20 02:08:04'),
(6, 'Jincheng', 1, '2026-07-20 02:08:12', '2026-07-20 02:08:12'),
(7, 'Bajaj', 1, '2026-07-20 02:08:18', '2026-07-20 02:08:18'),
(8, 'Akt', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(9, 'Tvs', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(10, 'Vaisand', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(11, 'Kymco', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(12, 'Victory', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(13, 'Ceronte', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(14, 'Hero', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04'),
(15, 'Um', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `modelos_moto`
--

CREATE TABLE `modelos_moto` (
  `id` int(11) NOT NULL,
  `marca_moto_id` int(11) NOT NULL,
  `tipo_moto_id` int(11) NOT NULL,
  `linea` varchar(50) NOT NULL,
  `cilindrada` smallint(5) UNSIGNED DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modelos_moto`
--

INSERT INTO `modelos_moto` (`id`, `marca_moto_id`, `tipo_moto_id`, `linea`, `cilindrada`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Xl', 185, 1, '2026-07-20 04:26:41', '2026-07-20 16:12:20'),
(3, 1, 3, 'Xl', 200, 1, '2026-07-20 04:27:09', '2026-07-20 16:12:22'),
(5, 1, 3, 'Crf', 200, 1, '2026-07-20 16:12:42', '2026-07-20 16:12:42'),
(6, 4, 3, 'Dt', 125, 1, '2026-07-20 18:31:24', '2026-07-20 18:31:24'),
(7, 2, 7, 'Gp', 125, 1, '2026-07-20 18:31:46', '2026-07-20 18:31:46'),
(8, 8, 3, 'Ttr', 125, 1, '2026-07-20 18:33:06', '2026-07-20 18:33:06'),
(9, 8, 7, 'Nkd', 125, 1, '2026-07-20 19:55:02', '2026-07-20 19:55:02'),
(10, 7, 7, 'Discover', 125, 1, '2026-07-20 19:55:02', '2026-07-20 19:55:02'),
(11, 7, 7, 'Discover', 100, 1, '2026-07-20 19:55:02', '2026-07-20 19:55:02'),
(12, 7, 7, 'Discover', 150, 1, '2026-07-20 19:55:02', '2026-07-20 19:55:02'),
(13, 4, 6, 'Crypton', 115, 1, '2026-07-23 00:34:42', '2026-07-23 00:34:42'),
(14, 1, 3, 'Xlr', 125, 1, '2026-07-23 03:20:22', '2026-07-23 03:20:22'),
(15, 1, 7, 'Cbf', 125, 1, '2026-07-23 03:20:55', '2026-07-23 03:20:55'),
(16, 1, 7, 'Cbf', 150, 1, '2026-07-23 03:21:12', '2026-07-23 03:21:12'),
(17, 9, 7, 'Max', 125, 1, '2026-07-23 15:22:36', '2026-07-23 15:22:36'),
(18, 1, 7, 'Cb', 110, 1, '2026-07-23 16:17:34', '2026-07-23 16:17:34'),
(19, 1, 7, 'Eco', 100, 1, '2026-07-23 16:17:58', '2026-07-23 16:17:58'),
(20, 1, 7, 'Cb', 125, 1, '2026-07-23 16:59:37', '2026-07-23 16:59:37'),
(21, 4, 6, 'CryptonFi', 115, 1, '2026-07-23 17:36:28', '2026-07-23 17:36:57'),
(22, 4, 6, 'Crypton', 110, 1, '2026-07-23 19:54:29', '2026-07-23 19:54:29'),
(23, 8, 3, 'Xm', 180, 1, '2026-07-24 21:22:42', '2026-07-24 21:22:42'),
(24, 10, 8, 'Zh', 200, 1, '2026-07-29 19:40:27', '2026-07-29 19:40:27'),
(25, 2, 5, 'Burgman', 125, 1, '2026-08-01 15:04:56', '2026-08-01 15:04:56'),
(26, 4, 3, 'Xtz', 150, 1, '2026-08-01 17:25:52', '2026-08-01 17:25:52'),
(27, 4, 7, 'Fazer', 160, 1, '2026-08-01 18:41:11', '2026-08-01 18:41:11'),
(28, 7, 7, 'Boxer Ct', 125, 1, '2026-08-05 20:28:38', '2026-08-05 21:04:51'),
(29, 11, 6, 'Jetix', 125, 1, '2026-08-07 15:43:54', '2026-08-07 15:43:54'),
(30, 7, 7, 'Pulsar', 135, 1, '2026-08-07 20:49:48', '2026-08-07 20:49:48'),
(31, 7, 7, 'Xcd', 125, 1, '2026-08-08 14:58:20', '2026-08-08 14:58:20'),
(32, 7, 7, 'Platino', 125, 1, '2026-08-08 14:58:40', '2026-08-08 14:58:40'),
(33, 7, 7, 'Discover', 110, 1, '2026-08-08 14:59:10', '2026-08-08 14:59:10'),
(35, 7, 7, 'Discover St', 125, 1, '2026-08-08 14:59:56', '2026-08-08 14:59:56'),
(36, 7, 7, 'Discover Fd', 125, 1, '2026-08-08 15:00:22', '2026-08-08 15:00:22'),
(37, 7, 7, 'Boxer Bm', 150, 1, '2026-08-08 15:00:49', '2026-08-08 15:00:49'),
(38, 7, 7, 'Boxer Bm', 100, 1, '2026-08-08 15:01:09', '2026-08-08 15:01:09'),
(40, 2, 6, 'Best', 125, 1, '2026-08-10 15:09:40', '2026-08-10 15:10:26'),
(41, 12, 6, 'Advance', 110, 1, '2026-08-11 20:51:26', '2026-08-11 20:51:26'),
(42, 13, 8, 'Ceronte', 200, 1, '2026-08-18 15:36:16', '2026-08-18 15:36:16'),
(43, 14, 7, 'iSmart', 110, 1, '2026-08-19 15:02:55', '2026-08-19 15:02:55'),
(44, 11, 5, 'Agiglity', 125, 1, '2026-08-24 13:13:04', '2026-08-24 13:13:04'),
(45, 1, 3, 'Xr', 150, 1, '2026-08-31 22:49:26', '2026-08-31 22:49:26'),
(46, 9, 7, 'Apache', 180, 1, '2026-09-01 00:29:25', '2026-09-01 00:29:25'),
(47, 4, 5, 'Bws', 100, 1, '2026-09-03 19:32:32', '2026-09-03 19:32:32'),
(48, 2, 11, 'Gn', 125, 1, '2026-09-04 18:48:56', '2026-09-04 18:48:56'),
(49, 7, 7, 'Ns', 200, 1, '2026-09-05 22:59:19', '2026-09-05 22:59:19'),
(50, 7, 5, 'Discover', 135, 1, '2026-09-07 15:54:32', '2026-09-07 15:54:32'),
(51, 4, 5, 'Bws', 125, 1, '2026-09-08 13:12:52', '2026-09-08 13:12:52'),
(52, 8, 6, 'Special', 110, 1, '2026-09-08 13:22:03', '2026-09-08 13:22:03'),
(53, 8, 6, 'Flex', 110, 1, '2026-09-08 13:22:56', '2026-09-08 13:22:56'),
(54, 8, 6, 'Flex', 125, 1, '2026-09-08 13:23:09', '2026-09-08 13:23:09'),
(55, 7, 7, 'Pulsar', 180, 1, '2026-09-10 16:23:38', '2026-09-10 16:23:38'),
(56, 7, 7, 'Pulsar Ug', 180, 1, '2026-09-10 16:24:05', '2026-09-10 16:24:05'),
(57, 7, 7, 'Pulsar', 220, 1, '2026-09-10 16:24:20', '2026-09-10 16:24:20'),
(58, 2, 7, 'Gs', 125, 1, '2026-09-12 19:19:38', '2026-09-12 19:19:38'),
(59, 2, 7, 'Gs', 500, 1, '2026-09-12 19:19:55', '2026-09-12 19:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `movimientos_inventario`
--

CREATE TABLE `movimientos_inventario` (
  `id` int(11) NOT NULL,
  `parte_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `caso_id` int(11) DEFAULT NULL,
  `tipo` enum('compra','consumo','ajuste_entrada','ajuste_salida') NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `stock_resultante` decimal(12,2) NOT NULL DEFAULT 0.00,
  `costo_unitario` decimal(10,2) DEFAULT NULL,
  `observacion` text DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movimientos_inventario`
--

INSERT INTO `movimientos_inventario` (`id`, `parte_id`, `usuario_id`, `caso_id`, `tipo`, `motivo`, `cantidad`, `stock_resultante`, `costo_unitario`, `observacion`, `fecha`) VALUES
(1, 1, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 34000.00, 'Original', '2026-07-13 17:57:25'),
(2, 1, 3, 87, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 34000.00, 'Aplicado desde WorkShop', '2026-07-13 17:57:41'),
(3, 2, 3, NULL, 'compra', 'Compra inicial', 10.00, 10.00, 400.00, 'compra', '2026-07-21 23:07:04'),
(4, 1, 3, NULL, 'compra', 'Compra inicial', 15.00, 15.00, 34000.00, '', '2026-07-21 23:07:25'),
(5, 4, 3, NULL, 'compra', 'Compra inicial', 20.00, 20.00, 18000.00, '', '2026-07-21 23:29:50'),
(8, 2, 3, 101, 'consumo', 'Consumo durante reparación', 2.00, 8.00, 400.00, 'Aplicado desde WorkShop', '2026-07-22 00:57:00'),
(9, 2, 3, 101, 'consumo', 'Consumo durante reparación', 2.00, 6.00, 400.00, 'Aplicado desde WorkShop', '2026-07-22 00:59:38'),
(10, 5, 3, NULL, 'compra', 'Compra inicial', 10.00, 10.00, 500.00, '', '2026-07-22 11:52:35'),
(11, 5, 3, 100, 'consumo', 'Consumo durante reparación', 2.00, 8.00, 500.00, 'Aplicado desde WorkShop', '2026-07-22 11:53:46'),
(12, 6, 3, NULL, 'compra', 'Compra inicial', 4.00, 4.00, 3500.00, '', '2026-07-22 21:57:38'),
(13, 7, 3, NULL, 'compra', 'Compra inicial', 2.00, 2.00, 3500.00, '', '2026-07-22 21:59:43'),
(14, 7, 3, 103, 'consumo', 'Consumo durante reparación', 1.00, 1.00, 3500.00, 'Aplicado desde WorkShop', '2026-07-22 22:00:11'),
(15, 8, 3, NULL, 'compra', 'Compra inicial', 2.00, 2.00, 2000.00, '', '2026-07-22 22:03:10'),
(16, 8, 3, 103, 'consumo', 'Consumo durante reparación', 1.00, 1.00, 2000.00, 'Aplicado desde WorkShop', '2026-07-22 22:03:27'),
(17, 6, 3, 103, 'consumo', 'Consumo durante reparación', 2.00, 2.00, 3500.00, 'Aplicado desde WorkShop', '2026-07-22 22:07:09'),
(18, 7, 3, 103, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 3500.00, 'Aplicado desde WorkShop', '2026-07-23 09:48:47'),
(19, 9, 3, NULL, 'compra', 'Compra inicial', 3.00, 3.00, 3600.00, '', '2026-07-23 11:12:42'),
(20, 9, 3, 96, 'consumo', 'Consumo durante reparación', 1.00, 2.00, 3600.00, 'Aplicado desde WorkShop', '2026-07-23 11:14:04'),
(21, 12, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 10000.00, '', '2026-07-23 12:02:31'),
(23, 14, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 28000.00, '', '2026-07-24 10:07:45'),
(24, 14, 3, 107, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 28000.00, 'Aplicado desde WorkShop', '2026-07-24 10:27:48'),
(25, 15, 3, NULL, 'compra', 'Compra inicial', 15.00, 15.00, 500.00, '', '2026-08-06 16:06:44'),
(26, 15, 3, 58, 'consumo', 'Consumo durante reparación', 4.00, 11.00, 500.00, 'Aplicado desde WorkShop', '2026-08-06 16:07:19'),
(27, 16, 3, NULL, 'compra', 'Compra inicial', 5.00, 5.00, 35000.00, '', '2026-08-06 16:12:34'),
(28, 16, 3, 58, 'consumo', 'Consumo durante reparación', 1.00, 4.00, 35000.00, 'Aplicado desde WorkShop', '2026-08-06 16:12:54'),
(29, 17, 3, NULL, 'compra', 'Compra inicial', 100.00, 100.00, 500.00, '', '2026-08-06 16:14:50'),
(30, 17, 3, 58, 'consumo', 'Consumo durante reparación', 2.00, 98.00, 500.00, 'Aplicado desde WorkShop', '2026-08-06 16:15:18'),
(31, 18, 3, NULL, 'compra', 'Compra inicial', 5.00, 5.00, 5000.00, '', '2026-08-06 16:18:39'),
(32, 18, 3, 58, 'consumo', 'Consumo durante reparación', 1.00, 4.00, 5000.00, 'Aplicado desde WorkShop', '2026-08-06 16:19:04'),
(33, 19, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 9000.00, '', '2026-08-07 15:26:29'),
(34, 19, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 9000.00, 'Aplicado desde WorkShop', '2026-08-07 15:26:50'),
(35, 20, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 16000.00, '', '2026-08-07 15:29:54'),
(36, 20, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 16000.00, 'Aplicado desde WorkShop', '2026-08-07 15:30:31'),
(37, 21, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 65000.00, '', '2026-08-07 15:34:30'),
(38, 21, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 65000.00, 'Aplicado desde WorkShop', '2026-08-07 15:34:51'),
(39, 22, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 22300.00, '', '2026-08-07 15:39:21'),
(40, 22, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 22300.00, 'Aplicado desde WorkShop', '2026-08-07 15:39:37'),
(41, 23, 3, NULL, 'compra', 'Compra inicial', 2.00, 2.00, 42000.00, '', '2026-08-07 15:52:02'),
(42, 23, 3, 109, 'consumo', 'Consumo durante reparación', 2.00, 0.00, 42000.00, 'Aplicado desde WorkShop', '2026-08-07 15:52:22'),
(43, 24, 3, NULL, 'compra', 'Compra inicial', 2.00, 2.00, 10000.00, '', '2026-08-07 15:54:34'),
(44, 24, 3, 109, 'consumo', 'Consumo durante reparación', 2.00, 0.00, 10000.00, 'Aplicado desde WorkShop', '2026-08-07 15:54:44'),
(45, 25, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 10000.00, '', '2026-08-07 16:04:20'),
(46, 25, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 10000.00, 'Aplicado desde WorkShop', '2026-08-07 16:04:39'),
(47, 26, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 4500.00, '', '2026-08-08 09:56:20'),
(48, 28, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 14100.00, '', '2026-08-08 10:09:16'),
(49, 29, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 9000.00, '', '2026-08-08 10:12:25'),
(50, 30, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 14000.00, '', '2026-08-08 14:55:37'),
(51, 28, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 14100.00, 'Aplicado desde WorkShop', '2026-08-08 15:09:45'),
(52, 26, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 4500.00, 'Aplicado desde WorkShop', '2026-08-08 15:10:45'),
(53, 27, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 5300.00, '', '2026-08-08 15:11:59'),
(54, 27, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 5300.00, 'Aplicado desde WorkShop', '2026-08-08 15:12:39'),
(55, 30, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 14000.00, 'Aplicado desde WorkShop', '2026-08-08 15:14:19'),
(56, 31, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 5000.00, '', '2026-08-10 09:47:24'),
(57, 32, 3, NULL, 'compra', 'Compra inicial', 2.00, 2.00, 9000.00, '', '2026-08-11 15:57:21'),
(58, 32, 3, 109, 'consumo', 'Consumo durante reparación', 2.00, 0.00, 9000.00, 'Aplicado desde WorkShop', '2026-08-11 15:59:02'),
(59, 33, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 16000.00, '', '2026-08-11 16:48:21'),
(60, 33, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 16000.00, 'Aplicado desde WorkShop', '2026-08-11 16:48:42'),
(61, 34, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 14000.00, '', '2026-08-11 18:11:56'),
(62, 34, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 14000.00, 'Aplicado desde WorkShop', '2026-08-11 18:12:25'),
(63, 31, 3, 109, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 5000.00, 'Aplicado desde WorkShop', '2026-08-12 11:57:26'),
(64, 35, 3, NULL, 'compra', 'Compra inicial', 3.00, 3.00, 5000.00, '', '2026-08-12 14:32:24'),
(65, 35, 3, 107, 'consumo', 'Consumo durante reparación', 2.00, 1.00, 5000.00, 'Aplicado desde WorkShop', '2026-08-12 14:32:44'),
(66, 36, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 24640.00, '', '2026-08-12 15:32:09'),
(67, 37, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 6530.00, '', '2026-08-12 15:36:47'),
(68, 38, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 9000.00, '', '2026-08-12 17:04:46'),
(69, 39, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 13000.00, '', '2026-08-12 20:16:39'),
(70, 39, 3, 129, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 13000.00, 'Aplicado desde WorkShop', '2026-08-12 20:17:20'),
(71, 17, 3, 134, 'consumo', 'Consumo durante reparación', 1.00, 97.00, 500.00, 'Aplicado desde WorkShop', '2026-08-18 10:38:21'),
(72, 17, 3, 134, 'consumo', 'Consumo durante reparación', 1.00, 96.00, 500.00, 'Aplicado desde WorkShop', '2026-08-18 10:39:13'),
(73, 40, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 22000.00, '', '2026-08-29 18:54:07'),
(74, 40, 6, 141, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 22000.00, 'Aplicado desde WorkShop', '2026-08-29 18:55:11'),
(75, 41, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 5000.00, '', '2026-08-31 17:40:11'),
(76, 42, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 4100.00, '', '2026-08-31 17:50:09'),
(77, 41, 6, 142, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 5000.00, 'Aplicado desde WorkShop', '2026-08-31 17:51:27'),
(78, 43, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 7500.00, '', '2026-08-31 17:55:32'),
(79, 43, 6, NULL, 'compra', 'Compra inicial', 1.00, 2.00, 7500.00, '', '2026-08-31 17:56:13'),
(80, 43, 6, 142, 'consumo', 'Consumo durante reparación', 1.00, 1.00, 7500.00, 'Aplicado desde WorkShop', '2026-08-31 17:56:24'),
(81, 44, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 32000.00, '', '2026-09-04 14:02:24'),
(82, 44, 6, 146, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 32000.00, 'Aplicado desde WorkShop', '2026-09-04 14:03:32'),
(83, 45, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 1000.00, '', '2026-09-04 14:08:48'),
(84, 45, 6, NULL, 'compra', 'Compra inicial', 3.00, 4.00, 1000.00, '', '2026-09-04 14:09:33'),
(85, 45, 6, 145, 'consumo', 'Consumo durante reparación', 2.00, 2.00, 1000.00, 'Aplicado desde WorkShop', '2026-09-04 14:09:58'),
(86, 46, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 60000.00, '', '2026-09-04 15:52:55'),
(87, 46, 6, 144, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 60000.00, 'Aplicado desde WorkShop', '2026-09-04 15:54:55'),
(88, 47, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 6000.00, '', '2026-09-04 16:00:56'),
(89, 47, 6, 144, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 6000.00, 'Aplicado desde WorkShop', '2026-09-04 16:01:29'),
(90, 48, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 25000.00, '', '2026-09-04 16:10:42'),
(91, 48, 6, 145, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 25000.00, 'Aplicado desde WorkShop', '2026-09-04 16:11:35'),
(92, 49, 3, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 25000.00, '', '2026-09-06 13:32:17'),
(93, 51, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 22000.00, '', '2026-09-08 14:05:07'),
(94, 51, 6, 150, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 22000.00, 'Aplicado desde WorkShop', '2026-09-08 14:05:41'),
(95, 52, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 68000.00, '', '2026-09-10 08:33:25'),
(96, 52, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 68000.00, 'Aplicado desde WorkShop', '2026-09-10 10:04:04'),
(97, 53, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 35000.00, '', '2026-09-10 10:16:24'),
(98, 53, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 35000.00, 'Aplicado desde WorkShop', '2026-09-10 10:16:57'),
(99, 54, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 20000.00, '', '2026-09-10 10:21:28'),
(100, 24, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 10000.00, '', '2026-09-10 10:34:37'),
(101, 24, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 10000.00, 'Aplicado desde WorkShop', '2026-09-10 10:34:49'),
(102, 56, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 15000.00, '', '2026-09-10 10:37:17'),
(103, 56, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 15000.00, 'Aplicado desde WorkShop', '2026-09-10 10:38:10'),
(104, 54, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 20000.00, 'Aplicado desde WorkShop', '2026-09-10 10:41:27'),
(105, 57, 6, NULL, 'compra', 'Compra inicial', 100.00, 100.00, 60.00, '', '2026-09-10 10:48:32'),
(106, 57, 6, 150, 'consumo', 'Consumo durante reparación', 30.00, 70.00, 60.00, 'Aplicado desde WorkShop', '2026-09-10 10:49:23'),
(107, 58, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 15000.00, '', '2026-09-10 11:16:56'),
(108, 58, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 15000.00, 'Aplicado desde WorkShop', '2026-09-10 11:17:23'),
(109, 59, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 21000.00, '', '2026-09-10 11:22:37'),
(110, 59, 6, 148, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 21000.00, 'Aplicado desde WorkShop', '2026-09-10 11:25:15'),
(111, 50, 6, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 15500.00, '', '2026-09-11 18:59:41'),
(112, 50, 6, 151, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 15500.00, 'Aplicado desde WorkShop', '2026-09-11 19:00:27'),
(113, 60, 7, NULL, 'compra', 'Compra inicial', 1.00, 1.00, 12000.00, '', '2026-09-12 14:24:01'),
(114, 60, 7, 153, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 12000.00, 'Aplicado desde WorkShop', '2026-09-12 14:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `partes`
--

CREATE TABLE `partes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `tipo` enum('repuesto','insumo','herramienta') NOT NULL DEFAULT 'repuesto',
  `nombre` varchar(150) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `fabricante_repuesto_id` int(11) DEFAULT NULL,
  `numero_parte` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `unidad` enum('Unidad','Juego','Par','Litro','Mililitro','Kilogramo','Gramo','Metro','Centimetro') NOT NULL DEFAULT 'Unidad',
  `stock_actual` decimal(12,2) NOT NULL DEFAULT 0.00,
  `stock_reservado` decimal(12,2) NOT NULL DEFAULT 0.00,
  `stock_minimo` decimal(12,2) NOT NULL DEFAULT 0.00,
  `costo` decimal(10,2) NOT NULL DEFAULT 0.00,
  `precio_venta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ubicacion` varchar(120) DEFAULT NULL,
  `codigo_barras` varchar(100) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partes`
--

INSERT INTO `partes` (`id`, `codigo`, `categoria_id`, `tipo`, `nombre`, `marca`, `fabricante_repuesto_id`, `numero_parte`, `created_by`, `unidad`, `stock_actual`, `stock_reservado`, `stock_minimo`, `costo`, `precio_venta`, `ubicacion`, `codigo_barras`, `imagen`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'CunDir001', 16, 'repuesto', 'Cunas de dirección.', 'Choho', 1, '', 3, 'Unidad', 15.00, 0.00, 10.00, 18000.00, 34000.00, 'NA', '22201GF6000LS', NULL, 1, '2026-07-13 17:56:39', '2026-07-22 01:01:51'),
(2, 'BombDirRedCruz', 11, 'repuesto', 'Bombillo direccional redondo pata cruzada', NULL, NULL, 'hjkl8', 3, 'Unidad', 6.00, 0.00, 10.00, 400.00, 1000.00, '', 'hjkñ', NULL, 1, '2026-07-20 13:34:53', '2026-07-22 00:59:38'),
(4, 'CunDir002', 16, 'repuesto', 'Cunas de dirección.', 'Casarella', 2, '67890l', 3, 'Unidad', 20.00, 0.00, 5.00, 18000.00, 32000.00, '', 'bnmo', NULL, 1, '2026-07-21 23:28:25', '2026-07-21 23:29:50'),
(5, 'TermPlanoHemb', 24, 'insumo', 'Terminales planos hembra', 'Sin marca', 3, '6777y', 3, 'Unidad', 8.00, 0.00, 20.00, 500.00, 700.00, 'NA', '22201GF6000LS', NULL, 1, '2026-07-22 11:52:21', '2026-07-22 11:53:46'),
(6, 'RodBol6301', 16, 'repuesto', 'Rodamiento 6301', 'Koyo', 5, 'jkjk', 3, 'Unidad', 2.00, 0.00, 20.00, 3500.00, 8000.00, 'Vitrina', '56789', NULL, 1, '2026-07-22 21:56:41', '2026-07-22 22:07:09'),
(7, 'RodBol6004', 16, 'repuesto', 'Rodamiento 6004', 'Pfi', 4, '34t', 3, 'Unidad', 0.00, 0.00, 20.00, 3500.00, 9000.00, 'Vitrina', '56890okhggfw45sy', NULL, 1, '2026-07-22 21:59:25', '2026-07-23 09:48:47'),
(8, 'TornPbandas15mm', 19, 'repuesto', 'Tornillo Porta bandas 15mm', 'Sin marca', 3, 'N/A', 3, 'Unidad', 1.00, 0.00, 10.00, 2000.00, 5000.00, 'Gabeta', 'N/A', NULL, 1, '2026-07-22 22:02:44', '2026-07-22 22:03:27'),
(9, 'EmpTapVol001', 25, 'repuesto', 'Empaque tapa volante', 'Akt', 6, '', 3, 'Unidad', 2.00, 0.00, 5.00, 3600.00, 4300.00, '', '7701023536394', NULL, 1, '2026-07-23 11:12:24', '2026-07-23 11:14:04'),
(12, 'CunDir003', 16, 'repuesto', 'Cunas de dirección.', 'Rnv', 7, '407500008', 3, 'Unidad', 1.00, 0.00, 3.00, 10000.00, 22000.00, 'Vitrina', 'NA', NULL, 1, '2026-07-23 11:21:40', '2026-07-24 09:54:18'),
(14, 'CunDir004', 16, 'repuesto', 'Cunas de dirección.', 'Honda', 8, '25K160S', 3, 'Unidad', 0.00, 0.00, 2.00, 28000.00, 36000.00, 'Vitrina', 'KCF7PKV4R2Z2', NULL, 1, '2026-07-24 10:06:45', '2026-07-24 10:27:48'),
(15, 'BombPlan', 11, 'repuesto', 'Bombillo tablero.', 'Sin marca', 3, 'NA', 3, 'Unidad', 11.00, 0.00, 10.00, 500.00, 1000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-06 16:06:30', '2026-08-06 16:07:19'),
(16, 'Batt001', 12, 'repuesto', 'Batería ', 'Tesla', 12, 'Mf Yb2.5lc', 3, 'Unidad', 4.00, 0.00, 3.00, 35000.00, 45000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-06 16:12:21', '2026-08-06 16:12:54'),
(17, 'TermRedHemb', 24, 'repuesto', 'Terminales redondos hembra', 'Sin marca', 3, 'NA', 3, 'Unidad', 96.00, 0.00, 20.00, 500.00, 1000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-06 16:14:27', '2026-08-18 10:39:13'),
(18, 'BombFaro', 11, 'repuesto', 'Bombillo delantero T19.', 'Sin marca', 3, 'NA', 3, 'Unidad', 4.00, 0.00, 3.00, 5000.00, 10000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-06 16:17:38', '2026-08-06 16:19:04'),
(19, 'EmpCul001', 25, 'repuesto', 'Empaque Culata.', 'Bajaj', 14, 'JZ511016', 3, 'Unidad', 0.00, 0.00, 2.00, 9000.00, 9500.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 15:26:17', '2026-08-07 15:26:50'),
(20, 'GuiaCadRep001', 4, 'repuesto', 'GuíasCadena Repartición', 'Bajaj', 14, '36JZ0122', 3, 'Unidad', 0.00, 0.00, 0.00, 16000.00, 18400.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 15:28:57', '2026-08-07 15:30:31'),
(21, 'Piston001', 4, 'repuesto', 'Pistón', 'Tkrj', 15, 'AZ0312X', 3, 'Unidad', 0.00, 0.00, 1.00, 65000.00, 74100.00, 'Vitrina', '731PCJ', NULL, 1, '2026-08-07 15:34:16', '2026-08-07 15:34:51'),
(22, 'CadRep0001', 4, 'repuesto', 'Cadena de repartición', 'Bajaj', 14, 'JE511236', 3, 'Unidad', 0.00, 0.00, 1.00, 22300.00, 45000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 15:39:02', '2026-08-07 15:39:37'),
(23, 'GuiaValv001', 4, 'repuesto', 'Guías de válvulas.', 'Sin marca', 3, 'NA', 3, 'Unidad', 0.00, 0.00, 2.00, 42000.00, 42000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 15:51:27', '2026-08-07 15:52:22'),
(24, 'SellValv001', 4, 'repuesto', 'Sellos de válvulas.', 'Bajaj', 14, '39201719', 3, 'Unidad', 0.00, 0.00, 2.00, 10000.00, 11300.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 15:54:05', '2026-09-10 10:34:49'),
(25, 'DiscPinArbolLev001', 4, 'repuesto', 'Disco Piñón árbol Levas.', 'Bajaj', 14, 'JE511237', 3, 'Unidad', 0.00, 0.00, 1.00, 10000.00, 20000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-07 16:04:04', '2026-08-07 16:04:39'),
(26, 'EmpTapVol002', 25, 'repuesto', 'Empaque tapa volante 05X126', 'Darrow', 16, '05X126', 3, 'Unidad', 0.00, 0.00, 1.00, 4500.00, 6000.00, 'Vitrina', '7-707008-726477', NULL, 1, '2026-08-08 09:56:04', '2026-08-08 15:10:45'),
(27, 'EmpTapCluth001', 25, 'repuesto', 'Empaque tapa cluth', 'Darrow', 16, '01P161', 3, 'Unidad', 0.00, 0.00, 1.00, 5300.00, 6800.00, 'Vitrina', '707008-726484', NULL, 1, '2026-08-08 10:05:12', '2026-08-08 15:12:39'),
(28, 'RodBol001', 16, 'repuesto', '6002', 'Nachi', 17, '6002ZZEC3', 3, 'Unidad', 0.00, 0.00, 1.00, 14100.00, 16500.00, 'Vitrina', 'NA', NULL, 1, '2026-08-08 10:09:03', '2026-08-08 15:09:45'),
(29, 'RodBol002', 16, 'repuesto', '6003-3005-503', 'Koyo', 5, '6003-3005-503', 3, 'Unidad', 1.00, 0.00, 1.00, 9000.00, 0.00, 'Vitrina', '4549250141409', NULL, 1, '2026-08-08 10:11:50', '2026-08-08 14:56:58'),
(30, 'RodBol003', 16, 'repuesto', '6003-ZZC3', 'Koyo', 5, '6003-ZZC3', 3, 'Unidad', 0.00, 0.00, 1.00, 14000.00, 18000.00, 'Vitrina', '983966', NULL, 1, '2026-08-08 14:55:28', '2026-08-08 15:14:19'),
(31, 'FiltAceit', 3, 'repuesto', 'Filtro aceite', 'Hibari', 18, 'DD-1211-81', 3, 'Unidad', 0.00, 0.00, 10.00, 5000.00, 6500.00, 'Vitrina', '7-450076-124705', NULL, 1, '2026-08-10 09:47:04', '2026-08-12 11:57:26'),
(32, 'Buj001', 24, 'repuesto', 'Bujía', 'Ngk', 19, 'CR7HSA', 3, 'Unidad', 0.00, 0.00, 5.00, 9000.00, 11000.00, 'Vitrina', '7-897707-508778', NULL, 1, '2026-08-11 15:55:55', '2026-08-11 15:59:02'),
(33, 'EmpCtin001', 25, 'repuesto', 'Empaque culatín', 'Bajaj', 14, 'JE511022', 3, 'Unidad', 0.00, 0.00, 2.00, 16000.00, 18300.00, 'Vitrina', 'NA', NULL, 1, '2026-08-11 16:47:36', '2026-08-11 16:48:42'),
(34, 'ManigEmb001', 6, 'repuesto', 'Manigueta embrague', 'Bajaj', 14, 'JG161008', 3, 'Unidad', 0.00, 0.00, 2.00, 14000.00, 16200.00, 'Vitrina', 'NA', NULL, 1, '2026-08-11 18:11:21', '2026-08-11 18:12:25'),
(35, 'RetBarr001', 25, 'repuesto', 'Retenedor de barra 31*43*11', 'Bajaj', 14, 'DJ181087', 3, 'Unidad', 1.00, 0.00, 4.00, 5000.00, 12000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-12 14:30:19', '2026-08-12 14:32:44'),
(36, 'Cutt001', 22, 'herramienta', 'Bisturí', 'Stanley', 20, '10-175', 3, 'Unidad', 1.00, 0.00, 1.00, 24640.00, 24640.00, 'Tablero', '76174-10175-1', NULL, 1, '2026-08-12 15:31:52', '2026-08-12 15:32:08'),
(37, 'HojaRep001', 22, 'insumo', 'Hoja cuchilla repuesto', 'Forte', 21, '4159', 3, 'Unidad', 1.00, 0.00, 1.00, 6530.00, 6530.00, 'Tablero', '7-707052-617653', NULL, 1, '2026-08-12 15:36:27', '2026-08-12 15:36:47'),
(38, 'CintaAis', 24, 'insumo', 'Cinta aislante', 'Accel', 22, '99323', 3, 'Unidad', 1.00, 0.00, 1.00, 9000.00, 9000.00, 'Tablero', '7-707564-892418', NULL, 1, '2026-08-12 17:04:26', '2026-08-12 17:04:46'),
(39, 'Direccional001', 11, 'repuesto', 'Direccionales', 'Gx', 23, '827197', 3, 'Unidad', 0.00, 0.00, 2.00, 13000.00, 16000.00, 'Estante', 'NA', NULL, 1, '2026-08-12 20:16:16', '2026-08-12 20:17:20'),
(40, 'Reg001', 24, 'repuesto', 'Regulador de carga', 'Industrias Leo', 24, 'xxxxxxx', 6, 'Unidad', 0.00, 0.00, 1.00, 22000.00, 32000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-29 18:53:22', '2026-08-29 18:55:11'),
(41, 'Filt001', 3, 'repuesto', 'Filtro de Aire', 'Gaviria', 25, '563A', 6, 'Unidad', 0.00, 0.00, 1.00, 5000.00, 12000.00, 'Vitrina', '0052792', NULL, 1, '2026-08-31 17:39:49', '2026-08-31 17:51:27'),
(42, 'Filt002', 3, 'repuesto', 'Filtro de Aire', 'Evol', 26, 'FIL2558', 6, 'Unidad', 1.00, 0.00, 1.00, 4100.00, 12000.00, 'Vitrina', '17211-KRE-900', NULL, 1, '2026-08-31 17:48:23', '2026-08-31 17:50:09'),
(43, 'Buj002', 24, 'repuesto', 'Bujía', 'Bajaj', 14, 'DD111018', 6, 'Unidad', 1.00, 0.00, 1.00, 7500.00, 12000.00, 'Vitrina', 'NA', NULL, 1, '2026-08-31 17:53:40', '2026-08-31 17:56:24'),
(44, 'DafrCarb001', 4, 'repuesto', 'Diafragma carburado', 'SukiParts', 27, '13500H48F00H000', 6, 'Unidad', 0.00, 0.00, 1.00, 32000.00, 40000.00, 'Vitrina', 'TP0817', NULL, 1, '2026-09-04 14:01:42', '2026-09-04 14:03:32'),
(45, 'Oring001', 17, 'repuesto', 'O-Ring', 'Sin marca', 3, '217', 6, 'Unidad', 2.00, 0.00, 2.00, 1000.00, 2000.00, 'Caja Azul', 'NA', NULL, 1, '2026-09-04 14:08:09', '2026-09-04 14:09:58'),
(46, 'Piston002', 4, 'repuesto', 'Kit pistón.', 'Casarella', 2, '4VP-E1631-00 25', 6, 'Unidad', 0.00, 0.00, 1.00, 60000.00, 64000.00, 'Vitrina', '00002710', NULL, 1, '2026-09-04 15:51:03', '2026-09-04 15:54:55'),
(47, 'EmpKitMedio001', 25, 'repuesto', 'Kit medio Empaques.', 'Darrow', 16, '19L19SE', 6, 'Unidad', 0.00, 0.00, 1.00, 6000.00, 6500.00, 'Vitrina', '707008 711985', NULL, 1, '2026-09-04 16:00:12', '2026-09-04 16:01:29'),
(48, 'TensCadlla001', 4, 'repuesto', 'Tensor Cadenilla Gn', 'Vitrix', 28, 'VS10116', 6, 'Unidad', 0.00, 0.00, 1.00, 25000.00, 30000.00, 'Vitrina', '9 903907 006421', NULL, 1, '2026-09-04 16:10:04', '2026-09-04 16:11:35'),
(49, 'PiedEsmer#60', 20, 'insumo', 'Piedra Esmeril#60', 'UyusTools', 29, 'PDE1660U', 3, 'Unidad', 1.00, 0.00, 1.00, 25000.00, 25000.00, 'Banco', '6 931598 2670 46', NULL, 1, '2026-09-06 13:32:01', '2026-09-06 13:32:17'),
(50, 'Bendix001', 4, 'repuesto', 'Bendix uniWay', 'Inoki', 30, 'NA', 6, 'Unidad', 0.00, 0.00, 1.00, 15500.00, 25000.00, 'Vitrina', '14A021K', NULL, 1, '2026-09-08 08:21:05', '2026-09-11 19:00:27'),
(51, 'Anill001', 4, 'repuesto', 'Anillos ', 'Tkrj', 15, '4C6-E1603-20 0.50', 6, 'Unidad', 0.00, 0.00, 1.00, 22000.00, 24800.00, '', 'RY0652X', NULL, 1, '2026-09-08 14:04:20', '2026-09-08 14:05:41'),
(52, 'Piston003', 4, 'repuesto', 'Kit pistón.', 'Dma', 31, '182 0.50', 6, 'Unidad', 0.00, 0.00, 1.00, 68000.00, 74000.00, 'Vitrina', '808150003', NULL, 1, '2026-09-10 08:27:42', '2026-09-10 10:04:04'),
(53, 'Valvulas001', 4, 'repuesto', 'Kitt válvulas', 'Bajaj', 14, '36DS1002', 6, 'Unidad', 0.00, 0.00, 1.00, 35000.00, 36400.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 10:15:44', '2026-09-10 10:16:57'),
(54, 'CadRep002', 4, 'repuesto', 'Cadena de repartición', 'Bajaj', 14, 'JE511230', 6, 'Unidad', 0.00, 0.00, 0.00, 20000.00, 22500.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 10:21:02', '2026-09-10 10:41:27'),
(55, 'SellValv002', 4, 'repuesto', 'Sellos de válvulas.', 'Bajaj', 14, '39201719', 6, 'Unidad', 0.00, 0.00, 1.00, 9000.00, 9100.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 10:31:50', '2026-09-10 10:31:50'),
(56, 'GuiaCadRep002', 4, 'repuesto', 'GuíasCadena Repartición', 'Bajaj', 14, '36DS1004', 6, 'Unidad', 0.00, 0.00, 1.00, 15000.00, 15800.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 10:36:46', '2026-09-10 10:38:10'),
(57, 'Manguera001', 20, 'repuesto', 'Manguera Gasolina', 'Sin marca', 3, 'NA', 6, 'Unidad', 70.00, 0.00, 10.00, 60.00, 200.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 10:48:03', '2026-09-10 10:49:23'),
(58, 'EmpCul002', 25, 'repuesto', 'Empaque Culata.', 'Bajaj', 14, 'DH101680', 6, 'Unidad', 0.00, 0.00, 1.00, 15000.00, 15300.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 11:16:13', '2026-09-10 11:17:23'),
(59, 'GuiaValv002', 4, 'repuesto', 'Guías de válvulas.', 'Guivaim', 32, 'G-0301-SA1', 6, 'Unidad', 0.00, 0.00, 1.00, 21000.00, 45000.00, 'Vitrina', 'NA', NULL, 1, '2026-09-10 11:21:48', '2026-09-10 11:25:15'),
(60, 'PastFren001', 7, 'repuesto', 'Pastillas de freno.', 'Evol', 26, 'BAN2553', 7, 'Unidad', 0.00, 0.00, 1.00, 12000.00, 18000.00, 'Vitrina', 'NA', NULL, 1, '2026-09-12 14:18:56', '2026-09-12 14:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `pendientes`
--

CREATE TABLE `pendientes` (
  `id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `caso_origen_id` int(11) NOT NULL,
  `caso_resuelto_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('pendiente','resuelto','descartado') NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendientes`
--

INSERT INTO `pendientes` (`id`, `vehiculo_id`, `caso_origen_id`, `caso_resuelto_id`, `usuario_id`, `descripcion`, `estado`, `created_at`, `resolved_at`) VALUES
(1, 78, 102, NULL, 3, 'Cliente debe $33000!', 'pendiente', '2026-07-23 04:26:53', NULL),
(2, 89, 96, NULL, 3, 'Cobrar bien duro. :)', 'pendiente', '2026-07-23 04:59:34', NULL),
(3, 78, 104, NULL, 3, 'Corregir la altura de la suspensión según el usuario decida después de probar el veículo.', 'pendiente', '2026-07-23 05:28:34', NULL),
(4, 69, 105, 105, 3, 'Instalar bombillo led.', 'resuelto', '2026-07-23 14:50:42', '2026-08-06 11:48:40'),
(5, 98, 108, 130, 3, 'La manzana paree estar ovalada, revisar cuando vuelva.', 'resuelto', '2026-07-23 18:22:17', '2026-08-14 13:58:04'),
(6, 100, 110, NULL, 3, 'Se ajustó palanca de modo provicional. \r\nPendiente cambio de eje y pedal de marchas.', 'pendiente', '2026-07-23 19:56:04', NULL),
(7, 89, 96, NULL, 3, 'Recalibrar válvlas luego de unos kilómtros.', 'pendiente', '2026-07-27 00:54:23', NULL),
(8, 83, 116, NULL, 3, 'Cambiae filtro de aire.', 'pendiente', '2026-07-27 03:31:29', NULL),
(9, 109, 123, 123, 3, 'Cambio aceite diferencial', 'resuelto', '2026-08-06 00:44:04', '2026-08-06 11:49:34'),
(10, 110, 124, 125, 3, 'Reparar sistema palanca freno trasero.', 'resuelto', '2026-08-07 15:50:40', '2026-08-07 10:51:09'),
(11, 16, 131, 152, 3, 'Tensionar y lubricar cadena.\r\nAbicar figa de aceite.', 'resuelto', '2026-08-14 21:08:44', '2026-09-11 17:53:01'),
(12, 39, 142, NULL, 3, 'saldo 44000', 'pendiente', '2026-09-02 14:26:38', NULL),
(13, 120, 144, NULL, 6, 'pendiente 70000', 'pendiente', '2026-09-04 23:37:33', NULL),
(14, 118, 139, NULL, 6, '80000', 'descartado', '2026-09-07 19:45:06', '2026-09-11 09:56:06'),
(15, 118, 139, NULL, 6, '50000', 'pendiente', '2026-09-11 14:56:25', NULL);

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
(32, 6, 3, '2025-10-25', '11:45:06', '2026-07-05', '22:54:39', 365410),
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
(45, 14, 3, '2025-10-29', '14:26:57', '2026-07-05', '22:56:36', 359430),
(46, 12, 3, '2025-10-29', '14:36:41', '2025-10-29', '15:23:44', 407),
(47, 12, 3, '2025-10-29', '15:51:22', '2025-10-29', '16:02:11', 371),
(48, 15, 3, '2025-10-29', '16:10:35', '2025-10-29', '16:39:21', 389),
(49, 12, 3, '2025-10-29', '17:56:13', '2025-10-29', '18:38:18', 402),
(50, 12, 3, '2025-10-30', '10:43:44', '2025-10-30', '14:48:55', 605),
(51, 16, 3, '2025-10-30', '12:54:33', '2025-10-30', '12:55:29', 361),
(52, 12, 3, '2025-10-30', '17:48:42', '2025-10-30', '20:16:54', 508),
(137, 72, 3, '2026-07-08', '00:19:01', '2026-07-08', '00:19:36', 421),
(148, 86, 3, '2026-07-11', '15:18:17', '2026-07-11', '20:51:02', 753),
(149, 33, 3, '2026-07-13', '15:03:00', '2026-07-26', '19:58:26', 19435),
(150, 87, 3, '2026-07-13', '16:27:58', '2026-07-18', '11:55:22', 7347),
(151, 88, 3, '2026-07-14', '13:42:56', '2026-07-15', '10:46:59', 1684),
(152, 89, 3, '2026-07-14', '15:49:27', '2026-07-18', '11:54:34', 5945),
(153, 90, 3, '2026-07-15', '14:13:27', NULL, NULL, 0),
(154, 91, 3, '2026-07-15', '18:25:44', '2026-07-15', '18:28:06', 422),
(155, 92, 3, '2026-07-16', '12:56:05', '2026-07-20', '14:49:55', 6294),
(156, 93, 3, '2026-07-17', '15:11:17', '2026-07-18', '11:53:46', 1662),
(157, 94, 3, '2026-07-17', '18:11:43', '2026-07-17', '18:17:33', 426),
(158, 95, 3, '2026-07-18', '11:57:51', '2026-07-22', '23:39:11', 6881),
(161, 100, 3, '2026-07-21', '22:58:34', '2026-07-22', '14:54:17', 1376),
(162, 101, 3, '2026-07-22', '00:37:09', '2026-07-22', '01:00:29', 443),
(163, 102, 3, '2026-07-22', '14:38:51', '2026-07-22', '23:29:54', 951),
(164, 103, 3, '2026-07-22', '19:36:03', '2026-07-22', '22:07:31', 571),
(165, 96, 3, '2026-07-22', '23:40:28', '2026-07-26', '19:56:05', 5956),
(166, 104, 3, '2026-07-23', '00:27:18', '2026-07-23', '00:28:52', 422),
(167, 105, 3, '2026-07-23', '09:50:16', '2026-07-23', '09:50:53', 421),
(168, 106, 3, '2026-07-23', '10:24:19', '2026-07-23', '11:13:24', 469),
(169, 107, 3, '2026-07-23', '12:01:28', NULL, NULL, 0),
(170, 108, 3, '2026-07-23', '13:20:41', '2026-07-23', '13:22:27', 422),
(171, 109, 3, '2026-07-23', '14:33:44', '2026-08-12', '15:52:29', 29299),
(172, 110, 3, '2026-07-23', '14:55:25', '2026-07-23', '14:56:13', 421),
(173, 111, 3, '2026-07-24', '16:24:28', '2026-07-24', '16:26:07', 422),
(174, 112, 3, '2026-07-24', '16:26:20', '2026-07-27', '18:40:57', 4875),
(175, 113, 3, '2026-07-25', '09:13:46', '2026-07-25', '09:14:27', 421),
(176, 114, 3, '2026-07-25', '09:45:33', '2026-07-26', '19:50:53', 2465),
(177, 115, 3, '2026-07-26', '20:29:38', NULL, NULL, 0),
(178, 116, 3, '2026-07-26', '22:31:12', '2026-07-26', '22:31:37', 420),
(179, 117, 3, '2026-07-28', '11:40:52', '2026-08-01', '09:24:23', 6044),
(180, 118, 3, '2026-07-29', '14:42:32', '2026-07-29', '20:23:10', 761),
(181, 58, 3, '2026-07-30', '16:41:48', NULL, NULL, 0),
(182, 120, 3, '2026-08-01', '13:39:46', '2026-08-01', '13:40:26', 421),
(183, 121, 3, '2026-08-01', '13:41:47', '2026-08-01', '13:43:08', 421),
(184, 119, 3, '2026-08-01', '19:44:46', '2026-08-01', '19:45:27', 421),
(185, 122, 3, '2026-08-05', '15:29:43', '2026-08-05', '17:11:35', 522),
(186, 123, 3, '2026-08-05', '17:13:29', '2026-08-06', '11:49:45', 1536),
(187, 124, 3, '2026-08-07', '10:45:56', '2026-08-07', '10:50:51', 425),
(188, 127, 3, '2026-08-10', '15:22:55', '2026-08-12', '11:23:22', 3060),
(189, 128, 3, '2026-08-11', '15:52:09', '2026-08-12', '11:22:01', 1590),
(190, 129, 3, '2026-08-12', '12:05:12', '2026-08-12', '20:17:30', 912),
(191, 130, 3, '2026-08-14', '11:48:09', '2026-08-16', '19:27:18', 3759),
(192, 131, 3, '2026-08-14', '15:37:05', '2026-08-14', '16:08:53', 452),
(193, 132, 3, '2026-08-17', '14:13:11', '2026-08-17', '14:14:44', 422),
(194, 133, 3, '2026-08-17', '14:15:41', '2026-08-17', '15:10:25', 475),
(195, 134, 3, '2026-08-18', '10:37:12', '2026-08-18', '10:39:28', 422),
(196, 135, 3, '2026-08-18', '15:06:55', NULL, NULL, 0),
(197, 136, 3, '2026-08-19', '10:05:20', '2026-08-20', '10:07:24', 1862),
(198, 137, 3, '2026-08-21', '12:41:04', '2026-09-05', '18:03:42', 22343),
(199, 138, 3, '2026-08-21', '14:21:18', NULL, NULL, 0),
(200, 140, 6, '2026-08-28', '14:56:59', NULL, NULL, 0),
(201, 139, 6, '2026-08-28', '14:58:56', NULL, NULL, 0),
(202, 141, 6, '2026-08-29', '16:34:46', '2026-09-03', '08:15:08', 7120),
(203, 142, 6, '2026-08-31', '17:50:59', '2026-09-05', '17:56:37', 7626),
(204, 143, 6, '2026-08-31', '19:30:11', '2026-08-31', '19:30:44', 421),
(205, 142, 3, '2026-09-01', '09:40:27', NULL, NULL, 0),
(206, 107, 6, '2026-09-03', '13:37:23', '2026-09-03', '18:56:22', 739),
(207, 144, 6, '2026-09-03', '14:33:58', '2026-09-04', '19:00:42', 2127),
(208, 145, 6, '2026-09-04', '13:50:08', '2026-09-04', '18:35:11', 705),
(209, 146, 6, '2026-09-04', '13:55:41', '2026-09-04', '14:03:40', 428),
(210, 147, 6, '2026-09-05', '18:00:33', '2026-09-05', '18:01:45', 421),
(211, 148, 6, '2026-09-07', '10:58:50', '2026-09-10', '19:02:46', 5224),
(212, 151, 6, '2026-09-08', '08:25:49', NULL, NULL, 0),
(213, 150, 6, '2026-09-08', '14:05:29', NULL, NULL, 0),
(214, 153, 7, '2026-09-12', '14:24:16', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_moto`
--

CREATE TABLE `tipos_moto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipos_moto`
--

INSERT INTO `tipos_moto` (`id`, `nombre`, `activo`, `created_at`, `updated_at`) VALUES
(3, 'Enduro', 1, '2026-07-20 02:30:51', '2026-07-20 02:30:51'),
(5, 'Scooter', 1, '2026-07-20 02:40:23', '2026-07-20 02:40:23'),
(6, 'Automática', 1, '2026-07-20 02:41:45', '2026-07-20 02:41:45'),
(7, 'Sport', 1, '2026-07-20 02:48:06', '2026-07-20 02:48:06'),
(8, 'Carguero Triciclo', 1, '2026-07-20 02:48:06', '2026-07-20 02:48:06'),
(9, 'Carguero Quad', 1, '2026-07-20 02:48:06', '2026-07-20 02:48:06'),
(10, 'Cuatrimoto', 1, '2026-07-20 02:48:06', '2026-07-20 02:48:06'),
(11, 'Chopper', 1, '2026-07-20 02:30:51', '2026-07-20 02:30:51');

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
(6, 'Oscar Molano', 'Oscar', '$2y$10$oNZ9rGRXqQpfJF74QmA9BewInx9SFeVlYFhisZUqsNL8gqz1UUzXG', 'mecanico', '2026-08-28 14:26:30'),
(7, 'Jose Cuellar', 'Jose', '$2y$10$BpIvITK1l36loRkgz9BQtuhMJhwcGURhKGkSp6DUeu9Y0dLsaeoi2', 'admin', '2026-09-12 07:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `placa` varchar(30) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `modelo_moto_id` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `propietario` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `placa`, `marca`, `modelo`, `modelo_moto_id`, `color`, `propietario`, `telefono`) VALUES
(6, 'KNF36', 'Honda', 'XL185', NULL, 'Azul', 'Yo', NULL),
(7, 'NQS51A', 'Suzuki', 'Gn 125', NULL, 'Rojo', 'Arnulfo Pintor', NULL),
(8, 'MEQ60E', 'Yamaha', 'Cripton Fi', NULL, 'Rojo negro', 'Eibar', NULL),
(9, 'BGQ86E', 'Akt', 'Flex125', NULL, 'Blanco', 'Doña', NULL),
(10, 'IDB77B', 'Suzuki', 'Viva X', NULL, 'Negra', 'Doña', NULL),
(11, 'BXG49H', 'Bajaj', '200Ns', NULL, 'Negra', 'Don', NULL),
(12, 'RIY59F', '', 'Victory', NULL, 'Negro', 'Manuel', NULL),
(13, 'OLO64B', 'Akt', 'Sl', NULL, 'Rojo', 'Cami||o', NULL),
(14, 'OQO88E', 'Victory', 'One', NULL, 'Negro', 'Maduros', NULL),
(15, 'RKT70C', 'Bajaj', 'Pulsar 135', NULL, 'Negro', 'Senador Cristian', NULL),
(16, 'MEE17B', 'Kymco', 'Active 110', NULL, 'Rojo/ Negro', 'Yolanda ', '3166429866'),
(17, 'JYI69E', 'Honda', 'Cb110', NULL, 'Rojo', 'GustavoYerno', NULL),
(18, 'QMV60C', 'Akt', 'Evo', NULL, 'Negro', '', NULL),
(19, 'AML67', 'Yamaha', 'Xt225', NULL, 'Azul', 'Nelson Borbòn', NULL),
(20, 'WAG02F', 'Akt', 'Nkd', NULL, 'Negro', 'Don', NULL),
(21, 'SYD47E', 'Yamaha', 'Fz2', NULL, 'Azul', 'Diana Marido', NULL),
(22, 'RCQ54D', 'Bajaj', 'Discover100m', NULL, 'Negro', 'Victor', NULL),
(23, 'JMB43C', 'Akt', 'Evo150', NULL, 'Rojo', 'Leonel Publicidad', NULL),
(24, 'MKB89C', 'Suzuki', 'Viva X', NULL, 'Negro', 'Jesùs vecino taller', NULL),
(25, 'JHW47F', 'Victory', 'Life', NULL, 'Negro', 'Diana Cuñado', NULL),
(26, 'FVB22A', 'Suzuki', 'Ax115', NULL, 'Rojo', 'Camilo Muñóz', NULL),
(27, 'QRB81C', 'Kymco', 'Agility', NULL, 'Rojo', 'VecinoJoseManuelCuellarHurtado', NULL),
(28, 'THZ82D', 'Bajaj', 'Discover125', NULL, 'Negro', 'Costeño Maduros', NULL),
(29, 'TBE70C', 'Yamaha', 'Fz16', NULL, 'Blanco', 'Vecino', NULL),
(30, 'JYN56E', 'Akt', 'Nkd', NULL, 'Negro', 'Mauricio Quintero', NULL),
(31, 'IWO76E', 'Yamaha', 'Xtz125', NULL, 'Azul', 'William Eduardo Arcos', '3118012876'),
(32, 'KKH08C', 'Yamaha', 'Cripton 115', NULL, 'Negro', 'Miguel Malavides', '3133942347'),
(33, 'HDT38B', 'Honda', 'WaveC100', NULL, 'Negro', 'crazyPeople', NULL),
(35, 'BIC26C', 'Akt', 'Special 110', NULL, 'Negro', 'Dayana Lizeth Clavijo', '3143486414'),
(36, 'OCQ29F', 'Yamaha', 'Xtz150', NULL, 'Azul', 'Limber', NULL),
(37, 'KKI09C', 'Honda', 'Invicta150', NULL, 'Rojo', 'Edilson', NULL),
(38, 'TZG20C', 'Yamaha', 'Bwis125', NULL, 'Blanco', 'Felipe Ramos', NULL),
(39, 'GIV26D', 'Kymco', 'Agility', NULL, 'Blanco', 'Estufa', NULL),
(40, 'NSV68B', 'Yamaha', 'Bwis125', NULL, 'Negro', 'Fabian', NULL),
(41, 'RVP05E', 'Akt', 'Nkd', NULL, 'Negro', 'Rosalba Estufas', NULL),
(42, 'EIQ99D', 'Suzuki', 'VivaR', NULL, 'Negro', 'amigo Harold', NULL),
(44, 'VZR08F', 'Bajaj', 'Dominar400', NULL, 'Negro', 'Felipe Ramos Amigo', NULL),
(45, 'LMT72D', 'Tongko', 'Bwis125', NULL, 'Blanco', 'Vecino', NULL),
(46, 'MIU26', 'Yamaha', 'Dt125', NULL, 'Azul', 'Fernando Motos', NULL),
(47, 'KNA37D', 'Yamaha', 'Ybr125', NULL, 'Negro/ Azul', 'Fernando Motos', NULL),
(48, 'GVN67D', 'Yamaha', 'Bwis125', NULL, 'Negro', 'Isabel', NULL),
(49, 'MKE64C', 'Bajaj', 'Boxer Ct100', NULL, 'Verde', 'Cristian Papá', NULL),
(50, 'RHA37F', 'Honda', 'Cb110', NULL, 'Negro', 'Fernando Motos', NULL),
(51, 'LGF35C', 'Yamaha', 'Crypton', NULL, 'Negro / Azul', 'Edilson Girl', NULL),
(52, 'KEM64G', 'Yamaha', 'fZ2.0', NULL, 'Azul', 'Fernando Motos', NULL),
(53, 'RUD92E', 'Akt', 'Nkd', NULL, 'Negro', 'Fernando Motos', NULL),
(54, 'YCK99G', 'Akt', 'Nkd', NULL, 'Negro', 'Eventos', NULL),
(55, 'EDB36E', 'Kawasaki', 'Klx150', NULL, 'Negro/Verde', 'Fernando Motos', NULL),
(56, 'PAA20D', 'Suzuki', 'Gs125', NULL, 'Negro', 'Nelson T/ñín', NULL),
(57, 'SCW31C', 'Kymco', 'Agility', NULL, 'Blanco', 'Fernando Motos', NULL),
(58, 'FZO38E', 'Honda', 'Cbr250', NULL, 'Rojo', 'José Manuel', NULL),
(59, 'Silla', 'PgDrivers', 'Pg2', NULL, 'Negro', 'Hugo Borugo', NULL),
(60, 'FYF14A', 'Jialing', '70', NULL, 'Rojo', 'Luís Oporapa', NULL),
(62, 'PWC23E', 'Bajaj', 'Ns200', NULL, 'Azul', 'Diego Papelería', NULL),
(63, 'NOPL4C4', 'Akt', 'Cr5', NULL, 'Verde', 'Fernando Motos', NULL),
(64, 'ZLH11', 'Suzuki', 'VivaX', NULL, 'Negro', 'Fernando Motos', NULL),
(65, 'CRYPTON', 'Yamaha', 'Crypton115', NULL, 'Negro', 'Fernando Motos', NULL),
(66, 'PWA84D', 'Bajaj', 'Discover125St', NULL, 'Negro', 'Diana Isabella', NULL),
(68, 'BIC79C', 'Honda', 'Cbf125', NULL, 'Amarillo', 'Fabian Zuares', NULL),
(69, 'BJB03C', 'Yamaha', 'Crypton 110', NULL, 'Negro', 'Aldemar Prada', NULL),
(70, 'OEQ80C', 'Honda', 'Eco Dlux', NULL, 'Negro', 'un varado', NULL),
(72, 'JTC12B', 'Honda', 'Cbf150', NULL, 'Negro', 'John Jairo Fajardo', '3145941447'),
(73, 'xxxxx', 'Suzuki', 'VivaX', NULL, 'Negro', 'Andrea andrea', '3115697437'),
(74, 'KRY99C', 'Kymco', 'Agility Digital', NULL, 'Negro', 'Carolina Gómez', '3115393028'),
(75, 'ZCT69C', 'Kymco', 'Agility Digital', NULL, 'Blanco', 'Santiago Gómez?', '3506872121'),
(76, 'OPH32E', 'Yamaha', 'Bwis Fi', NULL, 'Blanco', 'Manuel', '3208790871'),
(77, 'YNC43E', 'Yamaha', 'Bwis Fi', NULL, 'Azul', 'Jesús Cuellar', '3124509556'),
(78, 'ZOG25F', 'Honda', 'Xr 190l', NULL, 'Negro/ Blanco', 'Fernando Motos', ''),
(79, 'YL112M-2', 'Cormag', 'YL112M-2', NULL, 'Azul', 'Hector', '3107738282'),
(80, 'CARGO1', 'Ayco', 'Cargo200', NULL, 'Verde', 'Cargueros', '3142067495'),
(81, 'HDZ54G', 'Honda', 'Xr150l', NULL, 'Negro', 'NN', '0'),
(82, 'BKF95E', 'Yamaha', 'Bwis125', NULL, 'Negro', 'NN', ''),
(83, 'EPB64F', 'Honda', 'Xr150l', NULL, 'Negro', 'Jose Cuellar', '3203464628'),
(84, 'UNJ53D', 'Bajaj', 'Discover100m', NULL, 'Negro', 'Luís DeJesús Bernal', '3138003636'),
(85, 'FXP32', 'Honda', 'Eco Dlux', NULL, 'Negro', 'NN', '3212968271'),
(86, 'PFG84A', 'Yamaha', 'Libero', NULL, 'Rojo', 'Fernando Motos', ''),
(87, 'HNM14H', 'Bajaj', 'Boxer Ct', NULL, 'Azul', 'Salomón Artunduaga.', '3212919177'),
(88, 'FKA24C', 'Jincheng', 'Rocket 110', NULL, 'Azul', 'Refrigeradores', ''),
(89, 'WHV31G', 'Akt', 'Nkd', NULL, 'Gris', 'Jean Carlos', ''),
(93, 'PWN16E', 'Bajaj', 'Discover 150', 12, 'Negro', 'venMotos Marcos', '3146381494'),
(94, 'xxx12e', 'Bajaj', 'Discover 100', 11, 'Negro', 'cliente de prueba', '567890'),
(95, 'XCE33E', 'Yamaha', 'Crypton 115', 13, 'Negro', 'Mono Jr', '3507529413'),
(96, 'FLI23G', 'Tvs', 'Max 125', 17, 'Negro', 'NN', ''),
(97, 'OCK28F', 'Honda', 'Cb 125', 20, 'Rojo', 'Diego Primo Cristian', '3187469791'),
(98, 'LAF49E', 'Yamaha', 'CryptonFi 115', 21, 'Negro', 'Alexander Díaz', '3223146967'),
(99, 'JYY52E', 'Bajaj', 'Discover 150', 12, 'Negro', 'Hugo', '3115710524'),
(100, 'LLT78A', 'Yamaha', 'Crypton 110', 22, 'Verde', 'NN', ''),
(101, 'PUA24C', 'Akt', 'Xm 180', 23, 'Azul', 'Alexander Casas', '3212004951'),
(102, 'TEST01', 'Suzuki', 'Gp 125', 7, 'Gris', 'Adolfo Fajardo', '3145941447'),
(103, 'RZN46H', 'Akt', 'Ttr 125', 8, 'Negro', 'Juan Carlos Casas', '3114050324'),
(104, 'CARGO2', 'Vaisand', 'Zh 200', 24, 'Negro / Naranja', 'NN', '3142067495'),
(105, 'EZV96H', 'Suzuki', 'Burgman 125', 25, 'Negro', 'Hugo Claros', '3128717172'),
(106, 'XAR65G', 'Yamaha', 'Xtz 150', 26, 'Negro', 'NN', '0'),
(107, 'IGF92C', 'Yamaha', 'Fazer 160', 27, 'Negro', 'NN', '0'),
(108, 'GAP91I', 'Bajaj', 'Boxer 125', 28, 'Negro', 'Jeferson', '3134848115'),
(109, '00035', 'Vaisand', 'Zh 200', 24, 'Gris', 'Gerardo Cargueros', '3115373603'),
(110, 'MKE41C', 'Kymco', 'Jetix 125', 29, 'Negro', 'NN', '0'),
(111, 'HDD31D', 'Suzuki', 'Best 125', 40, 'Negro', 'Carlos Toño', ''),
(112, 'EOL20F', 'Akt', 'Nkd 125', 9, 'Blanco', 'Fernando Motos', ''),
(113, 'LAP06E', 'Victory', 'Advance 110', 41, 'Negro', 'NN', '0'),
(114, 'BIW43C', 'Honda', 'Cbf 150', 16, 'Rojo', 'Luís Oporapa (hijo)', '0'),
(115, '242AET', 'Ceronte', 'Ceronte 200', 42, 'Blanco', 'la pezca', '0'),
(116, 'PVY18E', 'Hero', 'iSmart 110', 43, '', 'Negro Azul', '3214621632'),
(117, 'MOTOR', '', '', NULL, 'Gris', 'Manuel Cbr', '3102605538'),
(118, 'TMI41D', 'Kymco', 'Agiglity 125', 44, 'Negro', 'Fernando motos', ''),
(119, 'KLG92C', 'Tvs', 'Apache 180', 46, 'Blanco', 'Eibar Dog', ''),
(120, 'ETB55B', 'Yamaha', 'Bws 100', 47, 'Violeta', 'Conductor Frente', '3146879327'),
(121, 'KNB77C', 'Suzuki', 'Gn 125', 48, 'Negro', 'Luís Hijo', '0'),
(122, 'Ns Vale', 'Bajaj', 'Ns 200', 49, 'Negro', 'Prino Valentina', '0'),
(123, 'KNL39B', 'Bajaj', 'Discover 125', 50, 'Negro', 'Luís Casas Jr', '0'),
(125, 'IVQ45D', 'Yamaha', 'Bws 125', 51, 'Blanco', 'Fernando motos', '0'),
(126, 'HOB21H', 'Suzuki', 'Gn 125', 48, 'Negro', 'Valentina la mejor', '3219284744');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplicacion_parte`
--
ALTER TABLE `aplicacion_parte`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_parte_modelo` (`parte_id`,`modelo_moto_id`),
  ADD KEY `idx_parte` (`parte_id`),
  ADD KEY `idx_modelo` (`modelo_moto_id`);

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
-- Indexes for table `caso_repuestos`
--
ALTER TABLE `caso_repuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caso_repuestos_usuario` (`usuario_id`),
  ADD KEY `idx_caso` (`caso_id`),
  ADD KEY `idx_parte` (`parte_id`);

--
-- Indexes for table `categorias_partes`
--
ALTER TABLE `categorias_partes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_categoria_nombre` (`nombre`);

--
-- Indexes for table `fabricante_repuesto`
--
ALTER TABLE `fabricante_repuesto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_fabricante_nombre` (`nombre`);

--
-- Indexes for table `marcas_moto`
--
ALTER TABLE `marcas_moto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_marcas_moto_nombre` (`nombre`);

--
-- Indexes for table `modelos_moto`
--
ALTER TABLE `modelos_moto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_modelo_moto` (`marca_moto_id`,`tipo_moto_id`,`linea`,`cilindrada`),
  ADD KEY `idx_marca` (`marca_moto_id`),
  ADD KEY `idx_tipo` (`tipo_moto_id`),
  ADD KEY `idx_linea` (`linea`),
  ADD KEY `idx_cilindrada` (`cilindrada`);

--
-- Indexes for table `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parte` (`parte_id`),
  ADD KEY `idx_usuario` (`usuario_id`),
  ADD KEY `idx_caso` (`caso_id`),
  ADD KEY `idx_fecha` (`fecha`);

--
-- Indexes for table `partes`
--
ALTER TABLE `partes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_codigo` (`codigo`),
  ADD KEY `idx_categoria` (`categoria_id`),
  ADD KEY `idx_nombre` (`nombre`),
  ADD KEY `idx_tipo` (`tipo`),
  ADD KEY `idx_codigo_barras` (`codigo_barras`),
  ADD KEY `idx_created_by` (`created_by`),
  ADD KEY `idx_fabricante` (`fabricante_repuesto_id`),
  ADD KEY `idx_numero_parte` (`numero_parte`);

--
-- Indexes for table `pendientes`
--
ALTER TABLE `pendientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_id` (`vehiculo_id`),
  ADD KEY `caso_origen_id` (`caso_origen_id`),
  ADD KEY `caso_resuelto_id` (`caso_resuelto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caso_id` (`caso_id`),
  ADD KEY `mecanico_id` (`mecanico_id`);

--
-- Indexes for table `tipos_moto`
--
ALTER TABLE `tipos_moto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_tipos_moto_nombre` (`nombre`);

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
  ADD UNIQUE KEY `placa` (`placa`),
  ADD KEY `idx_modelo_moto` (`modelo_moto_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplicacion_parte`
--
ALTER TABLE `aplicacion_parte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `avances`
--
ALTER TABLE `avances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=516;

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `caso_repuestos`
--
ALTER TABLE `caso_repuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `categorias_partes`
--
ALTER TABLE `categorias_partes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `fabricante_repuesto`
--
ALTER TABLE `fabricante_repuesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `marcas_moto`
--
ALTER TABLE `marcas_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `modelos_moto`
--
ALTER TABLE `modelos_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `partes`
--
ALTER TABLE `partes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pendientes`
--
ALTER TABLE `pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `tipos_moto`
--
ALTER TABLE `tipos_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aplicacion_parte`
--
ALTER TABLE `aplicacion_parte`
  ADD CONSTRAINT `fk_aplicacion_modelo` FOREIGN KEY (`modelo_moto_id`) REFERENCES `modelos_moto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aplicacion_parte` FOREIGN KEY (`parte_id`) REFERENCES `partes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `caso_repuestos`
--
ALTER TABLE `caso_repuestos`
  ADD CONSTRAINT `fk_caso_repuestos_caso` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_caso_repuestos_parte` FOREIGN KEY (`parte_id`) REFERENCES `partes` (`id`),
  ADD CONSTRAINT `fk_caso_repuestos_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `modelos_moto`
--
ALTER TABLE `modelos_moto`
  ADD CONSTRAINT `fk_modelo_marca` FOREIGN KEY (`marca_moto_id`) REFERENCES `marcas_moto` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modelo_tipo` FOREIGN KEY (`tipo_moto_id`) REFERENCES `tipos_moto` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  ADD CONSTRAINT `fk_movimiento_caso` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movimiento_parte` FOREIGN KEY (`parte_id`) REFERENCES `partes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_movimiento_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `partes`
--
ALTER TABLE `partes`
  ADD CONSTRAINT `fk_partes_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_partes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partes_created_by` FOREIGN KEY (`created_by`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_partes_fabricante` FOREIGN KEY (`fabricante_repuesto_id`) REFERENCES `fabricante_repuesto` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pendientes`
--
ALTER TABLE `pendientes`
  ADD CONSTRAINT `pendientes_ibfk_1` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_2` FOREIGN KEY (`caso_origen_id`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_3` FOREIGN KEY (`caso_resuelto_id`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `pendientes_ibfk_4` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  ADD CONSTRAINT `sesiones_trabajo_ibfk_1` FOREIGN KEY (`caso_id`) REFERENCES `casos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sesiones_trabajo_ibfk_2` FOREIGN KEY (`mecanico_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk_vehiculo_modelo` FOREIGN KEY (`modelo_moto_id`) REFERENCES `modelos_moto` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
