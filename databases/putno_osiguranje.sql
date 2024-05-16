-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 01:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `putno_osiguranje`
--

-- --------------------------------------------------------

--
-- Table structure for table `dodatni_osiguranici`
--

CREATE TABLE `dodatni_osiguranici` (
  `id` int(11) NOT NULL,
  `nosilac_osiguranja_id` int(11) NOT NULL,
  `ime_prezime` varchar(255) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `broj_pasosa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dodatni_osiguranici`
--

INSERT INTO `dodatni_osiguranici` (`id`, `nosilac_osiguranja_id`, `ime_prezime`, `datum_rodjenja`, `broj_pasosa`) VALUES
(15, 23, 'Nikola Milosavljevic', '2024-05-17', '12'),
(16, 23, 'Bogdan Bogdanovic', '2024-05-10', '14'),
(17, 25, 'Test', '2024-05-23', '132'),
(18, 25, 'Test 2', '2024-05-18', '543'),
(19, 25, 'Test 3', '2024-05-18', '43');

-- --------------------------------------------------------

--
-- Table structure for table `nosilac_osiguranja`
--

CREATE TABLE `nosilac_osiguranja` (
  `id` int(11) NOT NULL,
  `ime_prezime` varchar(255) NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `broj_pasosa` varchar(50) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `datum_putovanja` date NOT NULL,
  `datum_povratka` date NOT NULL,
  `vrsta_osiguranja` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nosilac_osiguranja`
--

INSERT INTO `nosilac_osiguranja` (`id`, `ime_prezime`, `datum_rodjenja`, `broj_pasosa`, `telefon`, `email`, `datum_putovanja`, `datum_povratka`, `vrsta_osiguranja`) VALUES
(22, 'Milan Ristic', '2002-01-23', '11', '1242512', 'milanr.ristic2002@gmail.com', '2024-05-17', '2024-05-25', 'individualno'),
(23, 'Bogdan Milosevic', '2024-05-16', '7', '1242512', 'milan.ristic@mvsoft.rs', '2024-05-17', '2024-05-23', 'grupno'),
(25, 'Nikola Jokic', '2024-05-18', '7', '5643245', 'milanr.ristic2002@gmail.com', '2024-05-17', '2024-05-23', 'grupno');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dodatni_osiguranici`
--
ALTER TABLE `dodatni_osiguranici`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nosilac_osiguranja_id` (`nosilac_osiguranja_id`);

--
-- Indexes for table `nosilac_osiguranja`
--
ALTER TABLE `nosilac_osiguranja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dodatni_osiguranici`
--
ALTER TABLE `dodatni_osiguranici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `nosilac_osiguranja`
--
ALTER TABLE `nosilac_osiguranja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dodatni_osiguranici`
--
ALTER TABLE `dodatni_osiguranici`
  ADD CONSTRAINT `dodatni_osiguranici_ibfk_1` FOREIGN KEY (`nosilac_osiguranja_id`) REFERENCES `nosilac_osiguranja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
