<?php

namespace API_Pizzaria\Models;

class Bebida{
//Propriedade do objeto Bebida

public $id;
public $nome;
public $qtd;
public $valor;
private $db;
private $tabela = "bebidas";

//Método construtor

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