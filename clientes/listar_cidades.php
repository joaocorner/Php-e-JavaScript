<?php
require_once('../conexao.php');
$estado = $_POST['estado'];
echo '<select type="text" class="form-select" id="cidade" name="cidade">';
$query = $pdo->query("SELECT * FROM cidades WHERE estado = '$estado' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
for ($i = 0; $i < $linhas; $i++) {
    echo '<option value="' . $res[$i]['nome'] . '">' . $res[$i]['nome'] . '</option>';
}
echo '</select>';
?>
