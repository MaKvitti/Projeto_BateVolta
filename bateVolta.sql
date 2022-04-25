CREATE TABLE `Funcionarios` (
	`idFuncionario` INT NOT NULL AUTO_INCREMENT,
	`cpf` VARCHAR(15) NOT NULL UNIQUE,
	`nome` VARCHAR(55) NOT NULL,
	`celular` VARCHAR(20) NOT NULL,
	`sexo` VARCHAR(25) NOT NULL,
	`cargo` VARCHAR(55) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`salt` VARCHAR(255) NOT NULL,
	`data` DATETIME NOT NULL,
	`ativo` BOOLEAN NOT NULL,
	`FK_enderecos` INT NOT NULL,
	`FK_sedes` INT NOT NULL,
	PRIMARY KEY (`idFuncionario`)
);

CREATE TABLE `Sedes` (
	`idSede` INT NOT NULL AUTO_INCREMENT,
	`telefone` VARCHAR(20) NOT NULL,
	`email` VARCHAR(55) NOT NULL,
	`site` VARCHAR(55) NOT NULL,
	`nome` VARCHAR(99) NOT NULL,
	`data` DATETIME NOT NULL,
	`FK_enderecos` INT NOT NULL,
	PRIMARY KEY (`idSede`)
);

CREATE TABLE `Encomendas` (
	`idEncomenda` INT NOT NULL AUTO_INCREMENT,
	`codRastreio` VARCHAR(25) NOT NULL,
	`peso` INT NOT NULL,
	`comprimento` FLOAT NOT NULL,
	`largura` FLOAT NOT NULL,
	`altura` FLOAT NOT NULL,
	`volume` FLOAT NOT NULL,
	`valorEntrega` FLOAT NOT NULL,
	`dataPostagem` DATETIME NOT NULL,
	`ativo` BOOLEAN NOT NULL,
	`FK_enderecoDestinatario` INT NOT NULL,
	`FK_enderecoSede` INT NOT NULL,
	PRIMARY KEY (`idEncomenda`,`codRastreio`)
);

CREATE TABLE `Rotas` (
	`idRota` INT NOT NULL AUTO_INCREMENT,
	`FK_funcionario` INT NOT NULL,
	`ativo` INT NOT NULL,
	`data` DATETIME NOT NULL,
	PRIMARY KEY (`idRota`)
);

CREATE TABLE `Enderecos` (
	`idEndereco` INT NOT NULL AUTO_INCREMENT,
	`rua` VARCHAR(99) NOT NULL,
	`numero` INT NOT NULL,
	`bairro` VARCHAR(99) NOT NULL,
	`cidade` VARCHAR(99) NOT NULL,
	`estado` VARCHAR(99) NOT NULL,
	`cep` VARCHAR(10) NOT NULL,
	`complemento` VARCHAR(99) NOT NULL,
	`data` DATETIME NOT NULL,
	PRIMARY KEY (`idEndereco`)
);

CREATE TABLE `Preco` (
	`idPreco` INT NOT NULL AUTO_INCREMENT,
	`precoKm` FLOAT NOT NULL,
	`precoPeso` FLOAT NOT NULL,
	`precoVolume` FLOAT NOT NULL,
	`precoFixo` FLOAT NOT NULL,
	PRIMARY KEY (`idPreco`)
);

CREATE TABLE `Rotas_Encomendas` (
	`idRotaEncomenda` INT NOT NULL AUTO_INCREMENT,
	`FK_encomendas` INT NOT NULL,
	`FK_rotas` INT,
	`FK_endereco` INT NOT NULL,
	`status` VARCHAR(255) NOT NULL,
	`data` DATETIME NOT NULL,
	PRIMARY KEY (`idRotaEncomenda`)
);

ALTER TABLE `Funcionarios` ADD CONSTRAINT `Funcionarios_fk0` FOREIGN KEY (`FK_enderecos`) REFERENCES `Enderecos`(`idEndereco`);

ALTER TABLE `Funcionarios` ADD CONSTRAINT `Funcionarios_fk1` FOREIGN KEY (`FK_sedes`) REFERENCES `Sedes`(`idSede`);

ALTER TABLE `Sedes` ADD CONSTRAINT `Sedes_fk0` FOREIGN KEY (`FK_enderecos`) REFERENCES `Enderecos`(`idEndereco`);

ALTER TABLE `Encomendas` ADD CONSTRAINT `Encomendas_fk0` FOREIGN KEY (`FK_enderecoDestinatario`) REFERENCES `Enderecos`(`idEndereco`);

ALTER TABLE `Encomendas` ADD CONSTRAINT `Encomendas_fk1` FOREIGN KEY (`FK_enderecoSede`) REFERENCES `Sedes`(`idSede`);

ALTER TABLE `Rotas` ADD CONSTRAINT `Rotas_fk0` FOREIGN KEY (`FK_funcionario`) REFERENCES `Funcionarios`(`idFuncionario`);

ALTER TABLE `Rotas_Encomendas` ADD CONSTRAINT `Rotas_Encomendas_fk0` FOREIGN KEY (`FK_encomendas`) REFERENCES `Encomendas`(`idEncomenda`);

ALTER TABLE `Rotas_Encomendas` ADD CONSTRAINT `Rotas_Encomendas_fk1` FOREIGN KEY (`FK_rotas`) REFERENCES `Rotas`(`idRota`);

ALTER TABLE `Rotas_Encomendas` ADD CONSTRAINT `Rotas_Encomendas_fk2` FOREIGN KEY (`FK_endereco`) REFERENCES `Enderecos`(`idEndereco`);
