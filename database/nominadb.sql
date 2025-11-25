-- -----------------------------------------------------
-- 1. CONFIGURACIÓN INICIAL Y LIMPIEZA
-- -----------------------------------------------------

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

-- Si la base de datos ya existe y quieres empezar desde cero, descomenta la siguiente línea:
-- DROP DATABASE IF EXISTS `nominadb`;

-- Crear Esquema
CREATE SCHEMA IF NOT EXISTS `nominadb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
USE `nominadb` ;

-- -----------------------------------------------------
-- 2. CREACIÓN DE TABLAS PADRE SIN DEPENDENCIAS DE FK (O SOLO A OTRAS PADRE)
-- -----------------------------------------------------

-- Table `EMPLEADO` (Padre Principal)
CREATE TABLE IF NOT EXISTS `nominadb`.`EMPLEADO` (
  `id_empleado` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(255) NOT NULL,
  `id_cedula` VARCHAR(45) NOT NULL,
  `sexo` VARCHAR(10) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `lugar_nacimiento` VARCHAR(255) NOT NULL,
  `telefono` VARCHAR(11) NOT NULL,
  `profesion` VARCHAR(255) NOT NULL,
  `direccion` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `ficha` INT NOT NULL,
  `situacion` VARCHAR(45) NOT NULL,
  `salario_base` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_empleado`)
)
ENGINE = InnoDB;

-- Table `FORMULA`
CREATE TABLE IF NOT EXISTS `nominadb`.`FORMULA` (
  `id_formula` INT NOT NULL AUTO_INCREMENT,
  `formula` TEXT NOT NULL,
  PRIMARY KEY (`id_formula`)
)
ENGINE = InnoDB;

-- Table `CONSTANTE_GLOBAL`
CREATE TABLE IF NOT EXISTS `nominadb`.`CONSTANTE_GLOBAL` (
  `id_constante_global` INT NOT NULL AUTO_INCREMENT,
  `constante_global` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `valor` DECIMAL(10,4) NOT NULL,
  PRIMARY KEY (`id_constante_global`)
)
ENGINE = InnoDB;

-- Table `PARAMETRO_BONO`
CREATE TABLE IF NOT EXISTS `nominadb`.`PARAMETRO_BONO` (
  `id_parametro_bono` INT NOT NULL AUTO_INCREMENT,
  `nro_dias_bono` INT NOT NULL,
  `dias_incremento` INT NOT NULL,
  PRIMARY KEY (`id_parametro_bono`)
)
ENGINE = InnoDB;

-- Table `BANCO`
CREATE TABLE IF NOT EXISTS `nominadb`.`BANCO` (
  `id_banco` INT NOT NULL AUTO_INCREMENT,
  `codigo_banco` VARCHAR(45) NOT NULL,
  `nombre_banco` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_banco`)
)
ENGINE = InnoDB;

-- Table `TIPOS_NOMINA`
CREATE TABLE IF NOT EXISTS `nominadb`.`TIPOS_NOMINA` (
  `id_tipos_nomina` INT NOT NULL AUTO_INCREMENT,
  `nro_calculo_nomina` INT NOT NULL,
  `dias_nomina` DECIMAL(10,2) NOT NULL,
  `descripcion_nomina` VARCHAR(255) NULL,
  PRIMARY KEY (`id_tipos_nomina`)
)
ENGINE = InnoDB;

-- Table `PARAMETRO_VACACIONE` (Clave Compuesta)
CREATE TABLE IF NOT EXISTS `nominadb`.`PARAMETRO_VACACIONE` (
  `id_parametros_vacaciones` INT NOT NULL,
  `antigueda_derechos_año` INT NOT NULL,
  `nro_dias_disfrute` INT NOT NULL,
  `dias_incremento_disfrute_años` DECIMAL(10,2) NOT NULL,
  `fecha_dd_aplicacion_incremento` DATE NOT NULL,
  `tipo_disfrute_continuo` VARCHAR(45) NOT NULL,
  `dias_habiles` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_parametros_vacaciones`, `antigueda_derechos_año`, `nro_dias_disfrute`, `dias_incremento_disfrute_años`, `fecha_dd_aplicacion_incremento`, `tipo_disfrute_continuo`, `dias_habiles`)
)
ENGINE = InnoDB;

