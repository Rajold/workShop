-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2026 at 02:09 AM
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
(22, 2, 9, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(23, 2, 8, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(24, 2, 11, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(25, 2, 10, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(26, 2, 12, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(27, 2, 5, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(28, 2, 1, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(29, 2, 3, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(30, 2, 7, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
(31, 2, 6, '2026-07-22 04:02:22', '2026-07-22 04:02:22'),
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
(46, 14, 20, '2026-07-24 15:24:02', '2026-07-24 15:24:02');

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
(46, 12, 4, 'Se fue por fin.', 'Repuesto', 0, '2025-11-01 01:02:32'),
(47, 12, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-01 01:02:44'),
(48, 13, 4, 'Batería se puso a cargar pero no mantiene carga.', 'Repuesto', 0, '2025-11-01 16:22:48'),
(49, 13, 4, 'Ajuste de válvulas, cambio de oRings tapas de válvulas.', 'Repuesto', 0, '2025-11-01 17:06:44'),
(50, 13, 4, 'Cambio de cadena, cambio de llanta y neumàtico, cambio de bandas.\r\nPendiente empaque tapa y cambio de retenes volante.', 'Repuesto', 0, '2025-11-02 00:41:30'),
(51, 12, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-04 13:42:26'),
(52, 17, 4, 'Se cambia el mando por el de segunda, el soporte del botón start está rota pero aún así funciona sin problemas.', 'Repuesto', 0, '2025-11-04 21:35:01'),
(53, 18, 4, 'Bomba no se escucha, Comprobar voltages hacia la bomba', 'Repuesto', 0, '2025-11-04 23:07:07'),
(54, 18, 4, 'La bomba está alimentada correctamente, Desmontar la bomba para revisión', 'Repuesto', 0, '2025-11-04 23:07:41'),
(55, 18, 4, 'Bomba atascada con suciedad y gasolina envejecida, limbiar y despegar.\r\nLa bomba ahora funciona correctamente pero sale combustible negro', 'Repuesto', 0, '2025-11-04 23:08:48'),
(56, 18, 4, 'Limpieza de conductos y montaje.\r\nMoto enciende correctamente, re armar y probar.', 'Repuesto', 0, '2025-11-04 23:09:40'),
(57, 18, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-04 23:09:48'),
(58, 19, 4, 'Cambiar escobillas y hacer mantenimiento.', 'Repuesto', 0, '2025-11-05 15:06:31'),
(59, 19, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-05 15:06:37'),
(60, 21, 4, 'Pendiente a hacer mantenimiento general.', 'Repuesto', 0, '2025-11-05 15:55:35'),
(61, 20, 4, 'Rearmar mando derecho, limar imperfecciones en la base del carburador.', 'Repuesto', 0, '2025-11-05 19:55:12'),
(62, 20, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-05 19:55:19'),
(63, 22, 4, 'Baterìa en carga.', 'Repuesto', 0, '2025-11-05 20:04:06'),
(64, 22, 4, 'Pedal de arranque se queda abajo. A desmontar!', 'Repuesto', 0, '2025-11-05 20:12:31'),
(65, 22, 4, 'Ajuste de vàlvulas', 'Repuesto', 0, '2025-11-06 19:03:33'),
(66, 22, 4, 'Vàlvulas fuera de ajuste, Cortina y aguja de carburador dañados.', 'Repuesto', 0, '2025-11-06 20:13:51'),
(67, 22, 4, 'Pendiente a cambio de empaque de culatìn.', 'Repuesto', 0, '2025-11-06 20:14:12'),
(68, 23, 4, 'Cambio de bobina de carga y luces.\r\ncambio regulador.\r\ncambio de batería.\r\nOrganizar cableado.', 'Repuesto', 0, '2025-11-07 14:21:19'),
(69, 23, 4, 'Buscar rodamiento que falta.', 'Repuesto', 0, '2025-11-07 15:16:33'),
(70, 23, 4, 'Rodamiento 36000', 'Repuesto', 0, '2025-11-07 15:16:46'),
(71, 22, 4, 'cadenilla sedida, guías gastadas.\r\nVariador dañado, se debe cambiar.', 'Repuesto', 0, '2025-11-07 22:25:40'),
(72, 22, 4, 'Cambio de pastilla de freno trasero.', 'Repuesto', 0, '2025-11-10 19:35:46'),
(73, 23, 4, 'Aplicar removedor de pintura a las carcazas centrales.', 'Repuesto', 0, '2025-11-10 19:36:53'),
(74, 24, 4, 'Cambio de terminales de bobinas de carga y luces.\r\nDiafragma perforado.', 'Repuesto', 0, '2025-11-11 16:14:07'),
(75, 24, 4, 'Aplicado t7000 al diafragma para tapar perforación.', 'Repuesto', 0, '2025-11-11 16:31:04'),
(76, 21, 4, 'Freno trasero grita.\r\nFreno delantero se atasca.', 'Repuesto', 0, '2025-11-11 16:32:05'),
(77, 21, 4, 'Mantenimientp freno delantero .', 'Repuesto', 0, '2025-11-12 14:54:03'),
(78, 21, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-12 14:54:10'),
(79, 22, 4, 'desarmar cabeza de fuerza para cambio de cadena y guías', 'Repuesto', 0, '2025-11-12 14:55:07'),
(80, 25, 4, 'Guaya de ascelerador dañada, Diafragma de carburador en mal estado.', 'Repuesto', 0, '2025-11-12 16:11:23'),
(81, 25, 4, 'Se Cambia la guaya de ascelerador\r\nreparar diafragma\r\ndesmontar carburador para mantenimiento\r\nfiltro de gasolina\r\narmado y ajuste de carburador', 'Repuesto', 0, '2025-11-13 00:05:38'),
(82, 25, 4, 'no Hay luces', 'Repuesto', 0, '2025-11-13 14:51:05'),
(83, 25, 4, 'Corrección de cableado en unidad de control de luces y cambio de bombillo.', 'Repuesto', 0, '2025-11-13 15:28:58'),
(84, 25, 4, 'cambio bombillo Stop', 'Repuesto', 0, '2025-11-13 15:37:04'),
(85, 26, 4, 'Rodamientos 6004-6202-6202', 'Repuesto', 0, '2025-11-13 17:13:12'),
(86, 26, 4, 'Cambio de rodamientos rueda delantela 6202, 6202\r\nPendiente autorización para cambiar pastillas.', 'Repuesto', 0, '2025-11-13 20:13:07'),
(87, 26, 4, 'pastillas no autorizadas. Nota: Disco de freno está torcido.', 'Repuesto', 0, '2025-11-13 20:39:40'),
(88, 25, 4, 'Abrir tapa cluth para revisar resorte de crank', 'Repuesto', 0, '2025-11-13 20:40:23'),
(89, 25, 4, 'resorte de crank roto.', 'Repuesto', 0, '2025-11-13 21:18:20'),
(90, 25, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-14 15:44:52'),
(91, 27, 4, 'Motor desmontado', 'Repuesto', 0, '2025-11-14 17:26:04'),
(92, 28, 4, '🆕 Caso creado a partir del caso anterior #20', 'Repuesto', 0, '2025-11-14 21:15:41'),
(93, 28, 4, 'Cambiar guaya de embrague.', 'Repuesto', 0, '2025-11-14 21:16:07'),
(94, 27, 4, 'motor desarmado.', 'Repuesto', 0, '2025-11-14 21:45:09'),
(95, 27, 4, 'hacer rosca para tapón de aceite', 'Repuesto', 0, '2025-11-15 19:14:15'),
(96, 27, 4, 'Pista de rodamiento de cigüeñal gastada, se lleva para rectificadora', 'Repuesto', 0, '2025-11-15 22:24:15'),
(97, 30, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2025-11-17 19:09:09'),
(98, 27, 4, 'Cambio de barras, pendiente poner aceite.', 'Repuesto', 0, '2025-11-19 00:09:17'),
(99, 27, 4, 'Cargar aceite en la suspensión delantera.', 'Repuesto', 0, '2025-11-27 15:00:58'),
(100, 27, 4, 'Terminar de cerrar motor.', 'Repuesto', 0, '2025-11-27 15:01:36'),
(101, 27, 4, 'Motor no enciende o se apaga después de un rato. Se pierde la corriente.', 'Repuesto', 0, '2025-11-27 15:02:06'),
(102, 27, 4, 'falla de encendido:\r\nCdi bien.', 'Repuesto', 0, '2025-11-28 21:41:07'),
(103, 31, 4, 'Se relaminó escape con acero inoxidable.\r\nAutomático nuevo.\r\nSe sugiere cambiar la batería.', 'Repuesto', 0, '2026-02-06 15:21:49'),
(104, 29, 4, 'Revisar:\r\nDiscos embrague\r\nBarras\r\nLuz tablero\r\nCambiar Manzana\r\nBandas Pastillas Aceite\r\nRuido motor', 'Repuesto', 0, '2026-02-09 14:30:08'),
(105, 29, 4, 'manzana agotada en el mercado.', 'Repuesto', 0, '2026-02-10 22:22:07'),
(106, 32, 4, 'Listo.', 'Repuesto', 0, '2026-02-10 22:23:55'),
(107, 33, 4, 'Listo', 'Repuesto', 0, '2026-02-20 21:16:50'),
(108, 31, 4, 'Cambio manzana trasera.', 'Repuesto', 0, '2026-02-20 21:17:52'),
(109, 34, 4, 'Fresado de prensa', 'Repuesto', 0, '2026-02-24 18:57:41'),
(110, 33, 4, 'Fabricación Bujes Manubrio', 'Repuesto', 0, '2026-03-07 21:42:51'),
(111, 33, 4, 'Arandelas de caucho para manubrio.', 'Repuesto', 0, '2026-03-07 21:43:17'),
(112, 33, 4, 'Instalación cubiertas de manubrio.', 'Repuesto', 0, '2026-03-07 21:43:37'),
(113, 33, 4, 'Tapizado de cojín.', 'Repuesto', 0, '2026-03-07 21:44:24'),
(114, 33, 4, 'reconstrucción tapa aleta lateral izquierda.', 'Repuesto', 0, '2026-03-07 21:45:04'),
(115, 35, 4, 'Biela, Empaquetadura, eje salida, eje cambios 180200.', 'Repuesto', 0, '2026-03-12 14:57:26'),
(116, 37, 4, 'Cadenilla 94\r\nguías cadenilla\r\nempaquetadura completa\r\nsellos válvula\r\nguías válvula\r\ndisco árbol\r\nválvulas', 'Repuesto', 0, '2026-03-14 20:03:49'),
(117, 39, 4, 'Instalar portaPlaca. 15\r\nCambiar Direccionales. 50\r\nCambia stop. 30\r\nCambio de bomba de freno. 55\r\nInstalar espejos. 15\r\nMantenimiento mandos 25\r\nInstalar posapies traseros 30\r\nInstalar cauchos posapies delanteros 15\r\nConectar luz piloto 8', 'Repuesto', 0, '2026-04-01 15:50:30'),
(118, 39, 4, 'bateria 81', 'Repuesto', 0, '2026-04-01 15:53:17'),
(120, 42, 4, 'cambio de empaquetadura.\r\nCambio termostato.\r\nCambio refrigerante.', 'Repuesto', 0, '2026-04-11 21:46:29'),
(122, 43, 4, 'Motor sin aceite, trabajó en seco.\r\nVálvulas ajustadas.\r\nSwitch requiere recontrucción.\r\nReconstruir o cambiar ramal eléctrico.\r\nRueda suelta.', 'Repuesto', 0, '2026-04-16 16:43:24'),
(123, 43, 4, 'Se ajustaron válvulas, motorn encendió con ruidos de desgaste.', 'Repuesto', 0, '2026-04-16 16:44:00'),
(124, 44, 4, 'Reconstruir bomba de aceite (kit retenes).\r\nponer aceite 2T.\r\nponer switch.\r\nAjustar cunas de dirección.\r\nMotor se apaga en bajas RPM. \r\nCarburador suelto Abrazaderas de carburador.', 'Repuesto', 0, '2026-04-18 22:02:00'),
(125, 45, 4, 'Tornillos de Bendix de arranque partidos.', 'Repuesto', 0, '2026-04-18 22:04:05'),
(126, 45, 4, 'Palanca de cambios sin estría.', 'Repuesto', 0, '2026-04-18 22:04:48'),
(127, 46, 4, 'Switch en mal estado, se hizo mantenimiento.', 'Repuesto', 0, '2026-04-20 14:24:56'),
(128, 46, 4, 'Se sacó tornillo roto en una de las botellas.', 'Repuesto', 0, '2026-04-20 14:25:44'),
(129, 42, 4, 'Se desmontó motor para cambiar junta de culata quemada. (El refrigerante estaba pasando hacia el cilindro).', 'Repuesto', 0, '2026-04-20 14:29:39'),
(130, 42, 4, 'Desmontar radiador y cabeza de lucer para reparación por choque.', 'Repuesto', 0, '2026-04-20 14:30:30'),
(131, 47, 4, 'Ajustar válvulas. \r\nRecablear bobina de pulsos.', 'Repuesto', 0, '2026-04-20 14:41:21'),
(132, 44, 4, 'Fabricar acople sistema yeis.', 'Repuesto', 0, '2026-04-20 16:21:03'),
(133, 44, 4, 'Guaya acelerador.', 'Repuesto', 0, '2026-04-22 16:08:46'),
(134, 45, 4, 'Bombillo led 32.\r\nsocket H4 8.\r\nsockets y pines 16.\r\ntermo encogible 6\r\ncable 8\r\nempaque volante 6\r\ntornillos 4.2', 'Repuesto', 0, '2026-04-23 22:16:15'),
(135, 33, 4, 'cambio amortiguadore 125\r\nretenedores 18\r\narranque falla al girar el manubrio.', 'Repuesto', 0, '2026-04-25 20:08:16'),
(136, 33, 4, 'Juego retenedores tapa volante y ejes. 22', 'Repuesto', 0, '2026-04-25 20:30:51'),
(137, 6, 4, 'Ajuste de válvulas.\r\nCambio manguera carburador.\r\nAjuste de carburador.', 'Repuesto', 0, '2026-04-28 14:19:43'),
(138, 7, 4, 'Recablear direccionales y stop.\r\ncambiar manzana.\r\ncambiar eje trasero.', 'Repuesto', 0, '2026-05-02 22:55:02'),
(139, 44, 4, 'Cablear Run.\r\nCablear pera neutro.\r\nRecablear Luces de tablero.\r\nAjuste de rueda y guardacadena.\r\ncambio de filtro de aire.\r\nhacer cabezas de guaya de acelerador y bomba.\r\nMontar guaya revoluciones.\r\nAbrir tapa cluth, instalar piñón de revoluciones.\r\nDireccional delantera derecha recablear.\r\nCambiar terminales sockets.', 'Repuesto', 0, '2026-05-05 18:20:41'),
(140, 44, 4, 'Instalar portaPlaca.', 'Repuesto', 0, '2026-05-05 18:20:59'),
(141, 49, 4, 'barra rayadas y torcidas.', 'Repuesto', 0, '2026-05-05 18:25:45'),
(142, 50, 4, 'cambiar tapas cola.\r\nCambiar manigueta.\r\nBombillo stop.\r\nLubricar guayas.\r\nInstalar portaplaca.\r\nCambiar guaya de cojín.\r\nInstalar base posapié izquierda.\r\nCambiar posapiés delanteros.\r\nEnderezar manubrio.', 'Repuesto', 0, '2026-05-08 19:38:34'),
(143, 51, 4, 'Instalar portaplaca.\r\nInstalar stop.\r\nInstalar direccionales.\r\nInstalar cabeza de luz.\r\nInstalar tablero.\r\nCambiar batería.\r\nSincronizar.\r\nReparar cableado.', 'Repuesto', 0, '2026-05-08 19:41:16'),
(144, 51, 4, 'No apaga, cableado roto.\r\nArranque no funciona, Cableado faltante.\r\nIndicador de marchas no funciona, cambio de sensor.\r\nCambiar bomba de freno.\r\nCambiar base y manigueta de embrague.', 'Repuesto', 0, '2026-05-13 18:43:51'),
(145, 52, 4, 'Reparación de motor.', 'Repuesto', 0, '2026-05-25 18:12:03'),
(146, 53, 4, 'Ajuste de válvulas.\r\nEnrutado guaya de embrague.\r\nColocación correcta mando izquierdo y manigueta de embrague.\r\nAjuste de mezcla en carburador.', 'Repuesto', 0, '2026-05-25 19:53:29'),
(147, 7, 4, 'Cambio de caja y reparación de motor (no árbol de levas ni balancines).', 'Repuesto', 0, '2026-06-03 13:04:24'),
(148, 55, 4, 'Instalar tablero digital.\r\nreparar ramal eléctrico.\r\najustar válvulas y carburador.\r\ncambiar mando.', 'Repuesto', 0, '2026-06-16 21:16:51'),
(149, 55, 4, 'cambio de terminales.\r\nCambio de automático.', 'Repuesto', 0, '2026-06-17 14:32:17'),
(150, 55, 4, '✅ Caso cerrado por el mecánico.', 'Repuesto', 0, '2026-06-17 14:32:31'),
(151, 37, 4, 'Moto continua tirando humo cuando el escape se calienta, el nivel de aceite de motor no ha bajado.\r\nBatería no carga.', 'Repuesto', 0, '2026-06-17 14:34:14'),
(152, 37, 4, 'Cambio de regulador.\r\nCorrecciones de cableado ahogador automático.\r\nCambio líquido de freno.', 'Repuesto', 0, '2026-06-18 15:24:20'),
(154, 58, 4, 'Tuerca y arandelas de presión primer embrague.', 'Repuesto', 22000, '2026-06-22 21:08:59'),
(162, 60, 4, 'testa\r\nCambio de refrigerante.\r\nCambio tren de arrastre.\r\nAjuste manillar.\r\nMantenimiento mando izquierdo. \r\nAjuste agarraderas pasajero.\r\nCambio de aceite.\r\nCambio filtro aceite.\r\nCambio empaque tapa rotor.\r\nBalanceo rueda trasera.', 'Mano de obra', 120000, '2026-07-03 04:57:33'),
(166, 33, 4, 'Alinear manubrio', 'Mano de obra', 35000, '2026-07-03 06:48:11'),
(167, 33, 4, 'tornillería', 'Repuesto', 3200, '2026-07-03 06:48:42'),
(168, 61, 4, 'Instalar posapié derecho.\nInstalar pedal de freno y resorte.\nInstalación carburador nuevo.', 'Mano de obra', 30000, '2026-07-04 00:28:19'),
(169, 61, 4, 'Tornillo posapié.\r\nResorte pedal freno.', 'Repuesto', 5000, '2026-07-04 00:28:47'),
(170, 61, 4, 'Reparar cableado corona de bobinas y pulsora. 20\r\nReconexión switch. 5\r\nCambio de bandas. 10\r\nMantenimiento tapa depósito combustible. 10\r\nAjuste de válvulas. 15\r\nInstalación placa. 5\r\nMantenimiento de mandos. 15', 'Mano de obra', 80000, '2026-07-04 00:32:34'),
(172, 62, 4, 'Ajuste de válvulas.', 'Mano de obra', 15000, '2026-07-04 15:38:24'),
(173, 4, 4, 'Ajuste de válvulas.\r\nAjuste de tensor cadena levas.\r\nCambio de mirilla de nivél de aceite.', 'Mano de obra', 20000, '2026-07-04 15:41:29'),
(174, 63, 4, 'Reconstruir sistema arranque eléctrico.', 'Mano de obra', 40000, '2026-07-04 23:26:30'),
(175, 63, 4, 'ajustar válvulas.', 'Mano de obra', 15000, '2026-07-04 23:26:49'),
(176, 63, 4, 'bombillos stop y direccional.', 'Repuesto', 2000, '2026-07-04 23:27:25'),
(177, 63, 4, 'Reparar pera freno delantero', 'Mano de obra', 5000, '2026-07-04 23:27:47'),
(178, 63, 4, 'Mantenimiento mando izquierdo.', 'Mano de obra', 10000, '2026-07-04 23:28:18'),
(179, 64, 4, 'Cambio pedal de cambios.', 'Mano de obra', 5000, '2026-07-04 23:45:20'),
(180, 64, 4, 'Instalar guaya velocímetro.', 'Mano de obra', 5000, '2026-07-04 23:46:11'),
(181, 64, 4, 'Reconstruir cableado.', 'Mano de obra', 30000, '2026-07-04 23:46:58'),
(182, 64, 4, 'Ajuste de válvulas.', 'Mano de obra', 15000, '2026-07-04 23:47:25'),
(183, 64, 4, 'Fabricr guaya de sillín.', 'Mano de obra', 10000, '2026-07-04 23:47:58'),
(184, 64, 4, 'Cambiar filtro de aire.', 'Mano de obra', 5000, '2026-07-04 23:48:16'),
(185, 64, 4, 'MAntenimiento mando izquierdo.', 'Mano de obra', 15000, '2026-07-04 23:48:53'),
(186, 62, 4, 'Instalar tapas frontal, tapa faro, direccionales y Switch de arranque.', 'Mano de obra', 20000, '2026-07-04 23:55:31'),
(187, 62, 4, 'Mantenimiento mando izquierdo.', 'Mano de obra', 15000, '2026-07-04 23:57:07'),
(188, 62, 4, 'Cambio de aceite.', 'Mano de obra', 5000, '2026-07-04 23:57:58'),
(189, 63, 4, 'Cambio de aceite.', 'Mano de obra', 5000, '2026-07-04 23:58:23'),
(190, 61, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-05 00:00:08'),
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
(219, 32, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 04:00:35'),
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
(234, 66, 4, 'Limpieza filtro de aire y carburador.', 'Mano de obra', 30000, '2026-07-06 18:39:42'),
(235, 67, 4, 'O-ring Tapón aceite.', 'Repuesto', 3000, '2026-07-06 19:49:33'),
(236, 67, 4, 'Ajuste de válvulas', 'Mano de obra', 15000, '2026-07-06 20:06:43'),
(237, 68, 4, 'Cambio guaya de embrague.', 'Mano de obra', 5000, '2026-07-06 21:21:07'),
(238, 68, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 21:21:19'),
(239, 68, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-06 21:21:47'),
(240, 69, 4, '🆕 Caso creado a partir del caso anterior #6', 'Mano de obra', 0, '2026-07-06 23:11:42'),
(241, 69, 4, 'completar aceite.', 'Mano de obra', 0, '2026-07-06 23:12:20'),
(242, 67, 4, 'cambio escobillas y ajustes.', 'Mano de obra', 30000, '2026-07-07 00:25:57'),
(243, 67, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 00:35:29'),
(244, 70, 3, '🆕 Caso creado a partir del caso anterior #16', 'Mano de obra', 0, '2026-07-07 02:31:28'),
(245, 70, 3, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 02:32:37'),
(246, 73, 4, 'Reparar motor. (no se cambian árbol de levas ni balancines).\r\nCaja dañada, cambiar completa.', 'Mano de obra', 300000, '2026-07-07 15:28:27'),
(247, 73, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 15:28:48'),
(248, 74, 4, '🆕 Caso creado a partir del caso anterior #73', 'Mano de obra', 0, '2026-07-07 15:31:38'),
(249, 74, 4, 'Automático dañado dañó estrías del eje de cigüeñal, Cambiar arandelas de ajuste. \r\nSe recomienda cambiar automático por desgaste.', 'Mano de obra', 0, '2026-07-07 15:33:30'),
(250, 76, 4, 'Ajuste de válvulas.', 'Mano de obra', 20000, '2026-07-07 16:32:59'),
(251, 76, 4, 'Cambio de choque eléctrico.', 'Mano de obra', 10000, '2026-07-07 16:51:01'),
(252, 76, 4, 'Mantenimiento carburador.\r\nCambio kit surtidores y diafragma.*\r\nReparación cubera rota remendada.', 'Mano de obra', 40000, '2026-07-07 18:14:49'),
(253, 75, 4, 'Limpieza y ajuste de carburador.', 'Mano de obra', 30000, '2026-07-07 18:49:38'),
(254, 75, 4, 'Cambio de terminales de choque y bobina de pulsos.', 'Repuesto', 15000, '2026-07-07 18:50:28'),
(255, 64, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 19:43:38'),
(256, 75, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 20:05:38'),
(257, 76, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 20:54:39'),
(258, 66, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 22:27:45'),
(259, 69, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 22:28:07'),
(260, 74, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-07 22:28:54'),
(261, 72, 3, 'Recibido, pendiente llevar al taller.', 'Mano de obra', 0, '2026-07-08 05:19:30'),
(262, 58, 4, 'Reflectores laterales.', 'Repuesto', 16000, '2026-07-08 14:23:09'),
(263, 58, 4, 'Espejos.', 'Repuesto', 22000, '2026-07-08 14:23:26'),
(264, 58, 4, 'Gasolina.', 'Repuesto', 10000, '2026-07-08 14:23:40'),
(265, 58, 4, 'Direccionales delanteros.', 'Repuesto', 16000, '2026-07-08 14:24:36'),
(266, 58, 4, 'Bombillo faro delantero.', 'Repuesto', 5000, '2026-07-08 14:25:20'),
(267, 78, 4, '🆕 Caso creado a partir del caso anterior #13', 'Mano de obra', 0, '2026-07-08 14:41:39'),
(268, 78, 4, 'Enderezar pedal de freno.', 'Mano de obra', 5000, '2026-07-08 14:42:08'),
(269, 78, 4, 'Cambio de aceite.', 'Mano de obra', 3000, '2026-07-08 14:42:26'),
(270, 78, 4, 'Cambio o-rings crburador.\r\nAlinear pedal freno.', 'Mano de obra', 27000, '2026-07-08 22:02:45'),
(271, 78, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-08 22:06:48'),
(272, 58, 4, 'Terminal redondo hembra.', 'Repuesto', 500, '2026-07-08 22:07:35'),
(273, 58, 4, 'Terminal redondo macho.', 'Repuesto', 500, '2026-07-08 22:15:40'),
(274, 58, 4, 'Batería.', 'Repuesto', 45000, '2026-07-08 22:16:07'),
(275, 63, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-09 14:14:09'),
(276, 62, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-09 14:14:23'),
(277, 79, 4, '🆕 Caso creado a partir del caso anterior #37', 'Mano de obra', 0, '2026-07-09 15:15:45'),
(278, 79, 4, 'Cambio de aceite.\r\nInstalación gato lateral.', 'Mano de obra', 10000, '2026-07-09 15:46:47'),
(279, 79, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-09 15:47:01'),
(280, 80, 4, 'Cargar batría.', 'Mano de obra', 7000, '2026-07-09 18:20:07'),
(281, 80, 4, 'Reparar terminal negativo de batería.\r\nCambio de terminal negativo cable masa.', 'Mano de obra', 13000, '2026-07-09 18:21:15'),
(282, 80, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-09 18:21:28'),
(283, 81, 4, 'Cambio de guaya.', 'Mano de obra', 0, '2026-07-09 19:57:28'),
(284, 81, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-09 19:57:39'),
(285, 58, 4, 'Bombillos de tablero 4', 'Repuesto', 3000, '2026-07-09 22:03:52'),
(286, 58, 4, 'Corrección de cableado.', 'Mano de obra', 30000, '2026-07-09 22:04:30'),
(287, 58, 4, 'Mantenimiento mando izquierdo.', 'Mano de obra', 30000, '2026-07-09 22:04:59'),
(288, 84, 4, '🆕 Caso creado a partir del caso anterior #49', 'Mano de obra', 0, '2026-07-10 15:22:15'),
(289, 85, 4, 'Ajuste cunas de dirección.', 'Mano de obra', 9000, '2026-07-10 17:45:51'),
(290, 77, 4, '3 Bujes para tornillo.', 'Repuesto', 3000, '2026-07-10 17:46:49'),
(291, 77, 4, 'Cambio de cunas.', 'Mano de obra', 60000, '2026-07-10 21:09:12'),
(292, 77, 4, 'Ajuste apertura deposito combustible.', 'Mano de obra', 10000, '2026-07-10 21:09:47'),
(293, 84, 4, 'Enderezar manigueta freno.', 'Mano de obra', 3000, '2026-07-11 00:30:19'),
(294, 84, 4, 'Calentar y enderezar guardabarror.', 'Mano de obra', 10000, '2026-07-11 00:34:25'),
(295, 84, 4, 'Mantenimiento pinza de freno.', 'Mano de obra', 20000, '2026-07-11 00:35:02'),
(296, 83, 4, 'Ajuste de válvulas.', 'Mano de obra', 15000, '2026-07-11 01:34:52'),
(297, 83, 4, 'Ajuste carburador.', 'Mano de obra', 30000, '2026-07-11 01:35:12'),
(298, 83, 4, 'Buje.', 'Repuesto', 3000, '2026-07-11 01:35:38'),
(299, 83, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-11 14:01:26'),
(300, 85, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-11 14:04:32'),
(301, 84, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-11 14:06:04'),
(302, 77, 4, '✅ Caso cerrado por el mecánico.', 'Mano de obra', 0, '2026-07-11 15:02:54'),
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
(331, 94, 3, 'Nivelar aceite, kilometraje 44711', 'Mano de obra', 0, '2026-07-17 23:12:50'),
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
(374, 112, 3, 'Ingreso- Difícil de encender, Se ahoga.', 'Mano de obra', 0, '2026-07-24 21:27:14');

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
(17, 20, 4, '2025-11-04', '16:33:34', 'Cambiar mando derecho por mando de segunda, el mando de cambio tiene defecto en base de botón start.', NULL, NULL, 'cerrado', '2026-07-05 22:57:13', NULL, 0, 0, 0.00),
(18, 21, 4, '2025-11-04', '18:06:00', 'Un mes en patios ahora no enciende', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(19, 22, 4, '2025-11-05', '09:28:42', 'No da arranque', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(20, 23, 4, '2025-11-05', '10:20:07', 'Mando derecho abierto, Acelerador no funciona.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(21, 24, 4, '2025-11-05', '10:47:13', 'Cambio de baterìa.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(22, 25, 4, '2025-11-05', '14:56:47', 'No enciende y si llega a hacerlo se ahoga, se recibe sin cubiertas de parte frontal.', NULL, NULL, 'cerrado', '2026-07-05 22:57:40', NULL, 0, 0, 0.00),
(23, 26, 4, '2025-11-07', '09:20:06', 'Ajustar sistema eléctrico a 12v.', NULL, NULL, 'cerrado', '2026-07-05 22:57:55', NULL, 0, 0, 0.00),
(24, 27, 4, '2025-11-11', '11:13:32', 'Descarga la batería, se ahoga', NULL, NULL, 'cerrado', '2026-07-05 22:58:13', NULL, 0, 0, 0.00),
(25, 28, 4, '2025-11-12', '11:10:46', 'Se ahoga, Motor ascelerado, Alto consumo.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(26, 29, 4, '2025-11-13', '11:46:52', 'Rodamientos rueda trasera', NULL, NULL, 'cerrado', '2026-07-05 22:58:31', NULL, 0, 0, 0.00),
(27, 30, 4, '2025-11-14', '10:46:16', 'Motor trabajó sin aceite, suema mal, desmontar para revisar.', NULL, NULL, 'cerrado', '2026-07-05 22:58:52', NULL, 0, 0, 0.00),
(28, 23, 4, '2025-11-14', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #20', '', 'cerrado', '2026-07-05 23:01:48', NULL, 0, 0, 0.00),
(29, 31, 4, '2025-11-15', '09:10:46', 'Cambiar Guardabarro delantero, cambio de aceite, Cambiar Palanca de cambios.', NULL, NULL, 'cerrado', '2026-07-05 22:59:54', NULL, 0, 0, 0.00),
(30, 32, 4, '2025-11-15', '18:29:58', 'Cambio de batería', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(31, 33, 4, '2026-02-06', '10:20:38', 'Escape roto, cambio de automático, revisar sistema de carga.', NULL, NULL, 'cerrado', '2026-07-05 22:59:38', NULL, 0, 0, 0.00),
(32, 34, 4, '2026-02-10', '17:23:42', 'Cambiar bomba de freno delantero y espejos.', NULL, NULL, 'cerrado', '2026-07-05 23:00:35', NULL, 0, 0, 0.00),
(33, 35, 4, '2026-02-20', '16:16:35', 'cambio carcazar headLight.\r\nCambio bombillos Hl\r\nFabricar bujes manubrio\r\nFabricar amortiguadores manubrio\r\ntornillos y chapetas\r\nNivelar aceite', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(34, 36, 4, '2026-02-24', '13:57:28', 'Embrague duro, cambios golpean.', NULL, NULL, 'cerrado', '2026-07-05 23:01:18', NULL, 0, 0, 0.00),
(35, 37, 4, '2026-03-12', '09:56:26', 'Reparación completa de motor', NULL, NULL, 'cerrado', '2026-07-05 23:02:51', NULL, 0, 0, 0.00),
(36, 38, 4, '2026-03-12', '09:59:18', 'Motor de arranque lento. Enciende con Pedal, batería nueva.\r\nCambio de regulador y Cdi quemados.', NULL, NULL, 'cerrado', '2026-07-05 23:02:16', NULL, 0, 0, 0.00),
(37, 39, 4, '2026-03-12', '10:00:36', 'Motor frenado. Cadena de levas descarrilada.', NULL, NULL, 'cerrado', '2026-07-05 23:02:35', NULL, 0, 0, 0.00),
(38, 40, 4, '2026-03-29', '12:57:26', 'Pendiente tornillo brazo soporte escape', NULL, NULL, 'cerrado', '2026-07-05 23:03:05', NULL, 0, 0, 0.00),
(39, 41, 4, '2026-04-01', '09:26:36', 'Acondicionamiento', NULL, NULL, 'cerrado', '2026-07-05 23:03:20', NULL, 0, 0, 0.00),
(40, 42, 4, '2026-04-01', '09:36:45', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-05 23:03:40', NULL, 0, 0, 0.00),
(42, 44, 4, '2026-04-11', '16:45:55', 'Refrigerante pasa a cilindro.', NULL, NULL, 'cerrado', '2026-07-05 23:11:55', NULL, 0, 0, 0.00),
(43, 45, 4, '2026-04-16', '11:38:24', 'No enciende. Ramal dañado. Switch desarmado.', NULL, NULL, 'cerrado', '2026-07-05 23:12:24', NULL, 0, 0, 0.00),
(44, 46, 4, '2026-04-18', '16:58:09', 'encamisar pista de rueda trasera.', NULL, NULL, 'cerrado', '2026-07-05 22:46:42', NULL, 0, 0, 0.00),
(45, 47, 4, '2026-04-18', '17:03:26', 'Arranque se desliza.', NULL, NULL, 'cerrado', '2026-07-05 22:47:09', NULL, 0, 0, 0.00),
(46, 48, 4, '2026-04-18', '17:06:29', 'Se niega a encender.', NULL, NULL, 'cerrado', '2026-07-05 23:12:44', NULL, 0, 0, 0.00),
(47, 49, 4, '2026-04-20', '09:39:09', 'Se apaga o no enciende. \r\nCompresión baja.', NULL, NULL, 'cerrado', '2026-07-05 22:53:00', NULL, 0, 0, 0.00),
(48, 50, 4, '2026-04-24', '17:42:59', 'Posapiés Roto. (rehacer rosca).\r\nEmbrague agarrotado.\r\nFaro suelto.\r\nManubrio suelto. (rehacer rosca).\r\nPedal de cambios torcido.', NULL, NULL, 'cerrado', '2026-07-05 22:47:30', NULL, 0, 0, 0.00),
(49, 51, 4, '2026-05-05', '13:24:34', 'Barras soporte torcidos.', NULL, NULL, 'cerrado', '2026-07-05 23:13:03', NULL, 0, 0, 0.00),
(50, 52, 4, '2026-05-08', '14:35:43', 'Cambiar tapas', NULL, NULL, 'cerrado', '2026-07-05 22:48:26', NULL, 0, 0, 0.00),
(51, 53, 4, '2026-05-08', '14:39:32', 'Descuidada.', NULL, NULL, 'cerrado', '2026-07-05 22:48:43', NULL, 0, 0, 0.00),
(52, 54, 4, '2026-05-25', '13:11:49', 'Moto se recibe con motor desarmado en caja de cartón.', NULL, NULL, 'cerrado', '2026-07-05 23:13:27', NULL, 0, 0, 0.00),
(53, 55, 4, '2026-05-25', '13:13:23', 'Difícil encender, no se sostiene.', NULL, NULL, 'cerrado', '2026-07-05 22:23:33', NULL, 0, 0, 0.00),
(54, 56, 4, '2026-05-25', '14:54:36', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-05 22:52:48', NULL, 0, 0, 0.00),
(55, 57, 4, '2026-06-06', '15:54:32', 'No se sostiene, suena mal, ramal dañado, sin tablero.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(56, 58, 4, '2026-06-07', '11:44:21', 'No enciende en las mañanas.', NULL, NULL, 'cerrado', '2026-07-05 22:52:10', NULL, 0, 0, 0.00),
(57, 59, 4, '2026-06-14', '10:47:27', 'Enciende con dols luces rojas destellando rápidamente', NULL, NULL, 'cerrado', '2026-07-05 22:51:54', NULL, 0, 0, 0.00),
(58, 60, 4, '2026-06-22', '11:28:23', 'Motor suena mal. \r\nHacer Mantenimiento general.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(60, 62, 4, '2026-06-22', '16:15:29', 'Vibra cuando rápido.\r\nRueda trasera Pinchada.\r\nCambio tren de arrastre.\r\nAjustar Manillar.\r\nCambiar aceite.\r\nRevisar fuga de aceite.\r\nCambiar refrigerante.', NULL, NULL, 'cerrado', '2026-07-05 22:51:29', NULL, 120000, 0, 0.00),
(61, 63, 4, '2026-07-03', '19:26:45', 'Avandonada. \r\nRevisar.', NULL, NULL, 'cerrado', NULL, NULL, NULL, 0, 0.00),
(62, 64, 4, '2026-07-04', '10:37:54', 'Resurección.', NULL, NULL, 'cerrado', '2026-07-09 09:14:23', NULL, 55000, 0, 0.00),
(63, 65, 4, '2026-07-04', '18:26:09', 'No funciona arranque', NULL, NULL, 'cerrado', '2026-07-09 09:14:09', NULL, 77000, 0, 0.00),
(64, 66, 4, '2026-07-04', '18:44:38', 'Mantenimiento y correción de fallas.', NULL, NULL, 'cerrado', '2026-07-07 14:43:38', NULL, 85000, 0, 0.00),
(66, 68, 4, '2026-07-06', '12:40:27', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-07 17:27:45', NULL, 30000, 0, 0.00),
(67, 69, 4, '2026-07-06', '14:42:14', 'Ajustar cunas de dirección.\r\nAjuste de válvulas.\r\nSincronizar carburador.\r\nArranque eléctrico no funciona.', NULL, NULL, 'cerrado', '2026-07-06 19:35:29', NULL, 48000, 0, 0.00),
(68, 70, 4, '2026-07-06', '15:30:19', 'Guaya embrague rota.', NULL, NULL, 'cerrado', '2026-07-06 16:21:47', NULL, 5000, 0, 0.00),
(69, 9, 4, '2026-07-06', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #6', '', 'cerrado', '2026-07-07 17:28:07', NULL, 0, 0, 0.00),
(70, 19, 3, '2026-07-06', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #16', '', 'cerrado', '2026-07-06 21:32:37', NULL, 0, 0, 0.00),
(72, 72, 3, '2026-07-06', '22:18:22', 'Motor sin compresión, la falla va y viene.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(73, 73, 4, '2026-06-04', '10:22:50', 'Caso de Control.', NULL, NULL, 'cerrado', '2026-07-07 10:28:47', NULL, 300000, 0, 0.00),
(74, 73, 4, '2026-06-13', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #73', '', 'cerrado', '2026-07-07 17:28:54', NULL, 0, 0, 0.00),
(75, 74, 4, '2026-07-07', '10:44:06', 'No enciende.', NULL, NULL, 'cerrado', '2026-07-07 15:05:38', NULL, 45000, 0, 0.00),
(76, 75, 4, '2026-07-07', '10:46:52', 'Enciende pero se ahoga. No anda.', NULL, NULL, 'cerrado', '2026-07-07 15:54:39', NULL, 70000, 0, 0.00),
(77, 76, 4, '2026-07-07', '15:53:42', 'Frente suspención torcido. Hala hacia los lados y golpea cunas.', NULL, NULL, 'cerrado', '2026-07-11 10:02:54', NULL, 73000, 0, 0.00),
(78, 16, 4, '2026-07-08', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #13', '', 'cerrado', '2026-07-08 17:06:48', NULL, 35000, 0, 0.00),
(79, 39, 4, '2026-07-09', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #37', '', 'cerrado', '2026-07-09 10:47:01', NULL, 10000, 0, 0.00),
(80, 77, 4, '2026-07-09', '11:35:33', 'Batería descargada.', NULL, NULL, 'cerrado', '2026-07-09 13:21:27', NULL, 20000, 0, 0.00),
(81, 78, 4, '2026-07-09', '13:25:26', 'Cambiar guaya velocímetro.', NULL, NULL, 'cerrado', '2026-07-09 14:57:39', NULL, 0, 0, 0.00),
(82, 79, 4, '2026-07-09', '15:17:30', 'Quemado, rebobinar', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(83, 80, 4, '2026-07-10', '10:21:21', 'Se ahoga.', NULL, NULL, 'cerrado', '2026-07-11 09:01:25', NULL, 48000, 0, 0.00),
(84, 51, 4, '2026-07-10', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #49', '', 'cerrado', '2026-07-11 09:06:04', NULL, 33000, 0, 0.00),
(85, 81, 4, '2026-07-10', '11:41:33', 'Ajustar cunas de dirección.', NULL, NULL, 'cerrado', '2026-07-11 09:04:32', NULL, 9000, 0, 0.00),
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
(96, 89, 3, '2026-07-20', '14:52:23', 'Motor suena mal.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(100, 93, 3, '2026-07-21', '22:58:25', 'No funciona el arranque eléctrico, a veces pierde fuerza y tironea.', NULL, NULL, 'cerrado', '2026-07-22 14:54:17', NULL, 40400, 0, 0.00),
(101, 94, 3, '2026-07-22', '00:06:14', 'sdfghjkl5678', NULL, NULL, 'cerrado', '2026-07-22 01:00:29', NULL, 36000, 0, 0.00),
(102, 78, 3, '2026-07-22', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #81', '', 'cerrado', '2026-07-22 23:29:54', NULL, 30000, 0, 0.00),
(103, 95, 3, '2026-07-22', '19:35:59', 'Manzana rueda trasera se mueve.', NULL, NULL, 'cerrado', '2026-07-22 22:07:31', NULL, 40000, 0, 0.00),
(104, 78, 3, '2026-07-22', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #102', '', 'cerrado', '2026-07-23 00:28:52', NULL, 0, 0, 0.00),
(105, 69, 3, '2026-07-23', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #67', '', 'cerrado', '2026-07-23 09:50:53', NULL, 0, 0, 0.00),
(106, 96, 3, '2026-07-23', '10:24:12', 'No enciende. Arranque eléctrco no funciona.', NULL, NULL, 'cerrado', '2026-07-23 11:13:24', NULL, 7000, 0, 0.00),
(107, 97, 3, '2026-07-23', '12:01:21', 'Dirección dura.\r\nHala hacia un lado.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(108, 98, 3, '2026-07-23', '12:49:46', 'Sin freno trasero. Reventó varilla.', NULL, NULL, 'cerrado', '2026-07-23 13:22:27', NULL, 10000, 0, 0.00),
(109, 99, 3, '2026-07-23', '14:33:39', 'Ruido en el motor y fuga de aceite.', NULL, NULL, 'abierto', NULL, NULL, NULL, 0, 0.00),
(110, 100, 3, '2026-07-23', '14:55:17', 'Bloqueada en cuarta marcha.', NULL, NULL, 'cerrado', '2026-07-23 14:56:13', NULL, 0, 0, 0.00),
(111, 101, 3, '2026-07-24', '16:24:18', 'Reparar motor y reacondicionar para revisión.', NULL, NULL, 'cerrado', '2026-07-24 16:26:07', NULL, 0, 0, 0.00),
(112, 101, 3, '2026-07-24', NULL, 'Nuevo ingreso del vehículo', 'Relacionado con caso #111', '', 'abierto', NULL, NULL, NULL, 0, 0.00);

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
(10, 107, 14, 3, 1.00, 28000.00, 36000.00, 36000.00, '2026-07-24 15:27:48');

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
(11, 'Kawasaki', 'Let the good times roll!', 1, '2026-07-22 04:25:39', '2026-07-23 02:55:09');

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
(9, 'Tvs', 1, '2026-07-20 02:07:04', '2026-07-20 02:07:04');

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
(23, 8, 3, 'Xm', 180, 1, '2026-07-24 21:22:42', '2026-07-24 21:22:42');

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
(24, 14, 3, 107, 'consumo', 'Consumo durante reparación', 1.00, 0.00, 28000.00, 'Aplicado desde WorkShop', '2026-07-24 10:27:48');

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
(14, 'CunDir004', 16, 'repuesto', 'Cunas de dirección.', 'Honda', 8, '25K160S', 3, 'Unidad', 0.00, 0.00, 2.00, 28000.00, 36000.00, 'Vitrina', 'KCF7PKV4R2Z2', NULL, 1, '2026-07-24 10:06:45', '2026-07-24 10:27:48');

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
(4, 69, 105, NULL, 3, 'Instalar bombillo led.', 'pendiente', '2026-07-23 14:50:42', NULL),
(5, 98, 108, NULL, 3, 'La manzana paree estar ovalada, revisar cuando vuelva.', 'pendiente', '2026-07-23 18:22:17', NULL),
(6, 100, 110, NULL, 3, 'Se ajustó palanca de modo provicional. \r\nPendiente cambio de eje y pedal de marchas.', 'pendiente', '2026-07-23 19:56:04', NULL);

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
(90, 27, 4, '2025-11-28', '16:40:18', NULL, NULL, 0),
(91, 31, 4, '2026-02-06', '10:20:43', '2026-02-20', '16:17:55', 20877),
(92, 29, 4, '2026-02-09', '09:28:29', '2026-02-10', '17:22:12', 2274),
(93, 32, 4, '2026-02-10', '17:23:45', '2026-02-10', '17:23:57', 360),
(94, 33, 4, '2026-02-20', '16:16:43', '2026-03-07', '16:45:10', 21988),
(95, 34, 4, '2026-02-24', '13:57:30', NULL, NULL, 0),
(96, 35, 4, '2026-03-12', '09:56:33', NULL, NULL, 0),
(97, 37, 4, '2026-03-12', '10:00:40', NULL, NULL, 0),
(98, 39, 4, '2026-04-01', '09:26:43', NULL, NULL, 0),
(99, 40, 4, '2026-04-01', '09:36:50', NULL, NULL, 0),
(101, 42, 4, '2026-04-11', '16:45:58', '2026-04-20', '09:30:36', 12945),
(103, 43, 4, '2026-04-16', '11:38:28', NULL, NULL, 0),
(104, 44, 4, '2026-04-18', '16:58:13', NULL, NULL, 0),
(105, 45, 4, '2026-04-18', '17:03:29', NULL, NULL, 0),
(106, 46, 4, '2026-04-20', '09:24:31', '2026-04-20', '09:25:48', 421),
(107, 47, 4, '2026-04-20', '09:39:58', NULL, NULL, 0),
(108, 33, 4, '2026-04-25', '15:03:34', NULL, NULL, 0),
(109, 6, 4, '2026-04-28', '09:18:28', NULL, NULL, 0),
(110, 7, 4, '2026-05-02', '11:42:55', NULL, NULL, 0),
(111, 49, 4, '2026-05-05', '13:25:17', NULL, NULL, 0),
(112, 50, 4, '2026-05-08', '14:35:45', NULL, NULL, 0),
(113, 51, 4, '2026-05-08', '14:39:37', NULL, NULL, 0),
(114, 52, 4, '2026-05-25', '13:11:52', NULL, NULL, 0),
(115, 53, 4, '2026-05-25', '14:52:22', '2026-05-25', '14:53:33', 421),
(116, 55, 4, '2026-06-06', '15:54:38', '2026-06-17', '09:32:27', 15878),
(117, 58, 4, '2026-06-22', '11:28:29', '2026-07-08', '09:26:09', 23338),
(119, 60, 4, '2026-06-22', '16:15:32', NULL, NULL, 0),
(121, 61, 4, '2026-07-03', '19:26:51', '2026-07-04', '19:00:07', 1833),
(122, 62, 4, '2026-07-04', '10:37:59', '2026-07-09', '09:14:23', 7536),
(123, 4, 4, '2026-07-04', '10:40:37', NULL, NULL, 0),
(124, 63, 4, '2026-07-04', '18:26:17', '2026-07-09', '09:14:09', 7068),
(125, 64, 4, '2026-07-04', '18:44:41', '2026-07-07', '14:43:38', 4499),
(126, 66, 4, '2026-07-06', '12:40:35', '2026-07-06', '14:21:49', 521),
(127, 67, 4, '2026-07-06', '14:42:28', '2026-07-06', '19:35:29', 713),
(128, 68, 4, '2026-07-06', '16:20:33', '2026-07-06', '16:21:11', 421),
(129, 69, 4, '2026-07-06', '18:11:59', '2026-07-06', '18:12:25', 420),
(130, 73, 4, '2026-07-07', '10:26:46', '2026-07-07', '10:28:47', 422),
(131, 74, 4, '2026-07-07', '10:31:49', '2026-07-07', '10:33:34', 422),
(132, 74, 4, '2026-07-07', '10:35:40', '2026-07-07', '10:35:52', 420),
(133, 76, 4, '2026-07-07', '10:46:59', '2026-07-07', '15:54:31', 728),
(134, 75, 4, '2026-07-07', '13:47:19', '2026-07-07', '15:05:38', 498),
(135, 77, 4, '2026-07-07', '15:53:47', '2026-07-07', '17:27:01', 513),
(136, 74, 4, '2026-07-07', '17:28:37', '2026-07-07', '17:28:54', 420),
(137, 72, 3, '2026-07-08', '00:19:01', '2026-07-08', '00:19:36', 421),
(138, 78, 4, '2026-07-08', '09:41:47', '2026-07-08', '17:06:42', 865),
(139, 58, 4, '2026-07-08', '17:07:10', '2026-07-09', '10:50:08', 1483),
(140, 79, 4, '2026-07-09', '10:15:51', '2026-07-09', '10:47:01', 451),
(141, 80, 4, '2026-07-09', '11:35:47', '2026-07-09', '13:21:21', 526),
(142, 81, 4, '2026-07-09', '13:25:29', '2026-07-09', '14:57:39', 512),
(143, 58, 4, '2026-07-09', '17:03:20', NULL, NULL, 0),
(144, 83, 4, '2026-07-10', '10:21:25', '2026-07-11', '09:01:12', 1780),
(145, 84, 4, '2026-07-10', '10:22:21', '2026-07-11', '09:05:58', 1784),
(146, 85, 4, '2026-07-10', '12:45:22', '2026-07-11', '09:04:26', 1639),
(147, 77, 4, '2026-07-10', '12:46:23', '2026-07-11', '10:02:48', 1696),
(148, 86, 3, '2026-07-11', '15:18:17', '2026-07-11', '20:51:02', 753),
(149, 33, 3, '2026-07-13', '15:03:00', NULL, NULL, 0),
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
(165, 96, 3, '2026-07-22', '23:40:28', NULL, NULL, 0),
(166, 104, 3, '2026-07-23', '00:27:18', '2026-07-23', '00:28:52', 422),
(167, 105, 3, '2026-07-23', '09:50:16', '2026-07-23', '09:50:53', 421),
(168, 106, 3, '2026-07-23', '10:24:19', '2026-07-23', '11:13:24', 469),
(169, 107, 3, '2026-07-23', '12:01:28', NULL, NULL, 0),
(170, 108, 3, '2026-07-23', '13:20:41', '2026-07-23', '13:22:27', 422),
(171, 109, 3, '2026-07-23', '14:33:44', NULL, NULL, 0),
(172, 110, 3, '2026-07-23', '14:55:25', '2026-07-23', '14:56:13', 421),
(173, 111, 3, '2026-07-24', '16:24:28', '2026-07-24', '16:26:07', 422),
(174, 112, 3, '2026-07-24', '16:26:20', NULL, NULL, 0);

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
(7, 'Sport', 1, '2026-07-20 02:48:06', '2026-07-20 02:48:06');

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
(7, 'NQS51A', 'Suzuki', 'GN125h', NULL, 'Red', 'Arnulfo Pintor', NULL),
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
(31, 'IWO76E', 'Yamaha', 'Xtz125', NULL, 'Azul', 'William', NULL),
(32, 'KKH08C', 'Yamaha', 'Cripton 115', NULL, 'Negro', 'Miguel Malavides', NULL),
(33, 'HDT38B', 'Honda', 'WaveC100', NULL, 'Negro', 'crazyPeople', NULL),
(34, 'BIC26B', 'Akt', 'Special', NULL, 'Negro', 'Dañada Clavijo', NULL),
(35, 'BIC26C', 'Akt', 'Special110', NULL, 'Negro', 'Oona', NULL),
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
(101, 'PUA24C', 'Akt', 'Xm 180', 23, 'Azul', 'Alexander Casas', '3212004951');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `avances`
--
ALTER TABLE `avances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `caso_repuestos`
--
ALTER TABLE `caso_repuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categorias_partes`
--
ALTER TABLE `categorias_partes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `fabricante_repuesto`
--
ALTER TABLE `fabricante_repuesto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `marcas_moto`
--
ALTER TABLE `marcas_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `modelos_moto`
--
ALTER TABLE `modelos_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `movimientos_inventario`
--
ALTER TABLE `movimientos_inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `partes`
--
ALTER TABLE `partes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendientes`
--
ALTER TABLE `pendientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sesiones_trabajo`
--
ALTER TABLE `sesiones_trabajo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `tipos_moto`
--
ALTER TABLE `tipos_moto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
