<?php
require_once('../conexao.php');

$nome = $_POST['nome'];

$query = $pdo->prepare("INSERT INTO estados SET nome = :nome");
$query->bindValue(':nome', $nome);
$query->execute();

echo 'Salvo com Sucesso';
