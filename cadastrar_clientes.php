<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $cidade = $_POST["cidade"];

    $sql = "INSERT INTO clientes (nome, cpf, telefone, email, endereco, cidade)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $cpf, $telefone, $email, $endereco, $cidade);

    if ($stmt->execute()) {
        echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='clientes.html';</script>";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }

    $stmt->close();
    $conexao->close();
}
?>