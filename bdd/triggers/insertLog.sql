CREATE TRIGGER `insertLog` BEFORE DELETE ON `booking`
 FOR EACH ROW BEGIN
SET @msgError := 'La suppression de la reservertion est interdite';

SET @stateName := (SELECT state_booking.name FROM state_booking WHERE state_booking.id = OLD.state_id);

SET @userEmail := (SELECT user.email FROM USER WHERE user.id = OLD.user_id);

SET @bookId := (SELECT booking_book.book_id FROM booking INNER JOIN booking_book ON booking.id = booking_book.booking_id WHERE booking.id = OLD.id);

IF @stateName = 'Terminé' OR @stateName = 'Annulé'
THEN
CALL addLog(OLD.reference,@userEmail,@stateName);
UPDATE book SET book.is_available = 1 
WHERE book.id = @bookId;
ELSE
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msgError;
END IF;
END