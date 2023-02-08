DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ps_toggle_book_is_available`(IN `bookId` INT(255))
BEGIN
DECLARE isBookAvailable BOOLEAN;

SET isBookAvailable = (SELECT is_available FROM book WHERE id=bookId);

UPDATE book SET is_available=(!isBookAvailable) WHERE id=bookId;
END$$
DELIMITER ;
