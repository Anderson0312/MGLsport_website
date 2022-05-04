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
    registros_name VARCHAR(255) NOT NULL,
    registros_birth DATE NOT NULL,
    registros_genero VARCHAR(20) NOT NULL,
    registros_password VARCHAR(255) NOT NULL,
    registros_telefone bigint NOT NULL,
    registros_nomeentrega VARCHAR(255),
    registros_cep INT NOT NULL,
    registros_address VARCHAR(255) NOT NULL,
    registros_number VARCHAR(255) NOT NULL,
    registros_district VARCHAR(255) NOT NULL,
    registros_city VARCHAR(255) NOT NULL,

    registros_permission ENUM('usuario', 'admin') NOT NULL DEFAULT 'usuario',
    registros_status ENUM('analysis', 'confirmed', 'deleted') NOT NULL DEFAULT 'confirmed' 
);

-- Teste de inserção na tabela 'registros'.
    INSERT INTO registros (
        registros_email,
        registros_cpf,
        registros_name,
        registros_birth,
        registros_genero,
        registros_password,
        registros_telefone,
        registros_nomeentrega,
        registros_cep,
        registros_address,
        registros_number,
        registros_district,
        registros_city,
        registros_permission
           
) VALUES (
    'andersonmoura812@gmail.com',
    '17749771760',
    'Anderson moura do nascimento',
    '2022/03/07',
    'masculino',
    SHA2('050200', 512),
    '21989419431',
    'anderson moura',
    '2198461',
    'rua dos manjollos',
    'casa 693 fundos',
    'ilha do governador',
    'Rio de janeiro',
    'admin'
);






-- Selecionar o banco de dados criado.
USE php_app;


-- Cria tabela para armazenar os {shirts} para test do aplicativo.
CREATE TABLE shirts (
    shirts_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    shirts_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    shirts_title VARCHAR(127) NOT NULL,
    shirts_image VARCHAR(255)  COMMENT 'Caminho absoluto da imagem.',
    shirts_image_2 VARCHAR(255)  COMMENT 'Caminho absoluto da imagem.',
    shirts_image_3 VARCHAR(255)  COMMENT 'Caminho absoluto da imagem.',
    shirts_image_4 VARCHAR(255)  COMMENT 'Caminho absoluto da imagem.',
    shirts_descript VARCHAR(255) NOT NULL,
    shirts_team VARCHAR(50) NOT NULL,
    shirts_pais VARCHAR(50) NOT NULL,
    shirts_size VARCHAR(50) NOT NULL,
    shirts_colors VARCHAR(50) NOT NULL,
    shirts_price float NOT NULL,
    shirts_amount INT NOT NULL,
    shirts_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);


INSERT INTO `shirts` (
    `shirts_title`,
    `shirts_image`,
    `shirts_image_2`,
    `shirts_image_3`,
    `shirts_image_4`,
    `shirts_descript`,
    `shirts_team`,
    `shirts_pais`,
    `shirts_size`,
    `shirts_colors`,
    `shirts_price`,
    `shirts_amount` 
    ) VALUES (
 'Camisa Bayern Munich',
 '/imgproduct/Camisas/Alemanhã/Bayernmunichaway20-21/bayernmunich2021frent.jpg',
 '/imgproduct/Camisas/Alemanhã/Bayernmunichaway20-21/bayernmunich2021lado.jpg',
 '/imgproduct/Camisas/Alemanhã/Bayernmunichaway20-21/bayernmunich2021cost.jpg',
 '/imgproduct/Camisas/Alemanhã/Bayernmunichaway20-21/bayernmunich2021zon.jpg',
 'Camisa Original do Bayern Munich away 20-21',
 'Bayern Munich',
 'Alemanha',
 'P',
 'Whith', 
 149,
 100 ),

('Camisa Bayern Munich',
'/imgproduct/Camisas/Alemanhã/Bayernmunichhome20-21/a16d764f.jpg', 
'/imgproduct/Camisas/Alemanhã/Bayernmunichhome20-21/87dee6eb.jpg', 
'/imgproduct/Camisas/Alemanhã/Bayernmunichhome20-21/7763e962.jpg',   
'/imgproduct/Camisas/Alemanhã/Bayernmunichhome20-21/dcaee3fb.jpg',
'Camisa Original do Bayern Munich home 20-21', 
'Bayern Munich',
'Alemanha',
'P',   
'Vermelha',  
149,  
100),

