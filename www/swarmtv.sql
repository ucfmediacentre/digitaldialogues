SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `swarmtv` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `swarmtv` ;

-- -----------------------------------------------------
-- Table `swarmtv`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `swarmtv`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `password` BINARY NOT NULL ,
  `description` VARCHAR(256) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `swarmtv`.`pages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `swarmtv`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `groups_id` INT NOT NULL ,
  `public` TINYINT(1) NOT NULL DEFAULT true ,
  `description` VARCHAR(256) NULL ,
  `title` VARCHAR(32) NOT NULL ,
  `keywords` VARCHAR(128) NULL ,
  `background` VARCHAR(128) NULL ,
  `indexable` TINYINT(1) NULL DEFAULT true ,
  `startDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `totalContentNum` INT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pages_groups` (`groups_id` ASC) ,
  CONSTRAINT `fk_pages_groups`
    FOREIGN KEY (`groups_id` )
    REFERENCES `swarmtv`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `swarmtv`.`content`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `swarmtv`.`content` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `backgroundColor` VARCHAR(16) NULL ,
  `color` VARCHAR(16) NULL ,
  `contents` LONGTEXT NULL DEFAULT NULL ,
  `filename` VARCHAR(256) NULL ,
  `fontFamily` VARCHAR(64) NULL ,
  `fontSize` INT NULL ,
  `height` INT NULL DEFAULT 100 ,
  `width` INT NULL DEFAULT 250 ,
  `timeline` VARCHAR(64) NULL ,
  `opacity` FLOAT NULL DEFAULT 1 ,
  `attribution` VARCHAR(256) NULL ,
  `description` VARCHAR(256) NULL ,
  `keywords` VARCHAR(128) NULL ,
  `license` VARCHAR(32) NULL DEFAULT 'BY-NC-SA' ,
  `pages_id` INT NOT NULL ,
  `textAlign` ENUM('left','right','center','justify') NULL ,
  `type` ENUM('text','image','audio','movie') NULL DEFAULT 'text' ,
  `x` INT NULL ,
  `y` INT NULL ,
  `z` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_content_pages1` (`pages_id` ASC) ,
  CONSTRAINT `fk_content_pages1`
    FOREIGN KEY (`pages_id` )
    REFERENCES `swarmtv`.`pages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `swarmtv`.`updates`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `swarmtv`.`updates` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `content_id` INT NOT NULL ,
  `pages_id` INT NOT NULL ,
  `groups_id` INT NOT NULL ,
  `previousState` BLOB NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_updates_content1` (`content_id` ASC) ,
  INDEX `fk_updates_pages1` (`pages_id` ASC) ,
  INDEX `fk_updates_groups1` (`groups_id` ASC) ,
  CONSTRAINT `fk_updates_content1`
    FOREIGN KEY (`content_id` )
    REFERENCES `swarmtv`.`content` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_updates_pages1`
    FOREIGN KEY (`pages_id` )
    REFERENCES `swarmtv`.`pages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_updates_groups1`
    FOREIGN KEY (`groups_id` )
    REFERENCES `swarmtv`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `swarmtv`.`searches`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `swarmtv`.`searches` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `keywords` TINYINT(1) NULL DEFAULT true ,
  `title` TINYINT(1) NULL DEFAULT true ,
  `description` TINYINT(1) NULL DEFAULT true ,
  `content` TINYINT(1) NULL DEFAULT true ,
  `searchString` VARCHAR(64) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
