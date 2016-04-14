-- MySQL Script generated by MySQL Workbench
-- 04/14/16 18:52:49
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Ubiko
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Ubiko
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Ubiko` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `Ubiko` ;

-- -----------------------------------------------------
-- Table `Ubiko`.`Paciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ubiko`.`Paciente` ;

CREATE TABLE IF NOT EXISTS `Ubiko`.`Paciente` (
  `DNIPaciente` VARCHAR(9) NOT NULL,
  `Nombre` VARCHAR(25) NOT NULL,
  `Apellido1` VARCHAR(15) NOT NULL,
  `Apellido2` VARCHAR(15) NULL,
  `Calle` VARCHAR(30) NULL,
  `Numero` INT NULL,
  `Piso` VARCHAR(10) NULL,
  `Estado` VARCHAR(15) NULL,
  PRIMARY KEY (`DNIPaciente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ubiko`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ubiko`.`Usuario` ;

CREATE TABLE IF NOT EXISTS `Ubiko`.`Usuario` (
  `idUsuario` VARCHAR(15) NOT NULL,
  `Password` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ubiko`.`Localizacion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ubiko`.`Localizacion` ;

CREATE TABLE IF NOT EXISTS `Ubiko`.`Localizacion` (
  `idLocalizacion` VARCHAR(10) NOT NULL,
  `numeroPlanta` INT NULL,
  `nombreLocalizacion` VARCHAR(10) NULL,
  PRIMARY KEY (`idLocalizacion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ubiko`.`Cama`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ubiko`.`Cama` ;

CREATE TABLE IF NOT EXISTS `Ubiko`.`Cama` (
  `numeroCama` INT NOT NULL,
  `Paciente_DNIPaciente` VARCHAR(9) NOT NULL,
  `Localizacion_idLocalizacion` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`numeroCama`, `Localizacion_idLocalizacion`),
  INDEX `fk_Cama_Paciente1_idx` (`Paciente_DNIPaciente` ASC),
  INDEX `fk_Cama_Localizacion1_idx` (`Localizacion_idLocalizacion` ASC),
  CONSTRAINT `fk_Cama_Paciente1`
    FOREIGN KEY (`Paciente_DNIPaciente`)
    REFERENCES `Ubiko`.`Paciente` (`DNIPaciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cama_Localizacion1`
    FOREIGN KEY (`Localizacion_idLocalizacion`)
    REFERENCES `Ubiko`.`Localizacion` (`idLocalizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ubiko`.`UbicacionPaciente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Ubiko`.`UbicacionPaciente` ;

CREATE TABLE IF NOT EXISTS `Ubiko`.`UbicacionPaciente` (
  `DNIPaciente` VARCHAR(9) NOT NULL,
  `idUsuario` VARCHAR(15) NOT NULL,
  `idLocalizacion` VARCHAR(10) NOT NULL,
  `fecha` DATE NULL,
  `horaInicio` TIME NULL,
  `horaFin` TIME NULL,
  `Paciente_DNIPaciente` VARCHAR(9) NOT NULL,
  `Usuario_idUsuario` VARCHAR(15) NOT NULL,
  `Localizacion_idLocalizacion` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`DNIPaciente`, `idUsuario`, `idLocalizacion`),
  INDEX `fk_UbicacionPaciente_Paciente_idx` (`Paciente_DNIPaciente` ASC),
  INDEX `fk_UbicacionPaciente_Usuario1_idx` (`Usuario_idUsuario` ASC),
  INDEX `fk_UbicacionPaciente_Localizacion1_idx` (`Localizacion_idLocalizacion` ASC),
  CONSTRAINT `fk_UbicacionPaciente_Paciente`
    FOREIGN KEY (`Paciente_DNIPaciente`)
    REFERENCES `Ubiko`.`Paciente` (`DNIPaciente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UbicacionPaciente_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `Ubiko`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UbicacionPaciente_Localizacion1`
    FOREIGN KEY (`Localizacion_idLocalizacion`)
    REFERENCES `Ubiko`.`Localizacion` (`idLocalizacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;