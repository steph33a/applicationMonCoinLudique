-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 juin 2025 à 21:51
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moncoinludique`
--

-- --------------------------------------------------------

--
-- Structure de la table `amitie`
--

DROP TABLE IF EXISTS `amitie`;
CREATE TABLE IF NOT EXISTS `amitie` (
  `id_amitie` int NOT NULL AUTO_INCREMENT,
  `utilisateur` int NOT NULL,
  `ami` int NOT NULL,
  `statut_demandeAmi` enum('en_attente','acceptee','refusee') DEFAULT 'en_attente',
  `dateDemandeAmi` date DEFAULT NULL,
  PRIMARY KEY (`id_amitie`),
  KEY `utilisateur` (`utilisateur`),
  KEY `ami` (`ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id_evenement` int NOT NULL AUTO_INCREMENT,
  `statut_evenement` enum('ouvert','fermé','annulé') DEFAULT 'ouvert',
  `id_organisateur` int NOT NULL,
  `recurrence` varchar(255) DEFAULT NULL,
  `date_evenement` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `titre_evenement` varchar(255) NOT NULL,
  `image_evenement` varchar(255) DEFAULT NULL,
  `jeux_et_themes` text,
  `nbParticipants_max` int DEFAULT NULL,
  `age_minimum` int DEFAULT '12',
  `adresse_rue` varchar(150) DEFAULT NULL,
  `adresse_numero` varchar(20) DEFAULT NULL,
  `adresse_ville` varchar(100) DEFAULT NULL,
  `adresse_CP` varchar(10) DEFAULT NULL,
  `url1` varchar(255) DEFAULT NULL,
  `url2` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `groupe_de_discussion` varchar(255) DEFAULT NULL,
  `description` text,
  `image_description` varchar(255) DEFAULT NULL,
  `url_descr` varchar(255) DEFAULT NULL,
  `pieceJointe_descr` varchar(255) DEFAULT NULL,
  `champ_modifié` varchar(500) NOT NULL DEFAULT '{   "recurrence": 0,   "styleEvenement": 0,   "date_evenement": 0,   "heure_evenement": 0,   "ImageEvenement": 0,   "Jeux_Theme": 0,   "places_disponibles": 0,   "age_minimum": 0,   "adresse_rue": 0,   "adresse_numero": 0,   "adresse_ville": 0,   "Adresse_CP": 0,   "url1": 0,   "url2": 0,   "telephone": 0,   "mail": 0,   "groupe_de_discussion": 0 }',
  `id_preferenceEvenement` int NOT NULL,
  `type_soiree` enum('createur','classique','thermatique','') NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_evenement`),
  KEY `organisateur` (`id_organisateur`),
  KEY `id_preferenceEvenement` (`id_preferenceEvenement`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evenement`, `statut_evenement`, `id_organisateur`, `recurrence`, `date_evenement`, `heure`, `titre_evenement`, `image_evenement`, `jeux_et_themes`, `nbParticipants_max`, `age_minimum`, `adresse_rue`, `adresse_numero`, `adresse_ville`, `adresse_CP`, `url1`, `url2`, `telephone`, `email`, `groupe_de_discussion`, `description`, `image_description`, `url_descr`, `pieceJointe_descr`, `champ_modifié`, `id_preferenceEvenement`, `type_soiree`, `date_creation`) VALUES
(4, 'ouvert', 6, '', '2025-06-27', '13:26:00', '', 'C:\\wamp64\\www\\applicationMonCoinLudique\\model/../vue/images/uploads/6/evennement/683ea2a5a629d_image_3.png', '', 4, 0, '', NULL, 'tournai', '', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-03'),
(5, 'ouvert', 6, '', '2025-06-26', '14:42:00', '', 'C:\\wamp64\\www\\applicationMonCoinLudique\\model/../vue/images/uploads/6/evenement/683ea640aa2dd_image_3.png', '', 4, 0, '', NULL, 'tournai', '', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-03'),
(6, 'ouvert', 6, '', '2025-06-19', '13:44:00', '', '/applicationMonCoinLudique/vue/images/uploads/6/evenement/683ea6dc8fcbb_image__9_.png', '', 3, 0, '', NULL, 'tournai', '', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-03'),
(7, 'ouvert', 6, '', '2025-06-26', '18:13:00', '', '/moncoinludique/vue/images/uploads/6/evenement/683eacf1c1c80_image__9_.png', '', 5, 0, '', NULL, 'tournai', '', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, '', '2025-06-03'),
(8, 'ouvert', 28, '', NULL, '16:27:00', 'fdfsfdggf', '/moncoinludique/vue/images/uploads/28/evenement/683ecd7f043e8_image_3.png', '', 30, 0, 'fdsf', NULL, 'tournai', '7540', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-03'),
(9, 'ouvert', 28, '', NULL, '18:35:00', 'fdfsfdggf', '/moncoinludique/vue/images/uploads/28/evenement/683ececb464de_image_3.png', '', 5, 16, 'fdsf', NULL, 'tournai', '7500', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'createur', '2025-06-03'),
(10, 'ouvert', 28, '', NULL, '18:35:00', 'fdfsfdggf', '/moncoinludique/vue/images/uploads/28/evenement/683ecf17ea8eb_image_3.png', '', 5, 16, 'fdsf', NULL, 'tournai', '7500', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'createur', '2025-06-03'),
(11, 'ouvert', 28, '', NULL, '16:40:00', 'fdfsfdggf', '/moncoinludique/vue/images/uploads/28/evenement/683ed062c7a87_Ellipse_5.png', '', 49, 0, 'fdsf', NULL, 'tournai', '7540', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-03'),
(12, 'ouvert', 28, '', '2025-07-06', '16:40:00', 'fdfsfdggf', '/moncoinludique/vue/images/uploads/28/evenement/683ed16003445_Ellipse_5.png', '', 49, 0, 'fdsf', NULL, 'tournai', '7540', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'createur', '2025-06-03'),
(13, 'ouvert', 29, '', '2025-06-18', '16:54:00', '', '/moncoinludique/vue/images/uploads/29/evenement/683ed3764707d_Rectangle_136.png', '', 35, 0, '', NULL, 'tournai', '7500', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'createur', '2025-06-03'),
(14, 'ouvert', 6, '', '2025-06-25', '20:13:00', '', '/moncoinludique/vue/images/uploads/6/evenement/6841b493ef3b3_image_3.png', '', 32, 0, '', '', 'tournai', '', '', '', '', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'classique', '2025-06-05'),
(17, 'ouvert', 38, '', '2025-06-20', '03:03:00', 'stephanieEvent', '/moncoinludique/vue/images/uploads/38/evenement/684356916041b_Rectangle_136.png', '', 3, 0, 'fdsf', '45', 'tournai', '7500', '', '', '0457296965', 'stephaniemarquant87@gmail.com', '', NULL, NULL, NULL, NULL, '{   \"recurrence\": 0,   \"styleEvenement\": 0,   \"date_evenement\": 0,   \"heure_evenement\": 0,   \"ImageEvenement\": 0,   \"Jeux_Theme\": 0,   \"places_disponibles\": 0,   \"age_minimum\": 0,   \"adresse_rue\": 0,   \"adresse_numero\": 0,   \"adresse_ville\": 0,   \"Adresse_CP\": 0,   \"url1\": 0,   \"url2\": 0,   \"telephone\": 0,   \"mail\": 0,   \"groupe_de_discussion\": 0 }', 0, 'createur', '2025-06-06');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id_inscription` int NOT NULL AUTO_INCREMENT,
  `id_evenement` int NOT NULL,
  `id_inscrit` int NOT NULL,
  `date_inscription` date NOT NULL,
  `statut` enum('inscrit','en attente','refusé','autre') NOT NULL,
  `nombre_inscrit` int NOT NULL,
  PRIMARY KEY (`id_inscription`),
  KEY `id_evenement` (`id_evenement`) USING BTREE,
  KEY `id_inscrit` (`id_inscrit`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id_inscription`, `id_evenement`, `id_inscrit`, `date_inscription`, `statut`, `nombre_inscrit`) VALUES
(5, 14, 6, '2025-06-06', 'inscrit', 3),
(10, 13, 6, '2025-06-06', 'inscrit', 5),
(11, 5, 37, '2025-06-06', 'inscrit', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_recup`
--

DROP TABLE IF EXISTS `password_recup`;
CREATE TABLE IF NOT EXISTS `password_recup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `question1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Quel est votre jeu préféré?',
  `reponse1` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `question2` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Quel est votre chanteur préféré?',
  `reponse2` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `password_recup`
--

INSERT INTO `password_recup` (`id`, `id_utilisateur`, `question1`, `reponse1`, `question2`, `reponse2`) VALUES
(2, 6, 'Quel est votre jeu préféré?', 'skyjo', 'Quel est votre chanteur préféré?', 'kyo'),
(4, 30, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(5, 31, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(6, 32, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(7, 33, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(8, 34, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(10, 36, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(11, 37, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(12, 38, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', ''),
(13, 39, 'Quel est votre jeu préféré?', '', 'Quel est votre chanteur préféré?', '');

-- --------------------------------------------------------

--
-- Structure de la table `preference_evenements`
--

DROP TABLE IF EXISTS `preference_evenements`;
CREATE TABLE IF NOT EXISTS `preference_evenements` (
  `id_preference` int NOT NULL AUTO_INCREMENT,
  `recurrence` varchar(255) DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `style_evenement` enum('public','privé') DEFAULT 'public',
  `titre` varchar(255) DEFAULT NULL,
  `jeux_et_theme` text,
  `nombre_places` int DEFAULT NULL,
  `age_requis` int DEFAULT '12',
  `adresse_rue` varchar(150) DEFAULT NULL,
  `adresse_numero` varchar(20) DEFAULT NULL,
  `adresse_ville` varchar(100) DEFAULT NULL,
  `adresse_CP` varchar(10) DEFAULT NULL,
  `url1` varchar(255) DEFAULT NULL,
  `url2` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `groupe_de_discussion` varchar(255) DEFAULT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_preference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `imageProfil` varchar(255) DEFAULT NULL,
  `pseudo` varchar(100) DEFAULT NULL,
  `nom_utilisateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom_utilisateur` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateInscription` date DEFAULT NULL,
  `role` enum('particulier','groupe','moderateur','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'particulier',
  `statut_utilisateur` enum('actif','inactif','banni','supprimé') DEFAULT 'actif',
  `dateNaissance` date DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `imageProfil`, `pseudo`, `nom_utilisateur`, `prenom_utilisateur`, `email`, `password`, `dateInscription`, `role`, `statut_utilisateur`, `dateNaissance`) VALUES
(6, NULL, 'steph33a', 'Marquant', 'stephanie', 'stephaniemarquant87@gmail.com', '$2y$10$LKNCvs.q3oIL.KcN.cAQquaGPfXnHV1Qm/J5E4gI9UrkXuU6axIeq', '2025-05-29', 'admin', 'actif', '2025-06-03'),
(11, NULL, 'Pariatur Optio sim', 'Quo deleniti reprehe', '', 'wovewaride@mailinator.com', '$2y$10$rVWnhA7SuW7u8Ys6osf.L.PvkrlqyCXFXod/gRbSJt0/omIsNXAW6', '2025-05-31', 'moderateur', 'actif', NULL),
(12, NULL, 'Quos dolor in id ni', 'Eaque possimus fuga', '', 'bizumyvem@mailinator.com', '$2y$10$9c3KJ.H7jq6NRbjwyMUgvO.I/.VeACRFgQVMKxzzWyU0Sf5kinFtq', '2025-05-31', 'groupe', 'actif', NULL),
(15, 'exist', 'Enim esse voluptate', 'Cumque voluptatum Na', '', 'tama@mailinator.com', '$2y$10$yY4IX8nDlFcPz4RrScKHZ.ZAxeKaBniwsafOqlJ2oDu7AmBaT7S4e', '2025-06-03', 'groupe', 'actif', NULL),
(16, 'exist', 'Aliqua Ducimus qui', 'Tempora in voluptate', '', 'butypys@mailinator.com', '$2y$10$Ow3mNxCZ/eAVqxDHsPldsuLcvLDGZzeCIH62ev.CmHAY0pYAWDLne', '2025-06-03', 'groupe', 'actif', NULL),
(17, 'exist', 'Ipsum est autem qui', 'Ut nostrum possimus', '', 'kycelyb@mailinator.com', '$2y$10$GzLOvZHx.wcDEzH6bwYvr.EcC8ZIW8aaIJNwSLrx4QbjMZOktOJcG', '2025-06-03', 'groupe', 'actif', NULL),
(19, 'exist', 'joBonier', 'Bonier', 'Jonathan', 'joBonier@mailinator.com', '$2y$10$rqm2FvSdOgFQm7xjs1SiteAfu5/SkynD/xyy6x9WTcXZkNBlHJGVq', '2025-06-03', 'particulier', 'actif', '2000-04-19'),
(20, 'exist', 'Qui et dolore aperia', 'Ex ullam alias do re', '', 'qefyfe@mailinator.com', '$2y$10$7wSP6Tgj3HHf7ycStAg1ZO5e0uYJSiUSzqQogb6EmFlZEmERg47ru', '2025-06-03', 'groupe', 'actif', NULL),
(21, 'exist', 'Omnis sed voluptatum', 'Ab aspernatur beatae', '', 'judeminozy@mailinator.com', '$2y$10$QEpNRxz8rlpBK/3NDgJsuO5QptY3VtKHidH53aJ2MY9eMHwn7tsy.', '2025-06-03', 'groupe', 'actif', NULL),
(22, 'exist', 'Ut maxime rerum quia', 'Aut sunt ullam alias', 'Enim sit nulla aute', 'zofawisoxe@mailinator.com', '$2y$10$ThPuEhmu0v30IHuyRqYATes.Fk5kh1EvzakpvJAkwTHMMt865owoK', '2025-06-03', 'particulier', 'actif', '1971-07-26'),
(23, 'exist', 'Aut praesentium sit', 'Nobis enim eveniet', 'Pariatur Non iste a', 'kapehywi@mailinator.com', '$2y$10$pNX1TGjAMHWdIgWoPTl.MeGOTon/Pq28DfYycNIU8COK5Af65N9vu', '2025-06-03', 'particulier', 'actif', '2004-06-29'),
(24, 'exist', 'Eos sit non sit eni', 'Dolores qui assumend', 'Incidunt illum vol', 'nalorod@mailinator.com', '$2y$10$BxCFeZGJoryu/vAE5HfZG.pA51hpHWFREbY/GJO6m8DfbestPsD7C', '2025-06-03', 'particulier', 'actif', '1970-05-09'),
(25, 'exist', 'Nulla quam magni nul', 'Qui aperiam ut conse', 'Nostrum quam tempore', 'muso@mailinator.com', '$2y$10$tMEZ1KVzv1qLm1rcMRlsquO5cKkhuNWtLazYZBv1EaPf249EGfK.6', '2025-06-03', 'particulier', 'actif', '2008-03-12'),
(26, 'exist', 'Reiciendis quis in r', 'Aliqua Commodo magn', '', 'tumilyre@mailinator.com', '$2y$10$Wz6nGz.yz1r0KSSJtYZFW./pMlasuk0bF/X5USgXYcdesXZL4b.BK', '2025-06-03', 'groupe', 'actif', NULL),
(27, 'exist', 'Quibusdam eum minima', 'Voluptas eiusmod ali', '', 'qubydawys@mailinator.com', '$2y$10$Ol3nbVLUzgwf5/YWpDEKHOZXOYW8a8caZXM621zx7zxCqAHai3G6K', '2025-06-03', 'groupe', 'actif', NULL),
(28, '/moncoinludique/vue/images/uploads/28/imageProfil/683eca9b2730d_image_3.png', 'Illum obcaecati mol', 'Eu ut perspiciatis', '', 'mypurim@mailinator.com', '$2y$10$1vBqLK5iidjBM1QKhLFmFOW1RIqXt86eFhXfAes4mAuJmfesF5VV6', '2025-06-03', 'groupe', 'actif', NULL),
(29, '/moncoinludique/vue/images/uploads/29/imageProfil/683ed34c6ac60_image_3.png', 'Ipsum ut enim moles', 'Libero velit ratione', 'bvbn', 'riqokos@mailinator.com', '$2y$10$todJ0mOiwdVd2cIrS/QhSepC3h6XjVz3O166wbWJ3uoC5qM53E6jC', '2025-06-03', 'particulier', 'actif', '0000-00-00'),
(30, '/moncoinludique/vue/images/uploads/30/imageProfil/6842f5a9554c4_image_3.png', 'In illo ut incididun', 'Accusantium voluptas', '', 'kaqyji@mailinator.com', '$2y$10$1TK1zrds240905TJFfbQ4O5NwFhvMJ6847bbTEtkeJkoLK86PDNBS', '2025-06-06', 'groupe', 'actif', NULL),
(31, '/moncoinludique/vue/images/uploads/31/imageProfil/6842f75f2f3d0_Rectangle_136.png', 'Necessitatibus conse', 'Quasi fugiat sint v', '', 'gacokino@mailinator.com', '$2y$10$hoQr0n3MEDVe1eBGefiEwu3NdpeapFJP7/E3cCjiMtQnUPPOjjjLW', '2025-06-06', 'particulier', 'actif', '0000-00-00'),
(32, '/moncoinludique/vue/images/uploads/32/imageProfil/6842f83587475_image_3.png', 'Ipsa voluptate expl', 'Alias lorem tenetur', 'Ut in nulla dolor si', 'joqa@mailinator.com', '$2y$10$DQ8vV9BDxV4JlTdlU76ZgOhfHZLHKIw7RT/ZyeDk2onzBZ4qVFEwa', '2025-06-06', 'particulier', 'actif', '1972-08-30'),
(33, '/moncoinludique/vue/images/uploads/33/imageProfil/68430230d41a9_image_3.png', 'Perferendis deleniti', 'Doloribus accusantiu', '', 'nibod@mailinator.com', '$2y$10$kFgeIUrQWSbSrCOu5UGGweXNecytMfZMHV/W8qbZrP7jGCWRLhMX2', '2025-06-06', 'groupe', 'actif', NULL),
(34, '/moncoinludique/vue/images/uploads/34/imageProfil/684303be01f15_image__9_.png', 'Ad magni ut lorem qu', 'Et dolore molestias', '', 'mujimo@mailinator.com', '$2y$10$.8Ax4NEWxu3Opn9TnZDOkewJ7UwAFt/M3/OIRP0PFiHK0yhBxn7u2', '2025-06-06', 'groupe', 'actif', NULL),
(36, '/moncoinludique/vue/images/uploads/36/imageProfil/684324710fea3_image_3.png', 'Dolorem ratione dolo', 'Dolor omnis eveniet', 'Repudiandae ex rerum', 'gydepezo@mailinator.com', '$2y$10$3kQvB1/JHVuAu4b4T5Lkq.95HPb3aXTLmiSXWAg165sicxXOAPKR6', '2025-06-06', 'particulier', 'actif', '1971-10-16'),
(37, '/moncoinludique/vue/images/uploads/37/imageProfil/684329816378a_image__9_.png', 'particulierStéphanie', 'Bonier', 'Stéphanie', 'stephaniemarquant87particulier@gmail.com', '$2y$10$OL.M9KJvnswev46QEj0Nx.0keX0Vj0L5/7M8uM0yrNyaXKUk1sYm2', '2025-06-06', 'particulier', 'actif', '2025-06-27'),
(38, '/moncoinludique/vue/images/uploads/38/imageProfil/68432c7cb1593_Group_2429.png', 'FolleDeJeu', 'FolleDeJeuSteph', '', 'FolleDeJeu@gmail.com', '$2y$10$s3pb2BtmBPjwjAdfQopZieRzI8aK68fXPiSVL8NeZfu8fJK2WQutq', '2025-06-06', 'groupe', 'actif', NULL),
(39, '/moncoinludique/vue/images/uploads/39/imageProfil/684354cfc42e6_image_3.png', 'Et qui distinctio E', 'Quae accusamus provi', 'Enim voluptatem eos', 'mesasucyk@mailinator.com', '$2y$10$IAWAP9l4kl.Hb3C3OAsxJeZJMw0hszqNRmXHfKCaWQyrLvll0K0YC', '2025-06-06', 'particulier', 'actif', '2005-01-12');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_inscriptions_evenement` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id_evenement`) ON DELETE CASCADE;

--
-- Contraintes pour la table `password_recup`
--
ALTER TABLE `password_recup`
  ADD CONSTRAINT `password_recup_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `preference_evenements`
--
ALTER TABLE `preference_evenements`
  ADD CONSTRAINT `preference_evenements_ibfk_1` FOREIGN KEY (`id_preference`) REFERENCES `evenements` (`id_preferenceEvenement`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
