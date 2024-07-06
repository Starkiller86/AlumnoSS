-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2024 a las 17:59:28
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alumnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido_paterno` varchar(200) NOT NULL,
  `apellido_materno` varchar(200) NOT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `e_mail` varchar(200) NOT NULL,
  `escolaridad` varchar(30) NOT NULL,
  `id_colegio` int(11) NOT NULL,
  `carrera` varchar(200) NOT NULL,
  `semestre` int(11) DEFAULT NULL,
  `documentos` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `nombre`, `apellido_paterno`, `apellido_materno`, `matricula`, `direccion`, `telefono`, `e_mail`, `escolaridad`, `id_colegio`, `carrera`, `semestre`, `documentos`, `fecha`, `status`) VALUES
(359, 'Victoria', 'Ortíz', 'Alcalá', '21322IPR000308', 'Paseo de la pirámide del Pueblito 491 Int 31', '4428013459', 'betohdzsalinas86@gmail.com', 'Bachillerato', 39, 'Programación', 5, 'Completa', '2024-07-04', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_password`
--

CREATE TABLE `alumno_password` (
  `id_alumno` int(11) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno_password`
--

INSERT INTO `alumno_password` (`id_alumno`, `password`) VALUES
(359, 'uXMVH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_servicio`
--

CREATE TABLE `alumno_servicio` (
  `id_proyecto` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `jefe_directo` varchar(200) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `no_horas` int(11) NOT NULL,
  `tipo_horas` int(11) NOT NULL,
  `tipo_servicio` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno_servicio`
--

INSERT INTO `alumno_servicio` (`id_proyecto`, `id_alumno`, `jefe_directo`, `fecha_inicio`, `fecha_termino`, `no_horas`, `tipo_horas`, `tipo_servicio`, `status`) VALUES
(29, 359, 'MGTI. Antonio Ledesma', '2023-11-15', '2024-07-03', 480, 1, 'Servicio social', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_servicio_new`
--

CREATE TABLE `alumno_servicio_new` (
  `id_proyecto` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `jefe_directo` varchar(200) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `no_horas` int(11) NOT NULL,
  `tipo_horas` int(11) NOT NULL,
  `tipo_servicio` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `horas` time NOT NULL,
  `horas_reales` time NOT NULL,
  `retardo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_alumno`, `fecha`, `hora_entrada`, `hora_salida`, `status`, `horas`, `horas_reales`, `retardo`) VALUES
(359, '2024-07-04', '03:00:13', '03:00:56', 'Salida registrada', '00:00:43', '00:00:43', ''),
(359, '2024-04-18', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-04-24', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-04-25', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-01', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-02', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-08', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-09', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-15', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-16', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-22', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-23', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-29', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-05-30', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-05', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-06', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-12', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-13', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-19', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-20', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-26', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-06-27', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', ''),
(359, '2024-07-03', '03:00:00', '06:00:00', 'Salida registrada', '03:00:00', '03:00:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia_new`
--

CREATE TABLE `asistencia_new` (
  `id_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `status` varchar(30) NOT NULL,
  `horas` time NOT NULL,
  `horas_reales` time NOT NULL,
  `retardo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE `colegio` (
  `id_colegio` int(11) NOT NULL,
  `colegios` varchar(200) NOT NULL,
  `responsable` varchar(200) DEFAULT NULL,
  `cargo_responsable` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`id_colegio`, `colegios`, `responsable`, `cargo_responsable`) VALUES
(39, 'Administración (DAP)', 'C.P. Gabriela Trápala Martínez', 'Directora ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_alumno` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_alumno`, `comentario`, `fecha`) VALUES
(359, '', '2024-07-04 02:54:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_alumno` int(11) NOT NULL,
  `e0` time DEFAULT NULL,
  `e1` time DEFAULT NULL,
  `e2` time DEFAULT NULL,
  `e3` time DEFAULT NULL,
  `e4` time DEFAULT NULL,
  `e5` time DEFAULT NULL,
  `e6` time DEFAULT NULL,
  `s0` time DEFAULT NULL,
  `s1` time DEFAULT NULL,
  `s2` time DEFAULT NULL,
  `s3` time DEFAULT NULL,
  `s4` time DEFAULT NULL,
  `s5` time DEFAULT NULL,
  `s6` time DEFAULT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_alumno`, `e0`, `e1`, `e2`, `e3`, `e4`, `e5`, `e6`, `s0`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `status`) VALUES
(359, NULL, NULL, NULL, '03:00:00', '03:00:00', NULL, NULL, NULL, NULL, NULL, '06:00:00', '06:00:00', NULL, NULL, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id_proyecto` int(11) NOT NULL,
  `nombre_proyecto` varchar(200) NOT NULL,
  `descripcion` varchar(400) DEFAULT NULL,
  `area` varchar(30) NOT NULL,
  `lugares_requeridos` int(11) NOT NULL,
  `lugares_asignados` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `area`, `lugares_requeridos`, `lugares_asignados`, `fecha`, `fecha_termino`, `status`) VALUES
(29, 'Eventos ', 'Responsables de eventos', 'Planeacion y promocion', 50, 1, '2024-04-15', '0000-01-01', 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `password` varchar(30) NOT NULL,
  `privilegios` varchar(32) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `nombre`, `password`, `privilegios`, `status`) VALUES
(36, 'BetoS', 'Beto Salinas', '123123', '11111111111111111111111111111111', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_colegio` (`id_colegio`);

--
-- Indices de la tabla `alumno_password`
--
ALTER TABLE `alumno_password`
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `alumno_servicio`
--
ALTER TABLE `alumno_servicio`
  ADD KEY `id_proyecto` (`id_proyecto`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD PRIMARY KEY (`id_colegio`),
  ADD UNIQUE KEY `colegios` (`colegios`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
  MODIFY `id_colegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`id_colegio`) REFERENCES `colegio` (`id_colegio`);

--
-- Filtros para la tabla `alumno_password`
--
ALTER TABLE `alumno_password`
  ADD CONSTRAINT `alumno_password_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);

--
-- Filtros para la tabla `alumno_servicio`
--
ALTER TABLE `alumno_servicio`
  ADD CONSTRAINT `alumno_servicio_ibfk_4` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `alumno_servicio_ibfk_5` FOREIGN KEY (`id_proyecto`) REFERENCES `proyecto` (`id_proyecto`);

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
