-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 26 mars 2025 à 12:50
-- Version du serveur : 8.0.36
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cryf`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

DROP TABLE IF EXISTS `candidature`;
CREATE TABLE IF NOT EXISTS `candidature` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_candidature` date DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `lettre_motivation` text,
  `offre_id` int DEFAULT NULL,
  `utilisateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offre_id` (`offre_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id`, `date_candidature`, `cv`, `lettre_motivation`, `offre_id`, `utilisateur_id`) VALUES
(16, '2025-03-01', 'cv_etudiant1.pdf', 'Lettre de motivation pour offre 1', 1, 1),
(17, '2025-03-02', 'cv_etudiant2.pdf', 'Lettre de motivation pour offre 2', 2, 31),
(18, '2025-03-03', 'cv_etudiant3.pdf', 'Lettre de motivation pour offre 3', 3, 32),
(19, '2025-03-04', 'cv_etudiant4.pdf', 'Lettre de motivation pour offre 4', 4, 33),
(20, '2025-03-05', 'cv_etudiant5.pdf', 'Lettre de motivation pour offre 5', 5, 34),
(21, '2025-03-06', 'cv_etudiant6.pdf', 'Lettre de motivation pour offre 6', 6, 35),
(22, '2025-03-07', 'cv_etudiant7.pdf', 'Lettre de motivation pour offre 7', 7, 36),
(23, '2025-03-08', 'cv_etudiant8.pdf', 'Lettre de motivation pour offre 8', 8, 37),
(24, '2025-03-09', 'cv_etudiant9.pdf', 'Lettre de motivation pour offre 9', 9, 38),
(25, '2025-03-10', 'cv_etudiant10.pdf', 'Lettre de motivation pour offre 10', 10, 39),
(26, '2025-03-11', 'cv_etudiant11.pdf', 'Lettre de motivation pour offre 11', 11, 40),
(27, '2025-03-12', 'cv_etudiant12.pdf', 'Lettre de motivation pour offre 12', 12, 41),
(28, '2025-03-13', 'cv_etudiant13.pdf', 'Lettre de motivation pour offre 13', 13, 42),
(29, '2025-03-14', 'cv_etudiant14.pdf', 'Lettre de motivation pour offre 14', 14, 43),
(30, '2025-03-15', 'cv_etudiant15.pdf', 'Lettre de motivation pour offre 15', 15, 44);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_competence` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `nom_competence`) VALUES
(1, 'C++'),
(2, 'C#'),
(3, 'HTML'),
(4, 'CSS'),
(5, 'JavaScript'),
(6, 'Python'),
(7, 'Java'),
(8, 'PHP'),
(9, 'SQL'),
(10, 'Ruby'),
(11, 'Kotlin'),
(12, 'Swift'),
(13, 'Bash'),
(14, 'Perl'),
(15, 'R'),
(16, 'Go'),
(17, 'TypeScript'),
(18, 'React'),
(19, 'Angular'),
(20, 'Node.js'),
(21, 'Spring Boot'),
(22, 'Django'),
(23, 'Laravel'),
(24, 'Flask'),
(25, 'Symfony'),
(26, 'Docker'),
(27, 'Kubernetes'),
(28, 'Git'),
(29, 'Linux'),
(30, 'Agile'),
(31, 'Scrum'),
(32, 'AWS'),
(33, 'Azure'),
(34, 'Google Cloud'),
(35, 'Machine Learning'),
(36, 'Deep Learning'),
(37, 'Data Science'),
(38, 'Big Data'),
(39, 'DevOps'),
(40, 'Cybersecurity'),
(41, 'Blockchain'),
(42, 'Internet of Things (IoT)'),
(43, 'AR/VR'),
(44, '3D Modeling'),
(45, 'UI/UX Design');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `description`, `email`, `telephone`) VALUES
(1, 'Airbus', 'Aerospace and defense company.', 'contact@airbus.com', '0102030405'),
(2, 'Total', 'Energy company with oil and gas operations.', 'service@total.com', '0607080910'),
(3, 'Vinci', 'Construction and infrastructure company.', 'support@vinci.com', '0506070809'),
(4, 'Orange', 'Telecommunications company.', 'partenaires@orange.com', '0908070605'),
(5, 'Google', 'Technology company specializing in Internet services.', 'tech@google.com', '0203040506'),
(6, 'Microsoft', 'Multinational technology corporation.', 'solutions@microsoft.com', '0304050607'),
(7, 'Apple', 'Consumer electronics and software company.', 'informatique@apple.com', '0405060708'),
(8, 'Amazon', 'E-commerce, cloud computing and AI company.', 'ecommerce@amazon.com', '0506070809'),
(9, 'Facebook', 'Social media and technology company.', 'marketing@facebook.com', '0607080910'),
(10, 'Tesla', 'Electric vehicle and clean energy company.', 'innovation@tesla.com', '0708091011'),
(11, 'IBM', 'Cloud and cognitive computing company.', 'cloud@ibm.com', '0809101112'),
(12, 'Intel', 'Multinational corporation and technology company.', 'hardware@intel.com', '0910111213'),
(13, 'Nvidia', 'Graphics and AI computing company.', 'graphics@nvidia.com', '1011121314'),
(14, 'Siemens', 'Engineering and technology company.', 'industrie@siemens.com', '1112131415'),
(15, 'Samsung', 'Multinational electronics and technology company.', 'mobile@samsung.com', '1213141516');

-- --------------------------------------------------------

--
-- Structure de la table `offre_competence`
--

DROP TABLE IF EXISTS `offre_competence`;
CREATE TABLE IF NOT EXISTS `offre_competence` (
  `offre_id` int NOT NULL,
  `competence_id` int NOT NULL,
  PRIMARY KEY (`offre_id`,`competence_id`),
  KEY `competence_id` (`competence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre_competence`
--

INSERT INTO `offre_competence` (`offre_id`, `competence_id`) VALUES
(1, 1),
(7, 1),
(4, 2),
(12, 2),
(1, 3),
(14, 3),
(2, 4),
(15, 4),
(2, 5),
(8, 5),
(3, 6),
(9, 6),
(4, 7),
(10, 8),
(3, 9),
(9, 9),
(11, 10),
(5, 11),
(11, 11),
(6, 12),
(13, 12),
(7, 13),
(14, 13),
(12, 14),
(6, 15),
(15, 15);

-- --------------------------------------------------------

--
-- Structure de la table `offre_de_stage`
--

DROP TABLE IF EXISTS `offre_de_stage`;
CREATE TABLE IF NOT EXISTS `offre_de_stage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `description` text,
  `date_publication` date DEFAULT NULL,
  `duree_du_stage` int DEFAULT NULL,
  `entreprise_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `offre_de_stage_ibfk_1` (`entreprise_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `offre_de_stage`
