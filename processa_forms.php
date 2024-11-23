<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "ReciclaMais";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo os dados enviados via POST de maneira segura
$nome_estabelecimento = $_POST['nome_estabelecimento'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$cidade = $_POST['cidade'];
$referencia = $_POST['referencia'];
$nomepessoa = $_POST['nomepessoa'];
$email = $_POST['email'];

// Usando prepared statements para evitar injeção de SQL
$stmt = $conn->prepare("INSERT INTO estabelecimentos (nome_estabelecimento, endereco, complemento, cidade, referencia, nomepessoa, email) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Vinculando os parâmetros à consulta (s -> string)
$stmt->bind_param("sssssss", $nome_estabelecimento, $endereco, $complemento, $cidade, $referencia, $nomepessoa, $email);

// Executando a consulta e verificando se houve sucesso
if ($stmt->execute()) {
    echo "<script> alert('Dados inseridos com sucesso!'); window.location.href='forms.html';</script>";
} else {
    echo "<script> alert('Erro!'); window.location.href='forms.html';</script>" . $stmt->error;
}

// Fechando a declaração e a conexão
$stmt->close();
$conn->close();
?>