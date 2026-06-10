<?php
  
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../Config/Database.php';
include_once '../../Models/Bebida.php';
 
use API_Pizzaria\Config\Database; 
use API_Pizzaria\Models\Bebida; 
 
$database = new Database();
$db = $database->getConnection();
 
$bebida = new Bebida($db);
 
$bebida->id = isset($_GET['id']) ? $_GET['id'] : null;
 
try {
 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {  
 
        if ($bebida->id) {
 
            $bebida->get();
 
            if ($bebida->nome != null) {
 
               
            $bebida_arr = array(
                "id" => $bebida->id,
                "nome" => $bebida->nome,
                "valor" => $bebida->valor,
                "qtd" => $bebida->qtd,
                "categoria" => $bebida->categoria
            );
 
            http_response_code(200);  
            echo json_encode($bebida_arr, JSON_PRETTY_PRINT);
           
            } else {
 
                http_response_code(404); 
                echo json_encode(
                    array("Mensagem" => "Bebida não encontrada.")
                );
            }
 
        } else {
 
            http_response_code(400); 
            echo json_encode(
                array("Mensagem" => "ID não informado.")
            );
        }
 
    } else {
 
        http_response_code(405); 
        echo json_encode(
            array("Mensagem" => "Método não permitido.")
        );
    }
 
   
 
} catch (PDOException $e) { 
 
    http_response_code(500); 
    echo json_encode(
        array("Mensagem" => "Erro ao buscar a bebida: " . $e->getMessage())
    );
 
} catch (Throwable $e) {
 
    http_response_code(500);
    echo json_encode(
        array("Mensagem" => "Erro inesperado: " . $e->getMessage())
    );
}
 