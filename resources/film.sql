-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2017 at 11:32 AM
-- Server version: 5.7.18-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afpa-bay`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `titre` varchar(256) NOT NULL,
  `auteur` varchar(256) NOT NULL,
  `acteurs` varchar(1024) NOT NULL,
  `date_sortie` year(4) NOT NULL,
  `thumbnail` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `titre`, `auteur`, `acteurs`, `date_sortie`, `thumbnail`) VALUES
(1, 'Bernie', 'Dupontel Albert', 'Dupontel Albert', 1996, 'http://fr.web.img6.acsta.net/medias/nmedia/18/64/13/46/18754633.jpg'),
(2, 'sdf', 'sdf', 'sdf', 2011, NULL),
(3, 'sdcsd', 'sdc', 'sdc', 2015, NULL),
(4, 'sdcsd', 'sdc', 'sdc', 2015, NULL),
(5, 'rturtu', 'rtutru', 'rtutr', 2005, NULL),
(6, 'kikou des bois', 'zonote', 'talui', 2005, NULL),
(7, 'sdcsdsdcsd', 'sdcsdcsdc', 'sdcsdcsdcdc', 2004, NULL),
(8, 'taliu', 'zonote', 'pikatchou', 2005, NULL),
(9, 'hgfj', 'gfj', 'fgjf', 2014, NULL),
(10, 'ddg', 'dfgdfg', 'dfgdfg', 1986, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `mdp`, `email`) VALUES
(1, 'lionel', '$2y$10$jd3m6moA6rQ.p8OUuwO.UO3XAxml/Z6GW/.WxK1qzTnnK6py38sbS', 'ldubbu@zonote.fr');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;