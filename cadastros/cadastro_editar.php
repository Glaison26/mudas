<?php
// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include('../conexao.php');
include('../interface.php');
include_once "../lib_gop.php";

$c_id = $_GET["id"];

// sql para pegar os dados do solicitante
$c_sql = "SELECT * FROM solicitantes WHERE id=$c_id";
$result = $conection->query($c_sql);
if ($result->num_rows == 0) {
    echo "<script>alert('Solicitante não encontrado!');</script>";
    header('location: /mudas/cadastros/consulta_cadastro.php');
    exit;
}
// busca os dados do solicitante
$row = $result->fetch_assoc();
// guardo os dados do solicitante em variaveis
$c_id = $row['id'];
$c_nome = $row['nome'];
$c_telefone = $row['telefone'];
$c_endereco = $row['endereco'];
$c_bairro = $row['bairro'];
$c_cep = $row['cep'];
$c_cidade = $row['cidade'];
$c_estado = $row['estado'];
$c_email = $row['email'];
$c_endereco_plantio = $row['endereco_plantio'];
$c_bairro_plantio = $row['bairro_plantio'];
$c_cep_plantio = $row['cep_plantio'];
$c_cidade_plantio = $row['cidade_plantio'];
$c_estado_plantio = $row['estado_plantio'];
$c_area = $row['area'];
$c_local_plantio = $row['local_plantio'];
$c_condicoes_luz = $row['condicoes_luz'];
$c_irrigacao = $row['irrigacao'];
 // verifico o checkbox do local de plantio
    if ($c_local_plantio == 'S') {
        $c_local_sim = 'checked';
        $c_local_nao = '';
    } else {
        $c_local_sim = '';
        $c_local_nao = 'checked';
    }
    // verifico o checkbox da irrigação 
    if ($c_irrigacao == 'S') {
        $c_irrigacao_sim = 'checked';
        $c_irrigacao_nao = '';
    } else {
        $c_irrigacao_sim = '';
        $c_irrigacao_nao = 'checked';
    }
// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get dos campos do formulário
    $c_nome = $_POST['nome'];
    $c_telefone = $_POST['telefone'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cidade = $_POST['cidade'];
    $c_estado = $_POST['estado'];
    $c_cpf = $_SESSION['cpf'];
    $c_email = $_POST['email'];
    $c_endereco_plantio = $_POST['endereco_plantio'];
    $c_bairro_plantio = $_POST['bairro_plantio'];
    $c_cep_plantio = $_POST['cep_plantio'];
    $c_cidade_plantio = $_POST['cidade_plantio'];
    $c_estado_plantio = $_POST['estado_plantio'];
    $c_area = $_POST['area'];
    $c_local_plantio = $_POST['local'];
    $c_condicoes_luz = $_POST['luz'];
    $c_irrigacao = $_POST['irrigacao'];
    do {
        // verifico se local de plantio é o mesmo do endereço do solicitante
        if ($c_local_plantio == 'N') {
            if (empty($c_endereco_plantio) || empty($c_bairro_plantio) || empty($c_cidade_plantio) || empty($c_cep_plantio) || empty($c_estado_plantio)) {
                $msg_erro = "Preencha todos os campos do endereço do plantio.";
                break;
            }
        }
       // sql para atualizar os dados do solicitante
        $c_sql = "UPDATE solicitantes SET 
            nome='$c_nome', 
            telefone='$c_telefone', 
            endereco='$c_endereco', 
            bairro='$c_bairro', 
            cep='$c_cep', 
            cidade='$c_cidade', 
            estado='$c_estado', 
            email='$c_email', 
            endereco_plantio='$c_endereco_plantio', 
            bairro_plantio='$c_bairro_plantio', 
            cep_plantio='$c_cep_plantio', 
            cidade_plantio='$c_cidade_plantio', 
            estado_plantio='$c_estado_plantio', 
            area=$c_area, 
            local_plantio='$c_local_plantio', 
            condicoes_luz='$c_condicoes_luz', 
            irrigacao='$c_irrigacao' WHERE id=$c_id";
        $result = $conection->query($c_sql);
        // verifico se a query foi correta
        if (!$result) {
            $msg_erro = "Erro ao atualizar os dados do solicitante: " . $conection->error;
            break;
        }
        // se tudo estiver correto, guardo a mensagem de sucesso
       
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /mudas/cadastros/consulta_cadastro.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script type="text/javascript">
        $(document).ready(function() {
            $("#cpf").mask("999.999.999-99");
        });
    </script>

    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</head>

<div class="container -my5">

    <body>

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
            <p>
            <h5>Dados do Solicitante</p>
            </h5>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome Completo (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone (*)</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="15" class="form-control" name="telefone" value="<?php echo $c_telefone; ?>" onkeyup="handlePhone(event)" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="endereco" value="<?php echo $c_endereco; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Bairro (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="bairro" value="<?php echo $c_bairro; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cidade (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="cidade" value="<?php echo $c_cidade; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cep (*)</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="11" class="form-control" name="cep" value="<?php echo $c_cep; ?>" required>
                </div>
                <label class="col-sm-2 col-form-label">Estado (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-3" id="estado" name="estado" required>
                        <option value="AC" <?= ($c_estado == 'AC') ? 'selected' : '' ?>>Acre</option>
                        <option value="AL" <?= ($c_estado == 'AL') ? 'selected' : '' ?>>Alagoas</option>
                        <option value="AP" <?= ($c_estado == 'AP') ? 'selected' : '' ?>>Amapa</option>
                        <option value="AM" <?= ($c_estado == 'AM') ? 'selected' : '' ?>>Amazonas</option>
                        <option value="BA" <?= ($c_estado == 'BA') ? 'selected' : '' ?>>Bahia</option>
                        <option value="CE" <?= ($c_estado == 'CE') ? 'selected' : '' ?>>Ceara</option>
                        <option value="DF" <?= ($c_estado == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
                        <option value="ES" <?= ($c_estado == 'ES') ? 'selected' : '' ?>>Espirito Santo</option>
                        <option value="GO" <?= ($c_estado == 'GO') ? 'selected' : '' ?>>Goias</option>
                        <option value="MA" <?= ($c_estado == 'MA') ? 'selected' : '' ?>>Maranhão</option>
                        <option value="MT" <?= ($c_estado == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
                        <option value="MS" <?= ($c_estado == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= ($c_estado == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
                        <option value="PA" <?= ($c_estado == 'PA') ? 'selected' : '' ?>>Para</option>
                        <option value="PB" <?= ($c_estado == 'PB') ? 'selected' : '' ?>>Paraiba</option>
                        <option value="PR" <?= ($c_estado == 'PR') ? 'selected' : '' ?>>Parana</option>
                        <option value="PE" <?= ($c_estado == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
                        <option value="PI" <?= ($c_estado == 'PI') ? 'selected' : '' ?>>Piaui</option>
                        <option value="RJ" <?= ($c_estado == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
                        <option value="RN" <?= ($c_estado == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= ($c_estado == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= ($c_estado == 'RO') ? 'selected' : '' ?>>Rondonia</option>
                        <option value="RR" <?= ($c_estado == 'RR') ? 'selected' : '' ?>>Roraima</option>
                        <option value="SC" <?= ($c_estado == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
                        <option value="SP" <?= ($c_estado == 'SP') ? 'selected' : '' ?>>São Paulo</option>
                        <option value="SE" <?= ($c_estado == 'SE') ? 'selected' : '' ?>>Sergipe</option>
                        <option value="TO" <?= ($c_estado == 'TO') ? 'selected' : '' ?>>Tocantis</option>

                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-4">
                    <input type="email" maxlength="120" class="form-control" name="email" value="<?php echo $c_email; ?>">
                </div>
            </div>
            </hr>
            <p>
            <h5>Informações sobre o Plantio</p>
            </h5>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Irrigação no local? (*)</label>
                <div class="col-sm-2">

                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="irrigacao" id="irrigacao_sim" value="S" <?php echo $c_irrigacao_sim ?> required>
                            <label class="form-check-label" for="local_sim">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="irrigacao" id="irrigacao_nao" value="N" <?php echo $c_irrigacao_nao ?>>
                            <label class="form-check-label" for="local_nao">
                                Não
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            </hr>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Área do Plantio (m²) (*)</label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="area" value="<?php echo $c_area; ?>" required>
                </div>
                <label class="col-sm-2 col-form-label">Condição de luz no local (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-1" id="luz" name="luz" required>
                        <option <?= ($c_condicoes_luz == 'Sombra') ? 'selected' : '' ?>>Sombra</option>
                        <option <?= ($c_condicoes_luz == 'Meia Sombra') ? 'selected' : '' ?>>Meia Sombra</option>
                        <option <?= ($c_condicoes_luz == 'Sol Pleno') ? 'selected' : '' ?>>Sol Pleno</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <hr>

                <label class="col-sm-3 col-form-label">O local de plantio é o mesmo do endereço informado?</label>
                <div class="col-sm-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="local" id="local_sim" value="S" <?php echo $c_local_sim ?> required>
                        <label class="form-check-label" for="local_sim">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="local" id="local_nao" value="N" <?php echo $c_local_nao ?>>
                        <label class="form-check-label" for="local_nao">
                            Não
                        </label>
                    </div>
                </div>

            </div>

            <hr>
            <p>
            <h5>Endereço do Plantio : (preencher somente se for diferente do Endereço do solicitante)</p>
            </h5>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço Plantio (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="endereco_plantio" value="<?php echo $c_endereco_plantio; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Bairro Plantio (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="bairro_plantio" value="<?php echo $c_bairro_plantio; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cidade Plantio (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="cidade_plantio" value="<?php echo $c_cidade_plantio; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cep Plantio (*)</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="120" class="form-control" name="cep_plantio" value="<?php echo $c_cep_plantio; ?>">
                </div>
                <label class="col-sm-2 col-form-label">Estado Plantio (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-3" id="estado_plantio" name="estado_plantio">
                        <option value="AC" <?= ($c_estado == 'AC') ? 'selected' : '' ?>>Acre</option>
                        <option value="AL" <?= ($c_estado == 'AL') ? 'selected' : '' ?>>Alagoas</option>
                        <option value="AP" <?= ($c_estado == 'AP') ? 'selected' : '' ?>>Amapa</option>
                        <option value="AM" <?= ($c_estado == 'AM') ? 'selected' : '' ?>>Amazonas</option>
                        <option value="BA" <?= ($c_estado == 'BA') ? 'selected' : '' ?>>Bahia</option>
                        <option value="CE" <?= ($c_estado == 'CE') ? 'selected' : '' ?>>Ceara</option>
                        <option value="DF" <?= ($c_estado == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
                        <option value="ES" <?= ($c_estado == 'ES') ? 'selected' : '' ?>>Espirito Santo</option>
                        <option value="GO" <?= ($c_estado == 'GO') ? 'selected' : '' ?>>Goias</option>
                        <option value="MA" <?= ($c_estado == 'MA') ? 'selected' : '' ?>>Maranhão</option>
                        <option value="MT" <?= ($c_estado == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
                        <option value="MS" <?= ($c_estado == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= ($c_estado == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
                        <option value="PA" <?= ($c_estado == 'PA') ? 'selected' : '' ?>>Para</option>
                        <option value="PB" <?= ($c_estado == 'PB') ? 'selected' : '' ?>>Paraiba</option>
                        <option value="PR" <?= ($c_estado == 'PR') ? 'selected' : '' ?>>Parana</option>
                        <option value="PE" <?= ($c_estado == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
                        <option value="PI" <?= ($c_estado == 'PI') ? 'selected' : '' ?>>Piaui</option>
                        <option value="RJ" <?= ($c_estado == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
                        <option value="RN" <?= ($c_estado == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= ($c_estado == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= ($c_estado == 'RO') ? 'selected' : '' ?>>Rondonia</option>
                        <option value="RR" <?= ($c_estado == 'RR') ? 'selected' : '' ?>>Roraima</option>
                        <option value="SC" <?= ($c_estado == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
                        <option value="SP" <?= ($c_estado == 'SP') ? 'selected' : '' ?>>São Paulo</option>
                        <option value="SE" <?= ($c_estado == 'SE') ? 'selected' : '' ?>>Sergipe</option>
                        <option value="TO" <?= ($c_estado == 'TO') ? 'selected' : '' ?>>Tocantis</option>
                    </select>
                </div>
            </div>


            <hr>
            <?php
            if (!empty($msg_gravou)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$msg_gravou</strong>

                             </div>
                        </div>     
                    </div>    
                ";
            }
            ?>
            <hr>
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/mudas/cadastros/consulta_cadastro.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>
        </form>
</div>

</body>

</html>