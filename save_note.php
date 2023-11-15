<?php
// Este script salva a nota no banco de dados MySQL

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

// Obtém o conteúdo da nota do corpo da solicitação
$noteContent = isset($_POST["content"]) ? $_POST["content"] : '';

// Verifica se o conteúdo da nota não está vazio
if (!empty($noteContent)) {
    // Escapa caracteres especiais para evitar injeção de SQL
    $noteContent = $conn->real_escape_string($noteContent);

    // Insere a nota no banco de dados
    $sql = "INSERT INTO notas (content) VALUES ('$noteContent')";

    if ($conn->query($sql) === TRUE) {
        echo "Nota salva com sucesso!";
    } else {
        echo "Erro ao salvar nota: " . $conn->error;
    }
} else {
    echo "O conteúdo da nota está vazio!";
}

$conn->close();
?>
 
