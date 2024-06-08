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
(1, 'admin', 'admin', 'admin', 'admin', 1),
(2, 'Chris', 'Christian', 'Moreno Diaz', 'Abcdef1*', 1),
(3, 'Suriñe', 'Suriñe', 'Garrido Lozoyo', 'Abcdef1*', 1),
(4, 'Sheila', 'Sheila', 'Moreno Diaz', 'Abcdef1*', 1),
(5, 'Nadalina', 'Nani', 'Moreno Diaz', 'Abcdef1*', 1);

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
INSERT INTO `themes` (`titulo_tema`, `date`, `id_usuario`) VALUES
('Innovaciones Tecnológicas en la Temporada 2024', '2024-05-12 10:48:09', 3),
('Análisis de las Estrategias de Carrera en el Gran Premio de Mónaco', '2024-03-01 23:18:29', 4),
('La Evolución de los Pilotos Novatos en la Fórmula 1','2024-06-06 07:18:00', 2);


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
INSERT INTO `posts` (`contenido`, `date`, `id_usuario`, `id_theme`) VALUES
('La Fórmula 1 es conocida por ser la cúspide del automovilismo, donde solo los mejores pilotos del mundo pueden competir. La evolución de los pilotos novatos en la Fórmula 1 ha sido un tema de gran interés a lo largo de los años. Desde los primeros días del campeonato mundial en 1950, los pilotos novatos han tenido que demostrar su valía en un entorno altamente competitivo y desafiante.

Uno de los factores clave en la evolución de los pilotos novatos es el nivel de preparación con el que ingresan a la Fórmula 1. En las décadas pasadas, muchos pilotos llegaban a la Fórmula 1 con poca experiencia en categorías inferiores. Sin embargo, en la actualidad, la mayoría de los novatos han pasado años compitiendo en categorías de monoplazas como la Fórmula 2, Fórmula 3, o incluso en otras disciplinas como el karting y la Fórmula E. Esto les proporciona una base sólida de habilidades y experiencia antes de dar el salto a la máxima categoría.

La tecnología y la formación también han jugado un papel crucial en esta evolución. Los simuladores de conducción, que replican con gran precisión las condiciones de una carrera de Fórmula 1, permiten a los pilotos novatos familiarizarse con los circuitos y los coches antes de su debut. Además, los equipos de Fórmula 1 ahora invierten significativamente en programas de desarrollo de pilotos jóvenes, ofreciendo tutoría y apoyo continuo para ayudarles a adaptarse rápidamente.

Otro aspecto importante es la gestión de la presión. La Fórmula 1 es un deporte donde los errores pueden ser costosos y las expectativas son altas. Los pilotos novatos deben aprender a manejar la presión mediática y la presión interna del equipo para rendir al máximo nivel. Aquellos que logran adaptarse rápidamente a este entorno suelen tener más éxito y carreras más largas en la Fórmula 1.

La historia de la Fórmula 1 está llena de ejemplos de pilotos novatos que se han convertido en grandes campeones. Desde Ayrton Senna y Michael Schumacher hasta Lewis Hamilton y Max Verstappen, muchos de los mejores pilotos de la historia han comenzado como novatos prometedores. Su capacidad para adaptarse rápidamente, aprender y evolucionar ha sido fundamental para su éxito en la Fórmula 1.

En conclusión, la evolución de los pilotos novatos en la Fórmula 1 es un proceso complejo y multifacético que requiere una combinación de talento natural, preparación exhaustiva, y la capacidad de manejar la presión. A medida que la tecnología y los programas de desarrollo de pilotos continúan avanzando, podemos esperar que los futuros novatos lleguen a la Fórmula 1 más preparados que nunca, listos para dejar su huella en el deporte.', CURRENT_TIMESTAMP, 5, 3);

INSERT INTO `posts` (`contenido`, `date`, `id_usuario`, `id_theme`) VALUES
('La Fórmula 1 es conocida por ser la cúspide del automovilismo, donde solo los mejores pilotos del mundo pueden competir. La evolución de los pilotos novatos en la Fórmula 1 ha sido un tema de gran interés a lo largo de los años. Desde los primeros días del campeonato mundial en 1950, los pilotos novatos han tenido que demostrar su valía en un entorno altamente competitivo y desafiante.

Uno de los factores clave en la evolución de los pilotos novatos es el nivel de preparación con el que ingresan a la Fórmula 1. En las décadas pasadas, muchos pilotos llegaban a la Fórmula 1 con poca experiencia en categorías inferiores. Sin embargo, en la actualidad, la mayoría de los novatos han pasado años compitiendo en categorías de monoplazas como la Fórmula 2, Fórmula 3, o incluso en otras disciplinas como el karting y la Fórmula E. Esto les proporciona una base sólida de habilidades y experiencia antes de dar el salto a la máxima categoría.', CURRENT_TIMESTAMP, 4, 3),

('La tecnología y la formación también han jugado un papel crucial en esta evolución. Los simuladores de conducción, que replican con gran precisión las condiciones de una carrera de Fórmula 1, permiten a los pilotos novatos familiarizarse con los circuitos y los coches antes de su debut. Además, los equipos de Fórmula 1 ahora invierten significativamente en programas de desarrollo de pilotos jóvenes, ofreciendo tutoría y apoyo continuo para ayudarles a adaptarse rápidamente.', CURRENT_TIMESTAMP, 2, 3),

('Otro aspecto importante es la gestión de la presión. La Fórmula 1 es un deporte donde los errores pueden ser costosos y las expectativas son altas. Los pilotos novatos deben aprender a manejar la presión mediática y la presión interna del equipo para rendir al máximo nivel. Aquellos que logran adaptarse rápidamente a este entorno suelen tener más éxito y carreras más largas en la Fórmula 1.

La historia de la Fórmula 1 está llena de ejemplos de pilotos novatos que se han convertido en grandes campeones. Desde Ayrton Senna y Michael Schumacher hasta Lewis Hamilton y Max Verstappen, muchos de los mejores pilotos de la historia han comenzado como novatos prometedores. Su capacidad para adaptarse rápidamente, aprender y evolucionar ha sido fundamental para su éxito en la Fórmula 1.', CURRENT_TIMESTAMP, 3, 3);

INSERT INTO `posts` (`contenido`, `date`, `id_usuario`, `id_theme`) VALUES
('La temporada 2024 de la Fórmula 1 promete ser una de las más innovadoras en términos de tecnología. Los equipos están adoptando nuevas tecnologías y enfoques para mejorar el rendimiento de sus coches y mantenerse competitivos. Entre las innovaciones más destacadas se encuentra el uso de materiales más ligeros y resistentes, lo que permite una mejor aerodinámica y mayor velocidad en las pistas.

Además, la integración de la inteligencia artificial y el aprendizaje automático en la estrategia de carrera está cambiando el juego. Los equipos ahora pueden analizar grandes cantidades de datos en tiempo real para tomar decisiones más informadas sobre las paradas en boxes, el uso de neumáticos y las estrategias de adelantamiento. Esto no solo mejora el rendimiento del coche, sino que también aumenta la seguridad en la pista.', CURRENT_TIMESTAMP, 2, 1),

('Otra área de innovación tecnológica en la temporada 2024 es la evolución de los sistemas de recuperación de energía. Los nuevos sistemas ERS (Energy Recovery System) son más eficientes y potentes, lo que permite a los coches recuperar más energía durante la frenada y utilizarla para aumentar la potencia del motor. Esto es crucial en un deporte donde cada fracción de segundo cuenta.

Los equipos también están experimentando con nuevas configuraciones de aerodinámica activa, que ajustan automáticamente los alerones y otras partes del coche en respuesta a las condiciones de la pista y la carrera. Esto no solo mejora la eficiencia del coche, sino que también puede ayudar a reducir el desgaste de los neumáticos y otros componentes críticos, prolongando su vida útil y mejorando la consistencia del rendimiento a lo largo de la carrera.', CURRENT_TIMESTAMP, 2, 1),

('La temporada 2024 también verá avances significativos en la tecnología de comunicación y telemetría. Los equipos están utilizando redes 5G para transmitir datos de los coches a los boxes en tiempo real, lo que permite una comunicación más rápida y efectiva. Esto es especialmente importante en situaciones de alta presión, donde cada segundo cuenta y las decisiones rápidas pueden hacer la diferencia entre ganar y perder.

Además, la Fórmula 1 está invirtiendo en tecnología verde para hacer el deporte más sostenible. Los nuevos motores híbridos son más eficientes y emiten menos CO2, y los equipos están explorando el uso de combustibles alternativos y materiales reciclados en la construcción de sus coches. Estas innovaciones no solo hacen que el deporte sea más respetuoso con el medio ambiente, sino que también establecen un ejemplo positivo para la industria automovilística en general.', CURRENT_TIMESTAMP, 5, 1);
