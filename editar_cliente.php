<?php
include "conexao.php";

// Se o formulario foi enviado (salvando a edicao)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $cidade = $_POST["cidade"];

    $sql = "UPDATE clientes SET nome=?, cpf=?, telefone=?, email=?, endereco=?, cidade=? WHERE id=?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssssssi", $nome, $cpf, $telefone, $email, $endereco, $cidade, $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Cliente atualizado!'); window.location.href='listar_clientes.php';</script>";
    exit;
}

// Se chegou aqui, e porque clicou em "Editar" na lista - precisa mostrar o formulario preenchido
$id = $_GET["id"];
$sql = "SELECT * FROM clientes WHERE id=$id";
$resultado = $conexao->query($sql);
$cliente = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editar Cliente - TechFix</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav class="nav">
		<img src="imagens/logo.png" class="nav-logo">
		<h1>TechFix Assistência Técnica</h1>
		<div class="nav-items">
			<button class="menu"><img src="imagens/menu.png"></button>
			<a href="index.html" class="nav-button">Início</a>
			<a href="clientes.html" class="nav-button">Clientes</a>
			<a href="orcamentos.html" class="nav-button">Orçamentos</a>
			<a href="contato.html" class="nav-button">Contato</a>
		</div>
	</nav>

	<h1 class="text">Editar Cliente</h1>

	<form class="formulario" action="editar_cliente.php" method="POST">
		<input type="hidden" name="id" value="<?php echo $cliente['id']; ?>">

		<label>Nome:</label>
		<input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required>

		<label>CPF:</label>
		<input type="text" name="cpf" value="<?php echo $cliente['cpf']; ?>" required>

		<label>Telefone:</label>
		<input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>

		<label>E-mail:</label>
		<input type="email" name="email" value="<?php echo $cliente['email']; ?>">

		<label>Endereço:</label>
		<input type="text" name="endereco" value="<?php echo $cliente['endereco']; ?>">

		<label>Cidade:</label>
		<input type="text" name="cidade" value="<?php echo $cliente['cidade']; ?>">

		<button type="submit">Salvar Alterações</button>
	</form>

	<footer class="footer">TechFix &copy; 2026</footer>
</body>
</html>