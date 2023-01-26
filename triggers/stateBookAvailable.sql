CREATE TRIGGER `stateBookAvailable` AFTER DELETE ON `booking_book`
 FOR EACH ROW UPDATE book SET book.is_available = 1 
WHERE book.id = OLD.book_id