CREATE DATABASE `sisclinica` CHARACTER SET 'utf8' COLLATE 'utf8_bin';
USE sisclinica;

CREATE TABLE `sisclinica`.`Untitled`  (
  `id_paciente` int NOT NULL,
  `nome_paciente` varchar(60) NOT NULL,
  `sobrenome_paciente` varchar(60) NOT NULL,
  `nascimento_paciente` date NOT NULL,
  `responsavel1_paciente` varchar(60) NOT NULL,
  `responsavel2_paciente` varchar(60) NULL,
  `rg_paciente` varchar(30) NULL,
  `cpf_paciente` varchar(11) NULL,
  `sexo_paciente` enum('M','F','O') NOT NULL,
  `tel1_paciente` varchar(11) NOT NULL,
  `tel2_paciente` varchar(11) NULL,
  `email_paciente` varchar(60) NULL,
  `peso_paciente` float(7) NULL,
  `altura_paciente` varchar(3) NULL,
  `endereco_paciente` varchar(60) NULL,
  `numero_paciente` varchar(6) NULL,
  `complemento_paciente` varchar(60) NULL,
  `bairro_paciente` varchar(30) NULL,
  `cep_paciente` varchar(8) NULL,
  `cidade_paciente` int NULL,
  `estado_paciente` int NULL,
  `cadastro_paciente` datetime NOT NULL,
  `atualizacao_paciente` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sts_paciente` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_paciente`),
  UNIQUE INDEX `cpf`(`cpf_paciente`);

  