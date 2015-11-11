SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `condominio` DEFAULT CHARACTER SET utf8 ;
USE `condominio` ;

-- -----------------------------------------------------
-- Table `condominio`.`categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`categoria` (
  `id_cat` INT(5) NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_cat`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`fornecedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`fornecedor` (
  `id_fornecedor` INT(5) NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  `endereço` VARCHAR(100) NOT NULL ,
  `cpf` VARCHAR(11) NULL DEFAULT NULL ,
  `cnpj` VARCHAR(14) NULL DEFAULT NULL ,
  `telefone` INT(20) NOT NULL ,
  `detalhes` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id_fornecedor`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`atendimento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`atendimento` (
  `id_atend` INT(5) NOT NULL ,
  `id_cat` INT(5) NOT NULL ,
  `id_fornecedor` INT(5) NOT NULL ,
  PRIMARY KEY (`id_atend`, `id_cat`, `id_fornecedor`) ,
  INDEX `FK_atend_fornec_id_fornec` (`id_fornecedor` ASC) ,
  INDEX `FK_atend_categoria_id_cat` (`id_cat` ASC) ,
  CONSTRAINT `FK_atend_categoria_id_cat`
    FOREIGN KEY (`id_cat` )
    REFERENCES `condominio`.`categoria` (`id_cat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_atend_fornec_id_fornec`
    FOREIGN KEY (`id_fornecedor` )
    REFERENCES `condominio`.`fornecedor` (`id_fornecedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`requisicao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`requisicao` (
  `id_requisicao` INT(5) NOT NULL ,
  `titulo` VARCHAR(100) NOT NULL ,
  `prioridade` INT(3) NOT NULL ,
  `descricao` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_requisicao`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`status` (
  `id_status` INT(5) NOT NULL ,
  `status` VARCHAR(14) NOT NULL ,
  PRIMARY KEY (`id_status`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`usuario` (
  `cpf` VARCHAR(11) NOT NULL ,
  `nome` VARCHAR(100) NOT NULL ,
  `telefone` INT(20) NOT NULL ,
  `unidade` VARCHAR(5) NOT NULL ,
  `login` VARCHAR(20) NOT NULL ,
  `senha` VARCHAR(20) NOT NULL ,
  `id_usuario` INT(20) NOT NULL AUTO_INCREMENT ,
  PRIMARY KEY (`id_usuario`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`historico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`historico` (
  `id_hist` INT(5) NOT NULL ,
  `id_requisicao` INT(5) NOT NULL ,
  `id_usuario` INT(20) ,
  `data_atualizacao` DATETIME NOT NULL ,
  `id_status` INT(5) NOT NULL ,
  `detalhes` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id_hist`) ,
  INDEX `FK_hist_requisicao_id_requisicao` (`id_requisicao` ASC) ,
  INDEX `FK_hist_status_id_status` (`id_status` ASC) ,
  INDEX `FK_hist_usuario_id_usuario` (`id_usuario` ASC) ,
  CONSTRAINT `FK_hist_requisicao_id_requisicao`
    FOREIGN KEY (`id_requisicao` )
    REFERENCES `condominio`.`requisicao` (`id_requisicao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_hist_status_id_status`
    FOREIGN KEY (`id_status` )
    REFERENCES `condominio`.`status` (`id_status` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_hist_usuario_id_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `condominio`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`seguranca`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`seguranca` (
  `id_seguranca` INT(5) NOT NULL AUTO_INCREMENT,
  `id_permissao` INT(5) NOT NULL ,
  `id_usuario` INT(20) ,
  PRIMARY KEY (`id_seguranca`) ,
  INDEX `FK_seg_usuario_id_usuario` (`id_usuario` ASC) ,
  CONSTRAINT `FK_seg_usuario_id_usuario`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `condominio`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`servico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`servico` (
  `id_servico` INT(5) NOT NULL ,
  `id_fornecedor` INT(5) NOT NULL ,
  `id_requisicao` INT(5) NOT NULL ,
  `detalhes` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_servico`, `id_fornecedor`, `id_requisicao`) ,
  INDEX `FK_servico_fornec_id_fornec` (`id_fornecedor` ASC) ,
  INDEX `FK_servico_requisicao_id_permissao` (`id_requisicao` ASC) ,
  CONSTRAINT `FK_servico_fornec_id_fornec`
    FOREIGN KEY (`id_fornecedor` )
    REFERENCES `condominio`.`fornecedor` (`id_fornecedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_servico_requisicao_id_permissao`
    FOREIGN KEY (`id_requisicao` )
    REFERENCES `condominio`.`requisicao` (`id_requisicao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `condominio`.`solicitacao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `condominio`.`solicitacao` (
  `id_cat` INT(5) NOT NULL ,
  `id_requisicao` INT(5) NOT NULL ,
  PRIMARY KEY (`id_cat`, `id_requisicao`) ,
  INDEX `FK_solici_requisicao_id_requisicao` (`id_requisicao` ASC) ,
  CONSTRAINT `FK_solici_categoria_id_cat`
    FOREIGN KEY (`id_cat` )
    REFERENCES `condominio`.`categoria` (`id_cat` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_solici_requisicao_id_requisicao`
    FOREIGN KEY (`id_requisicao` )
    REFERENCES `condominio`.`requisicao` (`id_requisicao` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

USE `condominio` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
