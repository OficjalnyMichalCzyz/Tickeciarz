-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 01:32 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza_uzytkownikow`
--

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID_uzytkownika` int(32) NOT NULL COMMENT 'ID użytkownika, od 0',
  `poziom_uprawnien` tinyint(1) NOT NULL COMMENT 'poziom uprawnien 0-9',
  `nazwa_uzytkownika` varchar(129) COLLATE utf8mb4_bin NOT NULL COMMENT 'duże + małe + liczby',
  `haslo_uzytkownika` varchar(129) COLLATE utf8mb4_bin NOT NULL COMMENT 'hashowane SHA512',
  `token_sesji` varchar(129) COLLATE utf8mb4_bin NOT NULL COMMENT 'hash z adresu IP oraz godziny zalogowania i hasła',
  `godzina_zalogowania` varchar(64) COLLATE utf8mb4_bin NOT NULL COMMENT 'godzina ostatniego zalogowania na server',
  `adres_ip_uzytkownika` varchar(64) COLLATE utf8mb4_bin NOT NULL COMMENT 'adres ip z którego się zalogowano'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID_uzytkownika`, `poziom_uprawnien`, `nazwa_uzytkownika`, `haslo_uzytkownika`, `token_sesji`, `godzina_zalogowania`, `adres_ip_uzytkownika`) VALUES
(0, 9, 'administrator', 'fa585d89c851dd338a70dcf535aa2a92fee7836dd6aff1226583e88e0996293f16bc009c652826e0fc5c706695a03cddce372f139eff4d13959da6f1f5d3eabe', '28506217c750716eaa9dcab9119fd4325528b6f7fc9c8b6ea98948d50df450298f12f3e6abef1f1ae9fff87ed7ba77517802128ac2e030c6670dc1877da92ee6', 'Friday 22nd of March 2019 03:32:01 PM', '::1'),
(3, 3, 'Marek Moskwa', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '77f53068b3241104cfc025d6b6de578fe44c13d2746d5b84857491c87db59c6a7c5f6cf2fbda5caca0e9ecfbc5deed5db3a7495301225334cdf3ac7cb4dd6399', 'Wednesday 20th of March 2019 11:47:44 AM', '::1'),
(1000, 0, 'Grazyna Zydek', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'brak', '', 'brak');

-- --------------------------------------------------------

--
-- Table structure for table `zgloszenia`
--

CREATE TABLE `zgloszenia` (
  `ID_inc` int(16) NOT NULL COMMENT 'ID incydentu',
  `uprawnienia` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'uprawnienia zdefiniowane metodą BIT FIELD(1 dostep, 0 odmowa dlauzytkownika od ID równym odległowsi od prawej strony)',
  `naglowek` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'nagłówek zgłoszenia',
  `tresc` varchar(8000) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'treść incydentu',
  `miejsce` varchar(127) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'miejsce incydentu',
  `kto_utworzyl_ticket` int(16) NOT NULL COMMENT 'id pracownika który utworzył ticket',
  `wlasciciel_ticketu` int(16) NOT NULL COMMENT 'id właściciela ticketu',
  `kto_pracuje_nad_ticketem` int(16) NOT NULL COMMENT 'id pracownika który pracuje nad ticketem',
  `ostatnia_modyfikacja` date NOT NULL COMMENT 'data ostatniej modyfikacji'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `zgloszenia`
--

INSERT INTO `zgloszenia` (`ID_inc`, `uprawnienia`, `naglowek`, `tresc`, `miejsce`, `kto_utworzyl_ticket`, `wlasciciel_ticketu`, `kto_pracuje_nad_ticketem`, `ostatnia_modyfikacja`) VALUES
(2, '1', 'DALEJ NIE DZIAŁA CZYTNIK!!!!!', 'DALEJ NIKT NIE NAPRAWIŁ CZYTNIKA TE FAKTURY MUSZE WYSŁAĆ DZIŚ', 'Třinecké železárny', 3, 1000, 3, '2019-03-07'),
(3, '2', 'PILNE!!!!!!!!!!!!!!!', 'MUSIAŁAM WYSŁAĆ U KOLEŻANKI ALE TE DZISIEJSZE TO TYLKO Z MOJEGO MOZNA NAPRAWCIE PLISKA', 'Třinecké železárny', 3, 1000, 3, '2019-03-07'),
(4, '9', 'Rolety', 'Proszę o zamówienie rolet bo mi świeci!', 'Kopalnia Wujek', 0, 1, 1, '2019-03-20'),
(5, '1', 'Nie działa czytnik.', 'Dzieńdobry. Wysyłałam faktury do Borsuka i czytnik pokazywać jakies błędy że nie wykrywa czytnika. PILNE', 'Třinecké železárny', 3, 1000, 3, '2019-03-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID_uzytkownika`);

--
-- Indexes for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  ADD PRIMARY KEY (`ID_inc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID_uzytkownika` int(32) NOT NULL AUTO_INCREMENT COMMENT 'ID użytkownika, od 0', AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `zgloszenia`
--
ALTER TABLE `zgloszenia`
  MODIFY `ID_inc` int(16) NOT NULL AUTO_INCREMENT COMMENT 'ID incydentu', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
