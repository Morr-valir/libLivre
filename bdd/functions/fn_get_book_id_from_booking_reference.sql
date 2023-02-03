DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_book_id_from_booking_reference`(`booking_reference` VARCHAR(255)) RETURNS int
BEGIN
SET @book_id := SPLIT_STR(booking_reference, '-', 2);
RETURN CONVERT(@book_id, UNSIGNED);
END$$
DELIMITER ;
