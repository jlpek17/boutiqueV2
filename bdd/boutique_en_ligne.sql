-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 27, 2024 at 09:48 PM
-- Server version: 8.0.36-2ubuntu3
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boutique_en_ligne`
--
CREATE DATABASE IF NOT EXISTS `boutique_en_ligne` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `boutique_en_ligne`;

-- --------------------------------------------------------

--
-- Table structure for table `adresses`
--

CREATE TABLE `adresses` (
  `id` int NOT NULL,
  `id_client` int NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adresses`
--

INSERT INTO `adresses` (`id`, `id_client`, `adresse`, `code_postal`, `ville`) VALUES
(1, 2, 'rue de la ville', '17200', 'Royan');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `id_gamme` int NOT NULL,
  `nom` varchar(25) NOT NULL,
  `description` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description_detaillee` text NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix` float NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `id_gamme`, `nom`, `description`, `description_detaillee`, `image`, `prix`, `stock`) VALUES
(1, 1, 'Extreme Watch', 'La montre connectée GPS idéale pour l\'extérieur.', 'Devenez le chef de la meute chaque fois que vous bravez l\'extérieur, que vos aventures vous mènent dans des forêts denses, vers des montagnes géantes ou dans les rues animées de la ville.', './img/gammeSport/extremeWatch.webp', 429.9, 2),
(2, 1, 'Balance Watch', 'Votre chemin vers l\'equilibre commence ici.', 'Le succès d\'aujourd\'hui repose sur les bases que vous avez posées hier. Pour réaliser tout ce dont vous êtes capable, vous devez trouver le bon équilibre entre l\'activité et la récupération.', './img/gammeSport/balanceWatch.webp', 249.9, 8),
(3, 1, 'Mini Wtach', 'Restez actif, restez en bonne santé.', 'Notre Watch Mini est votre guide : elle vous permets de planifier vos séances d\'entrainement d\'etre à l\'ecoute de votre récupération et de vous connecter à votre entourage.', './img/gammeSport/activeWatch.webp', 149.9, 4),
(4, 2, 'Bobo Watch', 'Une montre qui dira tout de vous', 'Rien de particulier juste le prix tres cher ;)', './img/gammeBlingbling/boboWatch.webp', 599, 0),
(5, 2, 'Hippie Watch', 'Une montre avec laquelle vous vous sentirez tres different !', 'Plein de couleur qui ne vont pas vraiment ensemble mais qui attireront l\'oeil de vos amis.', './img/gammeBlingbling/hippieWatch.webp', 209, 6),
(6, 2, 'Influencer Watch', 'Une montre pour les guider tous !', 'Avec cette montre vous envouterez votre auditoire et pourrez leur vendre n\'importe quoi ... vraiement n\'importe quoi !', './img/gammeBlingbling/influencerWatch.webp', 999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(2, 'De Pecker', 'Jean-Louis', 'jlpek17@gmail.com', '$2y$10$TZzKDqtzhIg9TMmMCK0Brug9N0EqaX4J7LC5Uv1KXHweyFR6U.Q6m');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int NOT NULL,
  `id_client` int NOT NULL,
  `numero` int NOT NULL,
  `date_commande` varchar(25) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `id_client`, `numero`, `date_commande`, `prix`) VALUES
(1, 2, 3090467, '25-04-24 08:04:45', 252.9),
(2, 2, 5120300, '25-04-24 09:35:48', 499.8),
(3, 2, 1954005, '25-04-24 09:36:29', 249.9),
(4, 2, 6984189, '25-04-24 09:36:44', 249.9),
(5, 2, 5474661, '25-04-24 09:39:09', 249.9),
(6, 2, 6493780, '25-04-24 09:41:14', 2956.5),
(7, 2, 6878015, '25-04-24 09:47:27', 1348.7),
(8, 2, 8253254, '25-04-24 09:48:40', 4855.8),
(9, 2, 7904533, '25-04-24 10:57:11', 2127.7),
(10, 2, 5578647, '26-04-24 09:57:55', 505.8),
(11, 2, 5904746, '27-04-24 01:30:52', 429.9),
(12, 2, 7012661, '27-04-24 01:32:56', 429.9),
(13, 2, 1223388, '27-04-24 01:36:50', 429.9),
(14, 2, 8974647, '27-04-24 01:37:17', 249.9),
(15, 2, 5828793, '27-04-24 01:55:48', 249.9);

-- --------------------------------------------------------

--
-- Table structure for table `commande_article`
--

CREATE TABLE `commande_article` (
  `id_commande` int NOT NULL,
  `id_article` int NOT NULL,
  `quantite` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commande_article`
--

INSERT INTO `commande_article` (`id_commande`, `id_article`, `quantite`) VALUES
(7, 2, 3),
(7, 4, 1),
(8, 1, 2),
(8, 6, 4),
(9, 2, 2),
(9, 4, 2),
(9, 1, 1),
(10, 2, 2),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gammes`
--

CREATE TABLE `gammes` (
  `id` int NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gammes`
--

INSERT INTO `gammes` (`id`, `nom`) VALUES
(1, 'Sport'),
(2, 'Blingbling');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adresses`
--
ALTER TABLE `adresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_ibfk_1` (`id_gamme`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Indexes for table `commande_article`
--
ALTER TABLE `commande_article`
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_article` (`id_article`);

--
-- Indexes for table `gammes`
--
ALTER TABLE `gammes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresses`
--
ALTER TABLE `adresses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `gammes`
--
ALTER TABLE `gammes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_gamme`) REFERENCES `gammes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `commande_article`
--
ALTER TABLE `commande_article`
  ADD CONSTRAINT `commande_article_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commandes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `commande_article_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
