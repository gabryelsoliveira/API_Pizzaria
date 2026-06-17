<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../Config/Database.php';
include_once '../../Models/Pizza.php';

use API_PIZZARIA\Config\Database;
use API_PIZZARIA\Models\Pizza;

// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();

// Instanciar o objeto Pizza
$pizza = new Pizza($db);

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Obter os dados postados
        $data = json_decode(file_get_contents("php://input"));

        // Verificar se os dados não estão vazios e se o ID foi fornecido
        if (
            !empty($data->id)
        ) {
            // Atribuir o ID para exclusão
            $pizza->id = $data->id; //é o que vem pelo json
            $pizza->get();


            // Tentar excluir a pizza
            if ($pizza->delete() && $pizza->nome) {
                http_response_code(200);
                echo json_encode(
                    array('Mensagem' => 'Pizza Excluída com Sucesso')
                );
            } else {
                http_response_code(404);
                echo json_encode(
                    array('Mensagem' => 'Pizza Não Encontrada ou Não Foi Possível Excluir')
                );
            }
        } else {
            http_response_code(400);
            echo json_encode(
                array('Mensagem' => 'Dados Incompletos. Não foi possível excluir a Pizza.')
            );
        }

    } catch (Exception $e) {
        echo json_encode(array("erro" => $e->getMessage()));
    }
} else {
    http_response_code(400);
    echo json_encode(array("erro" => "Método não suportado!"));
}