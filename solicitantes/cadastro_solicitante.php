<?php
// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include('../conexao.php');
include('../interface.php');
include_once "../lib_gop.php";

$c_nome = "";
$c_telefone = "";
$c_endereco = "";
$c_bairro = "";
$c_cep = "";
$c_cidade = "";
$c_estado = "";
$c_cpf = "";
$c_email = "";
$c_endereco_plantio = "";
$c_bairro_plantio = "";
$c_cep_plantio = "";
$c_cidade_plantio = "";
$c_estado_plantio = "";
$c_area = "";
$c_local_plantio = "";
$c_condicoes_luz = "";
$c_irrigacao = "";
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
        //isnerção no banco de dados
        $c_sql = "INSERT INTO solicitantes (nome, telefone, endereco, bairro, cep, cidade, estado, cpf, email, endereco_plantio,
         bairro_plantio, cep_plantio, cidade_plantio, estado_plantio, area, local_plantio, condicoes_luz, irrigacao) 
                  VALUES ('$c_nome', '$c_telefone', '$c_endereco', '$c_bairro', '$c_cep', '$c_cidade', '$c_estado', '$c_cpf', '$c_email',
                   '$c_endereco_plantio', '$c_bairro_plantio', '$c_cep_plantio', '$c_cidade_plantio', '$c_estado_plantio', '$c_area', '$c_local_plantio', 
                   '$c_condicoes_luz', '$c_irrigacao')";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /funcionarios/cadastro/cadastro_lista.php');
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
            echo '
            <div class="alert alert-warning" role="alert">
                <div style="padding-left:15px;">
                    
                </div>
                <h4><img Align="left" src="\funcionarios\imagens\aviso.png" alt="30" height="35"> $msg_erro</h4>
            </div>
            ';
        }
        ?>
        <form method="post">
            <hr>
            <p><h5>Dados do Solicitante</p></h5>
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
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Bairro (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cidade (*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cep (*)</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                </div>
                <label class="col-sm-2 col-form-label">Estado (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-3" id="estado" name="estado" required>
                        <option></option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapa</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceara</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espirito Santo</option>
                        <option value="GO">Goias</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option selected value="MG">Minas Gerais</option>
                        <option value="PA">Para</option>
                        <option value="PB">Paraiba</option>
                        <option value="PR">Parana</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piaui</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondonia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantis</option>

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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Irrigação no local? (*)</label>
                <div class="col-sm-2">

                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="irrigacao" id="irrigacao_sim" value="S" checked required>
                            <label class="form-check-label" for="local_sim">
                                Sim
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="irrigacao" id="irrigacao_nao" value="N">
                            <label class="form-check-label" for="local_nao">
                                Não
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            </hr>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <p><strong>Informações sobre o Plantio</strong></p>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Área do Plantio (m²) (*)</label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" name="area" value="<?php echo $c_area; ?>" required>
                </div>
                <label class="col-sm-2 col-form-label">Condição de luz no local (*)</label>
                <div class="col-sm-2">
                    <select class="form-select form-select-lg mb-1" id="luz" name="luz" required>
                        <option></option>
                        <option>Sombra</option>
                        <option>Meia Sombra</option>
                        <option>Sol Pleno</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <hr>

                <label class="col-sm-3 col-form-label">O local de plantio é o mesmo do endereço informado?</label>
                <div class="col-sm-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="local" id="local_sim" value="S" checked>
                        <label class="form-check-label" for="local_sim">
                            Sim
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="local" id="local_nao" value="N">
                        <label class="form-check-label" for="local_nao">
                            Não
                        </label>
                    </div>
                </div>

            </div>

            <hr>
            <p><h5>Endereço do Plantio : (preencher somente se for diferente do Endereço do solicitante)</p></h5>
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
                        <option></option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapa</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceara</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espirito Santo</option>
                        <option value="GO">Goias</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option selected value="MG">Minas Gerais</option>
                        <option value="PA">Para</option>
                        <option value="PB">Paraiba</option>
                        <option value="PR">Parana</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piaui</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondonia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantis</option>
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
                    <a class='btn btn-danger' href='/mudas/index.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>
        </form>
</div>

</body>

</html>