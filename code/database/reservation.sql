-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2020 at 10:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

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

CREATE TABLE `affectation` (
  `idProf` int(20) NOT NULL,
  `idSalle` int(20) NOT NULL,
  `date` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `Marge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `affectation`
--

INSERT INTO `affectation` (`idProf`, `idSalle`, `date`, `date_fin`, `Marge`) VALUES
(2, 1, '2020-05-06 09:00:00', '2020-05-06 12:00:00', 14400),
(3, 11, '2020-05-06 09:00:00', '2020-05-06 12:00:00', 14400),
(4, 12, '2020-05-07 09:00:00', '2020-05-07 12:00:00', 14400),
(5, 21, '2020-05-07 09:00:00', '2020-05-07 12:00:00', 14400),
(6, 31, '2020-05-07 09:00:00', '2020-05-07 12:00:00', 14400),
(7, 41, '2020-05-07 09:00:00', '2020-05-07 12:00:00', 14400);

-- --------------------------------------------------------

--
-- Table structure for table `batiment`
--

CREATE TABLE `batiment` (
  `id` int(20) NOT NULL,
  `nom` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `blocked_user`
--

CREATE TABLE `blocked_user` (
  `email` varchar(30) NOT NULL,
  `attempts` int(10) NOT NULL,
  `block_time` int(10) NOT NULL,
  `block` varchar(5) NOT NULL,
  `lastAttemp` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocked_user`
--

INSERT INTO `blocked_user` (`email`, `attempts`, `block_time`, `block`, `lastAttemp`) VALUES
('maha_alami@inpt.ma', 11, 6736, 'yes', '2020-05-05 20:01:04.000000'),
('saidaMe@ine.inpt.ma', 11, 6805, 'yes', '2020-05-05 20:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE `forget_password` (
  `email` varchar(50) NOT NULL,
  `random` int(20) NOT NULL,
  `validity` int(50) NOT NULL,
  `fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

CREATE TABLE `prof` (
  `idProf` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `gender` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prof`
--

INSERT INTO `prof` (`idProf`, `nom`, `prenom`, `email`, `password`, `gender`) VALUES
(1, 'Mohammed', 'AL JADD', 'aljadd.mohammed@ine.inpt.ma', '185aef3b1c810799a6be8314abf6512c', 'M'),
(2, 'Hassan', 'OMAR', 'hassan_omar@inpt.ac.ma', 'b3ddd238d6184cfd458205957c535457', 'M'),
(3, 'Hajar', 'BERADDA', 'hajar_berrada@inpt.ac.ma', '3f595562018cf3e30f8c8abe3d85edfc', 'F'),
(4, 'Maryem', 'SOUAD', 'maryem_souad@inpt.ac.ma', '2ea0689028b34656a4876fcd8824dab1', 'F'),
(5, 'Maha', 'ALAMI', 'maha_alami@inpt.ma', '8886c6191be8f53ebabcd957f6161712', 'F'),
(6, 'Fatima', 'AMINI', 'fati_amini@ine.inpt.ma', 'a41185c4140b74a0e2d5f2a82103c5bf', 'F'),
(7, 'Kawtar', 'HABIBA', 'kawtar@inpt.ac.ma', '4bcb345bad91feeebeaa34b8610c2120', 'F'),
(8, 'Saida', 'Maryem', 'saidaMe@ine.inpt.ma', 'e177640af5108663441301834bbfb69e', 'F'),
(9, 'Ahmed', 'Fahim', 'fahimahmed@ine.inpt.ma', '24fab433db521ef5eadbea5efb4edf3d', 'M'),
(10, 'Rachid', 'Alaoui', 'alaouirachid@ine.inpt.ma', 'bbb61fa7a1697e4cc572db4280dfc059', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `idBatiment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(41, 'Amphi_E1', 5),
(42, 'Amphi_E2', 5),
(43, 'Amphi_E3', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectation`
--
ALTER TABLE `affectation`
  ADD PRIMARY KEY (`idProf`);

--
-- Indexes for table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_user`
--
ALTER TABLE `blocked_user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`idProf`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affectation`
--
ALTER TABLE `affectation`
  MODIFY `idProf` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prof`
--
ALTER TABLE `prof`
  MODIFY `idProf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old` ON SCHEDULE EVERY 1 SECOND STARTS '2020-03-06 12:38:47' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM affectation WHERE date_fin<now()$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease the margin` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-25 20:00:33' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE affectation
set
affectation.Marge = TIMESTAMPDIFF(second,now(),affectation.date_fin)

WHERE
affectation.date < now()$$

CREATE DEFINER=`root`@`localhost` EVENT `delete_randon` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-27 02:14:48' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM forget_password WHERE forget_password.validity <0$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease random validty` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-27 02:26:38' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE forget_password
set
forget_password.validity = TIMESTAMPDIFF(second,now(),forget_password.fin)

WHERE 1$$

CREATE DEFINER=`root`@`localhost` EVENT `block user` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-29 01:16:14' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE blocked_user INNER JOIN forget_password ON blocked_user.email=forget_password.email
set
blocked_user.block = 'yes',
blocked_user.block_time=7200,
forget_password.fin=now()

WHERE
blocked_user.attempts=11
and
blocked_user.block_time=1
and 
blocked_user.email=forget_password.email$$

CREATE DEFINER=`root`@`localhost` EVENT `decrease block time` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-29 01:33:02' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE blocked_user
SET
blocked_user.block_time =blocked_user.block_time-1
WHERE
blocked_user.block ='yes'$$

CREATE DEFINER=`root`@`localhost` EVENT `unblock user` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-29 03:57:54' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM blocked_user WHERE blocked_user.block_time<5 and blocked_user.block='yes'$$

CREATE DEFINER=`root`@`localhost` EVENT `clear block` ON SCHEDULE EVERY 1 SECOND STARTS '2020-04-29 06:14:06' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM blocked_user
WHERE TIMESTAMPDIFF(second,blocked_user.lastAttemp,now())>3600 and blocked_user.block !='yes'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
