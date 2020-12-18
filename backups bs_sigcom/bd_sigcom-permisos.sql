-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2020 a las 19:01:38
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sigcom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `Activo` int(11) NOT NULL DEFAULT 1,
  `Descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tipo_embalaje` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unidad_medida` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Unidad_bulto` int(11) DEFAULT NULL,
  `Punto_pedido` int(11) NOT NULL,
  `Stock_disponible` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`ArticuloID`, `Activo`, `Descripcion`, `Tipo_embalaje`, `Unidad_medida`, `Unidad_bulto`, `Punto_pedido`, `Stock_disponible`) VALUES
(1, 1, 'Caño 50\' PVC', 'Sin embalaje', 'Unidad', 1, 30, 50),
(2, 1, 'Medidor clasisco', 'Sin embalaje', 'Unidad', 1, 20, 0),
(3, 1, 'Medidor inteligente', 'Sin embalaje', 'Unidad', 1, 15, 0),
(4, 1, 'Chip de medidor Inteligente', 'Caja', 'Unidad', 1, 5, 0),
(5, 1, 'Caño 75\' PVC', 'Sin embalaje', 'Unidad', 1, 50, 0),
(6, 1, 'Caño 90\' PVC', 'Sin embalaje', 'Unidad', 0, 30, 0),
(7, 1, 'Caño 110\' PVC', 'Sin embalaje', 'Unidad', 0, 40, 0),
(8, 1, 'Ataud cofre', 'Sin embalaje', 'Unidad', 1, 20, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_proveedor`
--

CREATE TABLE `articulo_proveedor` (
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `ProveedorID` bigint(20) UNSIGNED NOT NULL,
  `FechaDesde` date NOT NULL,
  `FechaHasta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articulo_proveedor`
--

INSERT INTO `articulo_proveedor` (`ArticuloID`, `ProveedorID`, `FechaDesde`, `FechaHasta`) VALUES
(1, 1, '2020-12-12', NULL),
(2, 2, '2020-12-16', NULL),
(2, 3, '2020-12-16', NULL),
(3, 2, '2020-12-16', NULL),
(4, 2, '2020-12-16', NULL),
(5, 2, '2020-12-16', NULL),
(5, 3, '2020-12-16', NULL),
(6, 2, '2020-12-16', NULL),
(6, 3, '2020-12-16', NULL),
(7, 1, '2020-12-18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden_compra`
--

CREATE TABLE `detalles_orden_compra` (
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `OrdenCompraID` bigint(20) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioUnitario` int(11) NOT NULL,
  `Descuento` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_orden_compra`
--

INSERT INTO `detalles_orden_compra` (`ArticuloID`, `OrdenCompraID`, `Cantidad`, `PrecioUnitario`, `Descuento`) VALUES
(1, 14, 8, 89, 0.00),
(1, 17, 58, 7000, 0.00),
(2, 1, 20, 700, 10.00),
(2, 2, 30, 3200, 0.00),
(2, 8, 10, 3200, 10.00),
(2, 10, 20, 3600, 15.00),
(2, 11, 20, 1500, 0.00),
(3, 4, 5, 6000, 0.00),
(3, 11, 10, 3300, 0.00),
(3, 12, 10, 4000, 0.00),
(3, 13, 10, 4000, 0.00),
(3, 15, 7, 80, 0.00),
(4, 3, 5, 6000, 0.00),
(4, 16, 9, 80, 0.00),
(5, 1, 40, 250, 0.00),
(5, 7, 10, 450, 0.00),
(5, 9, 30, 350, 0.00),
(6, 9, 30, 280, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_presupuestos`
--

CREATE TABLE `detalles_presupuestos` (
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `PresupuestoID` bigint(20) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `FechaHoraSeleccion` datetime DEFAULT NULL,
  `PrecioUnitario` double(8,2) NOT NULL,
  `Descuento` double(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_presupuestos`
--

INSERT INTO `detalles_presupuestos` (`ArticuloID`, `PresupuestoID`, `Cantidad`, `FechaHoraSeleccion`, `PrecioUnitario`, `Descuento`) VALUES
(1, 4, 10, NULL, 340.00, 0.00),
(1, 11, 89, NULL, 40.00, 0.00),
(1, 12, 8, '2020-12-17 00:00:00', 89.00, 0.00),
(1, 15, 58, '2020-12-17 00:00:00', 7000.00, 0.00),
(2, 1, 20, '2020-12-16 00:00:00', 700.00, 10.00),
(2, 2, 30, '2020-12-16 00:00:00', 3200.00, 0.00),
(2, 6, 10, '2020-12-17 00:00:00', 3200.00, 10.00),
(2, 7, 20, '2020-12-17 00:00:00', 3600.00, 15.00),
(2, 8, 20, '2020-12-17 00:00:00', 1500.00, 0.00),
(3, 3, 5, '2020-12-17 00:00:00', 6000.00, 0.00),
(3, 8, 10, '2020-12-17 00:00:00', 3300.00, 0.00),
(3, 9, 10, '2020-12-17 00:00:00', 4000.00, 0.00),
(3, 10, 10, '2020-12-17 00:00:00', 4000.00, 0.00),
(3, 13, 7, '2020-12-17 00:00:00', 80.00, 0.00),
(4, 3, 5, '2020-12-17 00:00:00', 3000.00, 0.00),
(4, 14, 9, '2020-12-17 00:00:00', 80.00, 0.00),
(5, 1, 40, '2020-12-16 00:00:00', 250.00, 0.00),
(5, 5, 10, '2020-12-17 00:00:00', 450.00, 0.00),
(5, 6, 30, '2020-12-17 00:00:00', 350.00, 0.00),
(6, 1, 30, '2020-12-16 00:00:00', 220.00, 5.00),
(6, 5, 10, NULL, 420.00, 0.00),
(6, 6, 30, '2020-12-17 00:00:00', 280.00, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_solicitud_compras`
--

CREATE TABLE `detalles_solicitud_compras` (
  `Cantidad` int(11) NOT NULL,
  `FechaResposicionEstimada` date NOT NULL,
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_solicitud_compras`
--

INSERT INTO `detalles_solicitud_compras` (`Cantidad`, `FechaResposicionEstimada`, `ArticuloID`, `SolicitudCompraID`) VALUES
(89, '2020-12-22', 1, 4),
(45, '2020-12-24', 1, 5),
(90, '2020-12-29', 1, 6),
(50, '2021-01-08', 1, 10),
(10, '2020-12-30', 1, 13),
(8, '2020-12-23', 1, 19),
(5564, '2021-01-06', 1, 21),
(20, '2020-12-30', 2, 7),
(30, '2020-12-30', 2, 9),
(20, '2020-12-28', 2, 10),
(30, '2020-12-16', 2, 12),
(10, '2021-01-08', 2, 14),
(20, '2021-01-20', 2, 15),
(20, '2021-01-08', 2, 16),
(10, '2020-12-30', 3, 7),
(10, '2020-12-30', 3, 8),
(10, '2020-12-30', 3, 9),
(5, '2020-12-31', 3, 11),
(10, '2020-12-16', 3, 12),
(5, '2021-01-08', 3, 14),
(10, '2021-01-20', 3, 15),
(10, '2020-12-30', 3, 16),
(10, '2020-12-31', 3, 17),
(10, '2021-01-07', 3, 18),
(7, '2020-12-30', 3, 19),
(5, '2020-12-30', 4, 9),
(5, '2020-12-31', 4, 11),
(10, '2020-12-16', 4, 12),
(9, '2020-12-26', 4, 19),
(40, '2021-01-08', 5, 10),
(10, '2020-12-30', 5, 13),
(30, '2021-01-08', 5, 14),
(30, '2021-01-08', 6, 10),
(10, '2020-12-30', 6, 13),
(30, '2021-01-08', 6, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deta_soli_presu`
--

CREATE TABLE `deta_soli_presu` (
  `Cantidad` int(11) NOT NULL,
  `FechaReposicion` date NOT NULL,
  `ArtiID` bigint(20) UNSIGNED NOT NULL,
  `SoliPresuID` bigint(20) UNSIGNED NOT NULL,
  `ProveID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deta_soli_presu`
--

INSERT INTO `deta_soli_presu` (`Cantidad`, `FechaReposicion`, `ArtiID`, `SoliPresuID`, `ProveID`) VALUES
(89, '2020-12-22', 1, 3, 1),
(90, '2020-12-29', 1, 9, 1),
(50, '2020-12-28', 1, 10, 1),
(10, '2020-12-30', 1, 13, 1),
(8, '2020-12-23', 1, 23, 1),
(5564, '2021-01-06', 1, 26, 1),
(20, '2020-12-30', 2, 4, 2),
(20, '2020-12-30', 2, 5, 3),
(30, '2020-12-30', 2, 8, 3),
(20, '2021-01-08', 2, 11, 2),
(10, '2021-01-08', 2, 16, 3),
(20, '2021-01-20', 2, 17, 2),
(20, '2021-01-20', 2, 18, 3),
(20, '2021-01-08', 2, 19, 2),
(20, '2021-01-08', 2, 20, 3),
(10, '2020-12-30', 3, 4, 2),
(10, '2020-12-30', 3, 6, 2),
(10, '2020-12-30', 3, 7, 2),
(5, '2020-12-31', 3, 12, 2),
(5, '2021-01-08', 3, 15, 2),
(10, '2021-01-20', 3, 17, 2),
(10, '2020-12-30', 3, 19, 2),
(10, '2020-12-31', 3, 21, 2),
(10, '2021-01-07', 3, 22, 2),
(7, '2020-12-30', 3, 24, 2),
(5, '2020-12-30', 4, 7, 2),
(5, '2020-12-31', 4, 12, 2),
(9, '2020-12-26', 4, 25, 2),
(40, '2021-01-08', 5, 11, 2),
(10, '2020-12-30', 5, 14, 3),
(30, '2021-01-08', 5, 16, 3),
(30, '2021-01-08', 6, 11, 2),
(10, '2020-12-30', 6, 14, 3),
(30, '2021-01-08', 6, 16, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `EstadoID` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`EstadoID`) VALUES
('Aprobada'),
('Finalizado'),
('Pendiente'),
('Procesado'),
('Rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ordenes_compras`
--

CREATE TABLE `estados_ordenes_compras` (
  `EstadoID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrdenCompraID` bigint(20) UNSIGNED NOT NULL,
  `AdminComprasID` bigint(20) UNSIGNED NOT NULL,
  `FechaHora` datetime NOT NULL,
  `IDAprobador` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados_ordenes_compras`
--

INSERT INTO `estados_ordenes_compras` (`EstadoID`, `OrdenCompraID`, `AdminComprasID`, `FechaHora`, `IDAprobador`) VALUES
('Aprobada', 1, 4, '2020-12-17 00:00:00', 4),
('Aprobada', 2, 2, '2020-12-16 00:00:00', 2),
('Aprobada', 7, 4, '2020-12-17 00:00:00', 4),
('Aprobada', 8, 2, '2020-12-17 00:00:00', 2),
('Aprobada', 9, 2, '2020-12-17 00:00:00', 2),
('Aprobada', 10, 2, '2020-12-17 00:00:00', 2),
('Aprobada', 11, 4, '2020-12-17 00:00:00', 4),
('Aprobada', 12, 4, '2020-12-17 00:00:00', 4),
('Aprobada', 14, 2, '2020-12-17 00:00:00', 2),
('Aprobada', 16, 2, '2020-12-17 00:00:00', 2),
('Aprobada', 17, 4, '2020-12-17 00:00:00', 4),
('Pendiente', 1, 2, '2020-12-16 00:00:00', 4),
('Pendiente', 2, 2, '2020-12-16 00:00:00', 2),
('Pendiente', 3, 2, '2020-12-17 00:00:00', 4),
('Pendiente', 4, 2, '2020-12-17 00:00:00', 4),
('Pendiente', 7, 2, '2020-12-17 00:00:00', 4),
('Pendiente', 8, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 9, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 10, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 11, 2, '2020-12-17 00:00:00', 4),
('Pendiente', 12, 1, '2020-12-17 00:00:00', 4),
('Pendiente', 13, 3, '2020-12-17 00:00:00', 2),
('Pendiente', 14, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 15, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 16, 2, '2020-12-17 00:00:00', 2),
('Pendiente', 17, 2, '2020-12-17 00:00:00', 4),
('Rechazada', 3, 4, '2020-12-17 00:00:00', 4),
('Rechazada', 4, 4, '2020-12-17 00:00:00', 4),
('Rechazada', 13, 2, '2020-12-17 00:00:00', 2),
('Rechazada', 15, 2, '2020-12-17 00:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_presupuestos`
--

CREATE TABLE `estados_presupuestos` (
  `EstadoID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PresupuestoID` bigint(20) UNSIGNED NOT NULL,
  `AdminComprasID` bigint(20) UNSIGNED NOT NULL,
  `FechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados_presupuestos`
--

INSERT INTO `estados_presupuestos` (`EstadoID`, `PresupuestoID`, `AdminComprasID`, `FechaHora`) VALUES
('Pendiente', 1, 2, '2020-12-16 00:00:00'),
('Pendiente', 2, 2, '2020-12-16 00:00:00'),
('Pendiente', 3, 2, '2020-12-17 00:00:00'),
('Pendiente', 4, 2, '2020-12-17 00:00:00'),
('Pendiente', 5, 2, '2020-12-17 00:00:00'),
('Pendiente', 6, 2, '2020-12-17 00:00:00'),
('Pendiente', 7, 2, '2020-12-17 00:00:00'),
('Pendiente', 8, 2, '2020-12-17 00:00:00'),
('Pendiente', 9, 1, '2020-12-17 00:00:00'),
('Pendiente', 10, 3, '2020-12-17 00:00:00'),
('Pendiente', 11, 2, '2020-12-17 00:00:00'),
('Pendiente', 12, 2, '2020-12-17 00:00:00'),
('Pendiente', 13, 2, '2020-12-17 00:00:00'),
('Pendiente', 14, 2, '2020-12-17 00:00:00'),
('Pendiente', 15, 2, '2020-12-17 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_solicitud_compras`
--

CREATE TABLE `estados_solicitud_compras` (
  `EstadoID` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaHora` datetime NOT NULL,
  `ResponsableID` bigint(20) UNSIGNED NOT NULL,
  `AdminComprasID` bigint(20) UNSIGNED DEFAULT NULL,
  `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados_solicitud_compras`
--

INSERT INTO `estados_solicitud_compras` (`EstadoID`, `FechaHora`, `ResponsableID`, `AdminComprasID`, `SolicitudCompraID`) VALUES
('Pendiente', '2020-12-15 00:00:00', 2, 2, 4),
('Pendiente', '2020-12-15 00:00:00', 2, NULL, 5),
('Pendiente', '2020-12-15 00:00:00', 2, 2, 6),
('Pendiente', '2020-12-16 00:00:00', 2, 2, 7),
('Pendiente', '2020-12-16 00:00:00', 2, 2, 8),
('Pendiente', '2020-12-16 00:00:00', 2, 2, 9),
('Pendiente', '2020-12-16 00:00:00', 2, 2, 10),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 11),
('Pendiente', '2020-12-17 00:00:00', 2, NULL, 12),
('Pendiente', '2020-12-17 00:00:00', 3, 2, 13),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 14),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 15),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 16),
('Pendiente', '2020-12-17 00:00:00', 3, 1, 17),
('Pendiente', '2020-12-17 00:00:00', 3, 3, 18),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 19),
('Pendiente', '2020-12-17 00:00:00', 2, 2, 21),
('Procesado', '2020-12-15 00:00:00', 2, NULL, 4),
('Procesado', '2020-12-16 00:00:00', 2, 2, 6),
('Procesado', '2020-12-16 00:00:00', 2, 2, 7),
('Procesado', '2020-12-16 00:00:00', 2, 2, 8),
('Procesado', '2020-12-16 00:00:00', 2, 2, 9),
('Procesado', '2020-12-16 00:00:00', 2, 2, 10),
('Procesado', '2020-12-17 00:00:00', 2, 2, 11),
('Procesado', '2020-12-17 00:00:00', 3, 2, 13),
('Procesado', '2020-12-17 00:00:00', 2, 2, 14),
('Procesado', '2020-12-17 00:00:00', 2, 2, 15),
('Procesado', '2020-12-17 00:00:00', 2, 2, 16),
('Procesado', '2020-12-17 00:00:00', 3, 1, 17),
('Procesado', '2020-12-17 00:00:00', 3, 3, 18),
('Procesado', '2020-12-17 00:00:00', 2, 2, 19),
('Procesado', '2020-12-17 00:00:00', 2, 2, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_11_10_133032_personas', 1),
(2, '2013_11_11_123529_roles', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2020_11_01_221313_create_sessions_table', 1),
(9, '2020_11_11_125307_permisos', 1),
(10, '2020_11_11_144419_sectores', 1),
(11, '2020_11_12_210614_proveedores', 1),
(12, '2020_11_13_210507_articulos', 1),
(13, '2020_11_23_142300_articulo_proveedor', 1),
(14, '2020_11_26_213746_solicitud_compras', 1),
(15, '2020_11_27_004642_detalles_solicitud_compras', 1),
(16, '2020_12_07_003255_estados', 1),
(17, '2020_12_07_005002_estados_solicitud_compras', 1),
(18, '2020_12_07_214234_solicitudes_presupuestos', 1),
(19, '2020_12_07_220349_solicitudes_presupuesto_proveedores', 1),
(20, '2020_12_07_234508_detalles_solicitud_presupuestos', 1),
(22, '2020_12_12_214328_roles_permisos', 1),
(23, '2020_12_12_224853_usuarios_roles', 1),
(47, '2020_12_07_235609_presupuestos', 2),
(48, '2020_12_12_194425_detalles_presupuestos', 2),
(49, '2020_12_13_002727_estados_presupuestos', 2),
(50, '2020_12_15_190141_ordenes_compras', 2),
(51, '2020_12_15_191333_etados_ordenes_compras', 2),
(52, '2020_12_15_212049_detalles_orden_compra', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_compras`
--

CREATE TABLE `ordenes_compras` (
  `OrdenCompraID` bigint(20) UNSIGNED NOT NULL,
  `FechaRegistro` date NOT NULL,
  `Total` decimal(8,2) NOT NULL,
  `PresuID` bigint(20) UNSIGNED NOT NULL,
  `SoliCompraID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordenes_compras`
--

INSERT INTO `ordenes_compras` (`OrdenCompraID`, `FechaRegistro`, `Total`, `PresuID`, `SoliCompraID`) VALUES
(1, '2020-12-16', '28870.00', 1, 10),
(2, '2020-12-16', '96000.00', 2, 9),
(3, '2020-12-17', '30000.00', 3, 11),
(4, '2020-12-17', '30000.00', 3, 11),
(6, '2020-12-17', '4500.00', 5, 13),
(7, '2020-12-17', '4500.00', 5, 13),
(8, '2020-12-17', '28800.00', 6, 14),
(9, '2020-12-17', '18900.00', 6, 14),
(10, '2020-12-17', '61200.00', 7, 15),
(11, '2020-12-17', '63000.00', 8, 16),
(12, '2020-12-17', '40000.00', 9, 17),
(13, '2020-12-17', '40000.00', 10, 18),
(14, '2020-12-17', '712.00', 12, 19),
(15, '2020-12-17', '560.00', 13, 19),
(16, '2020-12-17', '720.00', 14, 19),
(17, '2020-12-17', '406000.00', 15, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `PermisoID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PathAuth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`PermisoID`, `Descripcion`, `PathAuth`, `created_at`, `updated_at`) VALUES
('Alta_Art', 'Permite dar de Alta a un Articulo.', '/Ar/Alta', '2020-12-18 03:24:22', '2020-12-18 03:24:22'),
('Alta_OC', 'Permite dar de Alta una Orden de Compra.', '/OC/Alta', '2020-12-18 03:34:14', '2020-12-18 03:34:14'),
('Alta_Pres', 'Permite dar de Alta un  Presupuesto.', '/Pres/Alta', '2020-12-18 03:28:48', '2020-12-18 03:28:48'),
('Alta_Prov', 'Permite dar de Alta de Proveedores.', '/Prov/Alta', '2020-12-18 03:10:23', '2020-12-18 03:10:23'),
('Alta_SC', 'Permite dar de Alta una Solicitud de Compra.', '/SC/Alta', '2020-12-18 03:26:15', '2020-12-18 03:26:15'),
('Alta_SP', 'Permite dar de Alta una Solicitud de Presupuesto.', '/SP/Alta', '2020-12-18 03:27:22', '2020-12-18 03:27:22'),
('Baja_Art', 'Permite dar de Baja a un Articulo.', '/Ar/Baja', '2020-12-18 03:24:40', '2020-12-18 03:24:40'),
('Baja_Prov', 'Permite dar de Baja de Proveedores.', '/Prov/Baja', '2020-12-18 03:10:36', '2020-12-18 03:10:36'),
('Baja_SC', 'Permite dar de Baja una Solicitud de Compra.', '/SC/Baja', '2020-12-18 03:26:28', '2020-12-18 03:26:28'),
('Consultar_Art', 'Permite Consultar un Articulo.', '/Ar/Consultar', '2020-12-18 03:26:00', '2020-12-18 03:26:00'),
('Consultar_OC', 'Permite Consultar una Orden de Compra.', '/OC/Modificar', '2020-12-18 03:34:56', '2020-12-18 03:34:56'),
('Consultar_Pres', 'Permite Consultar  Presupuestos.', '/Pres/Modificar', '2020-12-18 03:28:25', '2020-12-18 03:28:25'),
('Consultar_Prov', 'Permite Consultar Proveedores.', '/Prov/Consultar', '2020-12-18 03:11:13', '2020-12-18 03:11:13'),
('Consultar_ProvAr', 'Permite Consultar vinculaciones de Proveedores que tenga un Articulo.', '/ProvAr/Consultar', '2020-12-18 03:23:10', '2020-12-18 03:23:10'),
('Consultar_SC', 'Permite Consultar una Solicitud de Compra.', '/SC/Consultar', '2020-12-18 03:26:55', '2020-12-18 03:26:55'),
('Consultar_SP', 'Permite Consultar Solicitudes de Presupuesto.', '/SP/Consultar', '2020-12-18 03:27:54', '2020-12-18 03:27:54'),
('DesVincular_ProvAr', 'Permite Desvincular Proveedores a un Articulo.', '/ProvAr/Desvincular', '2020-12-18 03:22:06', '2020-12-18 03:22:06'),
('Modificar_Art', 'Permite Modificar un Articulo.', '/Ar/Modificar', '2020-12-18 03:25:17', '2020-12-18 03:25:17'),
('Modificar_OC', 'Permite Modificar una Orden de Compra.', '/OC/Consultar', '2020-12-18 03:34:40', '2020-12-18 03:34:40'),
('Modificar_Pres', 'Permite Modificar un  Presupuesto.', '/Pres/Consultar', '2020-12-18 03:33:31', '2020-12-18 03:33:31'),
('Modificar_Prov', 'Permite Modificar Proveedores.', '/Prov/Modificar', '2020-12-18 03:10:54', '2020-12-18 03:10:54'),
('Modificar_SC', 'Permite Modificar una Solicitud de Compra.', '/SC/Modificar', '2020-12-18 03:26:41', '2020-12-18 03:26:41'),
('Vincular_ProvAr', 'Permite Vincular un Proveedor a un Articulo.', '/ProvAr/Vincular', '2020-12-18 21:00:01', '2020-12-18 21:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Legajo` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DNI` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cuil` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Activo` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Legajo`, `Nombre`, `Apellido`, `DNI`, `Cuil`, `telefono`, `Mail`, `Direccion`, `Activo`, `created_at`, `updated_at`) VALUES
(0, 'admin', 'admin', '0', '0', '0', 'admin@sigcom', '0', 1, '2020-12-12 23:06:43', NULL),
(1, 'Julio Cesar', 'Mejias', '20551467', '20215856', '1', 'julio_mejias@hotmail.com', 'Guido 262', 1, '2020-12-13 02:14:26', '2020-12-18 00:52:15'),
(2, 'Jesus Andres', 'Gonzalez', '31541545', '20315415454', '232146585', 'jesus@sigcom.com', '9 de Julio 315', 1, NULL, NULL),
(3, 'Hector Oscar', 'Varine', '27211531', '20272115314', '480600', 'pochi@sigcom.com', 'Balcarce 634', 1, NULL, NULL),
(4, 'Persona 4', 'Persona 4', '4', '4', '4', 'per@sigcom.com', '4', 0, '2020-12-18 00:56:13', '2020-12-18 00:56:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuestos`
--

CREATE TABLE `presupuestos` (
  `PresupuestoID` bigint(20) UNSIGNED NOT NULL,
  `NroPresupuesto` bigint(20) UNSIGNED NOT NULL,
  `FechaRegistro` date NOT NULL,
  `FechaValidez` date NOT NULL,
  `FechaEntregaEstimada` date NOT NULL,
  `Total` decimal(8,2) NOT NULL,
  `ProveID` bigint(20) UNSIGNED NOT NULL,
  `SoliPresuID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presupuestos`
--

INSERT INTO `presupuestos` (`PresupuestoID`, `NroPresupuesto`, `FechaRegistro`, `FechaValidez`, `FechaEntregaEstimada`, `Total`, `ProveID`, `SoliPresuID`) VALUES
(1, 21213121, '2020-12-16', '2020-12-23', '2020-12-23', '28870.00', 2, 11),
(2, 21213121, '2020-12-16', '2020-12-22', '2020-12-22', '96000.00', 3, 8),
(3, 21213121, '2020-12-17', '2020-12-30', '2020-12-30', '45000.00', 2, 12),
(4, 21213121, '2020-12-17', '2020-12-25', '2020-12-25', '3400.00', 1, 13),
(5, 21213121, '2020-12-17', '2020-12-23', '2020-12-23', '8700.00', 3, 14),
(6, 21213121, '2020-12-17', '2021-01-07', '2021-01-07', '47700.00', 3, 16),
(7, 21213121, '2020-12-17', '2021-01-05', '2021-01-05', '61200.00', 3, 18),
(8, 21213121, '2020-12-17', '2020-12-30', '2020-12-30', '63000.00', 2, 19),
(9, 21213121, '2020-12-17', '2021-01-09', '2021-01-09', '40000.00', 2, 21),
(10, 21213121, '2020-12-17', '2020-12-31', '2020-12-31', '40000.00', 2, 22),
(11, 1, '2020-12-17', '2020-12-29', '2020-12-29', '3560.00', 1, 3),
(12, 34345, '2020-12-17', '2020-12-29', '2020-12-29', '712.00', 1, 23),
(13, 567, '2020-12-17', '2020-12-28', '2020-12-28', '560.00', 2, 24),
(14, 678, '2020-12-17', '2020-12-29', '2020-12-29', '720.00', 2, 25),
(15, 56456, '2020-12-17', '2020-12-24', '2020-12-24', '406000.00', 1, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ProveedorID` bigint(20) UNSIGNED NOT NULL,
  `Activo` int(11) NOT NULL DEFAULT 1,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Razon_social` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cuit` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Condicion_Iva` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mail` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Localidad` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Provincia` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ProveedorID`, `Activo`, `Nombre`, `Razon_social`, `Cuit`, `Condicion_Iva`, `Direccion`, `Telefono`, `Mail`, `Localidad`, `Provincia`) VALUES
(1, 1, 'Luis', 'luisSA', '1', 'RI', 'micasa', '1234', 'luisangelgallozo@gmail.com', 'Del Viso', 'Buenos Aires'),
(2, 1, 'Nase', 'Nase Hidraulica SRL', '11111', 'RI', 'Av Libertador', '11156485154', 'soporte@nasehidraulica.com.ar', 'CABA', 'Buenos Aires'),
(3, 1, 'Hernan Lopez', 'Lopez Fusco SA', '2524556321', 'RI', 'Calle 2 entre 25/46', '0232156452588', 'helopezfuzco@gmail.com', 'La Plata', 'Buenos Aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `RolID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`RolID`, `created_at`, `updated_at`) VALUES
('Administrador_de_Compras', '2020-12-13 02:22:29', '2020-12-13 02:22:29'),
('Directivo', '2020-12-13 02:23:07', '2020-12-13 02:23:07'),
('Responsable_de_Sector', '2020-12-13 02:22:57', '2020-12-13 02:22:57'),
('Super_Usuario', '2020-12-13 02:23:21', '2020-12-13 02:23:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `RolID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PermisoID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaHoraRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles_permisos`
--

INSERT INTO `roles_permisos` (`RolID`, `PermisoID`, `FechaHoraRegistro`) VALUES
('Administrador_de_Compras', 'Alta_Art', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Alta_OC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Alta_Pres', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Alta_Prov', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Alta_SC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Alta_SP', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Baja_Art', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Baja_Prov', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Baja_SC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_Art', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_OC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_Pres', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_Prov', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_ProvAr', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_SC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Consultar_SP', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'DesVincular_ProvAr', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Modificar_Art', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Modificar_OC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Modificar_Pres', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Modificar_Prov', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Modificar_SC', '2020-12-18 00:00:00'),
('Administrador_de_Compras', 'Vincular_ProvAr', '2020-12-18 00:00:00'),
('Directivo', 'Consultar_OC', '2020-12-18 00:00:00'),
('Directivo', 'Modificar_OC', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Alta_Art', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Alta_SC', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Baja_Art', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Baja_SC', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Consultar_Art', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Consultar_SC', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Modificar_Art', '2020-12-18 00:00:00'),
('Responsable_de_Sector', 'Modificar_SC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_Art', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_OC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_Pres', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_Prov', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_SC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Alta_SP', '2020-12-18 00:00:00'),
('Super_Usuario', 'Baja_Art', '2020-12-18 00:00:00'),
('Super_Usuario', 'Baja_Prov', '2020-12-18 00:00:00'),
('Super_Usuario', 'Baja_SC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_Art', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_OC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_Pres', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_Prov', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_ProvAr', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_SC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Consultar_SP', '2020-12-18 00:00:00'),
('Super_Usuario', 'DesVincular_ProvAr', '2020-12-18 00:00:00'),
('Super_Usuario', 'Modificar_Art', '2020-12-18 00:00:00'),
('Super_Usuario', 'Modificar_OC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Modificar_Pres', '2020-12-18 00:00:00'),
('Super_Usuario', 'Modificar_Prov', '2020-12-18 00:00:00'),
('Super_Usuario', 'Modificar_SC', '2020-12-18 00:00:00'),
('Super_Usuario', 'Vincular_ProvAr', '2020-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `SectorID` bigint(20) UNSIGNED NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Persona_a_cargo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`SectorID`, `Descripcion`, `Persona_a_cargo`, `created_at`, `updated_at`, `Activo`) VALUES
(1, 'SectorFicticio', 4, '2020-12-18 16:07:50', '2020-12-18 16:07:50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HD2Gy3YBJlMrvFuAb3u3ss8IKltpGeHOJQp1Dq6C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibEtReFZLd3BpQnV5Rk1lNjNQR0xzVzVkSUtQNzM2NTZta3U0NWlvcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXN0aW9uQXJ0aWN1bG9zL21lbnUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkOHZtYWt1eHJVQW45ZHVpWEJiNmJsLkhlVlZyZ0xuNThIRXhCMGxzeThxYXBkdHcxdzU0NEsiO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJDh2bWFrdXhyVUFuOWR1aVhCYjZibC5IZVZWcmdMbjU4SEV4QjBsc3k4cWFwZHR3MXc1NDRLIjt9', 1608314455);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_presupuestos`
--

CREATE TABLE `solicitudes_presupuestos` (
  `SolicitudPresupuestoID` bigint(20) UNSIGNED NOT NULL,
  `FechaRegistro` date NOT NULL,
  `AdminComprasID` bigint(20) UNSIGNED NOT NULL,
  `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes_presupuestos`
--

INSERT INTO `solicitudes_presupuestos` (`SolicitudPresupuestoID`, `FechaRegistro`, `AdminComprasID`, `SolicitudCompraID`) VALUES
(3, '2020-12-15', 2, 4),
(4, '2020-12-16', 2, 7),
(5, '2020-12-16', 2, 7),
(6, '2020-12-16', 2, 8),
(7, '2020-12-16', 2, 9),
(8, '2020-12-16', 2, 9),
(9, '2020-12-16', 2, 6),
(10, '2020-12-16', 2, 10),
(11, '2020-12-16', 2, 10),
(12, '2020-12-17', 2, 11),
(13, '2020-12-17', 2, 13),
(14, '2020-12-17', 2, 13),
(15, '2020-12-17', 2, 14),
(16, '2020-12-17', 2, 14),
(17, '2020-12-17', 2, 15),
(18, '2020-12-17', 2, 15),
(19, '2020-12-17', 2, 16),
(20, '2020-12-17', 2, 16),
(21, '2020-12-17', 1, 17),
(22, '2020-12-17', 3, 18),
(23, '2020-12-17', 2, 19),
(24, '2020-12-17', 2, 19),
(25, '2020-12-17', 2, 19),
(26, '2020-12-17', 2, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_compras`
--

CREATE TABLE `solicitud_compras` (
  `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL,
  `FechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitud_compras`
--

INSERT INTO `solicitud_compras` (`SolicitudCompraID`, `FechaRegistro`) VALUES
(4, '2020-12-15'),
(5, '2020-12-15'),
(6, '2020-12-15'),
(7, '2020-12-16'),
(8, '2020-12-16'),
(9, '2020-12-16'),
(10, '2020-12-16'),
(11, '2020-12-17'),
(12, '2020-12-17'),
(13, '2020-12-17'),
(14, '2020-12-17'),
(15, '2020-12-17'),
(16, '2020-12-17'),
(17, '2020-12-17'),
(18, '2020-12-17'),
(19, '2020-12-17'),
(20, '2020-12-17'),
(21, '2020-12-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soli_presu_prove`
--

CREATE TABLE `soli_presu_prove` (
  `SolicitudPresupuestoID` bigint(20) UNSIGNED NOT NULL,
  `ProveedorID` bigint(20) UNSIGNED NOT NULL,
  `FechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Legajo` int(11) NOT NULL,
  `Activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`, `Legajo`, `Activo`) VALUES
(1, 'admin', 'admin@sigcom.com', NULL, '$2y$10$8vmakuxrUAn9duiXBb6bl.HeVVrgLn58HExB0lsy8qapdtw1w544K', NULL, NULL, NULL, NULL, '2020-12-13 02:13:24', '2020-12-13 02:13:24', 0, 1),
(2, 'julio', 'julio@sigcom.com', NULL, '$2y$10$uPMQr6zTHxIg6BWB7siA8.20PpAIxGweNwf/e8m9aN.PTWdoieUj.', NULL, NULL, NULL, NULL, '2020-12-13 02:27:01', '2020-12-13 02:27:01', 1, 1),
(3, 'jesus', 'jesus@sigcom.com', NULL, '$2y$10$Eaj671eDM8gr8r1w5wKstOUvK.lWUFXIZHGBnSrl4CZUmz7wjH8V.', NULL, NULL, NULL, NULL, '2020-12-17 20:41:33', '2020-12-17 20:41:33', 2, 1),
(4, 'hector', 'pochi@sigcom.com', NULL, '$2y$10$2LuFR8UMcq8vB5ws0XGL4ee6FIvHNjXsnFGqpjzt3BQspDjTIUxOu', NULL, NULL, NULL, NULL, '2020-12-17 23:30:15', '2020-12-17 23:30:15', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

CREATE TABLE `usuarios_roles` (
  `RolID` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UsuarioID` bigint(20) UNSIGNED NOT NULL,
  `FechaHoraRegistro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`RolID`, `UsuarioID`, `FechaHoraRegistro`) VALUES
('Administrador_de_Compras', 2, '2020-12-12 20:31:09'),
('Directivo', 4, '0000-00-00 00:00:00'),
('Responsable_de_Sector', 3, '2020-12-17 14:42:59'),
('Super_Usuario', 1, '2020-12-12 20:24:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`ArticuloID`);

--
-- Indices de la tabla `articulo_proveedor`
--
ALTER TABLE `articulo_proveedor`
  ADD PRIMARY KEY (`ArticuloID`,`ProveedorID`),
  ADD KEY `articulo_proveedor_proveedorid_foreign` (`ProveedorID`);

--
-- Indices de la tabla `detalles_orden_compra`
--
ALTER TABLE `detalles_orden_compra`
  ADD PRIMARY KEY (`ArticuloID`,`OrdenCompraID`),
  ADD KEY `detalles_orden_compra_ordencompraid_foreign` (`OrdenCompraID`);

--
-- Indices de la tabla `detalles_presupuestos`
--
ALTER TABLE `detalles_presupuestos`
  ADD PRIMARY KEY (`ArticuloID`,`PresupuestoID`),
  ADD KEY `detalles_presupuestos_presupuestoid_foreign` (`PresupuestoID`);

--
-- Indices de la tabla `detalles_solicitud_compras`
--
ALTER TABLE `detalles_solicitud_compras`
  ADD PRIMARY KEY (`ArticuloID`,`SolicitudCompraID`),
  ADD KEY `detalles_solicitud_compras_solicitudcompraid_foreign` (`SolicitudCompraID`);

--
-- Indices de la tabla `deta_soli_presu`
--
ALTER TABLE `deta_soli_presu`
  ADD PRIMARY KEY (`ArtiID`,`SoliPresuID`,`ProveID`),
  ADD KEY `deta_soli_presu_solipresuid_foreign` (`SoliPresuID`),
  ADD KEY `deta_soli_presu_proveid_foreign` (`ProveID`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`EstadoID`);

--
-- Indices de la tabla `estados_ordenes_compras`
--
ALTER TABLE `estados_ordenes_compras`
  ADD PRIMARY KEY (`EstadoID`,`OrdenCompraID`),
  ADD KEY `estados_ordenes_compras_idaprobador_foreign` (`IDAprobador`),
  ADD KEY `estados_ordenes_compras_ordencompraid_foreign` (`OrdenCompraID`),
  ADD KEY `estados_ordenes_compras_admincomprasid_foreign` (`AdminComprasID`);

--
-- Indices de la tabla `estados_presupuestos`
--
ALTER TABLE `estados_presupuestos`
  ADD PRIMARY KEY (`EstadoID`,`PresupuestoID`),
  ADD KEY `estados_presupuestos_presupuestoid_foreign` (`PresupuestoID`),
  ADD KEY `estados_presupuestos_admincomprasid_foreign` (`AdminComprasID`);

--
-- Indices de la tabla `estados_solicitud_compras`
--
ALTER TABLE `estados_solicitud_compras`
  ADD PRIMARY KEY (`EstadoID`,`SolicitudCompraID`),
  ADD KEY `estados_solicitud_compras_solicitudcompraid_foreign` (`SolicitudCompraID`),
  ADD KEY `estados_solicitud_compras_responsableid_foreign` (`ResponsableID`),
  ADD KEY `estados_solicitud_compras_admincomprasid_foreign` (`AdminComprasID`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  ADD PRIMARY KEY (`OrdenCompraID`),
  ADD KEY `ordenes_compras_presuid_foreign` (`PresuID`),
  ADD KEY `ordenes_compras_solicompraid_foreign` (`SoliCompraID`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`PermisoID`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Legajo`);

--
-- Indices de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD PRIMARY KEY (`PresupuestoID`),
  ADD KEY `presupuestos_solipresuid_foreign` (`SoliPresuID`),
  ADD KEY `presupuestos_proveid_foreign` (`ProveID`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ProveedorID`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RolID`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`RolID`,`PermisoID`),
  ADD KEY `roles_permisos_permisoid_foreign` (`PermisoID`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`SectorID`),
  ADD KEY `sectores_persona_a_cargo_foreign` (`Persona_a_cargo`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `solicitudes_presupuestos`
--
ALTER TABLE `solicitudes_presupuestos`
  ADD PRIMARY KEY (`SolicitudPresupuestoID`),
  ADD KEY `solicitudes_presupuestos_solicitudcompraid_foreign` (`SolicitudCompraID`),
  ADD KEY `solicitudes_presupuestos_admincomprasid_foreign` (`AdminComprasID`);

--
-- Indices de la tabla `solicitud_compras`
--
ALTER TABLE `solicitud_compras`
  ADD PRIMARY KEY (`SolicitudCompraID`);

--
-- Indices de la tabla `soli_presu_prove`
--
ALTER TABLE `soli_presu_prove`
  ADD PRIMARY KEY (`ProveedorID`,`SolicitudPresupuestoID`),
  ADD KEY `soli_presu_prove_solicitudpresupuestoid_foreign` (`SolicitudPresupuestoID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_legajo_foreign` (`Legajo`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`RolID`,`UsuarioID`),
  ADD KEY `usuarios_roles_usuarioid_foreign` (`UsuarioID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `ArticuloID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  MODIFY `OrdenCompraID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `PresupuestoID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ProveedorID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `SectorID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitudes_presupuestos`
--
ALTER TABLE `solicitudes_presupuestos`
  MODIFY `SolicitudPresupuestoID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `solicitud_compras`
--
ALTER TABLE `solicitud_compras`
  MODIFY `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo_proveedor`
--
ALTER TABLE `articulo_proveedor`
  ADD CONSTRAINT `articulo_proveedor_articuloid_foreign` FOREIGN KEY (`ArticuloID`) REFERENCES `articulos` (`ArticuloID`),
  ADD CONSTRAINT `articulo_proveedor_proveedorid_foreign` FOREIGN KEY (`ProveedorID`) REFERENCES `proveedores` (`ProveedorID`);

--
-- Filtros para la tabla `detalles_orden_compra`
--
ALTER TABLE `detalles_orden_compra`
  ADD CONSTRAINT `detalles_orden_compra_articuloid_foreign` FOREIGN KEY (`ArticuloID`) REFERENCES `articulos` (`ArticuloID`),
  ADD CONSTRAINT `detalles_orden_compra_ordencompraid_foreign` FOREIGN KEY (`OrdenCompraID`) REFERENCES `ordenes_compras` (`OrdenCompraID`);

--
-- Filtros para la tabla `detalles_presupuestos`
--
ALTER TABLE `detalles_presupuestos`
  ADD CONSTRAINT `detalles_presupuestos_articuloid_foreign` FOREIGN KEY (`ArticuloID`) REFERENCES `articulos` (`ArticuloID`),
  ADD CONSTRAINT `detalles_presupuestos_presupuestoid_foreign` FOREIGN KEY (`PresupuestoID`) REFERENCES `presupuestos` (`PresupuestoID`);

--
-- Filtros para la tabla `detalles_solicitud_compras`
--
ALTER TABLE `detalles_solicitud_compras`
  ADD CONSTRAINT `detalles_solicitud_compras_articuloid_foreign` FOREIGN KEY (`ArticuloID`) REFERENCES `articulos` (`ArticuloID`),
  ADD CONSTRAINT `detalles_solicitud_compras_solicitudcompraid_foreign` FOREIGN KEY (`SolicitudCompraID`) REFERENCES `solicitud_compras` (`SolicitudCompraID`);

--
-- Filtros para la tabla `deta_soli_presu`
--
ALTER TABLE `deta_soli_presu`
  ADD CONSTRAINT `deta_soli_presu_artiid_foreign` FOREIGN KEY (`ArtiID`) REFERENCES `articulos` (`ArticuloID`),
  ADD CONSTRAINT `deta_soli_presu_proveid_foreign` FOREIGN KEY (`ProveID`) REFERENCES `proveedores` (`ProveedorID`),
  ADD CONSTRAINT `deta_soli_presu_solipresuid_foreign` FOREIGN KEY (`SoliPresuID`) REFERENCES `solicitudes_presupuestos` (`SolicitudPresupuestoID`);

--
-- Filtros para la tabla `estados_ordenes_compras`
--
ALTER TABLE `estados_ordenes_compras`
  ADD CONSTRAINT `estados_ordenes_compras_admincomprasid_foreign` FOREIGN KEY (`AdminComprasID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estados_ordenes_compras_estadoid_foreign` FOREIGN KEY (`EstadoID`) REFERENCES `estados` (`EstadoID`),
  ADD CONSTRAINT `estados_ordenes_compras_idaprobador_foreign` FOREIGN KEY (`IDAprobador`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estados_ordenes_compras_ordencompraid_foreign` FOREIGN KEY (`OrdenCompraID`) REFERENCES `ordenes_compras` (`OrdenCompraID`);

--
-- Filtros para la tabla `estados_presupuestos`
--
ALTER TABLE `estados_presupuestos`
  ADD CONSTRAINT `estados_presupuestos_admincomprasid_foreign` FOREIGN KEY (`AdminComprasID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estados_presupuestos_estadoid_foreign` FOREIGN KEY (`EstadoID`) REFERENCES `estados` (`EstadoID`),
  ADD CONSTRAINT `estados_presupuestos_presupuestoid_foreign` FOREIGN KEY (`PresupuestoID`) REFERENCES `presupuestos` (`PresupuestoID`);

--
-- Filtros para la tabla `estados_solicitud_compras`
--
ALTER TABLE `estados_solicitud_compras`
  ADD CONSTRAINT `estados_solicitud_compras_admincomprasid_foreign` FOREIGN KEY (`AdminComprasID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estados_solicitud_compras_estadoid_foreign` FOREIGN KEY (`EstadoID`) REFERENCES `estados` (`EstadoID`),
  ADD CONSTRAINT `estados_solicitud_compras_responsableid_foreign` FOREIGN KEY (`ResponsableID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `estados_solicitud_compras_solicitudcompraid_foreign` FOREIGN KEY (`SolicitudCompraID`) REFERENCES `solicitud_compras` (`SolicitudCompraID`);

--
-- Filtros para la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  ADD CONSTRAINT `ordenes_compras_presuid_foreign` FOREIGN KEY (`PresuID`) REFERENCES `presupuestos` (`PresupuestoID`),
  ADD CONSTRAINT `ordenes_compras_solicompraid_foreign` FOREIGN KEY (`SoliCompraID`) REFERENCES `solicitud_compras` (`SolicitudCompraID`);

--
-- Filtros para la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  ADD CONSTRAINT `presupuestos_proveid_foreign` FOREIGN KEY (`ProveID`) REFERENCES `proveedores` (`ProveedorID`),
  ADD CONSTRAINT `presupuestos_solipresuid_foreign` FOREIGN KEY (`SoliPresuID`) REFERENCES `solicitudes_presupuestos` (`SolicitudPresupuestoID`);

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_permisoid_foreign` FOREIGN KEY (`PermisoID`) REFERENCES `permisos` (`PermisoID`),
  ADD CONSTRAINT `roles_permisos_rolid_foreign` FOREIGN KEY (`RolID`) REFERENCES `roles` (`RolID`);

--
-- Filtros para la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD CONSTRAINT `sectores_persona_a_cargo_foreign` FOREIGN KEY (`Persona_a_cargo`) REFERENCES `personas` (`Legajo`);

--
-- Filtros para la tabla `solicitudes_presupuestos`
--
ALTER TABLE `solicitudes_presupuestos`
  ADD CONSTRAINT `solicitudes_presupuestos_admincomprasid_foreign` FOREIGN KEY (`AdminComprasID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitudes_presupuestos_solicitudcompraid_foreign` FOREIGN KEY (`SolicitudCompraID`) REFERENCES `solicitud_compras` (`SolicitudCompraID`);

--
-- Filtros para la tabla `soli_presu_prove`
--
ALTER TABLE `soli_presu_prove`
  ADD CONSTRAINT `soli_presu_prove_proveedorid_foreign` FOREIGN KEY (`ProveedorID`) REFERENCES `proveedores` (`ProveedorID`),
  ADD CONSTRAINT `soli_presu_prove_solicitudpresupuestoid_foreign` FOREIGN KEY (`SolicitudPresupuestoID`) REFERENCES `solicitudes_presupuestos` (`SolicitudPresupuestoID`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_legajo_foreign` FOREIGN KEY (`Legajo`) REFERENCES `personas` (`Legajo`);

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_rolid_foreign` FOREIGN KEY (`RolID`) REFERENCES `roles` (`RolID`),
  ADD CONSTRAINT `usuarios_roles_usuarioid_foreign` FOREIGN KEY (`UsuarioID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
