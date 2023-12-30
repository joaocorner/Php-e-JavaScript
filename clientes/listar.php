<?php
$tabela = 'clientes';
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
	<th>Nome</th>
	<th>Telefone</th>
	<th>Pessoa</th>
	<th>CPF / CNPJ</th>
	<th>Cidade</th>
	<th>Estado</th>
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;


    for ($i = 0; $i < $linhas; $i++) {
        $id = $res[$i]['id'];
        $nome = $res[$i]['nome'];
        $telefone = $res[$i]['telefone'];
        $pessoa = $res[$i]['pessoa'];
        $cpf = $res[$i]['cpf'];
        $cidade = $res[$i]['cidade'];
        $estado = $res[$i]['estado'];


        echo <<<HTML
<tr>
<td>{$nome}</td>
<td>{$telefone}</td>
<td>{$pessoa}</td>
<td>{$cpf}</td>
<td>{$cidade}</td>
<td>{$estado}</td>

<td>
    <a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$pessoa}', '{$cpf}', '{$cidade}', '{$estado}')"><i class="bi bi-pencil text-primary"></i></a>	
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

    function editar(id, nome, telefone, pessoa, cpf, cidade, estado) {
        $('#nome').val(nome);
        $('#id').val(id);
        $('#telefone').val(telefone);
        $('#pessoa').val(pessoa).change();
        $('#cpf').val(cpf);
        $('#estado').val(estado).change();
        setTimeout(function() {
            $('#cidade').val(cidade).change();
            console.log("Código sendo executado após 1 segundos!")
        }, 400);

        // o .change() é para forçar a mudança do valor do select, isso é, o jquery vai mudar o valor do select e vai forçar a mudança do valor do select
        $('#estado').val(estado).change();
        $('#btn_salvar').text('Editar');
        $('#btn_salvar').removeClass('btn-success');
        $('#btn_salvar').addClass('btn-primary');
        console.log(id);
        console.log(nome);
    }
</script>