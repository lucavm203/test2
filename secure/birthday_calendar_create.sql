-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema birthday_calendar
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema birthday_calendar
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `birthday_calendar` DEFAULT CHARACTER SET utf8 ;
USE `birthday_calendar` ;

-- -----------------------------------------------------
-- Table `birthday_calendar`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `birthday_calendar`.`categories` (
  `idcategory` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `birthday_calendar`.`persons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `birthday_calendar`.`persons` (
  `idperson` INT NOT NULL AUTO_INCREMENT,
  `categories_idcategory` INT NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `preposition` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `day_of_birth` DATE NOT NULL,
  PRIMARY KEY (`idperson`),
  INDEX `fk_persons_categories_idx` (`categories_idcategory` ASC),
  CONSTRAINT `fk_persons_categories`
    FOREIGN KEY (`categories_idcategory`)
    REFERENCES `birthday_calendar`.`categories` (`idcategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
