<?php

namespace API_Pizzaria\Models;
use PDO;
use Throwable;

class Bebida{

public $id;
public $nome;
public $qtd;
public $valor;
public $categoria;
private $db;
private $tabela = "bebidas";

public function __construct($db){
    $this->db = $db;
}

public function getall(){
    $query = "SELECT idBebida, nome, qtd, valor, categoria FROM " . $this->tabela;

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
}

public function get(){

        $query = 'SELECT
                p.idBebida,
                p.nome,
                p.qtd,
                p.valor,
                p.categoria
            FROM
                ' . $this->tabela . ' p
            WHERE
                p.idBebida = ?    
            LIMIT 1';
 
        $stmt = $this->db->prepare($query);
 
        $stmt->bindParam(1, $this->id);
       
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        $this->nome = $row['nome'];
        $this->qtd = $row['qtd'];
        $this->valor = $row['valor'];
        $this->categoria = $row['categoria'];
}

} 