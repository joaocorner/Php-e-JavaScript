<?php
require_once('cabecalho.php');
?>

<div class="container" style="background: #f5f2f2; padding: 10px">
    <div class="row">
        <form id="form">
            <div class="col-md-2">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Sigla">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    <div id="listar">
        <table class="table" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Rio de Janeiro</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Script ajax para inserção de dados, isso é, não vai ter refresh na página -->
<script type="text/javascript">
    // o $ com o nome do componente significa que está tentando via jquery e não javascript chamar e dar referencia a um objeto que tenha esse id
    $("#form").submit(function() {

        // o preventDefault() é para não dar refresh na página
        event.preventDefault();
        // formData é um objeto que vai pegar todos os dados do formulário
        var formData = new FormData(this);

        // esse ajax pega os dados (formData) e envia para o caminho da url (estados.php) via post
        $.ajax({
            url: 'estados/salvar.php',
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem').text('');
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {

                    $('#btn-fechar').click();
                    listar();

                } else {

                    $('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }


            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>