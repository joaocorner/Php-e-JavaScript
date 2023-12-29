<?php 
$tabela = 'estados';
require_once("../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table">
	<thead> 
	<tr>
	<th>Id</th>	
	<th>Nome</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];

		
echo <<<HTML
<tr>
<td>
{$id}
</td>
<td>
{$nome}
</td>

<td>	
</td>
</tr>
HTML;

}


echo <<<HTML
</tbody>
</table>
HTML;

}else{
	echo '<small>Nenhum Registro Encontrado!</small>';
}

?>

