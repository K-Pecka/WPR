-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Cze 2023, 11:10
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
  `content` varchar(255) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `id_recipe`, `content`, `author`, `created_at`, `parent_id`) VALUES
(1, 10, 'To jest świetna strona!', 'JohnDoe', '2023-06-14 01:34:34', NULL),
(2, 10, 'to kom 2', 'nieznany', '2023-06-14 01:34:37', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `favorite_recipe`
--

CREATE TABLE `favorite_recipe` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `favorite_recipe`
--

INSERT INTO `favorite_recipe` (`id`, `id_user`, `id_recipe`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 2, 4),
(5, 3, 1),
(6, 3, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `accepted`) VALUES
(28, 'Makaron spaghetti', NULL),
(29, 'Mięso mielone', NULL),
(30, 'Cebula', NULL),
(31, 'Czosnek', NULL),
(32, 'Marchewka', NULL),
(33, 'Seler', NULL),
(34, 'Pomidory pelati', NULL),
(35, 'Masło', NULL),
(36, 'Bułka tarta', NULL),
(37, 'Jajko', NULL),
(38, 'Schab', NULL),
(39, 'Mąka pszenna', NULL),
(40, 'Jajko', NULL),
(41, 'Chleb tostowy', NULL),
(42, 'Filet z kurczaka', NULL),
(43, 'Sałata rzymska', NULL),
(44, 'Sos Caesar', NULL),
(45, 'Brokuły', NULL),
(46, 'Śmietana', NULL),
(47, 'Rosół', NULL),
(48, 'Maliny', NULL),
(49, 'Cukier puder', NULL),
(50, 'Mąka pszenna', NULL),
(51, 'Masło', NULL),
(52, 'Jajko', NULL),
(53, 'Cukier', NULL),
(54, 'Proszek do pieczenia', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredient_for_recipe`
--

CREATE TABLE `ingredient_for_recipe` (
  `id` int(11) NOT NULL,
  `id_recipe` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ingredient_for_recipe`
--

INSERT INTO `ingredient_for_recipe` (`id`, `id_recipe`, `id_ingredient`) VALUES
(40, 10, 28),
(41, 10, 29),
(42, 10, 30),
(43, 11, 28),
(44, 11, 30),
(45, 12, 28),
(46, 12, 54);

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
(1, 10, 1, 'Gotuj makaron w osolonej wodzie zgodnie z instrukcją na opakowaniu.', 15),
(2, 10, 2, 'Rozgrzej patelnię i podsmaż mięso mielone.', 10),
(3, 121, 2, 'Dodaj posiekaną cebulę i czosnek, smaż przez 5 minut.', 5),
(4, 10, 4, 'Dodaj marchewkę i selera, smaż przez kolejne 5 minut.', 5),
(5, 10, 5, 'Dodaj pomidory pelati i masło, dusz przez 20 minut.', 20);

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

--
-- Zrzut danych tabeli `rating`
--

INSERT INTO `rating` (`id`, `id_recipe`, `id_user`, `rating`) VALUES
(1, 10, 1, 4),
(2, 11, 1, 5),
(3, 12, 2, 3),
(4, 13, 2, 4),
(5, 14, 2, 5),
(6, 11, 3, 2),
(7, 12, 3, 3);

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
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `recipe`
--

INSERT INTO `recipe` (`id`, `name`, `description`, `image`, `id_user`, `accepted`) VALUES
(10, 'Spaghetti Bolognese', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL),
(11, 'Kotlet Schabowy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 2, NULL),
(12, 'Sałatka Cezar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL),
(13, 'Krem z Brokułów', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 2, NULL),
(14, 'Tarta z Malinami', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL),
(15, 'Spaghetti Bolognese', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL),
(16, 'Kotlet Schabowy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 2, NULL),
(17, 'Sałatka Cezar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL),
(18, 'Krem z Brokułów', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 2, NULL),
(19, 'Tarta z Malinami', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat urna nisl, eget porta libero sagittis eget. Etiam elementum, elit nec laoreet feugiat, erat turpis volutpat tortor, vitae ornare dolor augue vitae nisi. Etiam semper aliquet odio, eu volutpat mauris lacinia ac. Pellentesque commodo blandit sapien in porttitor. Proin porttitor, est non vestibulum luctus, urna nunc egestas elit, eget imperdiet leo nisi vulputate urna. Aliquam sollicitudin orci eget nulla volutpat tincidunt. Quisque interdum dapibus ligula, vel rutrum diam volutpat non. Nam ipsum ipsum, consectetur sed eros sit amet, facilisis vulputate orci.\r\n\r\nFusce orci quam, placerat sed arcu a, commodo ullamcorper ipsum. Mauris ultricies non justo sit amet luctus. Integer tempor malesuada fermentum. Donec tellus nulla, efficitur ac est et, cursus sagittis lectus. Nam turpis velit, finibus id sem ac, eleifend lacinia leo. Duis at egestas dolor. Quisque pulvinar est purus, id convallis ligula eleifend nec. Curabitur eget leo sed purus placerat semper non nec arcu. Suspendisse pulvinar est in lectus dictum rutrum. Morbi rhoncus malesuada nisl, vel consectetur lacus hendrerit vel. Morbi ante tortor, semper sit amet pellentesque eget, interdum non nulla. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam id sapien sit amet ligula ornare dictum non id arcu.\r\n\r\nCurabitur rutrum eu lacus nec volutpat. Maecenas convallis lorem ac augue porta congue. Donec pharetra velit vel neque porttitor sollicitudin. Pellentesque at gravida lacus. Aenean ac vestibulum nulla. Aenean luctus pulvinar augue et ultrices. Proin pretium velit ut mattis tincidunt. Etiam eu lorem quis ligula pellentesque tempus. Suspendisse convallis blandit quam, non tristique augue feugiat at. Cras varius, dolor ut volutpat vestibulum, eros neque convallis justo, vel maximus mauris mi volutpat nibh. Aliquam ultrices consectetur eros ac fermentum. Maecenas varius, dui non tincidunt vestibulum, diam massa efficitur justo, at lobortis nisi nulla consequat augue. Nulla vitae risus vel magna vehicula ultricies. Quisque malesuada varius efficitur. Donec sed lorem laoreet, porttitor ante sit amet, volutpat sem. In elementum, mauris quis imperdiet eleifend, sapien ante vulputate risus, a consequat diam arcu et nunc.\r\n\r\nNam nulla nunc, varius ut ligula vitae, placerat interdum sem. Praesent at lectus id lectus cursus fringilla. Nulla sodales erat et est finibus aliquet. Fusce ut eros libero. Suspendisse at sem ullamcorper, pharetra arcu hendrerit, aliquet leo. Aliquam placerat pretium sodales. Nullam ipsum neque, euismod quis velit id, placerat feugiat massa. Nulla fringilla nec velit sed auctor. Ut fringilla nisi est, ut ultricies augue mattis ut. Proin vulputate nisl sit amet rutrum dictum. Nam eget nisi mi. Praesent vehicula, leo efficitur volutpat rutrum, justo turpis vestibulum quam, ut pulvinar libero mi nec nisi. Suspendisse sit amet turpis blandit, placerat est id, facilisis ante. Curabitur accumsan lorem arcu, et condimentum tortor lobortis eget.\r\n\r\nIn hac habitasse platea dictumst. Suspendisse tellus quam, mollis ac ante cursus, fermentum gravida enim. Sed et semper eros. Donec fermentum tempor purus eu mollis. Suspendisse eget ante turpis. Phasellus pellentesque risus erat, eget tristique felis tempus vel. Nulla facilisi. Cras non velit nunc. Sed id bibendum ligula. Aenean consequat urna.', 'random.jpg', 1, NULL);

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
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `role`, `nickName`, `email`, `pass`) VALUES
(22, 2, 'kac', 'w@w.pl', '$2y$10$PCggKvK4HwLoS8d78KfYuO190siD7MQrTgDoKco9TIWJ5frcpEM6K');

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
-- Indeksy dla tabeli `token`
--
ALTER TABLE `token`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `favorite_recipe`
--
ALTER TABLE `favorite_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT dla tabeli `ingredient_for_recipe`
--
ALTER TABLE `ingredient_for_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT dla tabeli `preparation`
--
ALTER TABLE `preparation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
