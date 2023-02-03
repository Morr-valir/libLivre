DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_update_booking_reference`(IN `idBooking` INT(255))
BEGIN
DECLARE ref VARCHAR(255);
DECLARE verif INT(255);
SET ref=fn_get_booking_reference_from_id(idBooking);
SET verif=(SELECT id FROM booking WHERE id=idBooking);
IF verif=idBooking THEN
	UPDATE booking SET reference=ref WHERE booking.id=idBooking;
ELSE
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Réservation inconnue";
END IF;
END$$
DELIMITER ;
