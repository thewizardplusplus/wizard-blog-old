ALTER DATABASE `имя_базы_данных` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

SET NAMES 'utf8';
SET collation_connection = 'utf8_general_ci';
SET collation_server = 'utf8_general_ci';
SET character_set_client = 'utf8';
SET character_set_connection = 'utf8';
SET character_set_results = 'utf8';
SET character_set_server = 'utf8';

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`title` VARCHAR(96) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`text` VARCHAR(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`create_time` VARCHAR(19) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`modify_time` VARCHAR(19) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
