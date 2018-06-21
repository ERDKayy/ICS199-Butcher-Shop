-- MySQL Script generated by MySQL Workbench
-- 05/24/17 14:55:00
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ICS199db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ICS199db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ICS199db` DEFAULT CHARACTER SET utf8 ;
USE `ICS199db` ;

-- -----------------------------------------------------
-- Table `ICS199db`.`tblCategory`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblCategory` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblCategory` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(45) NULL,
  PRIMARY KEY (`cat_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199db`.`tblProducts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblProducts` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblProducts` (
  `prod_id` INT NOT NULL AUTO_INCREMENT,
  `prod_name` VARCHAR(45) NULL,
  `prod_weight` VARCHAR(45) NULL,
  `prod_price` VARCHAR(45) NULL,
  `prod_description` MEDIUMTEXT NULL,
  `prod_image` VARCHAR(255) NULL,
  `tblCategory_cat_id` INT NOT NULL,
  PRIMARY KEY (`prod_id`, `tblCategory_cat_id`),
  INDEX `fk_tblProducts_tblCategory_idx` (`tblCategory_cat_id` ASC),
  CONSTRAINT `fk_tblProducts_tblCategory`
    FOREIGN KEY (`tblCategory_cat_id`)
    REFERENCES `ICS199db`.`tblCategory` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199db`.`tblCustomers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblCustomers` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblCustomers` (
  `cust_id` INT NOT NULL AUTO_INCREMENT,
  `session_id` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cust_id`),
  UNIQUE INDEX `session_id_UNIQUE` (`session_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199db`.`tblOrder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblOrder` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblOrder` (
  `tblProducts_prod_id` INT NOT NULL,
  `tblCustomers_cust_id` INT NOT NULL,
  `prod_qty` INT NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tblProducts_prod_id`, `tblCustomers_cust_id`),
  INDEX `fk_tblOrder_tblProducts1_idx` (`tblProducts_prod_id` ASC),
  INDEX `fk_tblOrder_tblCustomers1_idx` (`tblCustomers_cust_id` ASC),
  CONSTRAINT `fk_tblOrder_tblProducts1`
    FOREIGN KEY (`tblProducts_prod_id`)
    REFERENCES `ICS199db`.`tblProducts` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblOrder_tblCustomers1`
    FOREIGN KEY (`tblCustomers_cust_id`)
    REFERENCES `ICS199db`.`tblCustomers` (`cust_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199db`.`tblPurchased`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblPurchased` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblPurchased` (
  `purchase_id` INT NOT NULL,
  `tblOrder_tblProducts_prod_id` INT NOT NULL,
  `tblOrder_tblCustomers_cust_id` INT NOT NULL,
  PRIMARY KEY (`purchase_id`, `tblOrder_tblProducts_prod_id`, `tblOrder_tblCustomers_cust_id`),
  INDEX `fk_tblPurchased_tblOrder1_idx` (`tblOrder_tblProducts_prod_id` ASC, `tblOrder_tblCustomers_cust_id` ASC),
  CONSTRAINT `fk_tblPurchased_tblOrder1`
    FOREIGN KEY (`tblOrder_tblProducts_prod_id` , `tblOrder_tblCustomers_cust_id`)
    REFERENCES `ICS199db`.`tblOrder` (`tblProducts_prod_id` , `tblCustomers_cust_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ICS199db`.`tblConfirmedOrder`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ICS199db`.`tblConfirmedOrder` ;

CREATE TABLE IF NOT EXISTS `ICS199db`.`tblConfirmedOrder` (
  `tblProducts_prod_id` INT NOT NULL,
  `tblCustomers_cust_id` INT NOT NULL,
  `prod_qty` INT NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` INT NOT NULL,
  PRIMARY KEY (`order_id`, `tblCustomers_cust_id`, `tblProducts_prod_id`),
  INDEX `fk_tblOrder_tblProducts1_idx` (`tblProducts_prod_id` ASC),
  INDEX `fk_tblOrder_tblCustomers1_idx` (`tblCustomers_cust_id` ASC),
  CONSTRAINT `fk_tblOrder_tblProducts10`
    FOREIGN KEY (`tblProducts_prod_id`)
    REFERENCES `ICS199db`.`tblProducts` (`prod_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tblOrder_tblCustomers10`
    FOREIGN KEY (`tblCustomers_cust_id`)
    REFERENCES `ICS199db`.`tblCustomers` (`cust_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
