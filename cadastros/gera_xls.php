
<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("../conexao.php");
// Aceitar csv ou texto 
header('Content-Type: text/csv; charset=utf-8');
// Definir o cabeçalho para download do arquivo
header('Content-Disposition: attachment; filename=inscritos.csv');
// Gravar no buffer
$resultado = fopen("php://output", 'w');
// faço leitura da tabela de solicitantes
$sql = "SELECT solicitantes.nome, solicitantes.telefone, solicitantes.cpf, solicitantes.email, solicitantes.endereco, solicitantes.bairro,
solicitantes.cep, solicitantes.cidade, solicitantes.estado,
CASE
    WHEN solicitantes.local_plantio='S' THEN 'SIM'
    WHEN solicitantes.local_plantio='N' THEN 'NÃO'
END AS mesmo_local_plantio,
solicitantes.endereco_plantio, solicitantes.cep_plantio, solicitantes.bairro_plantio,
solicitantes.cep_plantio, solicitantes.estado_plantio, solicitantes.cidade_plantio, solicitantes.area,  
solicitantes.condicoes_luz,
CASE
    WHEN solicitantes.irrigacao='S' THEN 'SIM'
    WHEN solicitantes.irrigacao='N' THEN 'NÃO'
END AS tem_irrigacao FROM solicitantes ORDER BY nome ASC"; 
$result = $conection->query($sql);
// Definir o cabeçalho do arquivo CSV
$cabecalho = array('Nome', 'Telefone', 'CPF', 'Email', 'Endereço', 'Bairro', 'CEP', 'Cidade', 'Estado',
    'Mesmo Local de Plantio?', 'Endereço de Plantio', 'CEP de Plantio', 'Bairro de Plantio',
    'Estado de Plantio', 'Cidade de Plantio', 'Área (m²)', 'Condições de Luz', 'Irrigação');
$cabecalho = mb_convert_encoding($cabecalho, "ISO-8859-1", "UTF-8");
// Abrir o arquivo
// Escrever o cabeçalho no arquivo
fputcsv($resultado, $cabecalho, ';');
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
// insiro os registro do banco de dados no arquivo CSV
while ($c_linha = $result->fetch_assoc()) {
    fputcsv($resultado, mb_convert_encoding($c_linha, "ISO-8859-1", "UTF-8"), ';');
}
// Fechar arquivo
fclose($resultado);