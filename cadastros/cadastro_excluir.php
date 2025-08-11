<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../conexao.php");
include('../interface.php');

if (!isset($_GET["id"])) {
    header('location: /mudas/cadastros/consulta_cadastro.php');
    exit;
}
$c_id = $_GET["id"];
// verifico se existe registro com id informado na agenda
$c_sql = "SELECT * FROM agenda WHERE id_solicitante=$c_id";
$result = $conection->query($c_sql);
if ($result->num_rows > 0) {
    echo "<script>alert('Não é possivel excluir registro! Existe agenda para este solicitante!')</script>";
    echo "<div class='container-fluid'>
    <a class='btn btn-primary' href='/mudas/cadastros/consulta_cadastro.php'><span class='glyphicon glyphicon-off'></span> Voltar a Lista</a>
    </div>";
   
    exit;
}
// Exclusão do registro
$c_sql = "delete from solicitantes where id=$c_id";
$result = $conection->query($c_sql);
header('location: /mudas/cadastros/consulta_cadastro.php');