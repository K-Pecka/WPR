-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Cze 2023, 22:52
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
-- Struktura tabeli dla tabeli `favorite_recipe`
--

CREATE TABLE `favorite_recipe` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients`
--

CREATE TABLE `ingredients` (
  `ID_skladnika` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredients`
--

INSERT INTO `ingredients` (`ID_skladnika`, `name`) VALUES
(1, 'jajko'),
(2, 'boczek'),
(3, 'cebula'),
(4, 'masło'),
(5, 'mleko'),
(6, 'płatki kukurydziane'),
(7, 'woda gazowana'),
(8, 'cukier waniliowy'),
(9, 'makaron'),
(10, 'łosoś w plastrach'),
(11, 'szpinak'),
(12, 'śmietana'),
(13, 'ser parmezan'),
(14, 'mąka pszenna'),
(15, 'banany'),
(16, 'miód'),
(17, 'mozzarella'),
(18, 'czarna oliwka'),
(19, 'suszone pomidory'),
(20, 'listek bazylii'),
(21, 'sól'),
(22, 'tymianek'),
(23, 'mięso mielone'),
(24, 'pomidor'),
(25, 'ząbek czonsku'),
(26, 'olej'),
(27, 'ryż');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient_for_recipe`
--

CREATE TABLE `ingredient_for_recipe` (
  `ID` int(11) NOT NULL,
  `ID_przepis` int(11) NOT NULL,
  `ID_skladnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient_for_recipe`
--

INSERT INTO `ingredient_for_recipe` (`ID`, `ID_przepis`, `ID_skladnika`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 5),
(8, 3, 7),
(9, 3, 1),
(10, 3, 8),
(11, 4, 9),
(12, 4, 10),
(13, 4, 11),
(14, 4, 12),
(15, 4, 13),
(16, 5, 14),
(17, 5, 1),
(18, 5, 5),
(19, 5, 15),
(20, 5, 16),
(21, 6, 9),
(22, 6, 17),
(23, 6, 18),
(24, 6, 19),
(25, 6, 20),
(26, 7, 9),
(27, 7, 21),
(28, 7, 22),
(29, 7, 23),
(30, 7, 24),
(31, 7, 25),
(32, 7, 26),
(33, 8, 3),
(34, 8, 4),
(35, 8, 5),
(36, 8, 1),
(37, 8, 6),
(38, 8, 27),
(39, 9, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `preparation`
--

CREATE TABLE `preparation` (
  `id` int(11) NOT NULL,
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
  `id_user` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `recipe`
--

INSERT INTO `recipe` (`id`, `nazwa`, `id_user`) VALUES
(1, 'Jajecznica z boczkiem', 0),
(2, 'płatki kukurydziane', 0),
(3, 'naleśniki', 0),
(4, 'makaron ze szpinakiem i łososiem', 0),
(5, 'placuszki bananowe', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `emile` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ID_skladnika`);

--
-- Indeksy dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_przepis_opis` (`ID_przepis`),
  ADD KEY `fk_przepis_skladniki` (`ID_skladnika`);

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
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ID_skladnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
