<?php
require_once('../conexao.php');
$tel = $_POST['tel'];
$query = $pdo->query("SELECT * FROM clientes WHERE telefone LIKE '%$tel%'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {

    for ($i = 0; $i < $linhas; $i++) {
        $id = $res[$i]['id'];
        $nome = $res[$i]['nome'];
        $telefone = $res[$i]['telefone'];
        $pessoa = $res[$i]['pessoa'];
        $cpf = $res[$i]['cpf'];
        $cidade = $res[$i]['cidade'];
        $estado = $res[$i]['estado'];

        echo $id . '*' . $nome . '*' . $telefone . '*' . $pessoa . '*' . $cpf . '*' . $cidade . '*' . $estado;
    }
} else {
    echo '';
};
