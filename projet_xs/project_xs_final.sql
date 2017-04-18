-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 18 Avril 2017 à 23:22
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project_xs`
--
CREATE DATABASE IF NOT EXISTS `project_xs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project_xs`;

-- --------------------------------------------------------

--
-- Structure de la table `contact_form`
--

DROP TABLE IF EXISTS `contact_form`;
CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('lu','non lu') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `subject`, `message`, `email`, `status`, `date`) VALUES
(6, 'Colombe', 'Mathieu est debout', 'mathieu travail', 'colombe.oliv@gmail.com', 'non lu', '0000-00-00 00:00:00'),
(7, 'Olivier', 'On test tkt', 'je verifie juste si le message arrive bien', 'oliviercomcomb@gmail.com', 'non lu', '0000-00-00 00:00:00'),
(8, 'Colombe', 'Ok c bon sa passe', 'la je retest pour le message', 'colombe@gmail.com', 'non lu', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_custom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `product_custom_id`) VALUES
(5, 14, 8),
(6, 14, 5),
(9, 14, 1),
(10, 14, 10),
(13, 1, 8),
(14, 1, 9);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `total` float NOT NULL,
  `date_create` datetime NOT NULL,
  `status` enum('en cours','pret','livre','annule') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `products`, `total`, `date_create`, `status`) VALUES
(32, 14, '{"id":["5","1"],"libelleProduit":["Request","Anarchy"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":[1,1],"image":["1492104606-model.png","1492103736-model.png"],"price":["50","10"]}', 60, '2017-04-16 00:46:42', 'livre'),
(33, 14, '{"id":["5","1"],"libelleProduit":["Request","Anarchy"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":[1,1],"image":["1492105793-model.png","1492103736-model.png"],"price":["50","10"]}', 60, '2017-04-16 00:47:06', 'pret'),
(34, 14, '{"id":["5","1"],"libelleProduit":["Request","Anarchy"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":[1,1],"image":["1492105793-model.png","1492103736-model.png"],"price":["50","10"]}', 60, '2017-04-16 00:47:14', 'en cours'),
(35, 14, '{"id":["5","1"],"libelleProduit":["Request","Anarchy"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":[1,1],"image":["1492105793-model.png","1492103736-model.png"],"price":["50","10"]}', 60, '2017-04-16 00:47:47', 'en cours'),
(36, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:13:37', 'en cours'),
(37, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:13:41', 'en cours'),
(38, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:14:31', 'en cours'),
(39, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:14:55', 'en cours'),
(40, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:15:18', 'en cours'),
(41, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:15:59', 'en cours'),
(42, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:18:24', 'en cours'),
(43, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:24:24', 'en cours'),
(44, 14, '{"id":["1"],"libelleProduit":["Anarchy"],"ref":["BC-TU00402M"],"qty":[1],"image":["1492103736-model.png"],"price":["10"]}', 10, '2017-04-16 06:24:27', 'en cours'),
(45, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:13:35', 'en cours'),
(46, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:14:13', 'en cours'),
(47, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:14:48', 'en cours'),
(48, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:14:50', 'en cours'),
(49, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:14:52', 'en cours'),
(50, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:16:23', 'en cours'),
(51, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:16:34', 'en cours'),
(52, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:16:48', 'en cours'),
(53, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:17:00', 'en cours'),
(54, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:17:02', 'en cours'),
(55, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:17:08', 'en cours'),
(56, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:17:19', 'en cours'),
(57, 14, '{"id":["1","5"],"libelleProduit":["Anarchy","Request"],"ref":["BC-TU00402M","BC-TU00402M"],"qty":["1",1],"image":["1492103736-model.png","1492105793-model.png"],"price":["10","50"]}', 60, '2017-04-16 07:17:28', 'en cours'),
(58, 14, '{"id":["5","1","7"],"libelleProduit":["Request","Anarchy","olioli"],"ref":["BC-TU00402M","BC-TU00402M","BC-TU00504XL"],"qty":[2,1,1],"image":["1492105793-model.png","1492103736-model.png","1492322100-model.png"],"price":["50","10","17.98"]}', 77.98, '2017-04-16 07:56:07', 'en cours'),
(59, 2, '{"id":["6"],"libelleProduit":["oliolivier"],"ref":["BC-TU00501XL"],"qty":[1],"image":["1492360759-model.png"],"price":["17.98"]}', 17.98, '2017-04-16 18:39:39', 'en cours'),
(60, 15, '{"id":["2","5","9"],"libelleProduit":["Doodle","Request","test12"],"ref":["BC-TU00402XL","BC-TU00402M","BC-TU00401M"],"qty":["3",1,1],"image":["1492103736-model.png","1492105793-model.png","1492446680-model.png"],"price":["30","50","14.98"]}', 94.98, '2017-04-18 22:11:39', 'en cours');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `reference` varchar(64) NOT NULL,
  `size` enum('s','m','l','xl','xxl') NOT NULL,
  `color` enum('blanc','noir','bleu','jaune','rouge','vert') NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`id`, `category_id`, `reference`, `size`, `color`, `note`) VALUES
(1, '1', '00S', 's', 'blanc', ''),
(4, '1', '00M', 'm', 'blanc', ''),
(5, '1', '00L', 'l', 'blanc', ''),
(8, '1', '00XL', 'xl', 'blanc', ''),
(9, '1', '00XXL', 'xxl', 'blanc', ''),
(10, '1', '01S', 's', 'noir', ''),
(11, '1', '01M', 'm', 'noir', ''),
(12, '1', '01L', 'l', 'noir', ''),
(13, '1', '01XL', 'xl', 'noir', ''),
(14, '1', '01XXL', 'xxl', 'noir', ''),
(15, '1', '02S', 's', 'bleu', ''),
(16, '1', '02M', 'm', 'bleu', ''),
(17, '1', '02L', 'l', 'bleu', ''),
(18, '1', '02XL', 'xl', 'bleu', ''),
(19, '1', '02XXL', 'xxl', 'bleu', ''),
(20, '1', '03S', 's', 'rouge', ''),
(21, '1', '03M', 'm', 'rouge', ''),
(22, '1', '03L', 'l', 'rouge', ''),
(23, '1', '03XL', 'xl', 'rouge', ''),
(24, '1', '03XXL', 'xxl', 'rouge', ''),
(25, '1', '04S', 's', 'vert', ''),
(26, '1', '04M', 'm', 'vert', ''),
(27, '1', '04L', 'l', 'vert', ''),
(28, '1', '04XL', 'xl', 'vert', ''),
(29, '1', '04XXL', 'xxl', 'vert', '');

-- --------------------------------------------------------

--
-- Structure de la table `products_category`
--

DROP TABLE IF EXISTS `products_category`;
CREATE TABLE `products_category` (
  `id` int(11) NOT NULL,
  `category` varchar(32) NOT NULL,
  `category_reference` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `view` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `products_category`
--

INSERT INTO `products_category` (`id`, `category`, `category_reference`, `name`, `description`, `view`, `price`, `tax`) VALUES
(1, 'T-Shirt B&C', 'BC-TU004', 'T-Shirt Manches Courtes', '100% coton pré-rétréci à fil de chaîne continu (Ring-Spun);\n\nAsh: 99% coton pré-rétréci à fil de chaîne continu - 1% viscose;\n\nSport Grey: 85% coton pré-rétréci à fil de chaîne continu - 15% viscose;\n\nEncolure ronde Exact double épaisseur\n·Encolure en côte 1x1 et élasthanne\n·Bande de propreté dans l''encolure\n·Base et bords de manche avec double surpiqûre\n·Coupe tubulaire', 'crew_front.png', '9.99', '19.60'),
(2, 'T-Shirt B&C', 'BC-TU005', 'T-Shirt Manches Longues', '100% coton pré-rétréci à fil de chaîne continu', 'mens_longsleeve_front.png', '12.99', '19.60'),
(4, 'sweat shirt', 'BC-SW001', 'sweat shirt manche longue', '100% coton', '1492520543-mens-hoodie-front.png', '100.00', '12.00'),
(5, 'Débardeur', 'BC-DE001', 'Débardeur', '100% coton', '1492546887-mens-tank-front.png', '12.00', '8.50');

-- --------------------------------------------------------

--
-- Structure de la table `products_custom`
--

DROP TABLE IF EXISTS `products_custom`;
CREATE TABLE `products_custom` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `design_label` varchar(255) NOT NULL,
  `product_reference` varchar(32) NOT NULL,
  `picture_source` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `date_create` datetime NOT NULL,
  `likes_count` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `products_custom`
--

INSERT INTO `products_custom` (`id`, `user_id`, `design_label`, `product_reference`, `picture_source`, `model`, `public`, `date_create`, `likes_count`, `price`) VALUES
(2, 3, 'Doodle', 'BC-TU00402XL', '1491934812-template.jpg', '1492103736-model.png', 1, '0000-00-00 00:00:00', 0, 30),
(5, 14, 'Request', 'BC-TU00402M', '1491934755-design.jpg', '1492105793-model.png', 1, '0000-00-00 00:00:00', 201, 50),
(9, 14, 'test12', 'BC-TU00401M', '1492446669-img-pres4.jpg', '1492446680-model.png', 1, '2017-04-17 18:31:20', 1, 14.98),
(10, 14, 'texpolo', 'BC-TU00403XL', '1492446697-logo.png', '1492446713-model.png', 1, '2017-04-17 18:31:53', 1, 14.98),
(12, 14, 'design0111', 'BC-TU00400XL', '1492464489-ana.jpg', '1492464497-model.png', 1, '2017-04-17 23:28:17', 0, 14.98),
(16, 2, 'gfbkjbdkjbhgf', 'BC-TU00404M', '1492527526-sel1.jpg', '1492527530-model.png', 1, '2017-04-18 16:58:50', 0, 14.98),
(17, 14, 'Webforce rouge', 'BC-TU00403XL', '1492528848-logo-wf3-new.png', '1492528930-model.png', 1, '2017-04-18 17:22:10', 0, 14.98),
(18, 14, 'tshirt-XS', 'BC-TU00400M', '1492530224-logo.png', '1492530251-model.png', 1, '2017-04-18 17:44:11', 0, 14.98),
(19, 14, 'orange', 'BC-TU00401XL', '1492530288-orange.jpg', '1492530310-model.png', 1, '2017-04-18 17:45:10', 0, 104.99),
(20, 14, 'gbh', 'BC-TU00402XL', '1492530392-gbh.png', '1492530408-model.png', 1, '2017-04-18 17:46:48', 0, 14.98),
(21, 15, 'Mon beau t-shirt', 'BC-TU00401M', '1492545756-orange.jpg', '1492545805-model.png', 0, '2017-04-18 22:03:25', 0, 14.98);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(128) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(128) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `username`, `email`, `password`, `role`, `street`, `city`, `zipcode`, `country`, `avatar`, `token`) VALUES
(1, 'Super', 'Admin', 'admin', 'admin@admin.com', '$2y$10$d.xkvei8GzYuqNp0nAQoy.Pwe3hVHPU2mH78q1ij8O6CDMfguVz7i', 'admin', '255 rue du tshirt', 'Teetown', '97200', 'Martinique', 'admin_avatar.png', ''),
(2, 'Super', 'User', 'User', 'user@user.com', '$2y$10$xr3TjOqmsN2PGsG0ueYQI.p5h9eOgXEmbQ.NPZxxaBkQ5g48VRvnq', 'user', '2 rue du Tshirt', 'Teetown', '94430', 'Martinique', '1492279892-s7-modele-mercedes-classe-glk', '-p-c5HC63T4KJxzyWzzNxA7hWlUgMnwkGw0e_g7pw-ykrWSdYQll8DiXrM-x0bj2Nyj95mzAqiJaikmy'),
(14, 'Colombe', 'Olivier', 'webforce3', 'colombe.oliv@gmail.com', '$2y$10$Dc1z49ABDWEgOAoZ2UdyUue1oTg7w75WeNF2peGgXdGOMIaaFViCe', 'admin', '49 rte de chateauboeuf', 'Fort de france', '97200', 'Martini', '1492321417-s7-modele-mercedes-classe-glk', 'phYgpQFf0b9bMXhKgBjzme7UGldoE58Ywfpa60h83FRTjPbbXd1-q6I4qaHG3l8rxejedE_hlFRkT-kq');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- Index pour la table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products_custom`
--
ALTER TABLE `products_custom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `products_custom`
--
ALTER TABLE `products_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
