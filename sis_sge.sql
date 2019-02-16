-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-11-2018 a las 08:12:55
-- Versión del servidor: 5.6.35
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sis_sge`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BitEventos`
--

CREATE TABLE `BitEventos` (
  `eCodEvento` int(11) NOT NULL,
  `eCodUsuario` int(11) NOT NULL,
  `eCodCliente` int(11) NOT NULL,
  `fhFechaEvento` date NOT NULL,
  `tObservaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BitTransacciones`
--

CREATE TABLE `BitTransacciones` (
  `eCodTransaccion` int(11) NOT NULL,
  `eCodCliente` int(11) DEFAULT NULL,
  `fhFecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatClientes`
--

CREATE TABLE `CatClientes` (
  `eCodCliente` int(11) NOT NULL,
  `tTitulo` varchar(25) DEFAULT NULL,
  `tNombres` varchar(100) DEFAULT NULL,
  `tApellidos` varchar(100) DEFAULT NULL,
  `tCorreo` varchar(100) DEFAULT NULL,
  `tPassword` varchar(60) DEFAULT NULL,
  `tTelefonoFijo` varchar(15) DEFAULT NULL,
  `tTelefonoMovil` varchar(15) DEFAULT NULL,
  `fhFechaCreacion` datetime DEFAULT NULL,
  `eCodUsuario` int(11) NOT NULL,
  `eCodEstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatClientes`
--

INSERT INTO `CatClientes` (`eCodCliente`, `tTitulo`, `tNombres`, `tApellidos`, `tCorreo`, `tPassword`, `tTelefonoFijo`, `tTelefonoMovil`, `fhFechaCreacion`, `eCodUsuario`, `eCodEstatus`) VALUES
(1, NULL, 'mario', 'basurto', 'ebasurtom@me.com', NULL, '56454756', '4564574', '2018-11-12 03:06:00', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatCombos`
--

CREATE TABLE `CatCombos` (
  `eCodCombo` int(11) NOT NULL,
  `tNombre` varchar(200) NOT NULL,
  `tDescripcion` text NOT NULL,
  `dPrecioVenta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatEstatus`
--

CREATE TABLE `CatEstatus` (
  `eCodEstatus` int(11) NOT NULL,
  `tCodEstatus` varchar(2) DEFAULT NULL,
  `tNombre` varchar(15) DEFAULT NULL,
  `tIcono` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatEstatus`
--

INSERT INTO `CatEstatus` (`eCodEstatus`, `tCodEstatus`, `tNombre`, `tIcono`) VALUES
(1, 'NU', 'Nuevo', 'Nuevo.png'),
(2, 'PR', 'En proceso...', 'Proceso.png'),
(3, 'AC', 'Activo', 'Activo.png'),
(4, 'CA', 'Cancelado', 'Cancelado.png'),
(5, 'RE', 'Rechazado', 'Rechazado.png'),
(6, 'BL', 'Bloqueado', 'Bloqueado.png'),
(7, 'EL', 'Eliminado', 'Eliminado.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatInventario`
--

CREATE TABLE `CatInventario` (
  `eCodInventario` int(11) NOT NULL,
  `eCodTipoInventario` int(11) NOT NULL,
  `tNombre` varchar(100) NOT NULL,
  `tMarca` varchar(100) NOT NULL,
  `tDescripcion` text NOT NULL,
  `dPrecioInterno` double NOT NULL,
  `dPrecioVenta` double NOT NULL,
  `ePiezas` int(11) NOT NULL,
  `tImagen` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatServicios`
--

CREATE TABLE `CatServicios` (
  `eCodServicio` int(11) NOT NULL,
  `tNombre` varchar(200) NOT NULL,
  `tDescripcion` text NOT NULL,
  `dPrecioVenta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatTiposInventario`
--

CREATE TABLE `CatTiposInventario` (
  `eCodTipoInventario` int(11) NOT NULL,
  `tNombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatTiposInventario`
--

INSERT INTO `CatTiposInventario` (`eCodTipoInventario`, `tNombre`) VALUES
(1, 'Equipo'),
(2, 'Mobiliario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisBotones`
--

CREATE TABLE `SisBotones` (
  `tCodBoton` varchar(2) NOT NULL,
  `tTitulo` varchar(10) DEFAULT NULL,
  `tFuncion` varchar(15) DEFAULT NULL,
  `tIcono` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisBotones`
--

INSERT INTO `SisBotones` (`tCodBoton`, `tTitulo`, `tFuncion`, `tIcono`) VALUES
('CO', 'Historial', 'consultar(url);', 'Consultar.png'),
('EL', 'Eliminar', 'eliminas();', 'Eliminar.ong'),
('GU', 'Guardar', 'guardar();', 'Guardar.png'),
('IM', 'Imprimir', 'imprimir();', 'Imprimir.png'),
('RE', 'Rechazar', 'rechazar();', 'Rechazar.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisPerfiles`
--

CREATE TABLE `SisPerfiles` (
  `eCodPerfil` int(11) NOT NULL,
  `tNombre` varchar(15) DEFAULT NULL,
  `tCodEstatus` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisPerfiles`
--

INSERT INTO `SisPerfiles` (`eCodPerfil`, `tNombre`, `tCodEstatus`) VALUES
(1, 'Administrador', 'AC'),
(2, 'Coordinador', 'AC'),
(3, 'Ventas', 'AC'),
(4, 'Pagos', 'AC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSecciones`
--

CREATE TABLE `SisSecciones` (
  `tCodSeccion` varchar(20) NOT NULL,
  `tCodPadre` varchar(20) DEFAULT NULL,
  `tTitulo` varchar(60) DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL,
  `ePosicion` int(11) DEFAULT NULL,
  `bFiltro` int(11) NOT NULL,
  `tIcono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSecciones`
--

INSERT INTO `SisSecciones` (`tCodSeccion`, `tCodPadre`, `tTitulo`, `eCodEstatus`, `ePosicion`, `bFiltro`, `tIcono`) VALUES
('cata-cli-con', 'inicio', 'Clientes', 3, 3, 1, 'fa fa-file-text-o'),
('cata-cli-det', 'cata-cli-con', 'Detalles de Clientes', 3, 2, 0, 'fa fa-file-text-o'),
('cata-cli-reg', 'cata-cli-con', '+ Clientes', 3, 1, 0, 'fa fa-file-text-o'),
('cata-eve-con', 'inicio', 'Eventos', 3, 2, 0, 'fa fa-file-text-o'),
('cata-eve-reg', 'cata-eve-con', '+ Eventos', 3, 1, 0, 'fa fa-file-text-o'),
('cata-inv-con', 'inicio', 'Inventario', 3, 3, 0, 'fa fa-file-text-o'),
('cata-inv-det', 'cata-inv-con', 'Detalles de Inventario', 3, 2, 0, 'fa fa-file-text-o'),
('cata-inv-reg', 'cata-inv-con', '+ Inventario', 3, 1, 0, 'fa fa-file-text-o'),
('cata-per-reg', 'cata-per-sis', '+ Perfiles', 3, 5, 0, 'fa fa-file-text-o'),
('cata-per-sis', 'inicio', 'Perfiles', 3, 6, 0, 'fa fa-file-text-o'),
('cata-ser-con', 'inicio', 'Servicios', 3, 3, 0, 'fa fa-file-text-o'),
('cata-ser-det', 'cata-ser-con', 'Detalles de Servicios', 3, 2, 0, 'fa fa-file-text-o'),
('cata-ser-reg', 'cata-ser-con', '+ Servicios', 3, 1, 0, 'fa fa-file-text-o'),
('cata-tra-con', 'inicio', 'Transacciones', 3, 4, 1, 'fa fa-file-text-o'),
('cata-usr-reg', 'cata-usr-sis', '+ Usuarios', 3, 5, 0, 'fa fa-file-text-o'),
('cata-usr-sis', 'inicio', 'Usuarios', 3, 5, 0, 'fa fa-file-text-o'),
('inicio', NULL, 'Inicio', 3, 1, 0, 'fa-tachometer-alt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesBotones`
--

CREATE TABLE `SisSeccionesBotones` (
  `tCodPadre` varchar(15) DEFAULT NULL,
  `tCodSeccion` varchar(15) DEFAULT NULL,
  `tCodBoton` varchar(2) DEFAULT NULL,
  `ePosicion` int(11) DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesMenusEmergentes`
--

CREATE TABLE `SisSeccionesMenusEmergentes` (
  `tCodPadre` varchar(20) DEFAULT NULL,
  `tCodSeccion` varchar(20) DEFAULT NULL,
  `tFuncion` varchar(50) DEFAULT NULL,
  `ePosicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesPerfiles`
--

CREATE TABLE `SisSeccionesPerfiles` (
  `eCodPerfil` int(11) DEFAULT NULL,
  `tCodSeccion` varchar(15) DEFAULT NULL,
  `bAll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSeccionesPerfiles`
--

INSERT INTO `SisSeccionesPerfiles` (`eCodPerfil`, `tCodSeccion`, `bAll`) VALUES
(1, 'cata-eve-con', 1),
(1, 'cata-eve-reg', 0),
(1, 'cata-cli-con', 1),
(1, 'cata-usr-sis', 1),
(1, 'cata-usr-reg', 0),
(1, 'cata-per-reg', 0),
(2, 'cata-eve-con', 1),
(2, 'cata-cli-con', 1),
(2, 'cata-tra-con', 1),
(2, 'cata-usr-sis', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisUsuarios`
--

CREATE TABLE `SisUsuarios` (
  `eCodUsuario` int(11) NOT NULL,
  `tNombre` varchar(50) DEFAULT NULL,
  `tApellidos` varchar(50) DEFAULT NULL,
  `tCorreo` varchar(100) DEFAULT NULL,
  `tPasswordAcceso` varchar(60) DEFAULT NULL,
  `tPasswordOperaciones` varchar(60) DEFAULT NULL,
  `fhFechaCreacion` datetime DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL,
  `eCodPerfil` int(11) DEFAULT NULL,
  `bAll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisUsuarios`
--

INSERT INTO `SisUsuarios` (`eCodUsuario`, `tNombre`, `tApellidos`, `tCorreo`, `tPasswordAcceso`, `tPasswordOperaciones`, `fhFechaCreacion`, `eCodEstatus`, `eCodPerfil`, `bAll`) VALUES
(1, 'Mario Ernesto', 'Basurto Medrano', 'babec.soluciones@gmail.com', 'MjgwMjkx', 'MjgwMjkx', '2018-07-29 00:00:00', 3, 1, 1),
(2, 'Administrador', 'Sistema', 'admin@lidertad.org', 'YWRtaW4=', 'YWRtaW4=', '2018-07-30 02:00:00', 3, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisVariables`
--

CREATE TABLE `SisVariables` (
  `eCodVariable` int(11) NOT NULL,
  `tNombreVariable` varchar(100) DEFAULT NULL,
  `tValorVariable` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `BitEventos`
--
ALTER TABLE `BitEventos`
  ADD PRIMARY KEY (`eCodEvento`);

--
-- Indices de la tabla `BitTransacciones`
--
ALTER TABLE `BitTransacciones`
  ADD PRIMARY KEY (`eCodTransaccion`);

--
-- Indices de la tabla `CatClientes`
--
ALTER TABLE `CatClientes`
  ADD PRIMARY KEY (`eCodCliente`),
  ADD KEY `cliente_rel_estatus_fk_idx` (`eCodEstatus`);

--
-- Indices de la tabla `CatCombos`
--
ALTER TABLE `CatCombos`
  ADD PRIMARY KEY (`eCodCombo`);

--
-- Indices de la tabla `CatEstatus`
--
ALTER TABLE `CatEstatus`
  ADD PRIMARY KEY (`eCodEstatus`),
  ADD UNIQUE KEY `tCodEstatus_UNIQUE` (`tCodEstatus`);

--
-- Indices de la tabla `CatInventario`
--
ALTER TABLE `CatInventario`
  ADD PRIMARY KEY (`eCodInventario`);

--
-- Indices de la tabla `CatServicios`
--
ALTER TABLE `CatServicios`
  ADD PRIMARY KEY (`eCodServicio`);

--
-- Indices de la tabla `CatTiposInventario`
--
ALTER TABLE `CatTiposInventario`
  ADD PRIMARY KEY (`eCodTipoInventario`);

--
-- Indices de la tabla `SisBotones`
--
ALTER TABLE `SisBotones`
  ADD PRIMARY KEY (`tCodBoton`);

--
-- Indices de la tabla `SisPerfiles`
--
ALTER TABLE `SisPerfiles`
  ADD PRIMARY KEY (`eCodPerfil`);

--
-- Indices de la tabla `SisSecciones`
--
ALTER TABLE `SisSecciones`
  ADD PRIMARY KEY (`tCodSeccion`);

--
-- Indices de la tabla `SisSeccionesBotones`
--
ALTER TABLE `SisSeccionesBotones`
  ADD KEY `tCodPadre_rel_fk_botones_idx` (`tCodPadre`),
  ADD KEY `tCodBoton_rel_fk_botones_idx` (`tCodBoton`),
  ADD KEY `eCodEstatus_rel_estatus_fk_idx` (`eCodEstatus`);

--
-- Indices de la tabla `SisSeccionesPerfiles`
--
ALTER TABLE `SisSeccionesPerfiles`
  ADD KEY `perfil_rel_seccion_fk_idx` (`eCodPerfil`),
  ADD KEY `seccion_rel_perfil_idx` (`tCodSeccion`);

--
-- Indices de la tabla `SisUsuarios`
--
ALTER TABLE `SisUsuarios`
  ADD PRIMARY KEY (`eCodUsuario`),
  ADD KEY `SisUsuarios_rel_perfiles_fk_idx` (`eCodPerfil`),
  ADD KEY `CatEstatus_rel_usuarios_fk_idx` (`eCodEstatus`);

--
-- Indices de la tabla `SisVariables`
--
ALTER TABLE `SisVariables`
  ADD PRIMARY KEY (`eCodVariable`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `BitEventos`
--
ALTER TABLE `BitEventos`
  MODIFY `eCodEvento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `BitTransacciones`
--
ALTER TABLE `BitTransacciones`
  MODIFY `eCodTransaccion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CatClientes`
--
ALTER TABLE `CatClientes`
  MODIFY `eCodCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `CatCombos`
--
ALTER TABLE `CatCombos`
  MODIFY `eCodCombo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CatEstatus`
--
ALTER TABLE `CatEstatus`
  MODIFY `eCodEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `CatInventario`
--
ALTER TABLE `CatInventario`
  MODIFY `eCodInventario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CatServicios`
--
ALTER TABLE `CatServicios`
  MODIFY `eCodServicio` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `CatTiposInventario`
--
ALTER TABLE `CatTiposInventario`
  MODIFY `eCodTipoInventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `SisPerfiles`
--
ALTER TABLE `SisPerfiles`
  MODIFY `eCodPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `SisUsuarios`
--
ALTER TABLE `SisUsuarios`
  MODIFY `eCodUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `SisVariables`
--
ALTER TABLE `SisVariables`
  MODIFY `eCodVariable` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `SisSeccionesBotones`
--
ALTER TABLE `SisSeccionesBotones`
  ADD CONSTRAINT `eCodEstatus_rel_estatus_fk` FOREIGN KEY (`eCodEstatus`) REFERENCES `CatEstatus` (`eCodEstatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tCodBoton_rel_fk_botones` FOREIGN KEY (`tCodBoton`) REFERENCES `SisBotones` (`tCodBoton`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tCodPadre_rel_fk_botones` FOREIGN KEY (`tCodPadre`) REFERENCES `SisSecciones` (`tCodSeccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `SisSeccionesPerfiles`
--
ALTER TABLE `SisSeccionesPerfiles`
  ADD CONSTRAINT `perfil_rel_seccion_fk` FOREIGN KEY (`eCodPerfil`) REFERENCES `SisPerfiles` (`eCodPerfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seccion_rel_perfil` FOREIGN KEY (`tCodSeccion`) REFERENCES `SisSecciones` (`tCodSeccion`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
