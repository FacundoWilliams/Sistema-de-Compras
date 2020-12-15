-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2020 a las 00:51:47
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
(1, 1, 'articulo 1', 'Bolsa', 'Unidad', 3, 5, 0);

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
(1, 1, '2020-12-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_orden_compra`
--

CREATE TABLE `detalles_orden_compra` (
  `ArticuloID` bigint(20) UNSIGNED NOT NULL,
  `OrdenCompraID` bigint(20) UNSIGNED NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `PrecioUnitario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_orden_compra`
--

INSERT INTO `detalles_orden_compra` (`ArticuloID`, `OrdenCompraID`, `Cantidad`, `PrecioUnitario`) VALUES
(1, 1, 89, 1);

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
(1, 1, 89, NULL, 1.00, 0.00);

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
(90, '2020-12-29', 1, 6);

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
(89, '2020-12-22', 1, 3, 1);

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
('Finalizado'),
('Pendiente'),
('Procesado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_ordenes_compras`
--

CREATE TABLE `estados_ordenes_compras` (
  `EstadoID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrdenCompraID` bigint(20) UNSIGNED NOT NULL,
  `AdminComprasID` bigint(20) UNSIGNED NOT NULL,
  `FechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados_ordenes_compras`
--

INSERT INTO `estados_ordenes_compras` (`EstadoID`, `OrdenCompraID`, `AdminComprasID`, `FechaHora`) VALUES
('Pendiente', 1, 2, '2020-12-15 00:00:00');

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
('Pendiente', 1, 2, '2020-12-15 00:00:00');

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
('Pendiente', '2020-12-15 00:00:00', 2, NULL, 6),
('Procesado', '2020-12-15 00:00:00', 2, NULL, 4);

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
(40, '2020_12_07_235609_presupuestos', 2),
(41, '2020_12_12_194425_detalles_presupuestos', 2),
(42, '2020_12_13_002727_estados_presupuestos', 2),
(43, '2020_12_15_190141_ordenes_compras', 2),
(44, '2020_12_15_191333_etados_ordenes_compras', 2),
(45, '2020_12_15_212049_detalles_orden_compra', 2);

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
(1, '2020-12-15', '0.00', 1, 4);

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
('Alta_SC', 'Permite Alta de Solicitud Compra.', '/solicitudesCompras/Alta', '2020-12-13 02:21:45', '2020-12-13 02:21:45');

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
(1, 'persona', 'persona', '1', '1', '1', 'persona@sigcom.com', '1', 1, '2020-12-13 02:14:26', '2020-12-13 02:14:26');

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
(1, 1, '2020-12-15', '2020-12-30', '2020-12-30', '89.00', 1, 3);

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
(1, 1, 'Luis', 'luisSA', '1', 'RI', 'micasa', '1234', 'luisangelgallozo@gmail.com', 'Del Viso', 'Buenos Aires');

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
('Responsable_de_Sector', 'Alta_SC', '2020-12-12 20:24:03');

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
('j12szrMwKEQnks2FSNzlS08m7HrdQAWfaxuetxN2', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoibHRnQm1EbFRVV0tMRHV6TW1SQkdhRFFCZHRBRTRmbFVtRm9KR09iSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXN0aW9uQ29tcHJhcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCR1UE1RcjZ6VEh4SWc2QldCN3NpQTguMjBQcEFJeEd3ZU53Zi9lOG05YU4uUFRXZG9pZVVqLiI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkdVBNUXI2elRIeElnNkJXQjdzaUE4LjIwUHBBSXhHd2VOd2YvZThtOWFOLlBUV2RvaWVVai4iO30=', 1608076239);

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
(3, '2020-12-15', 2, 4);

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
(6, '2020-12-15');

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
(2, 'julio', 'julio@sigcom.com', NULL, '$2y$10$uPMQr6zTHxIg6BWB7siA8.20PpAIxGweNwf/e8m9aN.PTWdoieUj.', NULL, NULL, NULL, NULL, '2020-12-13 02:27:01', '2020-12-13 02:27:01', 1, 1);

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
('Responsable_de_Sector', 2, '2020-12-12 20:31:09'),
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
  MODIFY `ArticuloID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `ordenes_compras`
--
ALTER TABLE `ordenes_compras`
  MODIFY `OrdenCompraID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuestos`
--
ALTER TABLE `presupuestos`
  MODIFY `PresupuestoID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ProveedorID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `SectorID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes_presupuestos`
--
ALTER TABLE `solicitudes_presupuestos`
  MODIFY `SolicitudPresupuestoID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_compras`
--
ALTER TABLE `solicitud_compras`
  MODIFY `SolicitudCompraID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
