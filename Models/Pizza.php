<?php
 
namespace API_Pizzaria\Models; //definindo o namespace para organizar o código e evitar conflitos de nomes
use PDO; // Importando a classe PDO para manipulação de banco de dados
use Exception; // Importando a classe Exception para tratamento de erros
 
class Pizza{
    public $id;
 
    public $nome;
 
    public $ingredientes;
 
    public $valor;
 
    private $db;
 
    private $tabela = "pizzas";
   
    //METODO CONSTRUTOR PARA RECEBER A CONEXAO COM O BANCO DE DADOS
 
    public function __construct($db){
        $this->db = $db;
    }
   
    public function getall(){   //VAI NO BANCO DE DADOS E TRAZ TODAS AS PIZZAS CADASTRADAS
        $query = "SELECT * FROM " . $this->tabela;
 
        $stmt = $this->db->prepare($query); //preparando a query para ser executada, evitando SQL Injection
 
        $stmt->execute();  //stmt é o objeto que contém o resultado da consulta, e execute() executa a consulta preparada
 
        return $stmt;
    }
 
    public function get(){  // VAI NO BANCO DE DADOS E TRAZ APENAS A PIZZA COM O ID ESPECIFICADO
    // Cria a consulta
        $query = 'SELECT
                p.idPizza,
                p.nome,
                p.ingredientes,
                p.valor
            FROM
                ' . $this->tabela . ' p
            WHERE
                p.idPizza = ?    
            LIMIT 1';
 
        // Prepara a query
        $stmt = $this->db->prepare($query);
 
        // Vincula o ID
        $stmt->bindParam(1, $this->id);
       
        // Executa a query
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // Define as propriedades
        $this->nome = $row['nome'];
        $this->ingredientes = $row['ingredientes'];
        $this->valor = $row['valor'];
 
    }
   
}
 