-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 03 fév. 2023 à 11:40
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
-- Doublure de structure pour la vue `v_nb_reservations_rendues_par_livre`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `v_nb_reservations_rendues_par_livre`;
CREATE TABLE IF NOT EXISTS `v_nb_reservations_rendues_par_livre` (
`amount` bigint
,`name` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure de la vue `v_nb_reservations_rendues_par_livre`
--
DROP TABLE IF EXISTS `v_nb_reservations_rendues_par_livre`;

DROP VIEW IF EXISTS `v_nb_reservations_rendues_par_livre`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nb_reservations_rendues_par_livre`  AS SELECT `book`.`name` AS `name`, count(`book`.`id`) AS `amount` FROM (`log` join `book` on((`book`.`id` = `fn_get_book_id_from_booking_reference`(`log`.`reference_booking`)))) WHERE (`log`.`state` = 'Terminé') GROUP BY `book`.`id`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
