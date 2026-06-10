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
  public function add()
    {
        $query = 'INSERT INTO ' . $this->tabela . ' (nome, qtd, valor, categoria) ' .
            ' VALUES (:nome, :qtd, :valor, :categoria)';

        // Preparar a query
        $stmt = $this->db->prepare($query);

        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':qtd', $this->qtd);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':categoria', $this->categoria);

        // Executar a query
        if ($stmt->execute()) {
            return true;
        }
        return false;

    }
       public function update(){

     // Query de atualização
            $query = 'UPDATE ' . $this->tabela. ' SET nome=:nome, qtd=:qtd, valor=:valor, categoria=:categoria WHERE idBebida=:id';
   
            // Preparar a query
            $stmt = $this->db->prepare($query);
                 
            // Vincular os parâmetros
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':qtd', $this->qtd);
            $stmt->bindParam(':valor', $this->valor);
            $stmt->bindParam(':categoria', $this->categoria);
            $stmt->bindParam(':id', $this->id);
   
            // Executar a query
            if($stmt->execute()) {
                return true;
            }
         
            return false;

    }
}