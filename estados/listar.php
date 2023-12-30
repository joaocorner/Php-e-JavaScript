<?php
$tabela = 'estados';
require_once("../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if ($linhas > 0) {
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


    for ($i = 0; $i < $linhas; $i++) {
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
    <a href="#" onclick="editar('{$id}', '{$nome}')"><i class="bi bi-pencil text-primary"></i></a>	
    <a href="#" onclick="excluir('{$id}')"><i class="bi bi-trash3 text-danger"></i></a>	
</td>
</tr>
HTML;
    }


    echo <<<HTML
</tbody>
</table>
HTML;
} else {
    echo '<small>Nenhum Registro Encontrado!</small>';
}

?>

<script>
    function excluir(id) {
        $.ajax({
            // concatenando a variavel pag com o caminho do arquivo listar.php
            url: pag + "/excluir.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "html",

            success: function(result) {
                if (result.trim() == 'Excluido com sucesso!') {
                    listar();
                } else {
                    $('#mensagem').addClass('text-danger')
                    $('#mensagem').text("Erro ao excluir:" + mensagem)
                }
            }
        });
    }

    function editar(id, nome) {
        // utiliza-se o .val em vez do .text, pois o .text é para texto em divs e spams, e o .val é para inputs
        $('#nome').val(nome);
        $('#id').val(id);
        $('#btn_salvar').text('Editar');
        $('#btn_salvar').removeClass('btn-success');
        $('#btn_salvar').addClass('btn-primary');
        console.log(id);
        console.log(nome);
    }
</script>