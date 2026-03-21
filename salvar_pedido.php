<?php
require_once 'config.php';
require_once 'autoload.php';

use App\Database\Connection;

$data = json_decode(file_get_contents("php://input"), true);

$nome = $data['nome'];
$total = $data['total'];

$sql = "INSERT INTO pedidos (nome_cliente, total) VALUES (?, ?)";
$stmt = Connection::getConn()->prepare($sql);
$stmt->execute([$nome, $total]);

$id = Connection::getConn()->lastInsertId();

echo json_encode(["id" => $id]);