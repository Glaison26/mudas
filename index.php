<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>PMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    </script>
</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>PMS - Prefeitura Municipal de Sabará</h4>
            <h5>Secretaria Municipal de Meio Ambiente<h5>
        </div>
    </div>

    <div class="container -my5">
       

        <div class="panel default class" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
            <div class="panel-heading">
                <img class="rounded mx-auto d-block" class="img-responsive" src="\mudas\imagens\prefeitura.png" class="img-fluid" style="height :100px" style="width:110px">
            </div>
        </div>
        <nav class="navbar ">
            <div class="container-fluid" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                <br>
                <a id="solicitante" class="btn btn-success" href="/mudas/solicitantes/entracpf_cadastro.php"><span class="glyphicon glyphicon-edit"></span> Cadastro de Solicitantes</a>
                <a id="agendamento" class="btn btn-primary" href="/mudas/entracpf_agenda.php"><span class="glyphicon glyphicon-calendar"></span> Agendamento para Retirada de Mudas</a>
                
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