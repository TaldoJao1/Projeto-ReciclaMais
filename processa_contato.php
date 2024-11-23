<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "usbw";    $dbname = "ReciclaMais";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo os dados enviados via POST
$nome_pessoa_contato = $_POST['nomepessoacont'];
$email_contato = $_POST['emailcont'];
$mensagem_contato = $_POST['mensagemcont'];

// Usando uma consulta preparada para evitar injeção de SQL
$stmt = $conn->prepare("INSERT INTO Contato (nome_pessoa_contato, email_contato, mensagem_contato) VALUES (?, ?, ?)");

// Vinculando os parâmetros à consulta (s -> string)
$stmt->bind_param("sss", $nome_pessoa_contato, $email_contato, $mensagem_contato);

// Executando a consulta
if ($stmt->execute()) {
    echo "<script> alert('Dados inseridos com sucesso!'); window.location.href='contato.html';</script>";
} else {
echo "<script> alert('Erro!'); window.location.href='contato.html';</script>" . $stmt->error;
}

// Fechando a declaração e a conexão
$stmt->close();
$conn->close();
?>