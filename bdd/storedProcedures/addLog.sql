DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addLog`(IN `referenceBooking` VARCHAR(255), IN `email` VARCHAR(255), IN `state` VARCHAR(255))
BEGIN
	INSERT INTO log (reference_booking,email,state,created_at) VALUES (referenceBooking,email,state, NOW());
END$$
DELIMITER ;
