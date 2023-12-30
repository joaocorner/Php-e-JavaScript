<?php
require_once('../conexao.php');

$nome = $_POST['nome'];
$id = $_POST['id'];

if ($id == '') {
    $query = $pdo->prepare("INSERT INTO estados SET nome = :nome");
} else {
    $query = $pdo->prepare("UPDATE estados SET nome = :nome WHERE id = '$id'");
}

$query->bindValue(':nome', $nome);
$query->execute();

echo 'Salvo com Sucesso';
?>