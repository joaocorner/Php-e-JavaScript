<?php
require_once('cabecalho.php');
$pag = "clientes";
?>

<div class="container-fluid" style="background: #f5f2f2; padding: 10px">
    <form id="form">
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
            </div>

            <div class="col-md-2">
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
            </div>

            <div class="col-md-1" style="padding: 0px;">
                <select class="form-select" id="pessoa" name="pessoa" onchange="mudarPessoa()">
                    <option value="Física">Física</option>
                    <option value="Jurídica">Jurídica</option>
                </select>
            </div>

            <div class="col-md-2" style="padding: 0px; padding-left: 2px">
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
            </div>

            <div class="col-md-1">
                <select type="text" class="form-select" id="estado" name="estado" onchange="mudarEstado()">
                    <?php
                    $query = $pdo->query("SELECT * from estados order by id desc");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $linhas = @count($res);
                    for ($i = 0; $i < $linhas; $i++) {
                        echo '<option value="' . $res[$i]['nome'] . '">' . $res[$i]['nome'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-2" id="listar_cidades">

            </div>

            <div class="col-md-1">
                <button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>
            </div>

            <input type="hidden" name="id" id="id">
        </div>
        <div class="col-md-12" align="center" style="margin-top: 20px;">
            <small>
                <div id="mensagem"></div>
            </small>
        </div>
    </form>
    <div id="listar" style="margin-top: 20px;"></div>

    <div class="row">
        <div class="col-md-2" style="">
            <input type="text" class="form-control" id="telefone_busca" placeholder="Telefone" required onkeyup="buscarDados()">
        </div>
        <div class="col-md-1">
            <button class="btn btn-primary">
                <!-- poderia passar onclick="buscarDados()" para ativar ao clicar nesse botão ao invés de buscar ao ir preenchendo -->
                <i class="bi bi-search"></i>
            </button>
        </div>
        <div class="col-md-9">
            <span style="margin-right: 10px;"><b>Cliente: </b><span id="nome_cliente"></span></span>
            <span style="margin-right: 10px;"><b>Cidade: </b><span id="cidade_cliente"></span></span>
        </div>
    </div>

</div>

<script type="text/javascript">
    var pag = "<?= $pag ?>"

    $(document).ready(function() {
        listar();
        limparCampos();
        mudarEstado();

        // nesse caso, o setInterval é para ficar realizando a função listar a cada 3 segundos, útil para quando tiver mais de um usuário cadastrando ao mesmo tempo por exemplo e um deles cadastrar, o outro já vai ver a alteração
        setInterval(listar, 3000);
    });


    $("#form").submit(function() {

        event.preventDefault();
        var formData = new FormData(this);

        $('#btn_salvar').hide()
        $('#mensagem').text('Salvando...')

        $.ajax({
            url: pag + "/salvar.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem').text('');
                $('#mensagem').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso") {

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

    function listar(p1, p2, p3, p4, p5, p6) {
        // console.log('listar foi chamado');
        $.ajax({
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
        $('#nome').val('');
        $('#id').val('');
        $('#telefone').val('');
        $('#pessoa').val('Física');
        $('#cpf').val('');
        $('#btn_salvar').text('Salvar');
        $('#btn_salvar').addClass('btn-success');
    }

    function mudarPessoa() {
        var pessoa = $('#pessoa').val();
        console.log(pessoa);
        if (pessoa == 'Física') {
            $('#cpf').attr('placeholder', 'CPF');
            $('#cpf').mask('000.000.000-00');
        } else {
            $('#cpf').attr('placeholder', 'CNPJ');
            $('#cpf').mask('00.000.000/0000-00');
        }
    }

    function mudarEstado() {
        var estado = $('#estado').val();
        console.log(estado);
        $.ajax({
            url: pag + "/listar_cidades.php",
            method: 'POST',
            data: {
                estado
            },
            dataType: "html",

            success: function(result) {
                $("#listar_cidades").html(result);
            }
        });
    }

    function buscarDados() {
        var tel = $('#telefone_busca').val();
        console.log(cpf);
        $.ajax({
            url: pag + "/listar_dados.php",
            method: 'POST',
            data: {
                tel
            },
            dataType: "html",

            success: function(result) {
                var separar = result.split('*');
                if (separar[0] == '') {
                    limparCampos();
                } else {
                    console.log(separar[0]);
                    $("#id").val(separar[0]);
                    $("#nome").val(separar[1]);
                    $("#telefone").val(separar[2]);
                    $("#pessoa").val(separar[3]).change();
                    $("#cpf").val(separar[4]);
                    $("#estado").val(separar[6]).change();
                    $("#nome_cliente").text(separar[1]);
                    $('#cidade_cliente').text(separar[5]).change();


                    setTimeout(function() {
                        $('#cidade').val(separar[5]).change();
                    }, 400);
                }
            }
        });
    }
</script>