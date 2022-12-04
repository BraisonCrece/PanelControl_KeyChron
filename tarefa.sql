-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: dbxdebug
-- Tiempo de generación: 04-12-2022 a las 11:03:42
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tarefa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aluga`
--

CREATE TABLE `aluga` (
  `ID_artigo` int NOT NULL,
  `ID_Cliente` int NOT NULL,
  `data` datetime NOT NULL,
  `num_dias_alugado` int NOT NULL,
  `prezo` int NOT NULL,
  `devolto` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `aluga`
--

INSERT INTO `aluga` (`ID_artigo`, `ID_Cliente`, `data`, `num_dias_alugado`, `prezo`, `devolto`) VALUES
(1, 1, '2022-12-02 13:22:30', 1, 64, 1),
(1, 1, '2022-12-02 13:22:34', 1, 64, 1),
(1, 1, '2022-12-02 14:16:12', 9, 64, 1),
(1, 1, '2022-12-02 14:16:17', 9, 64, 1),
(1, 1, '2022-12-02 14:42:51', 4, 64, 1),
(1, 1, '2022-12-02 14:45:42', 3, 64, 1),
(1, 1, '2022-12-03 11:14:24', 4, 64, 1),
(1, 1, '2022-12-03 11:14:56', 5, 64, 1),
(2, 1, '2022-12-03 12:35:32', 22, 79, 1),
(2, 2, '2022-12-02 14:43:06', 3, 79, 1),
(3, 1, '2022-12-02 14:41:38', 4, 94, 1),
(3, 2, '2022-12-02 15:06:36', 2, 94, 1),
(4, 1, '2022-12-02 13:22:08', 3, 84, 1),
(4, 1, '2022-12-02 14:30:48', 4, 84, 1),
(4, 3, '2022-12-02 14:25:06', 16, 84, 1),
(4, 3, '2022-12-02 14:25:10', 16, 84, 1),
(5, 2, '2022-12-02 14:18:54', 9, 179, 1),
(5, 2, '2022-12-02 14:39:37', 7, 179, 1),
(6, 2, '2022-12-02 14:32:31', 5, 179, 1),
(7, 1, '2022-12-02 14:33:28', 6, 205, 1),
(7, 1, '2022-12-03 11:01:02', 3, 205, 1),
(7, 1, '2022-12-03 11:01:08', 3, 205, 1),
(7, 1, '2022-12-03 14:10:33', 11, 205, 0),
(7, 2, '2022-12-02 14:34:42', 18, 205, 1),
(9, 2, '2022-12-02 14:25:41', 3, 64, 1),
(9, 2, '2022-12-02 15:07:31', 3, 64, 1),
(9, 9, '2022-12-03 14:10:40', 17, 64, 0),
(11, 3, '2022-12-03 12:34:36', 5, 89, 1),
(13, 2, '2022-12-02 14:31:44', 25, 195, 1),
(13, 3, '2022-12-02 14:25:44', 4, 195, 1),
(13, 3, '2022-12-02 14:25:47', 4, 195, 1),
(15, 3, '2022-12-02 14:41:56', 4, 57, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artigo`
--

