DROP DATABASE IF EXISTS efriends;
CREATE DATABASE efriends;
USE efriends;

CREATE TABLE Administrador (
  idAdministrador INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Login_Admin VARCHAR(15) UNIQUE NOT NULL,
  Senha_Admin VARCHAR(15) NOT NULL,
  Nome_Admin VARCHAR(100) NOT NULL,
  Telefone_Admin INTEGER NOT NULL,
  Email_Admin VARCHAR(20) NOT NULL,
  Status_Admin BOOL NOT NULL DEFAULT TRUE,
  Sessao BOOL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL
);

CREATE TABLE Cliente (
  idCliente INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Nome_Cli VARCHAR(100) NOT NULL,
  Email_Cli VARCHAR (50) NOT NULL,
  Telefone_Cli VARCHAR(20) NOT NULL,
  CPF_Cli VARCHAR(15) UNIQUE NOT NULL,
  Newsletter BOOL NOT NULL,
  Login_Cli VARCHAR(15) UNIQUE NOT NULL,
  Senha_Cli VARCHAR(20) NOT NULL,
  Status_Cli BOOL NOT NULL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL, 
  Sessao BOOL DEFAULT TRUE
);

CREATE TABLE Ebook (
  idEbook INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
  Capa VARCHAR (255) NOT NULL,
  Titulo_Ebook VARCHAR (100) NOT NULL,
  Descricao_Ebook TINYTEXT NOT NULL,
  Autor_Ebook VARCHAR(100) NOT NULL,
  Preco_Ebook DOUBLE,
  Categoria VARCHAR (100) NOT NULL,
  Status_Ebook BOOL NOT NULL DEFAULT TRUE,
  Data_Cadastro DATETIME NOT NULL, 
  Obra VARCHAR (255) NOT NULL
);

CREATE TABLE Log_Administrador_Cliente (
  Administrador_idAdministrador INTEGER NOT NULL,
  Cliente_idCliente INTEGER NOT NULL,
  Acao_Admin_Cli VARCHAR (50) NOT NULL,
  Justificativa TINYTEXT NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Administrador_idAdministrador) REFERENCES Administrador(idAdministrador), 
  FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente)
);

CREATE TABLE Log_Administrador_Ebook (
  Administrador_idAdministrador INTEGER NOT NULL,
  Ebook_idEbook INTEGER NOT NULL,
  Acao_Admin_Ebook VARCHAR(50) NOT NULL,
  Campo_Alterado VARCHAR (100) NOT NULL,
  Valor_Antigo VARCHAR (255) NOT NULL, 
  Valor_Novo VARCHAR (255) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Administrador_idAdministrador) REFERENCES Administrador(idAdministrador), 
  FOREIGN KEY (Ebook_idEbook) REFERENCES Ebook(idEbook)
  ON UPDATE CASCADE
);

CREATE TABLE Log_Cliente_Ebook (
  Cliente_idCliente INTEGER NOT NULL,
  Ebook_idEbook INTEGER NOT NULL,
  Status_Cli_Ebook VARCHAR(15) NOT NULL,
  Data_Acao DATETIME NOT NULL,
  FOREIGN KEY (Ebook_idEbook) REFERENCES Ebook(idEbook), 
  FOREIGN KEY (Cliente_idCliente) REFERENCES Cliente(idCliente)
  ON UPDATE CASCADE
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
);

DELIMITER $$
CREATE PROCEDURE CadastraAdministrador(Login varchar(15), Senha varchar(10), Nome varchar(100), Telefone varchar(13), Email varchar(50))
BEGIN
INSERT INTO Administrador(Login_Admin, Senha_Admin, Nome_Admin, Telefone_Admin, Email_Admin, Data_Cadastro)
VALUES (Login, Senha, Nome, Telefone, Email, now());
END $$
DELIMITER ;

CALL CadastraAdministrador("dufermiano", "123456", "Eduardo", "(11) 980357500", "dufermiano43@gmail.com");

