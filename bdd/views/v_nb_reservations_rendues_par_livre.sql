-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 fév. 2023 à 04:14
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_msp2`
--

-- --------------------------------------------------------

--
-- Structure de la vue `v_nb_reservations_rendues_par_livre`
--

DROP VIEW IF EXISTS `v_nb_reservations_rendues_par_livre`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nb_reservations_rendues_par_livre`  AS SELECT `book`.`name` AS `name`, count(`book`.`id`) AS `amount` FROM (`log` join `book` on((`book`.`id` = `fn_get_book_id_from_booking_reference`(`log`.`reference_booking`)))) WHERE (`log`.`state` = 'Terminé') GROUP BY `book`.`id` ORDER BY `amount` DESC;

--
-- VIEW `v_nb_reservations_rendues_par_livre`
-- Données : Aucun(e)
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
