<?php
session_start(); // icicio de session
include("..\interface.php");
$_SESSION['controle'] = 'N';
?>

<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    <br><br><br><br><br><br><br><br>
    <div class="container -my5">
        <div class="row mb-3">
            <div class="container">
                <div class="alert alert-secondary">
                    <h3><strong>Seu Cadastro foi realizado com sucesso!!</strong></h3>
                </div>
            </div>
        </div>
         <hr>
        <div class="container-fluid" class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
            <br>
            <a id="agendamento" class="btn btn-primary" href="/mudas/solicitantes/entracpf_agenda.php">
                <span class="glyphicon glyphicon-calendar"></span> Ir para agendamento de Retirada de Mudas</a>
        </div>
       
    </div>
</body>

</html>