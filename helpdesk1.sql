-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk1`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrativos`
--

CREATE TABLE `administrativos` (
  `id_administrativo` int(11) NOT NULL,
  `juridico` int(11) NOT NULL,
  `cartera` int(11) NOT NULL,
  `gestion_humana` int(11) NOT NULL,
  `desarrollo` int(11) NOT NULL,
  `analisis` int(11) NOT NULL,
  `tecnologia` int(11) NOT NULL,
  `contabilidad` int(11) NOT NULL,
  `afianzamiento` int(11) NOT NULL,
  `comercial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`ID`, `Nombre`) VALUES
(1, 'Afianzamiento'),
(2, 'Analisis'),
(3, 'Cartera'),
(4, 'Comercial'),
(5, 'Contabilidad'),
(6, 'Desarrollo'),
(7, 'Gestion_humana'),
(8, 'Juridico'),
(9, 'super_admin'),
(10, 'Sistemas');

-- --------------------------------------------------------

--
-- Table structure for table `chatters`
--

CREATE TABLE `chatters` (
  `name` text NOT NULL,
  `seen` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_conversation`
--

CREATE TABLE `chat_conversation` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_reporte` int(11) NOT NULL,
  `nombre_chat` varchar(245) NOT NULL,
  `mensaje` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_conversation`
--

INSERT INTO `chat_conversation` (`id`, `id_usuario`, `id_reporte`, `nombre_chat`, `mensaje`, `timestamp`) VALUES
(151, 0, 1, '', 'a', '2023-08-29 18:57:18'),
(152, 0, 1, '', 'a', '2023-08-29 19:32:38'),
(153, 0, 1, '', 'siu', '2023-08-29 19:32:44'),
(154, 0, 1, '', 'nani nai?', '2023-08-29 19:32:51'),
(155, 0, 1, '', 'ka', '2023-08-29 19:33:01'),
(156, 0, 1, '', 'zapa', '2023-08-29 19:33:06'),
(157, 0, 1, '', 'ehehehe', '2023-08-29 19:33:18'),
(158, 0, 1, '', 'a', '2023-08-29 20:53:55'),
(159, 0, 1, '', 'como esta!?', '2023-08-29 20:54:29'),
(160, 0, 1, '', 'a', '2023-08-29 21:04:32'),
(161, 0, 1, '', 'a', '2023-08-29 21:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id_chat` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_usuario_chat` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `msg` text NOT NULL,
  `posted` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_usuario_chat`, `name`, `msg`, `posted`) VALUES
(NULL, 'Bachors', 'hiiii', '2016-01-25 14:17:57'),
(NULL, 'Bachors', 'como estaN TODOS', '2016-01-25 14:18:02'),
(NULL, 'tusolutionweb', 'visiten la pagina para descargar mas sistemas', '2016-01-25 14:18:08'),
(NULL, 'Bachors', 'me recomiendan alguna pagina para descargar cursos de programacion', '2016-01-25 14:20:54'),
(NULL, 'tusolutionweb', 'http://tusolutionweb.blogspot.com/', '2016-01-25 14:21:30'),
(NULL, 'tusolutionweb', 'Cursos libros y sistemas con codigo fuente gratis', '2016-01-25 14:21:34'),
(NULL, 'usep', 'alguien en linea :v', '2016-01-25 14:24:58'),
(NULL, 'rayan', 'hola', '2018-03-03 08:20:20'),
(NULL, 'rayan', 'como estas', '2018-03-03 08:20:40'),
(NULL, 'kimi kami', 'como estan', '2018-03-03 08:21:29'),
(NULL, 'tirios', 'Descargado de la pagina http://tusolutionweb.blogspot.pe/', '2018-03-04 13:31:14'),
(NULL, 'tirios', 'sigannos //SIGUENOS //Siguenos en twitter //https://twitter.com/tusolutionweb //Vista nuestra pagina web //http://tusolutionweb.blogspot.com/ //Siguenos en facebook //https://www.facebook.com/CodigofuenteGratis/', '2018-03-04 13:32:01'),
(NULL, 'luis', 'hola', '2023-09-20 10:11:09'),
(NULL, 'luis', 'a', '2023-09-20 10:15:47'),
(NULL, 'luis', 'a', '2023-09-22 15:07:07'),
(NULL, 'luis', 'hola', '2023-09-22 15:31:58'),
(NULL, 'asd', 'a', '2023-09-22 15:56:52'),
(NULL, 'asd', 'gugug', '2023-09-22 15:58:33'),
(NULL, 'asd', 'ggcfg', '2023-09-22 15:58:49'),
(NULL, 'asd', 'hola mundo', '2023-09-22 15:59:17'),
(NULL, 'luis02', 'juggk', '2023-09-22 16:01:48'),
(NULL, 'luis', 'okokkk', '2023-09-26 11:36:47'),
(NULL, 'luis', 'kñkpñl', '2023-09-26 11:36:49'),
(NULL, 'a', 'a', '2023-09-26 11:44:59'),
(NULL, 'luis', 'a', '2023-09-26 11:45:08'),
(NULL, 'A', 'A', '2023-09-26 16:09:14'),
(NULL, 'A', 'A', '2023-09-26 16:09:21'),
(NULL, 'A', 'DASDSAD', '2023-09-26 16:09:24'),
(NULL, '&lt;', 'a', '2023-09-27 10:28:12'),
(NULL, 'luis02', 'a', '2023-09-27 16:54:36'),
(NULL, 'ADSA', 'DAS', '2023-10-19 14:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `prioridades`
--

CREATE TABLE `prioridades` (
  `id_prioridad` int(11) NOT NULL,
  `nombre_prioridad` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prioridades`
--

INSERT INTO `prioridades` (`id_prioridad`, `nombre_prioridad`) VALUES
(1, 'ALTA'),
(2, 'MEDIA'),
(3, 'BAJA');

-- --------------------------------------------------------

--
-- Table structure for table `t_asignacion`
--

CREATE TABLE `t_asignacion` (
  `id_asignacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `marca` varchar(245) DEFAULT NULL,
  `modelo` varchar(245) DEFAULT NULL,
  `numero_asignacion` varchar(245) DEFAULT NULL,
  `serial` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_asignacion`
--

INSERT INTO `t_asignacion` (`id_asignacion`, `id_persona`, `id_equipo`, `marca`, `modelo`, `numero_asignacion`, `serial`) VALUES
(25, 24, 3, 'GENIUS', 'm/nDX-110', 'MOS-001', '1587895614564/89'),
(26, 24, 4, 'hp', 'KU-1156', 'TCL-001', '167879456213'),
(28, 24, 8, 'grandsStream', '1405', 'TLF-001', '134567989876543'),
(29, 24, 6, 'iphone', '11 pro max 128 gb', 'CEL-001', '13256456478945654'),
(38, 28, 1, 'Maximus', 'rancher', 'PCF-001', '1345679898765431'),
(39, 64, 1, 'LENOVO', 'KMT-123', 'PCF-012', 'a124578997454');

-- --------------------------------------------------------

--
-- Table structure for table `t_cat_administrativo`
--

CREATE TABLE `t_cat_administrativo` (
  `id_admin` int(11) NOT NULL,
  `nombre_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_cat_administrativo`
--

INSERT INTO `t_cat_administrativo` (`id_admin`, `nombre_admin`) VALUES
(1, 'administrativo_general'),
(2, 'juridico'),
(3, 'cartera'),
(4, 'desarrollo'),
(5, 'gestion_humana'),
(6, 'comercial'),
(7, 'analisis'),
(8, 'tecnologia'),
(9, 'contabilidad'),
(10, 'afianzamiento');

-- --------------------------------------------------------

--
-- Table structure for table `t_cat_equipo`
--

CREATE TABLE `t_cat_equipo` (
  `id_equipo` int(11) NOT NULL,
  `nombre` varchar(245) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_cat_equipo`
--

INSERT INTO `t_cat_equipo` (`id_equipo`, `nombre`, `descripcion`) VALUES
(1, 'PC', 'fas fa-server'),
(2, 'impresora\r\n', 'fas fa-printer'),
(3, 'Mouse', 'fas fa-mouse\r\n'),
(4, 'Teclado', 'fas fa-keyboard'),
(5, 'Monitor', 'fas fa-desktop'),
(6, 'celular', 'fas fa-mobile'),
(7, 'audifonos', 'fas fa-headphone'),
(8, 'telefono', 'fas fa-phone');

-- --------------------------------------------------------

--
-- Table structure for table `t_cat_roles`
--

CREATE TABLE `t_cat_roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(245) NOT NULL,
  `descripcion` varchar(245) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_cat_roles`
--

INSERT INTO `t_cat_roles` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'cliente', 'Es un cliente'),
(2, 'admin', 'Es Admin'),
(3, 'super_admin', 'super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `t_mantenimiento`
--

CREATE TABLE `t_mantenimiento` (
  `id_mantenimiento` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion_m` varchar(245) NOT NULL,
  `responsable` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_mantenimiento`
--

INSERT INTO `t_mantenimiento` (`id_mantenimiento`, `id_persona`, `fecha`, `descripcion_m`, `responsable`) VALUES
(13, 8, '2023-06-09', 'sadadsa', 'sistemas');

-- --------------------------------------------------------

--
-- Table structure for table `t_persona`
--

CREATE TABLE `t_persona` (
  `id_persona` int(11) NOT NULL,
  `tipo_documento` varchar(245) NOT NULL,
  `numero_documento` varchar(245) DEFAULT NULL,
  `apellidos` varchar(245) NOT NULL,
  `nombres` varchar(245) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `oficina` varchar(245) DEFAULT NULL,
  `fechaInsert` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_persona`
--

INSERT INTO `t_persona` (`id_persona`, `tipo_documento`, `numero_documento`, `apellidos`, `nombres`, `telefono`, `correo`, `oficina`, `fechaInsert`) VALUES
(1, 'help', 'desku', 'demo1', '', NULL, '56895', 'helpdesk@gmail.com', '2021-08-09 14:18:27'),
(8, 'Cedula de ciudadania', '123456789', 'Ricaurte', 'Santiago', '123456789', '546987713', 'sadsa@dsadsa', '2023-05-19 12:55:47'),
(24, 'Cedula de ciudadania', '1004564889', 'usuario', 'prueba', '3204578', 'prueba@gmail.com', '02', '2023-05-23 13:16:46'),
(27, 'Cedula de ciudadania', '258741963', 'usuario', 'sistemas', '4567891230', 'sistemas@fianzasdecolombia.com', '01', '2023-06-15 08:05:02'),
(28, 'Cedula de ciudadania', '123456789', 'diaz', 'Wilmar', '25369871', 'sistemas@fianzas.com', '101', '2023-06-27 12:40:25'),
(29, 'Cedula de ciudadania', '128547963', 'PRUEBA', 'AFIANZAMIENTO', '25369871', 'afianzamiento@gmail.com', '101', '2023-07-10 10:28:25'),
(36, 'Cedula de ciudadania', '1004523558', 'PRUEBA', 'AFIANZAMIENTO', '25369871', 'afianzamiento@gmail.com', '101', '2023-07-10 11:05:27'),
(37, 'Cedula Extranjeria', '1004523558', 'diaz', 'Wilmar', '13245679', 'afianzamiento@gmail.com', '101', '2023-07-10 11:17:38'),
(39, 'Cedula de ciudadania', '147258', 'PRUEBA', 'ANALISIS', '25369871', 'analisis@gmail.com', '101', '2023-07-18 08:23:23'),
(40, 'Cedula de ciudadania', '147852369', 'PRUEBA', 'CARTERA', '13245679', 'comercia@fianzas.com', '101', '2023-07-18 09:55:49'),
(41, 'Cedula de ciudadania', '1004523558', 'PRUEBA', 'CARTERA', '25369871', 'cartera@fianzas.com', '101', '2023-07-18 10:19:07'),
(42, 'Cedula de ciudadania', '123456789', 'PRUEBA', 'COMERCIAL', '123456879', 'comercial@fianzas.com', '101', '2023-07-18 10:33:33'),
(43, 'Cedula de ciudadania', '1472583369', 'PRUEBA', 'CONTABILIDAD', '123456789', 'contabilidad@gmail.com', '101', '2023-07-18 10:48:51'),
(44, 'Cedula de ciudadania', '123456789', 'PRUEBA', 'DESARROLLO', '3165487787', 'desarrollo@gmail.com', '101', '2023-07-18 12:24:51'),
(45, 'Cedula de ciudadania', '1234567890', 'PRUEBA', 'Gestio_humana', '123456789', 'gestion@gmail.com', '101', '2023-07-18 16:04:50'),
(46, 'Cedula de ciudadania', '1472583369', 'PRUEBA', 'JURIDICO', '25369871', 'juridico@gmail.com', '201', '2023-07-19 08:23:15'),
(50, 'Cedula de ciudadania', '1472583369', 'PRUEBA', 'SISTEMAS', '123456789', 'sistemas@fianzas.com', '101', '2023-07-19 09:00:05'),
(51, 'Cedula de ciudadania', '147258', 'PRUEBA', 'CLIENTE_AFI', '7845613', 'cleiente@gmail.com', '101', '2023-07-19 09:30:01'),
(52, 'Cedula de ciudadania', '123456789', 'PRUEBA', 'CLIENTE_ANA', '13245679', 'analisis@gmail.com', '201', '2023-07-19 15:27:31'),
(53, 'Cedula de ciudadania', '1004523558', 'PRUEBA', 'CLIENTE_CAR', '25369871', 'cartera@fianzas.com', '201', '2023-07-21 15:33:16'),
(54, 'Cedula de ciudadania', '134567897897', 'PRUEBA', 'COMERCIAL_comercial', '13245679', 'comercia@fianzas.com', '201', '2023-07-24 11:16:31'),
(55, 'Cedula de ciudadania', '147852339', 'PRUEBA', 'CONTABILIDAD_clietnte', '74125/896', 'contabilidad@gmail.com', '101', '2023-07-24 16:50:42'),
(57, 'Cedula de ciudadania', '147852369', 'una', 'PRUIEBA', '147852369', 'ASDFWEQ@gmail.com', '155', '2023-09-12 11:57:32'),
(58, 'Cedula de ciudadania', '123456/7*', 'jua', 'no se', '123456879', 'ASDFWEQ@gmail.com', '155', '2023-09-14 13:11:12'),
(59, 'Cedula de ciudadania', '123456789', 'a', 'Analisis', '123456789', 'analisis@fianzasdecolombia.com', '145', '2023-09-14 13:58:07'),
(60, 'Cedula de ciudadania', '123456/7*', 'a', 'Analisis', '147852369', 'analisis@fianzasdecolombia.com', '145', '2023-09-14 14:10:44'),
(61, 'Cedula de ciudadania', '147852963', 'primera', 'Prueba', '963258741', 'afianzamiento@fianzasdecolombia.com', '100', '2023-09-15 08:10:28'),
(62, 'Cedula de ciudadania', '123456/7*', 'una', 'PRUEBA', '963258741', 'afianzamiento@fianzasdecolombia.com', '155', '2023-09-15 08:24:37'),
(63, 'Cedula de ciudadania', '123456/7*', 'una', 'PRUEBA', '963258741', 'afianzamiento@fianzasdecolombia.com', '155', '2023-09-15 08:29:53'),
(64, 'Cedula Extranjeria', '123456/7*', 'cliente', 'PRUEBA', '963258741', 'afianzamiento@fianzasdecolombia.com', '145', '2023-09-15 08:31:05'),
(65, 'Cedula de ciudadania', '1004253229', 'sistemas', 'prueba', '963258741', 'sistemas@fianzasdecolombia.com', '410', '2023-09-15 08:40:40'),
(66, 'Cedula de ciudadania', '963258741', 'admin', 'Analisis', '456789123', 'analisis@fianzasdecolombia.com', '502', '2023-09-15 09:35:17'),
(67, 'Cedula de ciudadania', '6549873122', 'cliente', 'Analisis', '789456123', 'analisis@fianzasdecolombia.com', '701', '2023-09-15 09:37:41'),
(68, 'Cedula de ciudadania', '123456/7*', 'admin', 'sistemas', '123456789', 'sistemas@fianzasdecolombia.com', '45', '2023-09-15 09:51:27'),
(69, 'Cedula de ciudadania', '6549873122', 'admin', 'cartera', '123456789', 'cartera@fianzasdecolombia.com', '705', '2023-09-15 11:33:57'),
(70, 'Cedula de ciudadania', '6549873122', 'cliente', 'cartera', '963258741', 'cartera@fianzasdecolombia.com', '701', '2023-09-15 11:35:50'),
(71, 'Cedula Extranjeria', '6549873122', 'cliente_2', 'afianzamieno_2', '963258741', 'afianzamiento@fianzasdecolombia.com', '45', '2023-09-21 13:05:02'),
(72, 'Cedula Extranjeria', 'dasdsadsa', 'daasdasdasd', 'asdasdasd', 'asdasdasd', 'sdasdsda@asdad.com', 'dadaasd', '2023-09-21 13:09:09'),
(73, 'Cedula Extranjeria', 'dasdsadsa', 'daasdasdasd', 'asdasdasd', 'asdasdasd', 'sdasdsda@asdad.com', 'dadaasd', '2023-09-21 13:09:55'),
(74, 'Cedula de ciudadania', 'asdasdsa', 'asdasdsd', 'asdasdasd', 'asdsda', 'asdsd@asdad', 'asdasdd', '2023-09-21 13:12:23'),
(75, 'Cedula de ciudadania', '123456/7*', 'cliente_02', 'afianzamieno_2', '963258741', 'afianzamiento@fianzasdecolombia.com', '155', '2023-09-21 13:16:24'),
(76, 'Cedula de ciudadania', 'asdasdasds', 'adasdasdasdsda', 'asdsdaasdasd', 'asdsdaasd', 'dsada@sadasd', 'asdasda', '2023-09-21 13:25:52'),
(77, 'Cedula de ciudadania', 'asdasddsdgsd', 'cliente_02', 'afianzamieno_2', '213213879/9874', 'afianzamiento@fianzasdecolombia.com', '458', '2023-09-21 13:56:17'),
(78, 'Cedula de ciudadania', '147852369', 'Ricaurte', 'Santiago', '123465789', 'sistemas@fianzasdecolombia.com', '101', '2023-11-08 09:42:45'),
(79, 'Cedula de ciudadania', '7894561212', 'segura', 'Maria', '123456789', 'afianzamiento@fianzasdecolombia.com', '101', '2023-11-08 09:44:53'),
(80, 'Cedula de ciudadania', '123456789', 'segura', 'maria', '963258741', 'afianzamiento@fianzasdecolombia.com', '701', '2023-11-08 09:52:30'),
(81, 'Cedula de ciudadania', '6549873122', 'ricaurte', 'santiago', '123456789', 'sistemas@fianzasdecolombia.com', '701', '2023-11-08 09:55:07'),
(82, 'Cedula de ciudadania', '147852369', 'desarrollo', 'admin', '13456789', 'desarrollo@fianzasdecolombia.com', '302', '2023-11-08 10:50:53'),
(83, 'Cedula de ciudadania', '123456789', 'desarrollo', '1', '123456789', 'desarrollo1@gmail.com', '302', '2023-11-08 11:16:10'),
(84, 'Cedula de ciudadania', '1002002202002', 'admin', 'contabilidad', '963258741', 'cotabilidad@fianzasdecolombia.com', '123', '2023-11-08 12:08:43'),
(85, 'Cedula de ciudadania', '1144778855223366699', 'admin', 'GES HUMANA', '12345689', 'gestionhumnana@fianzasdecolombia.com', '123', '2023-11-08 12:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `t_reportes`
--

CREATE TABLE `t_reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_equipo` int(11) NOT NULL,
  `id_usuario_tecnico` int(11) DEFAULT NULL,
  `descripcion_problema` text DEFAULT NULL,
  `solucion_problema` text DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `prioridad` varchar(25) NOT NULL,
  `fecha_cierre` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_reportes_general`
--

CREATE TABLE `t_reportes_general` (
  `id_reporte_general` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_equipo` int(11) DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  `id_area_envio` int(11) DEFAULT NULL,
  `id_usuario_asignado` int(11) DEFAULT NULL,
  `descripcion_general` text DEFAULT NULL,
  `solucion_general` text DEFAULT NULL,
  `solicitud_aprobado` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `estatus_general` int(11) NOT NULL,
  `fecha_general` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_cierre` timestamp NULL DEFAULT NULL,
  `prioridad_general` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_reportes_general`
--

INSERT INTO `t_reportes_general` (`id_reporte_general`, `id_usuario`, `id_equipo`, `id_area`, `id_area_envio`, `id_usuario_asignado`, `descripcion_general`, `solucion_general`, `solicitud_aprobado`, `observacion`, `estatus_general`, `fecha_general`, `fecha_cierre`, `prioridad_general`) VALUES
(103, 36, NULL, 10, 1, 37, 'se me fue el internet', 'asdadasda', 0, '', 1, '2023-12-12 15:09:44', '2023-12-15 21:09:44', 'BAJA');

-- --------------------------------------------------------

--
-- Table structure for table `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `usuario` varchar(245) NOT NULL,
  `password` varchar(245) NOT NULL,
  `area` text DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT 1,
  `fecha_insert` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `id_rol`, `id_persona`, `usuario`, `password`, `area`, `activo`, `fecha_insert`) VALUES
(1, 2, 1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Modulo 1', 1, NULL),
(2, 1, 1, 'cliente', 'd94019fd760a71edf11844bb5c601a4de95aacaf', 'Modulo 1', 1, NULL),
(35, 2, 63, 'afianza', '4d097177365fab5276114c60528381167d0ef925', '1\n', 1, NULL),
(36, 1, 64, 'cliente_afianza', '4d097177365fab5276114c60528381167d0ef925', '1', 1, NULL),
(37, 1, 65, 'cliente_sistemas', '4d097177365fab5276114c60528381167d0ef925', '9', 1, NULL),
(38, 2, 66, 'analisis', '4d097177365fab5276114c60528381167d0ef925', '2', 1, NULL),
(39, 1, 67, 'cliente_analisis', '4d097177365fab5276114c60528381167d0ef925', '2', 1, NULL),
(40, 2, 68, 'sistemas', '4d097177365fab5276114c60528381167d0ef925', '9', 1, NULL),
(41, 2, 69, 'cartera', '4d097177365fab5276114c60528381167d0ef925', '3', 1, NULL),
(42, 1, 70, 'cliente_cartera', '4d097177365fab5276114c60528381167d0ef925', '3', 1, NULL),
(51, 1, 80, 'maria', '4d097177365fab5276114c60528381167d0ef925', '1', 1, NULL),
(52, 1, 81, 'santiago', '4d097177365fab5276114c60528381167d0ef925', '9', 1, NULL),
(53, 2, 82, 'desarrollo', '4d097177365fab5276114c60528381167d0ef925', '6', 1, NULL),
(54, 1, 83, 'desarrollo1', '4d097177365fab5276114c60528381167d0ef925', '6', 1, NULL),
(55, 2, 84, 'contabilidad', '4d097177365fab5276114c60528381167d0ef925', '5', 1, NULL),
(56, 2, 85, 'gestion_humana', '4d097177365fab5276114c60528381167d0ef925', '7', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_usu_area`
--

CREATE TABLE `t_usu_area` (
  `id` int(11) NOT NULL,
  `id_tabla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `chat_conversation`
--
ALTER TABLE `chat_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `prioridades`
--
ALTER TABLE `prioridades`
  ADD PRIMARY KEY (`id_prioridad`);

--
-- Indexes for table `t_asignacion`
--
ALTER TABLE `t_asignacion`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `fkPersona_idx` (`id_persona`),
  ADD KEY `fkPersonaAsignacion_idx` (`id_persona`),
  ADD KEY `fkequipoAsignacion_idx` (`id_equipo`);

--
-- Indexes for table `t_cat_administrativo`
--
ALTER TABLE `t_cat_administrativo`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `t_cat_equipo`
--
ALTER TABLE `t_cat_equipo`
  ADD PRIMARY KEY (`id_equipo`);

--
-- Indexes for table `t_cat_roles`
--
ALTER TABLE `t_cat_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `t_mantenimiento`
--
ALTER TABLE `t_mantenimiento`
  ADD PRIMARY KEY (`id_mantenimiento`);

--
-- Indexes for table `t_persona`
--
ALTER TABLE `t_persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indexes for table `t_reportes`
--
ALTER TABLE `t_reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `fkUsuarioReporte_idx` (`id_usuario`),
  ADD KEY `fkEquipoReporte_idx` (`id_equipo`);

--
-- Indexes for table `t_reportes_general`
--
ALTER TABLE `t_reportes_general`
  ADD PRIMARY KEY (`id_reporte_general`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_equipo` (`id_equipo`);

--
-- Indexes for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fkPersona_idx` (`id_persona`),
  ADD KEY `fkRoles_idx` (`id_rol`);

--
-- Indexes for table `t_usu_area`
--
ALTER TABLE `t_usu_area`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_conversation`
--
ALTER TABLE `chat_conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prioridades`
--
ALTER TABLE `prioridades`
  MODIFY `id_prioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_asignacion`
--
ALTER TABLE `t_asignacion`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_cat_administrativo`
--
ALTER TABLE `t_cat_administrativo`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_cat_equipo`
--
ALTER TABLE `t_cat_equipo`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_cat_roles`
--
ALTER TABLE `t_cat_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_mantenimiento`
--
ALTER TABLE `t_mantenimiento`
  MODIFY `id_mantenimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_persona`
--
ALTER TABLE `t_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_reportes`
--
ALTER TABLE `t_reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `t_reportes_general`
--
ALTER TABLE `t_reportes_general`
  MODIFY `id_reporte_general` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `t_usu_area`
--
ALTER TABLE `t_usu_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_asignacion`
--
ALTER TABLE `t_asignacion`
  ADD CONSTRAINT `fkPersonaAsignacion` FOREIGN KEY (`id_persona`) REFERENCES `t_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkequipoAsignacion` FOREIGN KEY (`id_equipo`) REFERENCES `t_cat_equipo` (`id_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_reportes`
--
ALTER TABLE `t_reportes`
  ADD CONSTRAINT `fkEquipoReporte` FOREIGN KEY (`id_equipo`) REFERENCES `t_cat_equipo` (`id_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkUsuarioReporte` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `fkPersona` FOREIGN KEY (`id_persona`) REFERENCES `t_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkRoles` FOREIGN KEY (`id_rol`) REFERENCES `t_cat_roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
