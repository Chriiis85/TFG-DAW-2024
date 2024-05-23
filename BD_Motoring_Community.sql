-- --------------------------------------------------------
-- Base de datos: `motoring_community`
-- --------------------------------------------------------
-- Drop the existing database if it exists
DROP DATABASE IF EXISTS motoring_community;

-- Create a new database
CREATE DATABASE motoring_community;

-- Select the newly created database
USE motoring_community;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `users`
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `surname` VARCHAR(50) NOT NULL,
  `pwd` VARCHAR(100) NOT NULL,
  `verified` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

-- Volcado de datos para la tabla `users`
INSERT INTO `users` (`id`, `username`, `name`, `surname`, `pwd`, `verified`) VALUES
(1, 'Chris', 'Christian', 'Moreno Diaz', '12345', 1),
(2, 'Suri', 'Suriñe', 'Garrido Lozoyo', '12345', 1),
(3, 'admin', 'admin', 'admin', 'admin', 1);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `themes`
-- --------------------------------------------------------
CREATE TABLE `themes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo_tema` VARCHAR(255) NOT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `id_usuario` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `themes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Volcado de datos para la tabla `themes`
INSERT INTO `themes` (`id`, `titulo_tema`, `date`, `id_usuario`) VALUES
(3, 'Nuevas Reglas del Foro', '2024-05-12 10:48:09', 1),
(4, 'Discusión sobre Autos Eléctricos', '2024-05-12 10:48:09', 1),
(5, 'Prueba para decir que quiero mucho a mi novia', '2024-05-12 11:25:18', 2);

-- --------------------------------------------------------
-- Estructura de tabla para la tabla `posts`
-- --------------------------------------------------------
CREATE TABLE `posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `contenido` TEXT DEFAULT NULL,
  `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `id_usuario` INT(11) DEFAULT NULL,
  `id_theme` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_theme` (`id_theme`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_theme`) REFERENCES `themes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Volcado de datos para la tabla `posts`
INSERT INTO `posts` (`id`, `contenido`, `date`, `id_usuario`, `id_theme`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2024-05-12 10:49:33', 1, 3),
(2, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-05-12 10:49:33', 1, 3),
(3, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-05-12 10:49:33', 2, 4),
(4, 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2024-05-12 10:49:33', 1, 4),
(5, 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2024-05-12 10:49:33', 2, 4),
(6, 'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.', '2024-05-12 10:49:33', 2, 3),
(7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '2024-05-12 10:49:33', 2, 4),
(8, 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-05-12 10:49:33', 1, 4),
(9, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-05-12 10:49:33', 1, 3),
(10, 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2024-05-12 10:49:33', 2, 4),
(12, 'Ultimo de prieba', '2024-05-12 10:52:23', 1, 3);