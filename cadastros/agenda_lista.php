<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../conexao.php");
include("../interface.php");
include_once "../lib_gop.php";
$c_sql = $_SESSION['sql'];

?>
<!doctype html>
<html lang="en">

<body>

    <script>
        $(document).ready(function() {
            $('.tabfuncionarios').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [5]
                }, {
                    'aTargets': [0],
                    "visible": false
                }],
                "oLanguage": {
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sInfoFiltered": " - filtrado de _MAX_ registros",
                    "oPaginate": {
                        "spagingType": "full_number",
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",

                        "sLast": "Último"
                    },
                    "sSearch": "Pesquisar",
                    "sLengthMenu": 'Mostrar <select>' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> Registros'

                }

            });

        });
    </script>

    <br>
    <div class="container -my5">

        <div style="padding-top:5px">
            <h3 align="center">Agenda de Retiradas do Período</h3>
            <div class="panel">
                <div class="panel-heading">

                    <a class="btn btn btn-sm" href="\mudas\cadastros\menu.php"><img src="\mudas\imagens\saida.png" alt="" width="25" height="25"> Voltar</a>
                </div>
            </div>
        </div>

        <hr>
        <table class="table table display table-active tabfuncionarios">
            <thead class="thead">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Data</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Nome Solicitante</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Quantidade de Mudas</th>

                </tr>
            </thead>
            <tbody>
                <?php

                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    $c_data = date("d-m-Y", strtotime(str_replace('/', '-', $c_linha['data'])));
                    echo "
                    <tr class='info'>
                    <td>$c_linha[id]</td>
                    <td>$c_data</td>
                    <td>$c_linha[hora]</td>
                    <td>$c_linha[nome]</td>
                    <td>$c_linha[telefone]</td>
                    <td>$c_linha[numero_mudas]</td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>