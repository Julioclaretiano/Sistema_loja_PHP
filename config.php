<?php
// Configuração do banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$db = "loja";

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}
session_start();
?>