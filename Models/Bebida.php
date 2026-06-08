<?php

namespace API_Pizzaria\Models;

class Bebida{

public $id;
public $nome;
public $qtd;
public $valor;
private $db;
private $tabela = "bebidas";

public function __construct($db){
    $this->db = $db;
}

public function getall(){
    $query = "SELECT idBebida, nome, qtd, valor FROM " . $this->tabela;

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt;
}

}