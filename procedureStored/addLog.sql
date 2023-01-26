DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addLog`(IN `referenceBooking` VARCHAR(255), IN `email` VARCHAR(255), IN `etat` VARCHAR(255))
BEGIN
	INSERT INTO log (refence_booking,email,etat,created_at) VALUES (referenceBooking,email,etat, NOW());
END$$
DELIMITER ;