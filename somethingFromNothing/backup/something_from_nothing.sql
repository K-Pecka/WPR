-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Cze 2023, 09:36
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
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient_for_recipe`
--

CREATE TABLE `ingredient_for_recipe` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `measure` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `image` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(2, 'litr', 'L');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `nickName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `preparation`
--
ALTER TABLE `preparation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
