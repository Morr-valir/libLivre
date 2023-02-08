CREATE TRIGGER `onBeforeUpdateBooking` BEFORE UPDATE ON `booking`
 FOR EACH ROW BEGIN
DECLARE stateName VARCHAR(255);
DECLARE previousStateName VARCHAR(255);
DECLARE userEmail VARCHAR(255);
DECLARE bookingReference VARCHAR(255);

SET stateName = (SELECT name FROM state_booking WHERE id = NEW.state_id);
SET previousStateName = (SELECT name FROM state_booking WHERE id = OLD.state_id);
SET userEmail = (SELECT email FROM user WHERE id = NEW.user_id);
SET bookingReference = fn_get_booking_reference_from_id(NEW.id);

IF stateName != previousStateName AND stateName != "Annulé" AND stateName != "Terminé" THEN
	CALL addLog(bookingReference,userEmail,stateName);
END IF;
END
