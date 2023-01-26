CREATE TRIGGER `updateStateBooking` AFTER UPDATE ON `booking`
 FOR EACH ROW BEGIN
SET @stateName := (SELECT state_booking.name FROM state_booking WHERE state_booking.id = NEW.state_id);

SET @userEmail := (SELECT user.email FROM USER WHERE user.id = NEW.user_id);

IF @stateName = "Terminé"
THEN 
CALL addLog(NEW.reference,@userEmail,@stateName);
ELSEIF @stateName = "Annulé"
THEN
CALL addLog(NEW.reference,@userEmail,@stateName);
END IF;


END