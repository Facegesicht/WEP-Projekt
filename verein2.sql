-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Dez 2017 um 16:39
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ppb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` varchar(36) NOT NULL,
  `username` varchar(8) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(300) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `basicFeeId` varchar(36) NULL,
  `agegroup` int(4) NULL,
  `isClerk` tinyint(1) NOT NULL,
  `isTrainer` tinyint(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sportingGroup` (
  `id` varchar(36) NOT NULL,
  `trainerId` varchar(36) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(500) NOT NULL,
  `maxMembers` tinyint(2) NOT NULL,
  `fee` decimal(4,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `userInGroup` (
  `userId` varchar(36) NOT NULL,
  `groupId` varchar(200) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `basicFee` (
  `id` varchar(36) NOT NULL,
  `description` varchar(200) NOT NULL,
  `fee` decimal(4,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `basicFee`
  ADD PRIMARY KEY (`id`); 

ALTER TABLE `sportingGroup`
  ADD PRIMARY KEY (`id`),
  ADD CONSTRAINT `FK_GroupTrainer` FOREIGN KEY (`trainerId`) REFERENCES `user`(`Id`);

ALTER TABLE `userInGroup`
  ADD PRIMARY KEY (`userId`, `groupId`),
  ADD CONSTRAINT `FK_userInGroupGroup` FOREIGN KEY (`groupId`) REFERENCES `sportingGroup`(`id`),
  ADD CONSTRAINT `FK_userInGroupuser` FOREIGN KEY (`userId`) REFERENCES `user`(`id`);


INSERT INTO `basicFee` (`id`, `description`, `fee`, `created`) VALUES
('ec265eaf-744b-11ec-b604-2c4d544f8fe0', 'erm&auml;&#223;igt', 4.00, '2022-01-13 08:36:37'),
('ec26f4df-744b-11ec-b604-2c4d544f8fe0', 'Kind', 2.00, '2022-01-13 08:36:37'),
('ec26f580-744b-11ec-b604-2c4d544f8fe0', 'Vollzahler', 8.00, '2022-01-13 08:36:37');

-- pw: 12345 -> $2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6
INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `email`, `pw`, `basicFeeId`, `agegroup`, `isClerk`, `isTrainer`, `created`) VALUES
('aabecc6d-744a-11ec-b604-2c4d544f8fe0', 'anna2001', 'Anna', 'Aufschlag', 'anna@test.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', 'ec265eaf-744b-11ec-b604-2c4d544f8fe0', 2001, 0, 1, '2022-01-13 08:27:38'),
('aabed8b7-744a-11ec-b604-2c4d544f8fe0', 'tanja07', 'Tanja', 'Turner', 'anna@test.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', 'ec265eaf-744b-11ec-b604-2c4d544f8fe0', 2007, 0, 0, '2022-01-13 08:27:38'),
('aabed932-744a-11ec-b604-2c4d544f8fe0', 'Theo20', 'Theo', 'Turner', 'anna@test.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', 'ec26f4df-744b-11ec-b604-2c4d544f8fe0', 2020, 0, 0, '2022-01-13 08:27:38'),
('aabed966-744a-11ec-b604-2c4d544f8fe0', 'beate', 'Beate', 'Bearbeiter', 'beate@test-verein.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', null, null, 1, 0, '2022-01-13 08:27:38'),
('aabed9c7-744a-11ec-b604-2c4d544f8fe0', 'Tina80', 'Tina', 'Trainer', 'tina@test-verein.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', null, null, 0, 1, '2022-01-13 08:27:38'),
('aabed9a7-744a-11ec-b604-2c4d544f8fe0', 'ulf72', 'Ulf', 'Unsportlich', 'ulf@test.de', '$2y$10$IeMpvUuMIrnxFHN.j94tEe.T1rjsTga1yYoyt5JAAXYUwbbjh1km6', 'ec26f580-744b-11ec-b604-2c4d544f8fe0', 1972, 0, 0, '2022-01-13 08:27:38');

INSERT INTO `sportingGroup` (`id`, `trainerId`, `title`, `description`, `maxMembers`, `fee`, `created`) VALUES
('334f569e-744f-11ec-b604-2c4d544f8fe0', 'aabed9c7-744a-11ec-b604-2c4d544f8fe0', 'Volleyball D1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci', 24, 2.00, '2022-01-13 09:00:05'),
('334febe5-744f-11ec-b604-2c4d544f8fe0', 'aabed9c7-744a-11ec-b604-2c4d544f8fe0', 'Badminton 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci', 16, 2.00, '2022-01-13 09:00:05'),
('334fecc2-744f-11ec-b604-2c4d544f8fe0', 'aabed9c7-744a-11ec-b604-2c4d544f8fe0', 'Bodenturnen 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci', 14, 3.00, '2022-01-13 09:00:05'),
('334ffe83-744f-11ec-b604-2c4d544f8fe0', 'aabecc6d-744a-11ec-b604-2c4d544f8fe0', 'Kinderturnen', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci', 12, 1.00, '2022-01-13 09:00:05');

INSERT INTO `userInGroup`(`userId`, `groupId`, `startDate`) VALUES 
('aabecc6d-744a-11ec-b604-2c4d544f8fe0', '334f569e-744f-11ec-b604-2c4d544f8fe0', '2020-07-01 12:00:00'),
('aabecc6d-744a-11ec-b604-2c4d544f8fe0', '334febe5-744f-11ec-b604-2c4d544f8fe0', '2018-07-01 12:00:00'),
('aabed8b7-744a-11ec-b604-2c4d544f8fe0', '334f569e-744f-11ec-b604-2c4d544f8fe0', '2021-07-01 12:00:00'),
('aabed8b7-744a-11ec-b604-2c4d544f8fe0', '334fecc2-744f-11ec-b604-2c4d544f8fe0', '2018-01-01 12:00:00'),
('aabed932-744a-11ec-b604-2c4d544f8fe0', '334ffe83-744f-11ec-b604-2c4d544f8fe0', '2021-01-01 12:00:00');

-- -------------------------------------------------------

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
