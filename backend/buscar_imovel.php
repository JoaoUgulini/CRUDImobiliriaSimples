<?php
require_once 'conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

function buscarDadosImovel($id_imovel) {
    global $conn;

    $consulta = $conn->getConnection()->query("SELECT * FROM imovel WHERE id = '$id_imovel'");

    if ($consulta && $consulta->num_rows > 0) {
        $imovel = $consulta->fetch_assoc();

        $imovel['cpf_proprietario'] = '';

        $sql_cpf = "SELECT c.cpf FROM cliente c 
                    INNER JOIN imovel i ON c.id_cliente = i.id_proprietario 
                    WHERE i.id = '$id_imovel'";

        $consulta_cpf = $conn->getConnection()->query($sql_cpf);

        if ($consulta_cpf && $consulta_cpf->num_rows > 0) {
            $resultado_cpf = $consulta_cpf->fetch_assoc();
            $imovel['cpf_proprietario'] = $resultado_cpf['cpf'];
        }
        return $imovel;
    }
}
?>
