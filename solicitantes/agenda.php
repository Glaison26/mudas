<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include('../conexao.php');
include('../interface.php');
include_once "../lib_gop.php";
$msg_erro = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container -my5">
        <div class='alert alert-info' role='alert'>
            <div style="padding-left:15px;">
                <img Align="left" src="\mudas\imagens\escrita.png" alt="30" height="35">

            </div>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>

        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <div style='padding-left:15px;'>
                    <h5><img Align='left' src='\mudas\imagens\aviso.png' alt='30' height='35'> $msg_erro</h5>
                </div>
                
            </div>
            ";
        }
        ?>
        <form method="post">
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Data de Agendamento (*)</label>
                <div class="col-sm-6">
                    <input type="date"  class="form-control" name="data" value="<?php echo $c_data; ?>" required>
                </div>
            </div>
        </form>
    </div>

</body>

</html>