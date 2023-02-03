DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_booking_id_from_reference`(`bookingReference` VARCHAR(255)) RETURNS int
BEGIN
DECLARE bookingId VARCHAR(255);
SET bookingId = SPLIT_STR(bookingReference, '-', 3);
RETURN CONVERT(bookingId, UNSIGNED);
END$$
DELIMITER ;
