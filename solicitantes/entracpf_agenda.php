<?php
session_start();
include("..\lib_gop.php");
include("..\interface.php");
include("..\conexao.php");

$c_erro = "";
$c_cpf = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    do {
        // validação do campo cpf
        if (!validaCPF($_POST['entracpf'])) {
            $c_erro = 'CPF informado não e válido favor verificar!!';
            break;
        }
        $_SESSION['cpf'] = $_POST['entracpf']; // variavel de sessão com cpf
        // tiros os pontos cpf caso tenha sido digitado com pontos
        $_SESSION['cpf'] = preg_replace('/[^0-9]/', '', $_SESSION['cpf']);
        // sql para verificar se cpf ja existe no cadastro de solicitantes
        $c_sql = 'SELECT * FROM solicitantes where cpf=' . $_POST['entracpf'];
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();

        if ($registro) { // chama tipo de cadastro para registro novo
            // verifico se houve agendamento do solicitante a menos de 90 dias
            $c_sql = 'SELECT * FROM agenda WHERE id_solicitante=' . $registro['id'] . ' AND data >= DATE_SUB(CURDATE(), INTERVAL 90 DAY)';
            $result = $conection->query($c_sql);
            if ($result->num_rows > 0) {
                $c_erro = 'Já existe um agendamento para retirada realizado a menos de 90 dias. Favor verificar.';
                break;
            }
            $_SESSION['id_solicitante'] = $registro['id'];
            $_SESSION['nome'] = $registro['nome'];
            $_SESSION['email'] = $registro['email'];
            header('location: /mudas/solicitantes/agenda.php');
        } else {
            // aviso de cpf já cadastrado
            $c_erro = 'CPF não cadastrado, favor realizar o cadastro antes de agendar a retirada de mudas.';
            break;
        }
    } while (false);
}

?>
<!DOCTYPE html>
<html lang="en">

<body>


    <div class="container -my5">
        <?php
        if (!empty($c_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <h4>$c_erro</h4>
            </div>
                ";
        }
        ?>
        <form method="post">

            <div class="row mb-3">
                <div class="container">
                    <div class="alert alert-success">
                        <strong>Digite o CPF do solicitante para agendamento de retirada de Muda. Prazo minimo para nova retirada é de 90 dias.</strong>
                    </div>
                </div>
                <hr>
                <label class="col-sm-2 col-form-label">Informe seu CPF</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="11" placeholder="apenas números" class="form-control" name="entracpf" value="<?php echo $c_cpf; ?>">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <br>
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-circle-arrow-right'></span> Continuar</button>
                    <a class='btn btn-danger' href='/mudas/index.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>
            </div>

        </form>
    </div>
</body>

</html>