CREATE TABLE `artigo` (
  `ID_artigo` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_longo` varchar(100) NOT NULL,
  `detalle` varchar(500) NOT NULL,
  `prezo` int NOT NULL,
  `imaxe` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `artigo`
--

INSERT INTO `artigo` (`ID_artigo`, `nome`, `nome_longo`, `detalle`, `prezo`, `imaxe`) VALUES
(1, 'Keychron C2', 'Teclado mecánico con cable Keychron C2', 'UN TECLADO MECÁNICO CON CABLE DE TAMAÑO COMPLETO Diseñado para maximizar su productividad con el diseño de tamaño completo más popular con teclado numérico. La opción intercambiable en caliente en los interruptores mecánicos Gateron y los interruptores mecánicos Keychron ofrece la libertad de personalizar fácilmente su experiencia de escritura sin soldadura.', 64, 'Keychron-C2-hot-swappable-wired-mechanical-keyboard-tenkeyless-layout-for-mac-windows-non-backlight-retro-color-Keychron-switch-blue_1800x1800.webp'),
(2, 'Keychron K2', 'Teclado mecánico inalámbrico Keychron K2 (Versión 2)', 'LA MEJOR COMBINACIÓN DE TECLADO DE TAMAÑO COMPLETO Y TENKEYLESS K2 es un teclado inalámbrico o con cable súper táctil que le brinda todas las teclas y funciones que necesita mientras lo mantiene compacto, con la batería más grande que se haya visto en un teclado mecánico.', 79, 'Keychron-K2-wireless-mechanical-keyboard-for-Mac-Windows-iOS-Gateron-switch-blue-with-type-C-RGB-white-backlight-exclusive-color_1800x1800.webp'),
(3, 'Keycrhon K10', 'Teclado mecánico inalámbrico Keychron K10', 'Diseñado para maximizar su productividad con el diseño de tamaño completo más popular con teclado numérico. La opción intercambiable en caliente en los interruptores mecánicos Gateron G Pro ofrece la libertad de personalizar fácilmente su experiencia de escritura sin soldadura.', 94, 'keychron-k10--full-size-wired-wireless-mechanical-keyboard-white-rgb-backlight-gateron-red-switches-mac-windows-layout_1800x1800.webp'),
(4, 'Keychron K7', 'Teclado mecánico inalámbrico ultradelgado Keychron K7', 'El primer teclado mecánico inalámbrico 65% ultradelgado del mundo KEYCRHON K7 Opción intercambiable en caliente | Interruptores Gateron y ópticos de bajo perfil | 65% layout.\r\nLa incorporación de los primeros interruptores Gateron de perfil bajo intercambiables en caliente del mundo para personalizar la experiencia de escritura por tecla con facilidad, junto con todas las funciones exclusivas de Keychron.', 84, 'Keychron-K7-65-percent-ultra-slim-compact-wireless-mechanical-keyboard-for-Mac-Windows-Hot-swappable-low-profile-Gateron-Mechanical-blue-switches-for-Mac-Windows-with-white-backlit_1800x1800.webp'),
(5, 'Keychron Q2', 'Teclado mecánico personalizado Keychron Q2 QMK', 'Diseñado por expertos y compacto Para crear un teclado más compacto y pequeño para su escritorio, le ofrecemos el Q2. Toda la pieza está fabricada con aluminio 6063 que se procesa a través de CNC mecanizado, pulido, anodizado, pulido con chorro de arena y se somete a 24 etapas de fabricación más para hacer la obra de arte que es el Q2.', 179, 'Keychron-Q2-C1-QMK-VIA-custom-mechanical-keyboard-65-percent-layout-full-aluminum-black-frame-for-Mac-Windows-iOS-RGB-backlight-with-hot-swappable-Gateron-G-Pro-switch-red_1800x1800.webp'),
(6, 'Keychron Q7', 'Keychron Q7 QMK Teclado mecánico personalizado Colección de diseño ISO', 'Versión de diseño Q7 ISO La colección de diseño ISO de teclado mecánico personalizado Keychron Q7 QMK viene con los diseños del Reino Unido, alemán, nórdico, suizo, francés y español. Cada teclado con diseño Q7 ISO también está equipado con teclas adicionales que satisfacen completamente sus necesidades.', 179, 'Keychron-Q7-QMK-VIA-custom-mechanical-keyboard-70-percent-layout-full-aluminum-frame-Mac-Windows-German-DE-ISO-layout-Gateron-G-Pro-switch-brown_540x.webp'),
(7, 'Keychron Q8', 'Keychron Q8 (diseño de Alice) QMK Teclado mecánico personalizado Colección de diseño ISO', 'Keychron Q8 es un teclado mecánico completamente metálico con diseño Alice al 65 %. Con su cuerpo mecanizado CNC totalmente metálico, un diseño de tamaño completo, diseño de doble junta, soporte QMK/VIA y opción de perilla, el Q8 satisface todas sus necesidades prácticas y le brinda una experiencia de escritura de alto nivel.', 205, 'Keychron-Q8-QMK-VIA-Custom-Mechanical-Keyboard-Alice-Layout-Full-Aluminum-Frame-For-Mac-Windows-Linux-Fully-Assembled-Knob-Carbon-Black-German-ISO-DE-Layout-Gateron-G-Pro-Red_1800x1800.webp'),
(8, 'Keychron S1', 'Teclado mecánico personalizado Keychron S1 QMK', 'Keychron S1 es el primer teclado mecánico personalizado de bajo perfil totalmente metálico con diseño del 75 %. Con su cuerpo mecanizado CNC ultradelgado totalmente metálico, compatibilidad con QMK/VIA y teclas PBT de doble disparo de perfil bajo, el S1 le brinda una experiencia de escritura de alto nivel, una configuración de diseño única y un sinfín de posibilidades. Único en su clase.', 109, 'Keychron-S1-QMK-VIA-low-profile-custom-mechanical-keyboard-75-percent-layout-for-Mac-Windows-Linux-White-RGB-backlight-low-profile-Gateron-Red_0de3900c-e019-4fd8-b8e2-7f65e2f9bf43_1800x1800.webp'),
(9, 'Keychron V3', 'Teclado mecánico personalizado Keychron V3 QMK', 'El V3 es un teclado personalizado de diseño clásico TKL (80 %) con muchas características premium como compatibilidad con QMK/VIA, teclas PBT, pestañas atornillables, etc., que ofrece infinitas posibilidades y una cómoda experiencia de escritura.', 64, 'Keychron-V3-Custom-Mechanical-Keyboard-frosted-black-QMK-VIA-tenkeyless-hot-swappable-Keychron-K-Pro-switch-red-V3-A1_5b0d4891-ce08-448b-8956-d667bf5159ae_1800x1800.webp'),
(10, 'Keychron V4', 'Teclado mecánico personalizado Keychron V4 QMK', 'El V4 es un teclado mecánico totalmente personalizable adecuado para diferentes escenarios. Es un teclado personalizado de nivel de entrada con un diseño mini 60%, compatibilidad con QMK/VIA, una almohadilla de silicona acústica y teclas PBT de doble disparo para brindarle una gran sensación de escritura y un sinfín de posibilidades.', 79, 'Keychron-V4-QMK-VIA-Custom-Mechanical-Keyboard-60-Percent-German-ISO-Layout-K-Pro-Red-Switch_1800x1800.webp'),
(11, 'Keychron V5', 'Teclado mecánico personalizado Keychron V5 QMK', 'Con un diseño de diseño compacto 1800 (96 % de diseño) para ahorrar espacio de manera eficiente mientras conserva las teclas de función y el teclado numérico, el V5 es un teclado mecánico totalmente personalizable compatible con QMK/VIA, teclas PBT de dos disparos, pestañas atornillables y más para una sensación de escritura óptima.', 89, 'Keychron-V5-QMK-VIA-custom-mechanical-keyboard-96-percent-layout-for-Mac-Windows-Linux-frame-frosted-black-V5-A2_e7abb00f-8751-4ea1-b03b-16125d0c157a_1800x1800.webp'),
(12, 'Keychron V6', 'Teclado mecánico personalizado Keychron V6 QMK', 'V6 es un teclado mecánico personalizado de tamaño completo con compatibilidad con QMK/VIA y muchos diseños de primera calidad, como teclas PBT de doble disparo, puntas atornillables, etc. Satisfará sus diversas necesidades y le brindará una excelente comodidad al escribir.', 89, 'Keychron-V6-QMK-VIA-custom-mechanical-keyboard-full-size-layout-for-Mac-Windows-Linux-frame-frosted-black-V6-A1_acb6a67c-174b-447a-bf9e-ff82c82273ac_1800x1800.webp'),
(13, 'Keychron Q8', 'Teclado mecánico personalizado Keychron Q8 (diseño Alice) QMK', 'Keychron Q8 es un teclado mecánico completamente metálico con diseño Alice al 65 %. Con su cuerpo mecanizado CNC totalmente metálico, un diseño de tamaño completo, diseño de doble junta, soporte QMK/VIA y opción de perilla, el Q8 satisface todas sus necesidades prácticas y le brinda una experiencia de escritura de alto nivel.', 195, 'Keychron-Q8-QMK-VIA-Custom-Mechanical-Keyboard-Alice-Layout-Full-Aluminum-Frame-For-Mac-Windows-Linux-Fully-Assembled-Knob-Carbon-Black-German-ISO-DE-Layout-Gateron-G-Pro-Red_1800x1800.webp'),
(14, 'Keychron K6', 'Teclado mecánico inalámbrico sin retroiluminación Keychron K6', 'Diseñado para maximizar su espacio de trabajo con un diseño ergonómico, al tiempo que conserva todas las teclas de función y multimedia necesarias. K6 es un teclado inalámbrico o con cable súper táctil que le brinda todas las teclas y funciones que necesita mientras lo mantiene compacto. Con la batería más grande, la versión K6 sin retroiluminación puede durar hasta 2 meses.', 65, 'Keychron-K6-compact-65-percent-wireless-mechanical-keyboard-for-Mac-Windows-iOS-keychron-switch-brown-with-type-C-non-backlight-hot-swappable-aluminum-frame_1800x1800.webp'),
(15, 'Keychron K14', 'Teclado mecánico inalámbrico Keychron K14', 'K14 es un teclado mecánico inalámbrico compacto que retiene el acceso directo a todo el grupo de navegación (inicio, fin, teclas de flecha, etc.) que tiene un teclado sin teclas, pero en un espacio más pequeño. La opción intercambiable en caliente en las versiones Gateron y Non-backlight ofrece la libertad de personalizar fácilmente la experiencia de escritura por tecla sin soldadura.', 57, 'Keychron-K14-70-percent-compact-wireless-mechanical-keyboard-for-Mac-Windows-with-legends-never-fade-out-and-hot-swappable-with-Keychron-mechanical-switch-blue_1800x1800.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_Cliente` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `apelidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_Cliente`, `nome`, `apelidos`, `email`) VALUES
(1, 'Brais', 'Fernández Díaz', 'braisoncrece@hey.com'),
(9, 'María', 'Perez Reverte', 'maria.p.r@yahoo.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aluga`
--
ALTER TABLE `aluga`
  ADD PRIMARY KEY (`ID_artigo`,`ID_Cliente`,`data`),
  ADD KEY `ID_artigo` (`ID_artigo`,`ID_Cliente`);

--
-- Indices de la tabla `artigo`
--
ALTER TABLE `artigo`
  ADD PRIMARY KEY (`ID_artigo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artigo`
--
ALTER TABLE `artigo`
  MODIFY `ID_artigo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_Cliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
