<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
 
include_once '../../Config/Database.php';
include_once '../../Models/Bebida.php';
 
use API_Pizzaria\Config\Database;
use API_Pizzaria\Models\Bebida;
 
// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Bebida
$bebida = new Bebida($db);
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obter os dados postados
        $data = json_decode(file_get_contents("php://input"));
 
        // Verificar se os dados não estão vazios
        if (
            !empty($data->nome) &&
            !empty($data->qtd) &&
            !empty($data->valor) &&
            !empty($data->categoria)
        ) {
            // Atribuir os valores ao objeto Bebida
            $bebida->nome = $data->nome;
            $bebida->qtd = $data->qtd;
            $bebida->valor = $data->valor;
            $bebida->categoria = $data->categoria;
 
            // Criar a bebida
            if ($bebida->add()) {
                http_response_code(201);
                // Resposta de sucesso
                echo json_encode(
                    array('Mensagem' => 'Bebida Criada com Sucesso')
                );
            } else {
                http_response_code(400);
                // Resposta de erro
                echo json_encode(
                    array('Erro' => 'Nao foi possivel criar a Bebida')
                );
            }
        } else {
            http_response_code(400);
            // Resposta se dados estiverem incompletos
            echo json_encode(
                array('Erro' => 'Dados Incompletos. Nao foi possivel criar a Bebida.')
            );
        }
    } catch (Exception $e) {
        echo json_encode(array("Erro" => $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("Erro" => "Método não suportado!"));
}
?>