CREATE TRIGGER `onAfterInsertBooking` AFTER INSERT ON `booking`
 FOR EACH ROW BEGIN
DECLARE stateName VARCHAR(255);
DECLARE userEmail VARCHAR(255);
DECLARE bookingReference VARCHAR(255);

SET stateName = 'Reservé';
SET userEmail = (SELECT email FROM user WHERE id = NEW.user_id);
SET bookingReference = fn_get_booking_reference_from_id(NEW.id);

CALL addLog(bookingReference,userEmail,stateName);
CALL ps_toggle_book_is_available(NEW.book_id);
END
