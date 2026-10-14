<?php
include "conexao.php";

$id = $_GET["id"];

$sql = "DELETE FROM clientes WHERE id=$id";
$conexao->query($sql);
$conexao->close();

echo "<script>alert('Cliente excluído!'); window.location.href='listar_clientes.php';</script>";
?>