<?php
require_once 'config.php';
    class Model {
        protected $db;

        function __construct() {
            // Conexión al servidor MySQL sin especificar una base de datos
            $this->db = new PDO('mysql:host='. MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
            // Crear la base de datos si no existe
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` CHARACTER SET utf8 COLLATE utf8_general_ci");
            // Conectarse a la base de datos recién creada
            $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
            $this->deploy();
          }

        function deploy() {
            // Chequear si hay tablas
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
            $pass = '$2y$10$Y3d7juaIQNj4F9t4U3iAcOd9NtIA9gqCxX08FnYiHFjQDPTX5ezDa';
            if(count($tables)==0) {
                // Si no hay crearlas
                $sql =<<<END
                 SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                START TRANSACTION;
                SET time_zone = "+00:00";


                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                /*!40101 SET NAMES utf8mb4 */;

               

                CREATE TABLE `categorias` (
                  `ID_Categorias` int(11) NOT NULL,
                  `Nombre` varchar(45) NOT NULL,
                  `Descripcion` varchar(45) NOT NULL,
                  `URL_imagen` varchar(200) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

                --
                -- Volcado de datos para la tabla `categorias`
                --

                INSERT INTO `categorias` (`ID_Categorias`, `Nombre`, `Descripcion`, `URL_imagen`) VALUES
                (1, 'Teclados', 'Teclado gamer, y para oficina, tanto cableado', 'https://previews.123rf.com/images/frozenbunn/frozenbunn2306/frozenbunn230600230/207121642-dibujo-vectorial-de-teclado-ilustraci%C3%B3n-de-estilo-grabado-dibujada-a-mano-aislada.jpg'),
                (2, 'Parlantes', 'Equipos de sonido 3d max', 'https://img.freepik.com/vector-gratis/ilustracion-concepto-altavoz_114360-20824.jpg'),
                (3, 'Sillas', 'La mas grande variedad de sillas  gamer del p', 'https://justhomecollection.com/wp-content/uploads/2020/08/sillon_gamer_azul_negro.jpg'),
                (6, 'Procesadores', 'Muchos procesadores', 'https://tallerdehardwareutd.wordpress.com/wp-content/uploads/2018/03/cropped-motherboard_2-wallpaper-2560x14401.jpg'),
                (7, 'Monitores', 'Muchos monitores', 'https://argentina.solutekla.com/photo/1/dell/monitores/monitor_dell_27_vga_hdmi_ports/monitor_dell_27_vga_hdmi_ports_0001');

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `productos`
                --

                CREATE TABLE `productos` (
                  `ID_Productos` int(11) NOT NULL,
                  `Nombre` varchar(45) NOT NULL,
                  `Descripcion` varchar(45) NOT NULL,
                  `Precio` float NOT NULL,
                  `Marca` varchar(45) NOT NULL,
                  `URL_imagen` varchar(200) NOT NULL,
                  `ID_Categorias` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

                --
                -- Volcado de datos para la tabla `productos`
                --

                INSERT INTO `productos` (`ID_Productos`, `Nombre`, `Descripcion`, `Precio`, `Marca`, `URL_imagen`, `ID_Categorias`) VALUES
                (15, 'Parlante estereo', 'Parlantes estéreo USB de Genius SP-U150X. Es ', 8000, 'Genious', 'https://acdn.mitiendanube.com/stores/001/474/949/products/sin-titulo-1101-18782821c03f75ed9116137056464768-640-0.webp', 2),
                (16, 'Teclado de Goma', 'Teclado suave de silicona de alta calidad', 25150, 'HP', 'https://dcdn.mitiendanube.com/stores/003/992/860/products/c9022c61-ccef-4f5a-9b3e-75f2f8041bd3-5fbccdc05839755fab17089190266714-640-0.webp', 1),
                (18, 'Teclado Mecanico Asus ROG Azoth M701 ', 'Teclado Mecanico Asus ROG Azoth M701 Bluetoot', 250000, 'Asus', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_41460_Teclado_Mecanico_Asus_ROG_Azoth_M701_Bluetooth_Wireless_Switch_NX_Storm_White_a6245108-grn.jpg', 1),
                (19, 'Parlante Thonet &amp; Vander Vertrag Home', 'Parlante Thonet & Vander Vertrag Home Cinema ', 350000, 'Thonet & Vander', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_40856_Parlante_Thonet___Vander_Vertrag_Home_Cinema_Donker_Bluetooth_PC_Smart_TV_46W_c98b1097-grn.jpg', 2),
                (20, 'Monitor LG 26WQ500-B 26&quot;', 'Monitor LG 26WQ500-B 26\" UltraWide 21:9 Full ', 250000, 'LG', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_33355_Monitor_LG_26WQ500-B_26__UltraWide_21_9_Full_HD_75Hz_IPS_47ff2042-grn.jpg', 7),
                (21, 'Monitor Curvo Samsung 24&quot;', 'Monitor Curvo Samsung 24\" Essential S3 FHD 18', 200000, 'Samsung', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_41175_Monitor_Curvo_Samsung_24__Essential_S3_FHD_1800R_75Hz_82c8cf23-grn.jpg', 7),
                (22, 'Silla Gamer Noblechairs HERO', 'Silla Gamer Noblechairs HERO Mousesports Edit', 400000, 'Noblechairs', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_39273_Silla_Gamer_Noblechairs_HERO_Mousesports_Edition__Peso_MAX._150kg__ebefbe47-grn.jpg', 3),
                (23, 'Silla Gamer Noblechairs ICON White Edition ', 'Silla Gamer Noblechairs ICON White Edition - ', 500000, 'Noblechairs', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_39277_Silla_Gamer_Noblechairs_ICON_White_Edition_-_Blanco__Peso_MAX._150kg__e991539a-grn.jpg', 3),
                (24, 'Procesador AMD Ryzen 5 5600X', 'Procesador AMD Ryzen 5 5600X 4.6GHz Turbo AM4', 210000, 'AMD', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_22254_Procesador_AMD_Ryzen_5_5600X_4.6GHz_Turbo_AM4___Wraith_Stealth_Cooler_f737ec9f-grn.jpg', 6),
                (25, 'Procesador Intel Core i5 14400F', 'Procesador Intel Core i5 14400F 4.7GHz Turbo ', 250000, 'Intel', 'https://imagenes.compragamer.com/productos/compragamer_Imganen_general_38616_Procesador_Intel_Core_i5_14400F_4.7GHz_Turbo_Socket_1700_Raptor_Lake_dc4cb792-grn.jpg', 6);

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `usuario`
                --

                CREATE TABLE `usuario` (
                  `id` int(11) NOT NULL,
                  `email` varchar(250) NOT NULL,
                  `password` char(60) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

                --
                -- Volcado de datos para la tabla `usuario`
                --

                INSERT INTO `usuario` (`id`, `email`, `password`) VALUES
                (1, 'webadmin', '$pass');

                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `categorias`
                --
                ALTER TABLE `categorias`
                  ADD PRIMARY KEY (`ID_Categorias`),
                  ADD KEY `ID_Marcas` (`ID_Categorias`);

                --
                -- Indices de la tabla `productos`
                --
                ALTER TABLE `productos`
                  ADD PRIMARY KEY (`ID_Productos`),
                  ADD KEY `ID_Productos` (`ID_Productos`),
                  ADD KEY `ID_Marca` (`ID_Categorias`);

                --
                -- Indices de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                  ADD PRIMARY KEY (`id`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `categorias`
                --
                ALTER TABLE `categorias`
                  MODIFY `ID_Categorias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

                --
                -- AUTO_INCREMENT de la tabla `productos`
                --
                ALTER TABLE `productos`
                  MODIFY `ID_Productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

                --
                -- AUTO_INCREMENT de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `productos`
                --
                ALTER TABLE `productos`
                  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_Categorias`) REFERENCES `categorias` (`ID_Categorias`) ON DELETE NO ACTION ON UPDATE NO ACTION;
                COMMIT;

                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
                END;
                $this->db->query($sql);
            }
            
        }
    }