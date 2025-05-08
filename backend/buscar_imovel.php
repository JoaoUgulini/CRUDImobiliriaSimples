<?php
require_once 'conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

function buscarDadosImovel($id_imovel){

global $conn;
if (isset($_POST['id_imovel'])) {
    $id_imovel = $_POST['id_imovel'];

    $consulta = $conn->getConnection()->query("SELECT * FROM imovel WHERE id = '$id_imovel'");

    if ($consulta) {
        $imovel = $consulta->fetch_assoc();

        $sql_cpf = "SELECT c.cpf FROM cliente c 
                    INNER JOIN imovel i ON c.id_cliente = i.id_proprietario 
                    WHERE i.id = '$id_imovel'";

        $consulta_cpf = $conn->getConnection()->query($sql_cpf);

        if ($consulta_cpf) {
            $resultado_cpf = $consulta_cpf->fetch_assoc();
            $imovel['cpf_proprietario'] = $resultado_cpf['cpf'];
        }
    }

}}

if (isset($_POST['id_imovel'])) {
    $id_imovel = $_POST['id_imovel'];
    $dadosImovel = buscarDadosImovel($id_imovel);
}
?>
