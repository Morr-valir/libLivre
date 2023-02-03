DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_user_email_from_id`(`userId` INT) RETURNS varchar(255) CHARSET utf8mb4
RETURN (SELECT email FROM user WHERE id=userId)$$
DELIMITER ;
