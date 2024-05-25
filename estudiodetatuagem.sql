CREATE DATABASE IF NOT EXISTS estudio_tatuagem;
USE estudio_tatuagem;

-- Tabela de Clientes
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Tabela de Artistas
CREATE TABLE IF NOT EXISTS artistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL,
    portfolio TEXT
);

-- Tabela de Sessões
CREATE TABLE IF NOT EXISTS sessoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    data DATE NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- Tabela de Desenhos
CREATE TABLE IF NOT EXISTS desenhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sessao_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    FOREIGN KEY (sessao_id) REFERENCES sessoes(id)
);
