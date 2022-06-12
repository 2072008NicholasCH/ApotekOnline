-- MySQL Script generated by MySQL Workbench
-- Sun Jun 12 20:38:42 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema apotekonline
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `apotekonline` ;

-- -----------------------------------------------------
-- Schema apotekonline
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `apotekonline` DEFAULT CHARACTER SET utf8 ;
USE `apotekonline` ;

-- -----------------------------------------------------
-- Table `apotekonline`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`user` (
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `role` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`email`));


-- -----------------------------------------------------
-- Table `apotekonline`.`supplier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`supplier` (
  `idSupplier` INT NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `alamat` VARCHAR(255) NOT NULL,
  `kota` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idSupplier`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apotekonline`.`obat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`obat` (
  `idObat` VARCHAR(10) NOT NULL,
  `nama` VARCHAR(50) NOT NULL,
  `jenis` VARCHAR(45) NOT NULL,
  `harga` INT NULL,
  `stock` INT NULL,
  `photo` VARCHAR(50) NULL,
  `supplier_idSupplier` INT NOT NULL,
  PRIMARY KEY (`idObat`),
  INDEX `fk_obat_supplier_idx` (`supplier_idSupplier` ASC) VISIBLE,
  CONSTRAINT `fk_obat_supplier`
    FOREIGN KEY (`supplier_idSupplier`)
    REFERENCES `apotekonline`.`supplier` (`idSupplier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apotekonline`.`penjualan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`penjualan` (
  `idPenjualan` INT NOT NULL AUTO_INCREMENT,
  `tanggal` DATE NOT NULL,
  `total` INT NOT NULL,
  `payment` VARCHAR(45) NOT NULL,
  `user_email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idPenjualan`),
  INDEX `fk_penjualan_user1_idx` (`user_email` ASC) VISIBLE,
  CONSTRAINT `fk_penjualan_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `apotekonline`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apotekonline`.`obat_has_penjualan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`obat_has_penjualan` (
  `obat_idObat` VARCHAR(10) NOT NULL,
  `penjualan_idPenjualan` INT NOT NULL,
  `jumlah` INT NOT NULL,
  `harga` INT NOT NULL,
  PRIMARY KEY (`obat_idObat`, `penjualan_idPenjualan`),
  INDEX `fk_obat_has_penjualan_penjualan1_idx` (`penjualan_idPenjualan` ASC) VISIBLE,
  INDEX `fk_obat_has_penjualan_obat1_idx` (`obat_idObat` ASC) VISIBLE,
  CONSTRAINT `fk_obat_has_penjualan_obat1`
    FOREIGN KEY (`obat_idObat`)
    REFERENCES `apotekonline`.`obat` (`idObat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_obat_has_penjualan_penjualan1`
    FOREIGN KEY (`penjualan_idPenjualan`)
    REFERENCES `apotekonline`.`penjualan` (`idPenjualan`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `apotekonline`.`keranjang`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apotekonline`.`keranjang` (
  `idKeranjang` INT NOT NULL AUTO_INCREMENT,
  `jumlah` INT NULL,
  `total` INT NULL,
  `user_email` VARCHAR(255) NOT NULL,
  `obat_idObat` VARCHAR(10) NOT NULL,
  INDEX `fk_keranjang_user1_idx` (`user_email` ASC) VISIBLE,
  INDEX `fk_keranjang_obat1_idx` (`obat_idObat` ASC) VISIBLE,
  PRIMARY KEY (`idKeranjang`),
  CONSTRAINT `fk_keranjang_user1`
    FOREIGN KEY (`user_email`)
    REFERENCES `apotekonline`.`user` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_keranjang_obat1`
    FOREIGN KEY (`obat_idObat`)
    REFERENCES `apotekonline`.`obat` (`idObat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
