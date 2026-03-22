create database mcdonalds;

use mcdonalds;

create table pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100),
    total DECIMAL(10,2),
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    categoria ENUM('pao', 'recheio', 'complemento'),
    preco DECIMAL(5,2),
    imagem VARCHAR(255)
);

INSERT INTO ingredientes (nome, categoria, preco, imagem) VALUES

-- PÃES 🍞
('Pão Brioche', 2.50, 'pao', '../assets/paes/brioche.png'),
('Pão Integral', 3.00, 'pao', '../assets/paes/integral.jpg');

-- RECHEIOS 🍖
('Carne', 'recheio', 5.00, '../assets/recheios/carne.jpg'),
('Bacon', 'recheio', 3.00, '../assets/recheios/bacon.png'),
('Chicken Crispy', 'recheio', 6.00, '../assets/recheios/chicken-crispy.jpg'),
('Peixe Empanado', 'recheio', 5.50, '../assets/recheios/peixe.jpg'),

-- COMPLEMENTOS 🥬
('Tomate', 'complemento', 1.50, '../assets/complementos/tomate.avif'),
('Cebola Roxa', 'complemento', 1.20, '../assets/complementos/cebola-roxa.jpg'),
('Picles', 'complemento', 1.00, '../assets/complementos/picles.jpg'),
('Molho Especial', 'complemento', 2.00, '../assets/complementos/molho-especial.jpg'),
('Maionese', 'complemento', 1.50, '../assets/complementos/maionese.jpg'),
('Ketchup', 'complemento', 1.00, '../assets/complementos/ketchup.avif'),
('Mostarda', 'complemento', 1.00, '../assets/complementos/mostarda.jpeg'),

-- BEBIDAS 🍹
('Coca-Cola', 'bebida', 5.00, '../assets/bebidas/coca-cola.avif'),
('Coca Zero', 'bebida', 5.00, '../assets/bebidas/coca-zero.avif'),
('Guaraná', 'bebida', 4.50, '../assets/bebidas/guarana.jpg'),
('Fanta Laranja', 'bebida', 4.50, '../assets/bebidas/fanta.jpg'),
('Água', 'bebida', 3.00, '../assets/bebidas/água.png');