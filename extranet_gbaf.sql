-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 10 sep. 2020 à 15:04
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `extranet_gbaf`
--

-- --------------------------------------------------------

--
-- Structure de la table `account`
--

CREATE TABLE `account` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `account`
--

INSERT INTO `account` (`id_user`, `nom`, `prenom`, `username`, `password`, `question`, `response`) VALUES
(3, 'THIBAULT', 'Brice', 'B.THIBAULT', '$2y$10$6BVobGsEAEad0tztIjCXbunoHAVS.9HDmg77qgxnGXHuI6MdSGpUC', 'Quel est ton prénom ?', 'Brice'),
(11, 'THIBAULT', 'Eric', 'E.THIBAULT', '$2y$10$XVQiIPzBy9Oscv5SEYducuj4eHnLDeDSsO6LgVNmndOtBvHS1HrB6', 'Quel est ton prénom ?', 'Eric'),
(12, 'THIBAULT', 'Claude', 'C.THIBAULT', '$2y$10$87SApewEELSjvH3SlKb2aeNMPHn5u4HP5xi1GjR8/8QE43Y9sbNx2', 'Quel est ton prénom ?', 'Claude'),
(13, 'CHENE', 'Evelyne', 'E.CHENE', '$2y$10$lCEzKqKUtZHblsV3EJpXE.CxzQmhkwe7LhSXpauL0HTL4sCRF9BeW', 'Test', 'Test');

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE `acteur` (
  `id_acteur` int(11) NOT NULL,
  `acteur` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id_acteur`, `acteur`, `description`, `logo`) VALUES
(1, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\nNotre proposition : \r\n- un financement jusqu’à 30 000€ ;\r\n- un suivi personnalisé et gratuit ;\r\n- une lutte acharnée contre les freins sociétaux et les stéréotypes.\r\n\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… . Nous collaborons avec des personnes talentueuses et motivées.\r\nVous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.', 'formation_co.png'),
(2, 'Protectpeople', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n\r\nChez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\nProectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\nNous garantissons un accès aux soins et une retraite.\r\nChaque année, nous collectons et répartissons 300 milliards d’euros.\r\nNotre mission est double :\r\nsociale : nous garantissons la fiabilité des données sociales ;\r\néconomique : nous apportons une contribution aux activités économiques.', 'protectpeople.png'),
(3, 'Dsa France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s’adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises.', 'Dsa_france.png'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \r\nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.', 'CDE.png');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `id_acteur`, `date_add`, `post`) VALUES
(6, 3, 1, '2020-09-06 02:28:54', 'C\'est un commentaire pour Formation&Co.'),
(7, 3, 2, '2020-09-06 02:30:19', 'Je ne suis pas satisfait des informations transmises.'),
(9, 12, 3, '2020-09-06 02:33:06', 'Aucun commentaires.'),
(12, 11, 4, '2020-09-06 02:35:28', 'Aucune communication...'),
(28, 12, 2, '2020-09-10 15:59:01', 'Vous pouvez &eacute;crire ici');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id_user` int(11) NOT NULL,
  `id_acteur` int(11) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_user`, `id_acteur`, `vote`) VALUES
(3, 1, 1),
(3, 2, 0),
(11, 1, 1),
(11, 4, 0),
(12, 1, 0),
(12, 3, 0),
(13, 1, 0),
(13, 3, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `acteur`
--
ALTER TABLE `acteur`
  ADD PRIMARY KEY (`id_acteur`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_acteur`),
  ADD KEY `id_acteur` (`id_acteur`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_user`,`id_acteur`),
  ADD KEY `id_acteur` (`id_acteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `account`
--
ALTER TABLE `account`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `acteur`
--
ALTER TABLE `acteur`
  MODIFY `id_acteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`);

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `account_vote` FOREIGN KEY (`id_user`) REFERENCES `account` (`id_user`),
  ADD CONSTRAINT `acteur_vote` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
