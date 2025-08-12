<?php
session_start();
include("../interface.php"); // arquivo de cabeçalho de página
include("../conexao.php"); // arquivo de conexão com o banco de dados
$_SESSION['newsession'] = True;
$_SESSION['controle'] = 'S';
// sql para buscar os dados de todos os solicitantes
$sql = "SELECT * FROM solicitantes ORDER BY solicitantes.nome ASC";
$result = $conection->query($sql);

?>

<!-- front end HTML -->
<!DOCTYPE html>
<html lang="en">
<!-- script para chamar exclusão -->
<script language="Javascript">
    function confirmacao(id) {
        var resposta = confirm("Deseja remover esse registro?");
        if (resposta == true) {
            window.location.href = "/mudas/cadastros/cadastro_excluir.php?id=" + id;
        }
    }
</script>
<!-- script para formatação da tabela -->
<script>
    $(document).ready(function() {
        $('.tablista').DataTable({
            // 
            "iDisplayLength": -1,
            "order": [1, 'asc'],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [4]
            }, {
                'aTargets': [0],
                "visible": true
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

<!--  front end da aplicação -->

<body>
    <div class="container -my5">
        <div style="padding-top:5px">
            <h3 align="center">Lista de Solicitantes Cadastrados</h3>
            <div class="panel">
                <div class="panel-heading">
                    <a class='btn btn btn-sm' class="btn btn-primary" href='\mudas\cadastros\gera_xls.php'><img src='\parque\imagens\excell.png' alt='' width='25' height='25'> Gerar Planilha</a>
                    <a class="btn btn btn-sm" href="\mudas\cadastros\menu.php"><img src="\mudas\imagens\saida.png" alt="" width="25" height="25"> Voltar</a>
                    
                </div>
            </div>
        </div>

        <div style="padding-top:15px;padding-left:20px;">
            <table class="table table display table-active tablista">
                <thead class="thead">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">CPF</th>
                        <th scope="col">e-mail</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica se há registros
                    if ($result->num_rows == 0) {
                        echo "<tr><td colspan='10' class='text-center'>Nenhum registro encontrado.</td></tr>";
                        exit;
                    }

                    // insiro os registro do banco de dados na tabela 
                    while ($c_linha = $result->fetch_assoc()) {

                        echo "
                                <tr>
                                    <td>$c_linha[nome]</td>
                                    <td>$c_linha[telefone]</td>
                                    <td>$c_linha[cpf]</td>
                                    <td>$c_linha[email]</td>
                                    <td>
                                    
                                    <a class='btn' href='/mudas/cadastros/cadastro_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-edit'></span></a>
                                     &nbsp;&nbsp;   
                                    <a class='btn' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                                       
                                    </td>

                                </tr>
                                ";
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>

</body>

</html>