-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-04-2025 a las 17:32:00
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compra_optimizada`
--
CREATE DATABASE IF NOT EXISTS `compra_optimizada` DEFAULT CHARACTER SET utf16 COLLATE utf16_spanish_ci;
USE `compra_optimizada`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SP_AgregarProducto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AgregarProducto` (IN `nombreProd` VARCHAR(100), IN `descProd` TEXT, IN `precioProd` DECIMAL(10,2), IN `stockProd` INT)   BEGIN
    INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (nombreProd, descProd, precioProd, stockProd);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int DEFAULT NULL,
  `id_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;


--
-- Disparadores `detalle_pedido`
--
DROP TRIGGER IF EXISTS `TRG_ActualizarStock`;
DELIMITER $$
CREATE TRIGGER `TRG_ActualizarStock` AFTER INSERT ON `detalle_pedido` FOR EACH ROW BEGIN
    UPDATE productos SET stock = stock - NEW.cantidad WHERE id = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `estado` enum('pendiente','completado','cancelado') COLLATE utf16_spanish_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_pedidos_usuarios` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_eventos`
--

DROP TABLE IF EXISTS `procesos_eventos`;
CREATE TABLE IF NOT EXISTS `procesos_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `objeto` varchar(255) COLLATE utf16_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf16_spanish_ci NOT NULL,
  `moneda` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  `presupuesto` decimal(15,2) NOT NULL,
  `actividad` varchar(255) COLLATE utf16_spanish_ci NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_cierre` datetime NOT NULL,
  `estado` enum('ACTIVO','PUBLICADO','EVALUACIÓN') COLLATE utf16_spanish_ci DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_proceso_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf16_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf16_spanish_ci,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf16_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf16_spanish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf16_spanish_ci DEFAULT NULL,
  `rol` enum('cliente','admin') COLLATE utf16_spanish_ci DEFAULT NULL,
  `creado_en` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `creado_en`) VALUES
(3, 'Jan perez', 'ejemplocorreo@gmail.com', '$2y$10$fre7L822kcObJN7ekQtWLuTnj2ivKxMK8n8YJQSfOFrNduoSnQfDa', 'cliente', '2025-04-04 07:39:11'),
(2, 'Alejandro Osorio', 'yesitalejandroosorio@gmail.com', '$2y$10$eXlKqoPGji27Z9WuuVfWeuOilE6Uk3GQOYLDVOQo.97MW5tdqGdDm', 'admin', '2025-04-04 05:05:57');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