-- Table `CONCEPTO` (Referencia a FORMULA)
CREATE TABLE IF NOT EXISTS `nominadb`.`CONCEPTO` (
  `id_concepto` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `nro_constante` DECIMAL(10,4) NOT NULL,
  `etiqueta` VARCHAR(45) NOT NULL,
  `valor_calculado` BOOLEAN NOT NULL,
  `es_suma_sueldo` BOOLEAN NOT NULL,
  `FORMULA_id_formula` INT NOT NULL,
  `tipo_dato` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_concepto`),
  INDEX `fk_CONCEPTO_FORMULA1_idx` (`FORMULA_id_formula` ASC),
  CONSTRAINT `fk_CONCEPTO_FORMULA1`
    FOREIGN KEY (`FORMULA_id_formula`)
    REFERENCES `nominadb`.`FORMULA` (`id_formula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 3. CREACIÓN DE TABLAS CON DEPENDENCIAS SIMPLES
-- -----------------------------------------------------

-- Table `RELACION_LABORAL` (Referencia a EMPLEADO)
CREATE TABLE IF NOT EXISTS `nominadb`.`RELACION_LABORAL` (
  `id_relacion_laboral` INT NOT NULL AUTO_INCREMENT,
  `tipo_empleado` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `EMPLEADO_id_empleado` INT NOT NULL,
  PRIMARY KEY (`id_relacion_laboral`),
  INDEX `fk_RELACION_LABORAL_EMPLEADO1_idx` (`EMPLEADO_id_empleado` ASC),
  CONSTRAINT `fk_RELACION_LABORAL_EMPLEADO1`
    FOREIGN KEY (`EMPLEADO_id_empleado`)
    REFERENCES `nominadb`.`EMPLEADO` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `ORGANIZACION` (Referencia a RELACION_LABORAL)
CREATE TABLE IF NOT EXISTS `nominadb`.`ORGANIZACION` (
  `id_organizacion` INT NOT NULL AUTO_INCREMENT,
  `tipo_organizacion` VARCHAR(45) NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `departamento` VARCHAR(45) NOT NULL,
  `RELACION_LABORAL_id_relacion_laboral` INT NOT NULL,
  PRIMARY KEY (`id_organizacion`),
  INDEX `fk_ORGANIZACION_RELACION_LABORAL1_idx` (`RELACION_LABORAL_id_relacion_laboral` ASC),
  CONSTRAINT `fk_ORGANIZACION_RELACION_LABORAL1`
    FOREIGN KEY (`RELACION_LABORAL_id_relacion_laboral`)
    REFERENCES `nominadb`.`RELACION_LABORAL` (`id_relacion_laboral`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `GRUPOS_BANCO` (Referencia a BANCO)
CREATE TABLE IF NOT EXISTS `nominadb`.`GRUPOS_BANCO` (
  `id_grupo_banco` INT NOT NULL AUTO_INCREMENT,
  `codigo_banco_grupo` VARCHAR(45) NOT NULL,
  `generar_nomina` BOOLEAN NOT NULL,
  `cuenta_bancaria` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `tipo_cuenta_bancaria` VARCHAR(45) NOT NULL,
  `id_banco_FK` INT NOT NULL,
  PRIMARY KEY (`id_grupo_banco`),
  INDEX `fk_GRUPOS_BANCO_BANCO1_idx` (`id_banco_FK` ASC),
  CONSTRAINT `fk_GRUPOS_BANCO_BANCO1`
    FOREIGN KEY (`id_banco_FK`)
    REFERENCES `nominadb`.`BANCO` (`id_banco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `NOMINA_PPD` (Referencia a TIPOS_NOMINA)
CREATE TABLE IF NOT EXISTS `nominadb`.`NOMINA_PPD` (
  `id_tipo_nomina` INT NOT NULL AUTO_INCREMENT,
  `tipo_nomina` VARCHAR(45) NOT NULL,
  `TIPOS_NOMINA_id_tipos_nomina` INT NOT NULL,
  PRIMARY KEY (`id_tipo_nomina`),
  INDEX `fk_NOMINA_PPD_TIPOS_NOMINA1_idx` (`TIPOS_NOMINA_id_tipos_nomina` ASC),
  CONSTRAINT `fk_NOMINA_PPD_TIPOS_NOMINA1`
    FOREIGN KEY (`TIPOS_NOMINA_id_tipos_nomina`)
    REFERENCES `nominadb`.`TIPOS_NOMINA` (`id_tipos_nomina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `CONSTANTE` (Referencia a FORMULA, PARAMETRO_BONO, CONSTANTE_GLOBAL)
CREATE TABLE IF NOT EXISTS `nominadb`.`CONSTANTE` (
  `id_constante` INT NOT NULL AUTO_INCREMENT,
  `nro_constante` DECIMAL(10,4) NOT NULL,
  `etiqueta` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `tipo_datos` VARCHAR(45) NOT NULL,
  `valor` BOOLEAN NOT NULL,
  `CONSTANTE_GLOBAL_id_constante_global` INT NOT NULL,
  `FORMULA_id_formula` INT NOT NULL,
  `PARAMETRO_BONO_id_parametro_bono` INT NOT NULL,
  PRIMARY KEY (`id_constante`),
  INDEX `fk_CONSTANTE_FORMULA1_idx` (`FORMULA_id_formula` ASC),
  INDEX `fk_CONSTANTE_PARAMETRO_BONO1_idx` (`PARAMETRO_BONO_id_parametro_bono` ASC),
  INDEX `fk_CONSTANTE_CONSTANTE_GLOBAL1_idx` (`CONSTANTE_GLOBAL_id_constante_global` ASC),
  CONSTRAINT `fk_CONSTANTE_FORMULA1`
    FOREIGN KEY (`FORMULA_id_formula`)
    REFERENCES `nominadb`.`FORMULA` (`id_formula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CONSTANTE_PARAMETRO_BONO1`
    FOREIGN KEY (`PARAMETRO_BONO_id_parametro_bono`)
    REFERENCES `nominadb`.`PARAMETRO_BONO` (`id_parametro_bono`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CONSTANTE_CONSTANTE_GLOBAL1`
    FOREIGN KEY (`CONSTANTE_GLOBAL_id_constante_global`)
    REFERENCES `nominadb`.`CONSTANTE_GLOBAL` (`id_constante_global`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `CONSTANTE_CONCEPTO` (Referencia a CONSTANTE)
CREATE TABLE IF NOT EXISTS `nominadb`.`CONSTANTE_CONCEPTO` (
  `id_constante_concepto` INT NOT NULL AUTO_INCREMENT,
  `id_concepto` VARCHAR(45) NOT NULL,
  `etiqueta` VARCHAR(45) NOT NULL,
  `valor` DECIMAL(10,4) NOT NULL,
  `CONSTANTE_id_constante` INT NOT NULL,
  PRIMARY KEY (`id_constante_concepto`),
  INDEX `fk_CONSTANTE_CONCEPTO_CONSTANTE1_idx` (`CONSTANTE_id_constante` ASC),
  CONSTRAINT `fk_CONSTANTE_CONCEPTO_CONSTANTE1`
    FOREIGN KEY (`CONSTANTE_id_constante`)
    REFERENCES `nominadb`.`CONSTANTE` (`id_constante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `CONSTANTE_CONTRACTO` (Referencia a CONSTANTE, EMPLEADO)
CREATE TABLE IF NOT EXISTS `nominadb`.`CONSTANTE_CONTRACTO` (
  `id_constante_contracto` INT NOT NULL AUTO_INCREMENT,
  `constante_contracto` VARCHAR(255) NOT NULL,
  `id_empleado_FK` INT NOT NULL,
  `etiqueta` VARCHAR(45) NOT NULL,
  `valor` DECIMAL(10,4) NOT NULL,
  `CONSTANTE_id_constante` INT NOT NULL,
  `EMPLEADO_id_empleado` INT NOT NULL,
  PRIMARY KEY (`id_constante_contracto`),
  INDEX `fk_CONSTANTE_CONTRACTO_CONSTANTE1_idx` (`CONSTANTE_id_constante` ASC),
  INDEX `fk_CONSTANTE_CONTRACTO_EMPLEADO1_idx` (`EMPLEADO_id_empleado` ASC),
  CONSTRAINT `fk_CONSTANTE_CONTRACTO_CONSTANTE1`
    FOREIGN KEY (`CONSTANTE_id_constante`)
    REFERENCES `nominadb`.`CONSTANTE` (`id_constante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CONSTANTE_CONTRACTO_EMPLEADO1`
    FOREIGN KEY (`EMPLEADO_id_empleado`)
    REFERENCES `nominadb`.`EMPLEADO` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `DOTACION_LABORAL` (Referencia a EMPLEADO)
CREATE TABLE IF NOT EXISTS `nominadb`.`DOTACION_LABORAL` (
  `id_dotacion_laboral` INT NOT NULL AUTO_INCREMENT,
  `nro_dotacion` VARCHAR(45) NOT NULL,
  `fecha_dotacion` DATE NOT NULL,
  `tipo_dotacion` VARCHAR(45) NOT NULL,
  `id_empleado_FK` INT NOT NULL,
  `cantidad_aplicada` INT NOT NULL,
  `EMPLEADO_id_empleado` INT NOT NULL,
  PRIMARY KEY (`id_dotacion_laboral`),
  INDEX `fk_DOTACION_LABORAL_EMPLEADO1_idx` (`EMPLEADO_id_empleado` ASC),
  CONSTRAINT `fk_DOTACION_LABORAL_EMPLEADO1`
    FOREIGN KEY (`EMPLEADO_id_empleado`)
    REFERENCES `nominadb`.`EMPLEADO` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- Table `ESCALA_PARA_CALCULAR_VACACIONES` (Referencia a PARAMETRO_VACACIONE)
CREATE TABLE IF NOT EXISTS `nominadb`.`ESCALA_PARA_CALCULAR_VACACIONES` (
  `id_escala_para_calcular_vacaciones` INT NOT NULL AUTO_INCREMENT,
  `codigo_escala_disfrute` DECIMAL(10,2) NOT NULL,
  `codigo_escala_vacaciones` INT NOT NULL,
  `codigo_escala_bono` DECIMAL(5,2) NOT NULL,
  `PARAMETRO_VACACIONE_id_parametros_vacaciones` INT NOT NULL,
  `PARAMETRO_VACACIONE_antigueda_derechos_año` INT NOT NULL,
  `PARAMETRO_VACACIONE_nro_dias_disfrute` INT NOT NULL,
  `PARAMETRO_VACACIONE_dias_incremento_disfrute_años` DECIMAL(10,2) NOT NULL,
  `PARAMETRO_VACACIONE_fecha_dd_aplicacion_incremento` DATE NOT NULL,
  `PARAMETRO_VACACIONE_tipo_disfrute_continuo` VARCHAR(45) NOT NULL,
  `PARAMETRO_VACACIONE_dias_habiles` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id_escala_para_calcular_vacaciones`),
  INDEX `fk_ESCALA_PARA_CALCULAR_VACACIONES_PARAMETRO_VACACIONE1_idx` (`PARAMETRO_VACACIONE_id_parametros_vacaciones` ASC, `PARAMETRO_VACACIONE_antigueda_derechos_año` ASC, `PARAMETRO_VACACIONE_nro_dias_disfrute` ASC, `PARAMETRO_VACACIONE_dias_incremento_disfrute_años` ASC, `PARAMETRO_VACACIONE_fecha_dd_aplicacion_incremento` ASC, `PARAMETRO_VACACIONE_tipo_disfrute_continuo` ASC, `PARAMETRO_VACACIONE_dias_habiles` ASC),
  CONSTRAINT `fk_ESCALA_PARA_CALCULAR_VACACIONES_PARAMETRO_VACACIONE1`
    FOREIGN KEY (`PARAMETRO_VACACIONE_id_parametros_vacaciones` , `PARAMETRO_VACACIONE_antigueda_derechos_año` , `PARAMETRO_VACACIONE_nro_dias_disfrute` , `PARAMETRO_VACACIONE_dias_incremento_disfrute_años` , `PARAMETRO_VACACIONE_fecha_dd_aplicacion_incremento` , `PARAMETRO_VACACIONE_tipo_disfrute_continuo` , `PARAMETRO_VACACIONE_dias_habiles`)
    REFERENCES `nominadb`.`PARAMETRO_VACACIONE` (`id_parametros_vacaciones` , `antigueda_derechos_año` , `nro_dias_disfrute` , `dias_incremento_disfrute_años` , `fecha_dd_aplicacion_incremento` , `tipo_disfrute_continuo` , `dias_habiles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- 4. MANEJO DE DEPENDENCIAS CIRCULARES (NOMINA_DETALLE <-> PAGOS_NOMINA)
-- -----------------------------------------------------

-- Paso 4a: Crear NOMINA_DETALLE SIN la FK a PAGOS_NOMINA
CREATE TABLE IF NOT EXISTS `nominadb`.`NOMINA_DETALLE` (
  `id_detalle` INT NOT NULL AUTO_INCREMENT,
  `id_empleado_FK` INT NOT NULL,
  `monto_calculado` DECIMAL(10,2) NOT NULL,
  `NOMINA_PERIODO_id_tipo_nomina` INT NOT NULL,
  `nro_periodo` INT NOT NULL,
  `PAGO_id_pago` INT NOT NULL, -- Columna INT, NO AÑADIMOS LA FK AQUÍ
  `CONCEPTO_id_concepto` VARCHAR(45) NOT NULL, 
  PRIMARY KEY (`id_detalle`),
  INDEX `fk_NOMINA_DETALLE_NOMINA_PPD1_idx` (`NOMINA_PERIODO_id_tipo_nomina` ASC),
  INDEX `fk_NOMINA_DETALLE_EMPLEADO1_idx` (`id_empleado_FK` ASC),
  
  -- FK a tablas ya creadas
  CONSTRAINT `fk_NOMINA_DETALLE_NOMINA_PPD1`
    FOREIGN KEY (`NOMINA_PERIODO_id_tipo_nomina`)
    REFERENCES `nominadb`.`NOMINA_PPD` (`id_tipo_nomina`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NOMINA_DETALLE_EMPLEADO1`
    FOREIGN KEY (`id_empleado_FK`)
    REFERENCES `nominadb`.`EMPLEADO` (`id_empleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_NOMINA_DETALLE_CONCEPTO1`
    FOREIGN KEY (`CONCEPTO_id_concepto`)
    REFERENCES `nominadb`.`CONCEPTO` (`id_concepto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- Paso 4b: Crear PAGOS_NOMINA (que referencia a NOMINA_DETALLE)
CREATE TABLE IF NOT EXISTS `nominadb`.`PAGOS_NOMINA` (
  `id_pagos_nomina` INT NOT NULL AUTO_INCREMENT,
  `id_pago` INT NOT NULL UNIQUE, -- <<-- CORRECCIÓN: DEBE SER UNIQUE PARA SER REFERENCIADO
  `monto` DECIMAL(10,2) NOT NULL,
  `NOMINA_DETALLE_id_detalle` INT NOT NULL,
  PRIMARY KEY (`id_pagos_nomina`),
  
  -- FK de PAGOS_NOMINA a NOMINA_DETALLE (esta referencia ya funciona)
  CONSTRAINT `fk_PAGOS_NOMINA_NOMINA_DETALLE1`
    FOREIGN KEY (`NOMINA_DETALLE_id_detalle`)
    REFERENCES `nominadb`.`NOMINA_DETALLE` (`id_detalle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- Paso 4c: Añadir la FK faltante a NOMINA_DETALLE (rompiendo el ciclo)
-- Ahora sí, NOMINA_DETALLE puede referenciar a PAGOS_NOMINA.id_pago (que es UNIQUE)
ALTER TABLE `nominadb`.`NOMINA_DETALLE`
ADD INDEX `fk_NOMINA_DETALLE_PAGOS_NOMINA1_idx` (`PAGO_id_pago` ASC),
ADD CONSTRAINT `fk_NOMINA_DETALLE_PAGOS_NOMINA1`
  FOREIGN KEY (`PAGO_id_pago`)
  REFERENCES `nominadb`.`PAGOS_NOMINA` (`id_pago`) 
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- 5. RESTAURAR CONFIGURACIÓN
-- -----------------------------------------------------
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;