('Camisa RB Leipzig',   
'/imgproduct/Camisas/Alemanhã/CamisaNikeRBLeipzigI20-21-TorcedorMasculina/0.jpg', 
'/imgproduct/Camisas/Alemanhã/CamisaNikeRBLeipzigI20-21-TorcedorMasculina/95f0a4c6.jpg',
'/imgproduct/Camisas/Alemanhã/CamisaNikeRBLeipzigI20-21-TorcedorMasculina/49263069.jpg' ,  
'/imgproduct/Camisas/Alemanhã/CamisaNikeRBLeipzigI20-21-TorcedorMasculina/197b8664.jpg' , 
'Camisa Original do RB Leipzig home 20-21',  
'RB Leipzig',
'Alemanha',
'P',   
'Vermelha',  
149,  
100),

('Camisa Borussia Dortmund',
'/imgproduct/Camisas/Alemanhã/CamisaPumaBorussiaDortmundI20-21-TorcedorMasculina/0.jpg',   
'/imgproduct/Camisas/Alemanhã/CamisaPumaBorussiaDortmundI20-21-TorcedorMasculina/9ae96f23.jpg',   
'/imgproduct/Camisas/Alemanhã/CamisaPumaBorussiaDortmundI20-21-TorcedorMasculina/3fe5aa3f.jpg',   
'/imgproduct/Camisas/Alemanhã/CamisaPumaBorussiaDortmundI20-21-TorcedorMasculina/74c24819.jpg',   
'Camisa Original do Borussia Dortmund 20-21', 
'Borussia Dortmund',
'Alemanha',
'P',   
'Amarela',
149,   
100),

('Camisa Seleção da Alemanha',  
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaAway2020/f2c5d2f6.jpg', 
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaAway2020/3bebaa3e.jpg',
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaAway2020/a453fa21.jpg',   
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaAway2020/1d9d7da5.jpg', 
'Camisa Original do Alemanha Away 20-21',
'Alemanha',
'Alemanha',
'P',   
'Preta',  
149,
100),

('Camisa Seleção da Alemanha',  
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaHome2020/f08474bb.jpg', 
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaHome2020/2411b962.jpg',
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaHome2020/99e35a19.jpg',  
'/imgproduct/Camisas/Alemanhã/CamisaSeleçãodaAlemanhaHome2020/a3582f7b.jpg',  
'Camisa Original do Alemanha home 20-21',
'Alemanha',
'Alemanha',
'P',   
'Preta',  
149 ,
100),

('Camisa Boca Juniors', 
'/imgproduct/Camisas/Argentina/CamisaAdidasBocaJuniorsI20-21-TorcedorMasculina/0.jpg',  
'/imgproduct/Camisas/Argentina/CamisaAdidasBocaJuniorsI20-21-TorcedorMasculina/f0188001.jpg',
'/imgproduct/Camisas/Argentina/CamisaAdidasBocaJuniorsI20-21-TorcedorMasculina/dc9437cb.jpg',  
'/imgproduct/Camisas/Argentina/CamisaAdidasBocaJuniorsI20-21-TorcedorMasculina/c32f09de.jpg',
'Camisa Original Boca Juniors 20-21',  
'Boca Juniors',  
'Argentina', 
'M',
'Azul',
149,   
100),

('Camisa River Plate',  
'/imgproduct/Camisas/Argentina/CamisaAdidasRiverPlateI20-21-TorcedorMasculina/0.jpg',
'/imgproduct/Camisas/Argentina/CamisaAdidasRiverPlateI20-21-TorcedorMasculina/1ca71395.jpg',   
'/imgproduct/Camisas/Argentina/CamisaAdidasRiverPlateI20-21-TorcedorMasculina/e76c5432.jpg',  
'/imgproduct/Camisas/Argentina/CamisaAdidasRiverPlateI20-21-TorcedorMasculina/6836f659.jpg', 
'Camisa Original River Plate 20-21',
'River Plate', 
'Argentina',
'M',   
'Preta',  
149 ,
100),

