<?php
require_once('../conexao.php');

$id = $_POST['id'];

$pdo->query("DELETE FROM clientes WHERE id = '$id'");


echo 'Excluido com sucesso!';
?>