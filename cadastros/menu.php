<?php
session_start();
include("../interface.php"); // arquivo de cabeçalho de página
$_SESSION['newsession'] = True;
$_SESSION['controle']='S';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body>
    

    <div class="container -my5">


        <div class="panel default class" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
            <div class="panel-heading">
                <img class="rounded mx-auto d-block" class="img-responsive" src="\mudas\imagens\prefeitura.png" class="img-fluid" style="height :100px" style="width:110px">
            </div>
        </div>
        <br>
        
        <nav class="navbar ">
            <div class="container-fluid" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                <br>
                <a id="solicitante" class="btn btn-success" href="/mudas/cadastros/consulta_cadastro.php"><span class="glyphicon glyphicon-edit"></span> Cadastro de Solicitantes</a>
                <a id="agendamento" class="btn btn-primary" href="/mudas/cadastros/consulta_agenda.php"><span class="glyphicon glyphicon-calendar"></span> Consultar agenda de Retirada de Mudas</a>

            </div>
        </nav>

        <hr>
        <div class="container">
            <div class="alert alert-info">
                <strong>Para acessar o sistema, clique na opção desejada acima.</strong>
            </div>
        </div>
    </div>

</body>

</html>