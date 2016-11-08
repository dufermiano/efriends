DROP DATABASE IF EXISTS efriends;
CREATE DATABASE efriends;
USE efriends;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

ALTER TABLE ci_sessions ADD PRIMARY KEY (id);

CREATE TABLE Administrador (
  idAdministrador INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Login_Admin VARCHAR(100) UNIQUE NOT NULL,
  Senha_Admin VARCHAR(255) NOT NULL,
  Nome_Admin VARCHAR(100) NOT NULL,
  Telefone_Admin INTEGER NOT NULL,
  Email_Admin VARCHAR(30) NOT NULL,
  Status_Admin BOOL NOT NULL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL,
  Pergunta VARCHAR(100) NOT NULL, 
  Resposta VARCHAR(100) NOT NULL
);

CREATE TABLE Cliente (
  idCliente INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome_Cli VARCHAR(100) NOT NULL,
  Email_Cli VARCHAR (50) NOT NULL,
  Telefone_Cli VARCHAR(20) NOT NULL,
  CPF_Cli VARCHAR(15) UNIQUE NOT NULL,
  Newsletter BOOL NOT NULL,
  Login_Cli VARCHAR(100) UNIQUE NOT NULL,
  Senha_Cli VARCHAR(100) NOT NULL,
  Status_Cli BOOL NOT NULL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL,
  Pergunta VARCHAR(100) NOT NULL, 
  Resposta VARCHAR(100) NOT NULL,
  Token VARCHAR(255)	
);

CREATE TABLE Ebook (
  idEbook INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Capa VARCHAR (255) NOT NULL,
  Titulo_Ebook VARCHAR (100) NOT NULL,
  Descricao_Ebook TINYTEXT NOT NULL,
  Autor_Ebook VARCHAR(100) NOT NULL,
  Preco_Ebook DECIMAL(10,2),
  Categoria VARCHAR (100) NOT NULL,
  Status_Ebook BOOL NOT NULL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL, 
  Obra VARCHAR (255) NOT NULL
);











CREATE TABLE Log_Administrador_Cliente (
  Administrador_idAdministrador INTEGER NOT NULL,
  Cliente_idCliente INTEGER NOT NULL,
  Acao_Admin_Cli VARCHAR (50) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Administrador_idAdministrador) REFERENCES Administrador(idAdministrador), 
  FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);

CREATE TABLE Log_Administrador_Ebook (
  Administrador_idAdministrador INTEGER NOT NULL,
  Ebook_idEbook INTEGER NOT NULL,
  Acao_Admin_Ebook VARCHAR(50) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Administrador_idAdministrador) REFERENCES Administrador(idAdministrador), 
  FOREIGN KEY (Ebook_idEbook) REFERENCES Ebook(idEbook)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);

CREATE TABLE Log_Cliente_Ebook (
  Cliente_idCliente INTEGER NOT NULL,
  Ebook_idEbook INTEGER NOT NULL,
  Status_Cli_Ebook VARCHAR(15) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Ebook_idEbook) REFERENCES Ebook(idEbook), 
  FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);

CREATE TABLE Historico_Cliente (
  Cliente_idCliente INTEGER NOT NULL,
  Acao_Realizada VARCHAR(50) NOT NULL,
  Campo_Alterado VARCHAR (100) NOT NULL,
  Valor_Antigo VARCHAR (255) NOT NULL, 
  Valor_Novo VARCHAR (255) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente)
  ON UPDATE CASCADE
  ON DELETE CASCADE
);

#trigger que faz a auditoria de alterações de dados do usuário na tabela HISTORICO_CLIENTE e LOG_ADMINISTRADOR_CLIENTE
DELIMITER $$
CREATE TRIGGER tg_audita_cli AFTER UPDATE 
ON Cliente
FOR EACH ROW
BEGIN

 IF (New.Nome_Cli <> Old.Nome_Cli) THEN 
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO DE NOME', 'Nome_Cli', OLD.Nome_Cli, NEW.Nome_Cli, NOW());
END IF;

 IF (New.Email_Cli <> Old.Email_Cli) THEN 
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO DE EMAIL', 'Email_Cli', OLD.Email_Cli, NEW.Email_Cli, NOW());
END IF;

 IF (New.Telefone_Cli <> Old.Telefone_Cli) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO DE TELEFONE', 'Telefone_Cli', OLD.Telefone_Cli, NEW.Telefone_Cli, NOW());
END IF;

 IF (New.Newsletter <> Old.Newsletter) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO NA NEWSLETTER', 'Newsletter', OLD.Newsletter, NEW.Newsletter, NOW());
END IF;

 IF (New.Senha_Cli <> Old.Senha_Cli) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO NA SENHA', 'Senha_Cli', OLD.Senha_Cli, NEW.Senha_Cli, NOW());
END IF;

IF (New.Token <> Old.Token) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO NO TOKEN PAGSEGURO', 'Token', OLD.Token, NEW.Token, NOW());
END IF;

IF (New.Pergunta <> Old.Pergunta ) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO NA PERGUNTA DE SEGURANÇA', 'Pergunta de segurança', OLD.Pergunta , NEW.Pergunta , NOW());
END IF;

IF (New.Resposta <> Old.Resposta) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	(NEW.idCliente, 'ALTERAÇÃO NA RESPOSTA DE SEGURANÇA', 'Resposta de segurança', OLD.Resposta, NEW.Resposta, NOW());
END IF;

END $$
DELIMITER ;