#trigger que audita data de uma PUBLICAÇÃO por parte de um usuário
DELIMITER $$
CREATE TRIGGER tg_cliente_ebook_publicacao AFTER INSERT
ON Ebook
FOR EACH ROW
BEGIN
INSERT INTO log_cliente_ebook VALUES
((SELECT idCliente FROM Cliente WHERE Sessao = true), NEW.idEbook, 'Publicação', NOW());
END $$
DELIMITER ;


#trigger que faz a auditoria de alterações de dados do usuário na tabela HISTORICO_CLIENTE
DELIMITER $$
CREATE TRIGGER tg_audita_cli AFTER UPDATE 
ON Cliente
FOR EACH ROW
BEGIN

 IF (New.Nome_Cli <> Old.Nome_Cli) THEN 
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO DE NOME', 'Nome_Cli', OLD.Nome_Cli, NEW.Nome_Cli, NOW());
END IF;

 IF (New.Email_Cli <> Old.Email_Cli) THEN 
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO DE EMAIL', 'Email_Cli', OLD.Email_Cli, NEW.Email_Cli, NOW());
END IF;

 IF (New.Telefone_Cli <> Old.Telefone_Cli) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO DE TELEFONE', 'Telefone_Cli', OLD.Telefone_Cli, NEW.Telefone_Cli, NOW());
END IF;

 IF (New.Newsletter <> Old.Newsletter) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO NA NEWSLETTER', 'Newsletter', OLD.Newsletter, NEW.Newsletter, NOW());
END IF;

 IF (New.Senha_Cli <> Old.Senha_Cli) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO NA SENHA', 'Senha_Cli', OLD.Senha_Cli, NEW.Senha_Cli, NOW());
END IF;

 IF (New.Status_Cli <> Old.Status_Cli) THEN
	INSERT INTO HISTORICO_CLIENTE VALUES
	((SELECT IDCLIENTE FROM CLIENTE WHERE SESSAO = TRUE), 'ALTERAÇÃO NO STATUS', 'Status_Cli', OLD.Status_Cli, NEW.Status_Cli, NOW());
END IF;

END $$
DELIMITER ;

#TRIGGER QUE AUDITA O EBOOK ALTERADO PELO ADMIN

DELIMITER $$
CREATE TRIGGER tg_audita_ebook_admin AFTER UPDATE 
ON Ebook
FOR EACH ROW
BEGIN

 IF (New.Capa <> Old.Capa) THEN 
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'Alteração da Capa', 'Capa', OLD.Capa, NEW.Capa, NOW());
END IF;

 IF (New.Titulo_Ebook <> Old.Titulo_Ebook) THEN 
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'Alteração do Titulo', 'Titulo_Ebook', OLD.Titulo_Ebook, NEW.Titulo_Ebook, NOW());
END IF;

 IF (New.Descricao_Ebook <> Old.Descricao_Ebook) THEN
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'Alteração da Descricao', 'Descricao_Ebook', OLD.Descricao_Ebook, NEW.Descricao_Ebook, NOW());
END IF;

 IF (New.Autor_Ebook <> Old.Autor_Ebook) THEN
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'ALTERAÇÃO NO AUTOR', 'Autor_Ebook', OLD.Autor_Ebook, NEW.Autor_Ebook, NOW());
END IF;

 IF (New.Preco_Ebook <> Old.Preco_Ebook) THEN
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'ALTERAÇÃO NO PRECO', 'Preco_Ebook', OLD.Preco_Ebook, NEW.Preco_Ebook, NOW());
END IF;

 IF (New.Status_Ebook <> Old.Status_Ebook) THEN
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'ALTERAÇÃO NO STATUS', 'Status_Ebook', OLD.Status_Ebook, NEW.Status_Ebook, NOW());
END IF;

 IF (New.Obra <> Old.Obra) THEN
	INSERT INTO LOG_ADMINISTRADOR_EBOOK VALUES
	((SELECT IDADMINISTRADOR FROM ADMINISTRADOR WHERE SESSAO = TRUE), NEW.IDEBOOK, 'ALTERAÇÃO NA Obra', 'Obra', OLD.Obra, NEW.Obra, NOW());
END IF;

END $$
DELIMITER ;
