INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('family');
INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('friend');
INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('colleague');
INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('acquaintance');
INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('customer');
INSERT INTO `birthday_calendar`.`categories` (`category_name`) VALUES ('supplier');

INSERT INTO `birthday_calendar`.`persons` (`categories_idcategory`, `first_name`, `last_name`, `day_of_birth`) VALUES ('3', 'Hanneke', 'Kool', '1965-01-01');
INSERT INTO `birthday_calendar`.`persons` (`categories_idcategory`, `first_name`, `preposition`, `last_name`, `day_of_birth`) VALUES ('3', 'Hilco', 'van de', 'Kraats', '1983-10-02');
INSERT INTO `birthday_calendar`.`persons` (`categories_idcategory`, `first_name`, `preposition`, `last_name`, `day_of_birth`) VALUES ('3', 'Jonathan', 'van de', 'Brink', '1997-05-05');
