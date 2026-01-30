CREATE DATABASE ldlBD;

CREATE TABLE jogador (
    id SERIAL PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE personagem (
    id SERIAL PRIMARY KEY,
    id_jogador INT REFERENCES jogador(id) ON DELETE CASCADE
);

CREATE TABLE base (
    id SERIAL PRIMARY KEY,
    id_personagem INT REFERENCES personagem(id) ON DELETE CASCADE,
    nome VARCHAR(100),
    idade INT,
    genero VARCHAR(20),
    altura FLOAT,
    ocupacao VARCHAR(50),
    residencia VARCHAR(100),
    nacionalidade VARCHAR(50),
    arquetipo VARCHAR(50),
    sina VARCHAR(100),
    nivel INT,
    pontos_armazenados INT,
    contato INT
);

CREATE TABLE tipo_atributo (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE atributo (
    id SERIAL PRIMARY KEY,
    id_personagem INT REFERENCES personagem(id) ON DELETE CASCADE,
    id_tipo_atributo INT REFERENCES tipo_atributo(id),
    dado VARCHAR(10),  
    valor INT
);

CREATE TABLE tipo_pericia (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE pericia (
    id SERIAL PRIMARY KEY,
    id_personagem INT REFERENCES personagem(id) ON DELETE CASCADE,
    id_tipo_pericia INT REFERENCES tipo_pericia(id),
    valor INT
);

CREATE TABLE tipo_habilidade (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE tipo_efeito (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE habilidade (
    id SERIAL PRIMARY KEY,
    id_personagem INT REFERENCES personagem(id) ON DELETE CASCADE,
    id_tipo_habilidade INT REFERENCES tipo_habilidade(id),
    nome VARCHAR(100) NOT NULL,
    atributo_ligado INT REFERENCES tipo_atributo(id),
    bonus INT,
    id_efeito INT REFERENCES tipo_efeito(id),
    custo INT,
    descricao TEXT
);

CREATE TABLE item (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50),
    preco INT NOT NULL,
    descricao TEXT
);

CREATE TABLE inventario (
    id SERIAL PRIMARY KEY,
    id_personagem INT REFERENCES personagem(id) ON DELETE CASCADE,
    id_item INT REFERENCES item(id),
    quantidade INT NOT NULL
);