('Camisa Seleção da Argentina', 
'/imgproduct/Camisas/Argentina/CamisaAdidasSeleçãodaArgentinaI2020-TorcedorMasculina/0.jpg',
'/imgproduct/Camisas/Argentina/CamisaAdidasSeleçãodaArgentinaI2020-TorcedorMasculina/8464cf1d.jpg',
'/imgproduct/Camisas/Argentina/CamisaAdidasSeleçãodaArgentinaI2020-TorcedorMasculina/2e615adf.jpg',
'/imgproduct/Camisas/Argentina/CamisaAdidasSeleçãodaArgentinaI2020-TorcedorMasculina/9585f269.jpg',
'Camisa Original Seleção da Argentina 20-21',  
'Argentina', 
'Argentina',
'M',   
'Branca', 
149,
100),

('Camisa Flamengo', 
'/imgproduct/Camisas/Brasil/CamisaFlamengolll20-21/eb8d6704.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFlamengolll20-21/bab549eb.jpg',
'/imgproduct/Camisas/Brasil/CamisaFlamengolll20-21/d0841ca8.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFlamengolll20-21/c69e9334.jpg' ,
'Camisa Original Flamengo 20-21' ,  
'Flamengo',   
'Brasil', 
'M',
'Preta' ,  
149,  
100),

('Camisa Flamengo', 
'/imgproduct/Camisas/Brasil/CamisaFlamengoOutubroRosa20-21/e6329e7b.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFlamengoOutubroRosa20-21/2cc88e23.jpg', 
'/imgproduct/Camisas/Brasil/CamisaFlamengoOutubroRosa20-21/0af4afb6.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFlamengoOutubroRosa20-21/3224a1de.jpg', 
'Camisa Original Flamengo 20-21',   
'Flamengo',   
'Brasil', 
'M',
'Rosa',
149,   
100),

('Camisa São Paulo',
'/imgproduct/Camisas/Brasil/CamisaAdidasSãoPauloI20-21-TorcedorMasculina/0.jpg',   
'/imgproduct/Camisas/Brasil/CamisaAdidasSãoPauloI20-21-TorcedorMasculina/a3291b49.jpg',   
'/imgproduct/Camisas/Brasil/CamisaAdidasSãoPauloI20-21-TorcedorMasculina/70f28045.jpg',  
'/imgproduct/Camisas/Brasil/CamisaAdidasSãoPauloI20-21-TorcedorMasculina/ae8c6365.jpg',   
'Camisa Original São Paulo 20-21',
'São Paulo',   
'Brasil', 
'M',
'Branca',  
149,
100),

('Camisa Corinthians',
'/imgproduct/Camisas/Brasil/CamisaCorinthiansTitular20-21/5718f3f3.jpg',
'/imgproduct/Camisas/Brasil/CamisaCorinthiansTitular20-21/a040c4da.jpg',
'/imgproduct/Camisas/Brasil/CamisaCorinthiansTitular20-21/8b49d9eb.jpg',  
'/imgproduct/Camisas/Brasil/CamisaCorinthiansTitular20-21/1b6b9aff.jpg',  
'Camisa Original Corinthians 20-21', 
'Corinthians' , 
'Brasil',
'M',   
'Branca', 
149,
100),

('Camisa Fluminense',   
'/imgproduct/Camisas/Brasil/CamisaFluminenseReserva20-21/d53c8539.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFluminenseReserva20-21/ba7f9467.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFluminenseReserva20-21/4fecd629.jpg',   
'/imgproduct/Camisas/Brasil/CamisaFluminenseReserva20-21/555db44d.jpg',   
'Camisa Original Fluminense 20-21',   
'Fluminense', 
'Brasil',   
'M',  
'Branca',
149,   
100),

('Camisa Botafogo', 
'/imgproduct/Camisas/Brasil/CamisaKappaBotafogoI20-21-TorcedorMasculina/0.jpg', 
'/imgproduct/Camisas/Brasil/CamisaKappaBotafogoI20-21-TorcedorMasculina/27a72644.jpg',  
'/imgproduct/Camisas/Brasil/CamisaKappaBotafogoI20-21-TorcedorMasculina/5433ad50.jpg',   
'/imgproduct/Camisas/Brasil/CamisaKappaBotafogoI20-21-TorcedorMasculina/6ba1e5d1.jpg',
'Camisa Original Botafogo 20-21',  
'Botafogo',  
'Brasil',
'M',   
'Branca', 
149,
100),

