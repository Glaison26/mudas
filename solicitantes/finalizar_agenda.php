<?php
session_start(); // icicio de session
include("..\interface.php");
$_SESSION['controle']='N';
$c_dia = date('d/m/Y', strtotime($_SESSION['data']));
$c_hora = $_SESSION['horario'];
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
                    <h3><strong>Sua Retirada de Muda foi agendada com sucesso para do dia <?php echo $c_dia?> às <?php echo $c_hora?>hs.!!</strong></h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>