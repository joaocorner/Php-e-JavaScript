<?php
require_once('../conexao.php');

$id = $_POST['id'];

$pdo->query("DELETE FROM cidades WHERE id = '$id'");


echo 'Excluido com sucesso!';
?>