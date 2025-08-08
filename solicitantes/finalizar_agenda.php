<?php
session_start(); // icicio de session
include("..\interface.php");
$c_email = $_SESSION['email'];
// chamo o envio de email ordem de serviço gerada
if (filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
    $c_assunto = "Abertura de Ordem  de Serviço no GOP";
    $c_body = "teste de envio de email";
    include('../email.php');
}

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
                    <h3><strong>Sua Retirada de Muda foi agendada com sucesso para do dia <?php echo $c_dia ?> às <?php echo $c_hora ?>hs.!!</strong></h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>