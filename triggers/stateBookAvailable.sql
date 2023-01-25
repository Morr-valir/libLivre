CREATE TRIGGER `stateBookAvailable` AFTER INSERT ON `booking_book`
 FOR EACH ROW UPDATE book SET book.is_available = 0 
WHERE book.id = NEW.book_id