<?php
require_once('cabecalho.php');
$pag = "estados";
?>

<div class="container" style="background: #f5f2f2; padding: 10px">
    <form id="form">
        <div class="row">
            <div class="col-md-2">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Sigla">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <div class="col-md-8">
                <div id="mensagem"></div>
            </div>
        </div>
    </form>
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

<!-- criando variavel do javascript para pegar a variavel $pag do php -->
<script type="text/javascript">
    var pag = "<?= $pag ?>"
</script>

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
            url: pag + "/salvar.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem').text('');
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {

                    // $('#mensagem').addClass('text-success');
                    // $('#mensagem').text(mensagem)
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

<!-- Script ajax para listar os dados -->
<script type="text/javascript">
    function listar(p1, p2, p3, p4, p5, p6) {
        $.ajax({
            // concatenando a variavel pag com o caminho do arquivo listar.php
            url: pag + "/listar.php",
            method: 'POST',
            data: {
                p1,
                p2,
                p3,
                p4,
                p5,
                p6
            },
            dataType: "html",

            success: function(result) {
                $("#listar").html(result);
            }
        });
    }
</script>