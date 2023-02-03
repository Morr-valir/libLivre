DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_booking_reference_from_id`(`idBooking` INT(255)) RETURNS varchar(255) CHARSET utf8mb4
BEGIN
DECLARE userId INT(255);
DECLARE bookId INT(255);

SET userId=(SELECT user_id FROM booking WHERE id = idBooking);
SET bookId=(SELECT book_id FROM booking WHERE id = idBooking);

RETURN CONCAT(userId,'-',bookId,'-',idBooking);

END$$
DELIMITER ;
