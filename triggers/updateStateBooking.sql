DELIMITER //

CREATE TRIGGER `updateStateBooking2` AFTER UPDATE ON `booking`
 FOR EACH ROW BEGIN
SET @stateName := (SELECT state_booking.name FROM state_booking WHERE state_booking.id = NEW.state_id);

SET @userEmail := (SELECT user.email FROM USER WHERE user.id = NEW.user_id);

SET @bookId := (SELECT booking_book.book_id FROM booking INNER JOIN booking_book ON booking.id = booking_book.booking_id WHERE booking.id = NEW.ID);

IF @stateName = "Terminé"
THEN 
CALL addLog(NEW.reference,@userEmail,@stateName);
UPDATE book SET book.is_available = 1 
WHERE book.id = @bookId;

ELSEIF @stateName = "Annulé"
THEN
CALL addLog(NEW.reference,@userEmail,@stateName);
UPDATE book SET book.is_available = 1 
WHERE book.id = @bookId;
ELSE
UPDATE book SET book.is_available = 0 
WHERE book.id = @bookId;
END IF;


END

//

DELIMITER ;