('Camisa Vasco',
'/imgproduct/Camisas/Brasil/CamisaVascoReserva20-21/3229aa3f.jpg', 
'/imgproduct/Camisas/Brasil/CamisaVascoReserva20-21/e7eb4836.jpg',  
'/imgproduct/Camisas/Brasil/CamisaVascoReserva20-21/d8e20711.jpg',   
'/imgproduct/Camisas/Brasil/CamisaVascoReserva20-21/640175cf.jpg',
'Camisa Original Vasco 20-21', 
'Vasco',
'Brasil',  
'M', 
'Branca',   
149,  
100),

('Camisa Flamengo', 
'/imgproduct/Camisas/Brasil/Flamengo-2021-vermelha/7f9162ff.jpg',   
'/imgproduct/Camisas/Brasil/Flamengo-2021-vermelha/85b425d2.jpg', 
'/imgproduct/Camisas/Brasil/Flamengo-2021-vermelha/95d21aaa.jpg',   
'/imgproduct/Camisas/Brasil/Flamengo-2021-vermelha/2f02cc01.jpg', 
'Camisa Original Flamengo 20-21',   
'Flamengo',   
'Brasil', 
'M',
'Vermelha',
149,   
100),

('Camisa Fluminense',   
'/imgproduct/Camisas/Brasil/Fluminensethird20-21/2082d1bc.jpg',   
'/imgproduct/Camisas/Brasil/Fluminensethird20-21/f3716168.jpg',   
'/imgproduct/Camisas/Brasil/Fluminensethird20-21/bb98c622.jpg',   
'/imgproduct/Camisas/Brasil/Fluminensethird20-21/e968a6eb.jpg',   
'Camisa Original Fluminense 20-21',   
'Fluminense',
'Brasil',
'M',  
'Verde' ,
149,
100),

('Camisa Vasco',
'/imgproduct/Camisas/Brasil/Vasco-2021-preta/be792b36.jpg',
'/imgproduct/Camisas/Brasil/Vasco-2021-preta/53969378.jpg',
'/imgproduct/Camisas/Brasil/Vasco-2021-preta/29ddc62b.jpg',
'/imgproduct/Camisas/Brasil/Vasco-2021-preta/15aaff03.jpg',
'Camisa Original Vasco 20-21' ,
'Vasco',
'Brasil' , 
'M',
'Preta',
149,
100);










-- Cria tabela para armazenar os {coats} para test do aplicativo.
CREATE TABLE coats (
    coats_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    coats_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    coats_title VARCHAR(127) NOT NULL,
    coats_image VARCHAR(255) NOT NULL COMMENT 'Caminho absoluto da imagem.',
    coats_descript VARCHAR(255) NOT NULL,
    coats_team VARCHAR(50) NOT NULL,
    coats_size VARCHAR(50) NOT NULL,
    coats_colors VARCHAR(50) NOT NULL,
    coats_price float NOT NULL,
    coats_amount INT NOT NULL,
    coats_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);



-- Cria tabela para armazenar os {newcolecion} para test do aplicativo.
CREATE TABLE newcolecion (
    newcolecion_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    newcolecion_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    newcolecion_title VARCHAR(127) NOT NULL,
    newcolecion_image VARCHAR(255) NOT NULL COMMENT 'Caminho absoluto da imagem.',
    newcolecion_descript VARCHAR(255) NOT NULL,
    newcolecion_team VARCHAR(50) NOT NULL,
    newcolecion_size VARCHAR(50) NOT NULL,
    newcolecion_colors VARCHAR(50) NOT NULL,
    newcolecion_price float NOT NULL,
    newcolecion_amount INT NOT NULL,
    newcolecion_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);


-- Cria tabela para armazenar os {newcolecion} para test do aplicativo.
CREATE TABLE accessories (
    accessories_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    accessories_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    accessories_title VARCHAR(127) NOT NULL,
    accessories_image VARCHAR(255) NOT NULL COMMENT 'Caminho absoluto da imagem.',
    accessories_descript VARCHAR(255) NOT NULL,
    accessories_team VARCHAR(50) NOT NULL,
    accessories_size VARCHAR(50) NOT NULL,
    accessories_colors VARCHAR(50) NOT NULL,
    accessories_price float NOT NULL,
    accessories_amount INT NOT NULL,
    accessories_status ENUM('on', 'off', 'deleted') NOT NULL DEFAULT 'on'
);






