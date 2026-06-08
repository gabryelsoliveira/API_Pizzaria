<?php
use API_Pizzaria\Models\Bebida;
use API_Pizzaria\Config\Database;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../Config/Database.php';
include_once '../../Models/Bebida.php';
 
$database = new Database();
$db = $database->getConnection();
 
$bebida = new Bebida($db);

$query = "SELECT * FROM bebidas where categoria = 'Não alcoólica'";
$stmt = $db->prepare($query);
$stmt->execute();

$bebida = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($bebida);