<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";  // senha do MySQL
$dbname = "ReciclaMais";  // nome do banco de dados

// Criando a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo os dados enviados via POST de maneira segura
$email_login = $_POST['emaillogin'];
$senha_login = $_POST['senhalogin'];

// Usando prepared statements para evitar injeção de SQL
$stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (?, ?)");

// Vinculando os parâmetros à consulta (s -> string)
$stmt->bind_param("ss", $email_login, $senha_login);

// Executando a consulta e verificando se houve sucesso
if ($stmt->execute()) {
    echo "<script> alert('Dados inseridos com sucesso!'); window.location.href='index.html';</script>";
} else {
    echo "<script> alert('Erro ao inserir dados: " . $stmt->error . "'); window.location.href='cadastro.html';</script>";
}

// Fechando a declaração e a conexão
$stmt->close();
$conn->close();
?>
