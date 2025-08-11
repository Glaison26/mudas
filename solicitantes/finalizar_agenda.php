<?php
session_start(); // icicio de session
include("..\interface.php");
// rotina para envio de email
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
$c_email = $_SESSION['email'];
$c_dia = $_SESSION['data'];
$c_data = date("d-m-Y", strtotime(str_replace('/', '-', $c_dia)));
$c_hora = $_SESSION['horario'];
// chamo o envio de email para o solicitante
if (filter_var($c_email, FILTER_VALIDATE_EMAIL)) {
    $c_assunto = "Sua retirada de muda foi agendada com sucesso!<br>";
    $c_body = "E-mail de confirmação.<br><br>";    
    $c_body .="Sua Retirada foi agendada pra o dia " . $c_data . " às " . $_SESSION['horario'] . "hs.<br><br>";
    $c_body .= "Obrigado por utilizar nossos serviços!<br><br>";
    $c_body .= "Atenciosamente,<br><br>";
    $c_body .= "Secretaria Municipal de Meio Ambiente do Municipio de Sabará.<br>";
    include('../email.php');
}
?>

<!-- front-end da página de finalização -->
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
                    <h3><strong>Sua Retirada de Muda foi agendada com sucesso para do dia <?php echo $c_data ?> às <?php echo $c_hora ?>horas !!</strong></h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>