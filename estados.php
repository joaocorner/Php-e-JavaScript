<?php
require_once('cabecalho.php');
$pag = "estados";
?>

<div class="container" style="background: #f5f2f2; padding: 10px">
    <form id="form">
        <div class="row">
            <div class="col-md-2">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Sigla" required>
            </div>
            <div class="col-md-2">
                <button type="submit" id="btn_salvar" class="btn btn-success">Salvar</button>
            </div>
            <div class="col-md-8">
                <div id="mensagem"></div>
            </div>
            <input type="hidden" name="id" id="id">
        </div>
    </form>
    <div id="listar" style="margin-top: 20px;">

    </div>
</div>

<!-- criando variavel do javascript para pegar a variavel $pag do php -->
<script type="text/javascript">
    var pag = "<?= $pag ?>"

    // esse método é para quando a página carregar, já listar os dados
    $(document).ready(function() {
        listar();
        limparCampos();
    });


    // Script ajax para inserção de dados, isso é, não vai ter refresh na página
    // o $ com o nome do componente significa que está tentando via jquery e não javascript chamar e dar referencia a um objeto que tenha esse id
    $("#form").submit(function() {

        // o preventDefault() é para não dar refresh na página
        event.preventDefault();
        // formData é um objeto que vai pegar todos os dados do formulário
        var formData = new FormData(this);

        $('#btn_salvar').hide()
        $('#mensagem').text('Salvando...')

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
                    limparCampos();

                } else {

                    $('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }

                $('#btn_salvar').show()


            },


            cache: false,
            contentType: false,
            processData: false,

        });

    });


    // Script ajax para listar os dados, isso é, não vai ter refresh na página

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

    function limparCampos() {
        // o $ com o nome do componente significa que está tentando via jquery e não javascript chamar e dar referencia a um objeto que tenha esse id, e o .val('') é para limpar esse campo
        $('#nome').val('');
        $('#id').val('');
        $('#btn_salvar').text('Salvar');
        $('#btn_salvar').addClass('btn-success');
    }
</script>