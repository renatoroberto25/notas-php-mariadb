<?php
// Este script retorna as notas do banco de dados MySQL em formato JSON

// Configurações do banco de dados
$servername = "SEU_IP_BANCO";
$username = "exemplo";
$password = "exemplo";
$dbname = "notas";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Seleciona todas as notas do banco de dados
$sql = "SELECT * FROM notas";
$result = $conn->query($sql);

// Cria um array para armazenar as notas
$notes = array();

// Adiciona cada nota ao array
while ($row = $result->fetch_assoc()) {
    $notes[] = $row;
}

// Converte o array de notas para JSON e retorna
echo json_encode($notes);

$conn->close();
?>
