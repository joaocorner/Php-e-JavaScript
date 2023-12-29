<?php
require_once('cabecalho.php');
?>

<div class="container" style="background: #f5f2f2; padding: 10px">
    <div class="row">
        <div class="col-md-2">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Sigla">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary">Salvar</button>
        </div>
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