CREATE DATABASE IF NOT EXISTS sr_waterfalls
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_unicode_ci;

USE sr_waterfalls;

CREATE TABLE perguntas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('multipla', 'texto') NOT NULL DEFAULT 'multipla',
    pergunta TEXT NOT NULL,
    opcao_a VARCHAR(255) NULL,
    opcao_b VARCHAR(255) NULL,
    opcao_c VARCHAR(255) NULL,
    opcao_d VARCHAR(255) NULL,
    opcao_e VARCHAR(255) NULL,
    resposta TEXT NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL
);
