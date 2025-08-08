<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include('../conexao.php');
include('../interface.php');
include_once "../lib_gop.php";
$msg_erro = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {

        $c_data = $_POST['data'];
        // verifico se data é sabado ou domingo
        if (date('N', strtotime($c_data)) >= 6) {
            $msg_erro = 'Data de agendamento não pode ser em um final de semana.';
            break;
        }
        // validação do campo horario
        if (empty($_POST['horario'])) {
            $msg_erro = 'Horário de agendamento é obrigatório.';
            break;
        }
        $c_horario = $_POST['horario'];

        // validação do campo quantidade
        if (empty($_POST['quantidade']) || $_POST['quantidade'] < 1 || $_POST['quantidade'] > 3) {
            $msg_erro = 'Quantidade de mudas deve ser entre 1 e 3.';
            break;
        }
        $i_quantidade = $_POST['quantidade'];
        $i_id_solicitante = $_SESSION['id_solicitante'];
        // Insere o agendamento no banco de dados
        $c_sql = "INSERT INTO agenda (id_solicitante, data, hora, numero_mudas) 
        VALUES ('$i_id_solicitante', '$c_data', '$c_horario', '$i_quantidade')";
        if (!$conection->query($c_sql)) {
            $msg_erro = 'Erro ao agendar: ' . $conection->error;
            break;
        }
        $_SESSION['data'] = $c_data;
        $_SESSION['horario'] = $c_horario;
        // Redireciona para a página de finalização
        header('Location: /mudas/solicitantes/finalizar_agenda.php');
        exit();
    } while (false);
}
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
            <h5>Campos com (*) são obrigatórios. Máximo 3 mudas por solicitante</h5>
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
                <div class="col-sm-2">
                    <input type="date" class="form-control" name="data" value="<?php echo $c_data; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Horário (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-3" id="horario" name="horario" required>
                        <option></option>
                        <option value="09:00">09:00 hs</option>
                        <option value="10:00">10:00 hs</option>
                        <option value="11:00">11:00 hs</option>
                        <option value="12:00">12:00 hs</option>
                        <option value="13:00">13:00 hs</option>
                        <option value="14:00">14:00 hs</option>
                        <option value="15:00">15:00 hs</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-sm-3 col-form-label">Quantidade de mudas (Max. 3 mudas)</label>
                <div class="col-sm-2">
                    <input type="number" max="3" min="1" class="form-control" name="quantidade" value="<?php echo $i_quantidade; ?>" required>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <br>
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-right'></span> Agendar</button>
                    <a class='btn btn-danger' href='/mudas/index.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>
            </div>
        </form>
    </div>

</body>

</html>