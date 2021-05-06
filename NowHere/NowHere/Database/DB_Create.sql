-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema LocalAD
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema LocalAD
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `LocalAD` DEFAULT CHARACTER SET utf8 ;
USE `LocalAD` ;

-- -----------------------------------------------------
-- Table `LocalAD`.`Biz_Type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Biz_Type` (
  `Biz_Type_Code` INT(11) NOT NULL,
  `Biz_Type_Name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Biz_Type_Code`),
  UNIQUE INDEX `Biz_Type_Code_UNIQUE` (`Biz_Type_Code` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Member` (
  `Mem_No` INT(11) NOT NULL AUTO_INCREMENT,
  `User_ID` VARCHAR(16) NOT NULL,
  `Password` VARCHAR(32) NOT NULL,
  `Mem_Name` VARCHAR(30) NOT NULL,
  `Mem_Type` INT(11) NOT NULL,
  `Reg_Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last_Conn_Dt` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Mem_No`),
  UNIQUE INDEX `User_ID_UNIQUE` (`User_ID` ASC) VISIBLE,
  UNIQUE INDEX `Mem_No_UNIQUE` (`Mem_No` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 39
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Advertiser`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Advertiser` (
  `Mem_No` INT(11) NOT NULL,
  `Biz_No` CHAR(10) NOT NULL,
  `Boss_Name` VARCHAR(30) NOT NULL,
  `Biz_Zipcode` CHAR(5) NULL DEFAULT NULL,
  `Biz_Addr` VARCHAR(60) NULL DEFAULT NULL,
  `Biz_Addr_Detail` VARCHAR(60) NULL DEFAULT NULL,
  `Contact_Phone` VARCHAR(15) NOT NULL,
  `Biz_Type_Code` INT(11) NOT NULL,
  PRIMARY KEY (`Mem_No`),
  INDEX `fk_Advertiser_Member1_idx` (`Mem_No` ASC) VISIBLE,
  INDEX `fk_Advertiser_Biz_Type1_idx` (`Biz_Type_Code` ASC) VISIBLE,
  CONSTRAINT `fk_Advertiser_Biz_Type1`
    FOREIGN KEY (`Biz_Type_Code`)
    REFERENCES `LocalAD`.`Biz_Type` (`Biz_Type_Code`),
  CONSTRAINT `fk_Advertiser_Member1`
    FOREIGN KEY (`Mem_No`)
    REFERENCES `LocalAD`.`Member` (`Mem_No`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Category` (
  `Category_No` INT(11) NOT NULL,
  `Cat_Name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`Category_No`),
  UNIQUE INDEX `Category_No_UNIQUE` (`Category_No` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Person` (
  `Mem_No` INT(11) NOT NULL,
  `Born_Date` CHAR(6) NOT NULL,
  `Zip_Code` CHAR(5) NULL DEFAULT NULL,
  `Addr` VARCHAR(60) NULL DEFAULT NULL,
  `Addr_Detail` VARCHAR(60) NULL DEFAULT NULL,
  `Cell_Phone` VARCHAR(15) NOT NULL,
  `Email` VARCHAR(70) NULL DEFAULT NULL,
  `Gender` CHAR(1) NOT NULL,
  PRIMARY KEY (`Mem_No`),
  INDEX `fk_Person_Member_idx` (`Mem_No` ASC) VISIBLE,
  CONSTRAINT `fk_Person_Member`
    FOREIGN KEY (`Mem_No`)
    REFERENCES `LocalAD`.`Member` (`Mem_No`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Category_Preference`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Category_Preference` (
  `Person_Mem_No` INT(11) NOT NULL,
  `Category_Category_No` INT(11) NOT NULL,
  `Pref_No` INT(11) NOT NULL,
  PRIMARY KEY (`Pref_No`, `Person_Mem_No`),
  INDEX `fk_Person_has_Category_Category1_idx` (`Category_Category_No` ASC) VISIBLE,
  INDEX `fk_Person_has_Category_Person1_idx` (`Person_Mem_No` ASC) VISIBLE,
  CONSTRAINT `fk_Person_has_Category_Category1`
    FOREIGN KEY (`Category_Category_No`)
    REFERENCES `LocalAD`.`Category` (`Category_No`),
  CONSTRAINT `fk_Person_has_Category_Person1`
    FOREIGN KEY (`Person_Mem_No`)
    REFERENCES `LocalAD`.`Person` (`Mem_No`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Code_Zip`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Code_Zip` (
  `IDX` INT(11) NOT NULL,
  `ZipCode` CHAR(5) NULL DEFAULT NULL,
  `Sido` VARCHAR(20) NULL DEFAULT NULL,
  `Sigun` VARCHAR(20) NULL DEFAULT NULL,
  `Dong` VARCHAR(20) NULL DEFAULT NULL,
  `Street` VARCHAR(80) NULL DEFAULT NULL,
  `Building` VARCHAR(200) NULL DEFAULT NULL,
  `Legal_Dong_Name` VARCHAR(20) NULL DEFAULT NULL,
  `Gov_Dong_Name` VARCHAR(40) NULL DEFAULT NULL,
  PRIMARY KEY (`IDX`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Event` (
  `Event_No` INT(11) NOT NULL AUTO_INCREMENT,
  `Mem_No` INT(11) NOT NULL,
  `Category_No` INT(11) NOT NULL,
  `Reg_Name` VARCHAR(20) NULL DEFAULT NULL,
  `Event_Name` VARCHAR(60) NULL DEFAULT NULL,
  `Event_Type_Code` INT(11) NOT NULL,
  `Event_Content` LONGTEXT NULL DEFAULT NULL,
  `Event_Contact_No` VARCHAR(15) NULL DEFAULT NULL,
  `Start_Date` DATETIME NOT NULL,
  `End_Date` DATETIME NOT NULL,
  `Place_X` DOUBLE NOT NULL,
  `Place_Y` DOUBLE NOT NULL,
  `Pub_Coupon_Cnt` INT(11) NULL DEFAULT NULL,
  `Target_Gender` CHAR(1) NULL DEFAULT NULL,
  `Target_Age` INT(11) NULL DEFAULT NULL,
  `Reg_Date` DATETIME NOT NULL,
  `Radius` INT(11) NULL DEFAULT '500',
  `Region` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`Event_No`),
  UNIQUE INDEX `Event_No_UNIQUE` (`Event_No` ASC) VISIBLE,
  INDEX `fk_Event_Category1_idx` (`Category_No` ASC) VISIBLE,
  INDEX `fk_Event_Advertiser1_idx` (`Mem_No` ASC) VISIBLE,
  CONSTRAINT `fk_Event_Advertiser1`
    FOREIGN KEY (`Mem_No`)
    REFERENCES `LocalAD`.`Advertiser` (`Mem_No`),
  CONSTRAINT `fk_Event_Category1`
    FOREIGN KEY (`Category_No`)
    REFERENCES `LocalAD`.`Category` (`Category_No`))
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Coupon`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Coupon` (
  `Coupon_No` INT(11) NOT NULL AUTO_INCREMENT,
  `Coupon_Code` CHAR(16) NOT NULL,
  `Use_Limit_Date` DATETIME NULL DEFAULT NULL,
  `Event_No` INT(11) NOT NULL,
  PRIMARY KEY (`Coupon_No`),
  UNIQUE INDEX `Coupon_No_UNIQUE` (`Coupon_No` ASC) VISIBLE,
  INDEX `fk_Coupon_Event1_idx` (`Event_No` ASC) VISIBLE,
  CONSTRAINT `fk_Coupon_Event1`
    FOREIGN KEY (`Event_No`)
    REFERENCES `LocalAD`.`Event` (`Event_No`))
ENGINE = InnoDB
AUTO_INCREMENT = 851
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Coupon_Download`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Coupon_Download` (
  `Down_No` INT(11) NOT NULL AUTO_INCREMENT,
  `Mem_No` INT(11) NOT NULL,
  `Coupon_No` INT(11) NOT NULL,
  `Down_Date` DATETIME NULL DEFAULT NULL,
  `Use_Stat` INT(11) NULL DEFAULT NULL,
  `Use_Date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Down_No`),
  UNIQUE INDEX `Down_No_UNIQUE` (`Down_No` ASC) VISIBLE,
  INDEX `fk_Person_has_Coupon_Coupon1_idx` (`Coupon_No` ASC) VISIBLE,
  INDEX `fk_Person_has_Coupon_Person1_idx` (`Mem_No` ASC) VISIBLE,
  CONSTRAINT `fk_Person_has_Coupon_Coupon1`
    FOREIGN KEY (`Coupon_No`)
    REFERENCES `LocalAD`.`Coupon` (`Coupon_No`),
  CONSTRAINT `fk_Person_has_Coupon_Person1`
    FOREIGN KEY (`Mem_No`)
    REFERENCES `LocalAD`.`Person` (`Mem_No`))
ENGINE = InnoDB
AUTO_INCREMENT = 46
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`Event_Type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`Event_Type` (
  `Event_Type_No` INT(11) NOT NULL AUTO_INCREMENT,
  `Event_Type_Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Event_Type_No`),
  UNIQUE INDEX `Evt_No_UNIQUE` (`Event_Type_No` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `LocalAD`.`push_token`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LocalAD`.`push_token` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `token` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `token_UNIQUE` (`token` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 172
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
