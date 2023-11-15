<?php
// Este script deleta uma nota do banco de dados MySQL

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

// Obtém o ID da nota do corpo da solicitação
$noteId = isset($_POST["noteId"]) ? $_POST["noteId"] : '';

// Deleta a nota do banco de dados
$sql = "DELETE FROM notas WHERE id = $noteId";
$conn->query($sql);

$conn->close();
?>
