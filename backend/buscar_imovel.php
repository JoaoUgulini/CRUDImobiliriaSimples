<?php
require_once 'conecao.php';

function buscarDadosImovel($id_imovel) {
    $conexao = conectar("bdimovel");

    $sql = "SELECT * FROM imovel WHERE id = :id_imovel";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id_imovel', $id_imovel);
    $stmt->execute();
    $imovel = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql_cpf = "SELECT c.cpf FROM cliente c INNER JOIN imovel i ON c.id_cliente = i.id_proprietario WHERE i.id = :id_imovel";
    $stmt_cpf = $conexao->prepare($sql_cpf);
    $stmt_cpf->bindParam(':id_imovel', $id_imovel);
    $stmt_cpf->execute();
    $cpf = $stmt_cpf->fetchColumn();

    $imovel['cpf_proprietario'] = $cpf;

    return $imovel;
}

if (isset($_POST['id_imovel'])) {
    $id_imovel = $_POST['id_imovel'];
    $dadosImovel = buscarDadosImovel($id_imovel);
    //echo json_encode($dadosImovel);
}
?>
