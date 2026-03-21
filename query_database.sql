create database mcdonalds;

use mcdonalds;

CREATE TABLE ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    categoria ENUM('pao', 'recheio', 'complemento'),
    preco DECIMAL(5,2),
    imagem VARCHAR(255)
);

INSERT INTO ingredientes (nome, categoria, preco, imagem) VALUES

-- RECHEIOS 🍖
('Hambúrguer 2x Carne', 'recheio', 7.50, 'https://via.placeholder.com/150'),
('Bacon', 'recheio', 3.00, 'https://via.placeholder.com/150'),
('Chicken Crispy', 'recheio', 6.00, 'https://via.placeholder.com/150'),
('Peixe Empanado', 'recheio', 5.50, 'https://via.placeholder.com/150'),

-- COMPLEMENTOS 🥬
('Tomate', 'complemento', 1.50, 'https://via.placeholder.com/150'),
('Cebola Roxa', 'complemento', 1.20, 'https://via.placeholder.com/150'),
('Picles', 'complemento', 1.00, 'https://via.placeholder.com/150'),
('Molho Especial', 'complemento', 2.00, 'https://via.placeholder.com/150'),
('Maionese', 'complemento', 1.50, 'https://via.placeholder.com/150'),
('Ketchup', 'complemento', 1.00, 'https://via.placeholder.com/150'),
('Mostarda', 'complemento', 1.00, 'https://via.placeholder.com/150');