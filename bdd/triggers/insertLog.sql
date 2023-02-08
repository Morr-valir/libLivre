CREATE TRIGGER `insertLog` BEFORE DELETE ON `booking`
 FOR EACH ROW BEGIN
SET @msgError := 'La suppression de la reservertion est interdite';
SET @stateName := (SELECT state_booking.name FROM state_booking WHERE state_booking.id = OLD.state_id);
SET @userEmail := (SELECT user.email FROM USER WHERE user.id = OLD.user_id);
SET @bookId := OLD.book_id;

IF @stateName = 'Terminé' OR @stateName = 'Annulé' THEN
    CALL addLog(OLD.reference,@userEmail,@stateName);
    CALL ps_toggle_book_is_available(@bookId);
ELSE
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = @msgError;
END IF;
END