--

INSERT INTO `offre_de_stage` (`id`, `titre`, `description`, `date_publication`, `duree_du_stage`, `entreprise_id`) VALUES
(1, 'Ingénieur Aéronautique', 'Stage en ingénierie aéronautique pour la construction d\'avions.', '2025-03-26', 6, 1),
(2, 'Analyste Énergie', 'Stage dans le domaine de l\'énergie pour analyser les tendances énergétiques.', '2025-03-26', 5, 2),
(3, 'Ingénieur Civil', 'Participation aux grands projets d\'infrastructures internationales.', '2025-03-26', 6, 3),
(4, 'Stage Réseau Télécom', 'Stage pour mettre en place des infrastructures de télécommunications.', '2025-03-26', 4, 4),
(5, 'Développeur Web', 'Développement d\'applications web et cloud.', '2025-03-26', 6, 5),
(6, 'Développeur Logiciel', 'Participation à des projets de développement de logiciels.', '2025-03-26', 6, 6),
(7, 'Stage Marketing', 'Stage dans l\'équipe marketing pour développer de nouvelles stratégies.', '2025-03-26', 4, 7),
(8, 'Data Scientist', 'Analyse des données massives pour améliorer l\'efficacité des opérations.', '2025-03-26', 6, 8),
(9, 'Community Manager', 'Gestion des réseaux sociaux et de la communication en ligne.', '2025-03-26', 4, 9),
(10, 'Ingénieur Énergies Renouvelables', 'Stage axé sur les énergies renouvelables et la durabilité.', '2025-03-26', 5, 10),
(11, 'Consultant Digital', 'Conseil et accompagnement des entreprises dans la transformation numérique.', '2025-03-26', 4, 11),
(12, 'Responsable Sécurité Informatique', 'Veiller à la sécurité des infrastructures informatiques de l\'entreprise.', '2025-03-26', 6, 12),
(13, 'Développeur Mobile', 'Création d\'applications mobiles pour Android et iOS.', '2025-03-26', 5, 13),
(14, 'Chef de Projet IT', 'Pilotage de projets de transformation digitale.', '2025-03-26', 6, 14),
(15, 'Ingénieur Cloud', 'Mise en place d\'infrastructures cloud pour les clients de l\'entreprise.', '2025-03-26', 6, 15);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom_role`) VALUES
(1, 'etudiant'),
(2, 'entreprise'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`, `role_id`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@gmail.com', 'cesi1', 1),
(31, 'Martin', 'Marie', 'marie.martin@viacesi.com', 'cesi2', 1),
(32, 'Bernard', 'Luc', 'luc.bernard@viacesi.com', 'cesi3', 1),
(33, 'Robert', 'Julie', 'julie.robert@viacesi.com', 'cesi4', 1),
(34, 'Richard', 'Pierre', 'pierre.richard@viacesi.com', 'cesi5', 1),
(35, 'Petit', 'Sophie', 'sophie.petit@viacesi.com', 'cesi6', 1),
(36, 'Durand', 'Paul', 'paul.durand@viacesi.com', 'cesi7', 1),
(37, 'Leroy', 'Clara', 'clara.leroy@viacesi.com', 'cesi8', 1),
(38, 'Moreau', 'Hugo', 'hugo.moreau@viacesi.com', 'cesi9', 1),
(39, 'Simon', 'Emma', 'emma.simon@viacesi.com', 'cesi10', 1),
(40, 'Laurent', 'Noah', 'noah.laurent@viacesi.com', 'cesi11', 1),
(41, 'Lefevre', 'Olivia', 'olivia.lefevre@viacesi.com', 'cesi12', 1),
(42, 'Michel', 'Louis', 'louis.michel@viacesi.com', 'cesi13', 1),
(43, 'Garcia', 'Chloe', 'chloe.garcia@viacesi.com', 'cesi14', 1),
(44, 'David', 'Lucas', 'lucas.david@viacesi.com', 'cesi15', 1),
(45, 'Bertrand', 'Alice', 'alice.bertrand@viacesi.com', 'cesi16', 1),
(46, 'Roux', 'Ethan', 'ethan.roux@viacesi.com', 'cesi17', 1),
(47, 'Vincent', 'Léa', 'lea.vincent@viacesi.com', 'cesi18', 1),
(48, 'Fournier', 'Nathan', 'nathan.fournier@viacesi.com', 'cesi19', 1),
(49, 'Morel', 'Elodie', 'elodie.morel@viacesi.com', 'cesi20', 1),
(50, 'Girard', 'Liam', 'liam.girard@viacesi.com', 'cesi21', 1),
(51, 'Andre', 'Manon', 'manon.andre@viacesi.com', 'cesi22', 1),
(52, 'Lemoine', 'Gabriel', 'gabriel.lemoine@viacesi.com', 'cesi23', 1),
(53, 'Blanc', 'Louise', 'louise.blanc@viacesi.com', 'cesi24', 1),
(54, 'Gauthier', 'Maxime', 'maxime.gauthier@viacesi.com', 'cesi25', 1),
(55, 'Perrin', 'Camille', 'camille.perrin@viacesi.com', 'cesi26', 1),
(56, 'Lopez', 'Arthur', 'arthur.lopez@viacesi.com', 'cesi27', 1),
(57, 'Faure', 'Julien', 'julien.faure@viacesi.com', 'cesi28', 1),
(58, 'Carpentier', 'Sarah', 'sarah.carpentier@viacesi.com', 'cesi29', 1),
(59, 'Bouchet', 'Tom', 'tom.bouchet@viacesi.com', 'cesi30', 1),
(60, 'Airbus', 'Contact', 'contact@airbus.com', 'airbus1', 2),
(61, 'Total', 'Service', 'service@total.com', 'total2', 2),
(62, 'Vinci', 'Support', 'support@vinci.com', 'vinci3', 2),
(63, 'Orange', 'Partenaires', 'partenaires@orange.com', 'orange4', 2),
(64, 'Google', 'Tech', 'tech@google.com', 'google5', 2),
(65, 'Microsoft', 'Solutions', 'solutions@microsoft.com', 'microsoft6', 2),
(66, 'Apple', 'Informatique', 'informatique@apple.com', 'apple7', 2),
(67, 'Amazon', 'Ecommerce', 'ecommerce@amazon.com', 'amazon8', 2),
(68, 'Facebook', 'Marketing', 'marketing@facebook.com', 'facebook9', 2),
(69, 'Tesla', 'Innovation', 'innovation@tesla.com', 'tesla10', 2),
(70, 'IBM', 'Cloud', 'cloud@ibm.com', 'ibm11', 2),
(71, 'Intel', 'Hardware', 'hardware@intel.com', 'intel12', 2),
(72, 'Nvidia', 'Graphics', 'graphics@nvidia.com', 'nvidia13', 2),
(73, 'Siemens', 'Industrie', 'industrie@siemens.com', 'siemens14', 2),
(74, 'Samsung', 'Mobile', 'mobile@samsung.com', 'samsung15', 2),
(75, 'Lefèvre', 'Éléonore', 'eleonore.lefevre@cryf.com', 'cryf1', 3),
(76, 'Dubois', 'Augustin', 'augustin.dubois@cryf.com', 'cryf2', 3),
(77, 'Rousseau', 'Célestin', 'celestin.rousseau@cryf.com', 'cryf3', 3),
(78, 'Gauthier', 'Apolline', 'apolline.gauthier@cryf.com', 'cryf4', 3),
(79, 'Morin', 'Baptiste', 'baptiste.morin@cryf.com', 'cryf5', 3),
(80, 'Girard', 'Capucine', 'capucine.girard@cryf.com', 'cryf6', 3),
(81, 'Leroy', 'Daphné', 'daphne.leroy@cryf.com', 'cryf7', 3),
(82, 'Dumont', 'Eugène', 'eugene.dumont@cryf.com', 'cryf8', 3),
(83, 'Simon', 'Félicie', 'felicie.simon@cryf.com', 'cryf9', 3),
(84, 'Lambert', 'Gaspard', 'gaspard.lambert@cryf.com', 'cryf10', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`offre_id`) REFERENCES `offre_de_stage` (`id`),
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `offre_competence`
--
ALTER TABLE `offre_competence`
  ADD CONSTRAINT `offre_competence_ibfk_1` FOREIGN KEY (`offre_id`) REFERENCES `offre_de_stage` (`id`),
  ADD CONSTRAINT `offre_competence_ibfk_2` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`);

--
-- Contraintes pour la table `offre_de_stage`
--
ALTER TABLE `offre_de_stage`
  ADD CONSTRAINT `offre_de_stage_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
