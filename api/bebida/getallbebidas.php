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

try {
    $stmt = $bebida->getall();
    $num = $stmt->rowCount();

    if ($num > 0) {
        $bebidas_arr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $bebida_item = array(
                "id" => $idBebida,
                "nome" => $nome,
                "qtd" => $qtd,
                "valor" => $valor,
                "categoria" => $categoria,
            );
            array_push($bebidas_arr, $bebida_item);
        }

        http_response_code(200);

        echo json_encode($bebidas_arr);

    } else {
        http_response_code(404);

        echo json_encode(
            array("Mensagem" => "Nenhuma bebida encontrada.")
        );
    }

} catch (PDOException $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}
catch (Throwable $e) {
    echo json_encode(array("erro" => $e->getMessage()));
}