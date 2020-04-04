-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2020 at 03:04 PM
-- Server version: 10.3.20-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `affectation`
--

DROP TABLE IF EXISTS `affectation`;
CREATE TABLE IF NOT EXISTS `affectation` (
  `idProf` int(20) NOT NULL AUTO_INCREMENT,
  `idSalle` int(20) NOT NULL,
  `date` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `Marge` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `affectation`
--

INSERT INTO `affectation` (`idProf`, `idSalle`, `date`, `date_fin`, `Marge`) VALUES
(1, 16, '2020-03-08 21:00:00', '2020-03-08 23:30:00', 9000),
(3, 16, '2020-03-08 18:00:00', '2020-03-08 20:30:00', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
CREATE TABLE IF NOT EXISTS `batiment` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batiment`
--

INSERT INTO `batiment` (`id`, `nom`) VALUES
(1, 'Batiment_A'),
(2, 'Batiment_B'),
(3, 'Batiment_C'),
(4, 'Batiment_D'),
(5, 'Batiment_E');

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

DROP TABLE IF EXISTS `prof`;
CREATE TABLE IF NOT EXISTS `prof` (
  `idProf` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`idProf`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prof`
--

INSERT INTO `prof` (`idProf`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'Mohammed', 'AL JADD', 'aljadd700@inpt.ac.ma', 'inpt99'),
(2, 'Hassan', 'OMAR', 'hassan_omar@inpt.ac.ma', 'omarict55'),
(3, 'Hajar', 'BERADDA', 'hajar_berrada@inpt.ac.ma', 'berradainpt22'),
(4, 'Maryem', 'SOUAD', 'maryem_souad@inpt.ac.ma', 'souadinpt22'),
(5, 'Amine', 'SAID', 'amine_said@inpt.ma', 'saidinpt54'),
(6, 'Khadija', 'ALAMI', 'khadija_alami@inpt.ma', 'alamiinpt54'),
(7, 'Ahmed', 'FAHIM', 'ahmed_fahim@inpt.ac.ma', 'fahiminpt102'),
(8, 'Mohamed', 'ABDELLAH', 'mohamed_abdellah@inpt.ac.ma', 'abdellahinpt911'),
(9, 'Abdellah', 'LOTIF', 'abdellah78@inpt.ac.ma', 'lotifi99inpt'),
(10, 'Amine', 'AL JADD', 'amine199@inpt.ac.ma', 'amine89inpt0'),
(11, 'Souad', 'BERRADA', 'berrada10@inpt.ac.ma', 'ber2019ine');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `idBatiment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id`, `nom`, `idBatiment`) VALUES
(1, 'salle001', 1),
(2, 'salle002', 1),
(3, 'salle003', 1),
(4, 'salle004', 1),
(5, 'salle005', 1),
(6, 'salle006', 1),
(7, 'salle007', 1),
(8, 'salle008', 1),
(9, 'salle009', 1),
(10, 'salle010', 1),
(11, 'salle011', 2),
(12, 'salle012', 2),
(13, 'salle013', 2),
(14, 'salle014', 2),
(15, 'salle015', 2),
(16, 'salle016', 2),
(17, 'salle017', 2),
(18, 'salle018', 2),
(19, 'salle019', 2),
(20, 'salle020', 2),
(21, 'salle021', 3),
(22, 'salle022', 3),
(23, 'salle023', 3),
(24, 'salle024', 3),
(25, 'salle025', 3),
(26, 'salle026', 3),
(27, 'salle027', 3),
(28, 'salle028', 3),
(29, 'salle029', 3),
(30, 'salle030', 3),
(31, 'salle031', 4),
(32, 'salle032', 4),
(33, 'salle033', 4),
(34, 'salle034', 4),
(35, 'salle035', 4),
(36, 'salle036', 4),
(37, 'salle037', 4),
(38, 'salle038', 4),
(39, 'salle039', 4),
(40, 'salle040', 4),
(42, 'Amphi_E1', 5),
(43, 'Amphi_E2', 5),
(44, 'Amphi_E3', 5);

DELIMITER $$
--
-- Events
--
DROP EVENT `delete_old`$$
CREATE DEFINER=`root`@`localhost` EVENT `delete_old` ON SCHEDULE EVERY 1 SECOND STARTS '2020-03-06 12:38:47' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM affectation WHERE date_fin<now()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
