-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2023, 09:11
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `something_from_nothing`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accepted`
--

CREATE TABLE `accepted` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `edited` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `id_recipe`, `id_user`, `content`, `created_at`, `edited`) VALUES
(1, 45, 1, 'magia', '2023-06-23 09:46:48', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favorite_recipe`
--

CREATE TABLE `favorite_recipe` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `unite` int(11) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `unite`, `accepted`) VALUES
(64, 'okon', 4, NULL),
(65, 'warta', 3, NULL),
(66, 'tymiank', 4, NULL),
(67, 'rym', 5, NULL),
(68, 'pingwin', 9, NULL),
(69, 'rerre', 2, NULL),
(70, 're', 2, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient_for_recipe`
--

CREATE TABLE `ingredient_for_recipe` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient_for_recipe`
--

INSERT INTO `ingredient_for_recipe` (`id`, `id_recipe`, `id_ingredient`, `unit_id`, `value`) VALUES
(21, 45, 64, 4, 0),
(22, 45, 65, 3, 0),
(23, 56, 66, 4, 0),
(24, 70, 67, 5, 3),
(25, 71, 68, 9, 1),
(26, 77, 69, 2, 3),
(27, 77, 70, 2, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lang`
--

CREATE TABLE `lang` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `initials` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `lang`
--

INSERT INTO `lang` (`id`, `name`, `initials`) VALUES
(1, 'Polski', 'PL'),
(2, 'Engilsh', 'ENG');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `preparation`
--

CREATE TABLE `preparation` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `preparation`
--

INSERT INTO `preparation` (`id`, `id_recipe`, `no`, `description`, `time`) VALUES
(13, 45, 1, '1', 1),
(14, 45, 2, '1', 2),
(15, 46, 1, '1', 1),
(16, 46, 2, '1', 2),
(17, 47, 1, '1', 1),
(18, 47, 2, '1', 2),
(19, 48, 1, '1', 1),
(20, 48, 2, '1', 2),
(21, 49, 1, '1', 1),
(22, 49, 2, '1', 2),
(23, 50, 1, '34e', 534),
(24, 51, 1, '34e', 534),
(25, 52, 1, '34e', 534),
(26, 53, 1, 'Przygotuj', 5),
(27, 54, 1, 'Przygotuj', 5),
(28, 55, 1, 'Przygotuj', 5),
(29, 56, 1, '344rw', 4),
(30, 57, 1, 'Przygotuj', 5),
(31, 58, 1, 'Przygotuj', 5),
(32, 59, 1, 'Przygotuj', 5),
(33, 60, 1, 'Przygotuj', 5),
(34, 61, 1, 'Przygotuj', 5),
(35, 62, 1, 'Przygotuj', 5),
(36, 63, 1, 'Przygotuj', 5),
(37, 64, 1, 'Przygotuj', 5),
(38, 65, 1, 'Przygotuj', 5),
(39, 66, 1, 'Przygotuj', 5),
(40, 67, 1, 'Przygotuj', 5),
(41, 68, 1, 'Przygotuj', 5),
(42, 69, 1, 'Przygotuj', 5),
(43, 70, 1, 'krok 1', 2),
(44, 71, 1, 'pingwiny dodać do wrzątku', 60),
(45, 72, 1, 'pingwiny dodać do wrzątku', 60),
(46, 78, 1, 'da', 2),
(47, 79, 1, 'da', 2),
(48, 80, 1, 'da', 2),
(49, 81, 1, 'da', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `lang` int(11) NOT NULL DEFAULT 2,
  `status` int(11) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `recipe`
--

INSERT INTO `recipe` (`id`, `name`, `description`, `id_user`, `lang`, `status`, `accepted`) VALUES
(45, 'kacper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(46, 'kacper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, 2, 2, NULL),
(47, 'kacper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(48, 'kacper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(49, 'kacper', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(50, 'CV2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(51, 'CV2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(52, 'CV2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(53, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(54, 't', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 2, NULL),
(55, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 2, NULL),
(56, 'spagethii', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(57, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 2, NULL),
(58, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 2, NULL),
(59, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(60, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(61, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(62, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(63, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(64, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(65, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(66, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(67, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(68, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(69, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 2, 2, NULL),
(70, '123', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 3, 2, 2, NULL),
(71, 'pingwiny w sosie własnym', 'Pingwiny', 3, 2, 2, NULL),
(72, 'pingwiny w sosie własnym', 'Pingwiny', 3, 2, 2, NULL),
(76, 'ert', 'reter', 3, 2, 2, NULL),
(77, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(78, 's', 'saas', 3, 2, 2, NULL),
(79, 's', 'saas', 3, 2, 2, NULL),
(80, 's', 'saas', 3, 2, 2, NULL),
(81, 's', 'saas', 3, 2, 2, NULL),
(82, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(83, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(84, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(85, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(86, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(87, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(88, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(89, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(90, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(91, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(92, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(93, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(94, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(95, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(96, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(97, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(98, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL),
(99, '', 'Kliknij przycisk i dodaj opis', 3, 2, 2, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'moderator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'private'),
(2, 'public');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token_expiration` date NOT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `unite`
--

CREATE TABLE `unite` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `short` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `unite`
--

INSERT INTO `unite` (`id`, `name`, `short`) VALUES
(1, 'kilogram', 'KG'),
(2, 'litr', 'L'),
(3, 'gram', 'G');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `nickName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `deactive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `role`, `nickName`, `email`, `pass`, `deactive`) VALUES
(1, 2, 'kacper', 'w@w.pl', '$2y$10$u5hJYD2kMT/pVSuYoNlelujYwpuHsOWhB/VxZqm92aIEBa8uIlb2a', NULL),
(3, 2, 'kac', 'w@p.pl', '$2y$10$AkIOH/1KBI.ffqLA44iVheFGkifXrEcF/8IoCOYqlt1r4matotDRy', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accepted`
--
ALTER TABLE `accepted`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_przepis_opis` (`id_recipe`),
  ADD KEY `fk_przepis_skladniki` (`id_ingredient`);

--
-- Indeksy dla tabeli `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `preparation`
--
ALTER TABLE `preparation`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accepted`
--
ALTER TABLE `accepted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `preparation`
--
ALTER TABLE `preparation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `unite`
--
ALTER TABLE `unite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
