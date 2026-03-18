create database mcdonalds;

use mcdonalds;

create table tarefas(
	id INT auto_increment primary key,
    titulo varchar(255) not null,
    status ENUM('pendente', 'concluida') default 'pendente'
);

CREATE TABLE ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    categoria ENUM('pao', 'recheio', 'complemento'),
    preco DECIMAL(5,2),
    imagem VARCHAR(255)
);

INSERT INTO ingredientes (nome, categoria, preco, imagem) VALUES
('Pão Brioche', 'pao', 3.00, 'https://via.placeholder.com/150'),
('Pão Integral', 'pao', 2.50, 'https://via.placeholder.com/150'),

('Carne', 'recheio', 5.00, 'https://via.placeholder.com/150'),
('Frango', 'recheio', 4.50, 'https://via.placeholder.com/150'),

('Alface', 'complemento', 1.00, 'https://via.placeholder.com/150'),
('Queijo', 'complemento', 2.00, 'https://via.placeholder.com/150');