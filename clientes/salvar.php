<?php
require_once('../conexao.php');

$nome = $_POST['nome'];
$id = $_POST['id'];
$telefone = $_POST['telefone'];
$pessoa = $_POST['pessoa'];
$cpf = $_POST['cpf'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

if ($id == '') {
    $query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, telefone = :telefone, pessoa = :pessoa, cpf = :cpf, cidade = :cidade, estado = :estado");
} else {
    $query = $pdo->prepare("UPDATE clientes SET nome = :nome, telefone = :telefone, pessoa = :pessoa, cpf = :cpf, cidade = :cidade, estado = :estado WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":pessoa", "$pessoa");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":cidade", "$cidade");
$query->bindValue(":estado", "$estado");
$query->execute();

echo 'Salvo com Sucesso';
?>