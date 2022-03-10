-- *******************************************
-- Cria/descreve banco de dados do aplicativo.
-- *******************************************

-- *******************************  ATENÇÃO! *************************************
-- Este arquivo deve ser APAGADO quando aplicativo for para o nível de "produção".
-- *******************************************************************************

-- Apaga o banco de dados caso ele exista.
DROP DATABASE IF EXISTS php_app;

-- Cria banco de dados usando a tabela de caracters UTF-8 e buscas case-insensitive.
CREATE DATABASE php_app CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Selecionar o banco de dados criado.
USE php_app;

-- Cria tabela para armazenar os registros.
CREATE TABLE registros (
    registros_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    registros_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    registros_email VARCHAR(255) NOT NULL,
    registros_cpf VARCHAR(255) NOT NULL,
    registros_nome VARCHAR(255) NOT NULL,
    registros_Nascimento DATE NOT NULL,
    registros_genero VARCHAR(20) NOT NULL,
    registros_senha1 VARCHAR(20) NOT NULL,
    registros_senha2 VARCHAR(20) NOT NULL,
    registros_telefone INT NOT NULL,
    registros_nomeentrega VARCHAR(255),
    registros_cep INT NOT NULL,

    registros_status ENUM('analysis', 'confirmed', 'deleted') NOT NULL DEFAULT 'analysis'
);

-- Teste de inserção na tabela 'registros'.
INSERT INTO `registros` (
    `registros_email`,
    `registros_cpf`,
    `registros_nome`,
    `registros_Nascimento`,
    `registros_genero`,
    `registros_senha1`,
    `registros_senha2`,
    `registros_telefone`,
    `registros_nomeentrega`,
    `registros_cep`
    
) VALUES (
    'joca@silva.com',
    '17749771760',
    'Joca da Silva',
    '2022/03/07',
    'masculino',
    '050200',
    '050200',
    '21989419431',
    'anderson moura',
    '2198461'
);









-- Cria tabela para armazenar os {} para test do aplicativo.
CREATE TABLE shirts (
    shirts_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    shirts_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    shirts_title VARCHAR(127) NOT NULL,
    shirts_image VARCHAR(255) NOT NULL COMMENT 'Caminho absoluto da imagem.',
    shirts_descript VARCHAR(255) NOT NULL,
    shirts_team VARCHAR(50) NOT NULL,
    shirts_zise VARCHAR(50) NOT NULL,
    shirts_colors VARCHAR(50) NOT NULL,
    shirts_price INT NOT NULL,
    shirts_amount INT NOT NULL,
    shirts_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);


-- Insere alguns {} para testes.
INSERT INTO `shirts` (
    `shirts_title`, 
    `shirts_image`, 
    `shirts_descript`, 
    `shirts_team`,
    `shirts_zise`, 
    `shirts_colors`,
    `shirts_amount`,
    `shirts_price`
) VALUES (
    'Flamengo Principal',
    '/imgproduct/Camisaflabranca.png',
    'Camisa Original do Flamengo',
    'Flamengo',
    'P',
    'Whith',
    '100',
    '129.90'
);

-- Insere alguns {} para testes.
INSERT INTO `shirts` (
    `shirts_title`, 
    `shirts_image`, 
    `shirts_descript`, 
    `shirts_team`,
    `shirts_zise`, 
    `shirts_colors`,
    `shirts_amount`,
    `shirts_price`
) VALUES (
    'Flamengo Principal',
    '/imgproduct/Camisaflavermelha.png',
    'Camisa Original do Flamengo',
    'Flamengo',
    'P',
    'red',
    '100',
    '129.90'
);


-- Insere alguns {} para testes.
INSERT INTO `shirts` (
    `shirts_title`, 
    `shirts_image`, 
    `shirts_descript`, 
    `shirts_team`,
    `shirts_zise`, 
    `shirts_colors`,
    `shirts_amount`,
    `shirts_price`
) VALUES (
    'Flamengo Reserva',
    '/imgproduct/Camisaflapreta.png',
    'Camisa Original do Flamengo',
    'Flamengo',
    'P',
    'Black',
    '100',
    '129.90'
);