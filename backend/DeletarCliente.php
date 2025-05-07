<?php
include_once 'conecao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id_cliente = $_POST['id_cliente'];;
    $conexao = conectar("bdimovel");
    $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
    $pstmt = $conexao->prepare($sql);
    $pstmt->bindValue(':id_cliente', $_POST['id_cliente']);
    $pstmt->execute();
    $conexao = encerrar();
    echo "$id_cliente";
    header("Location: ../frontend-sistemaFunc/TelaListarClientes.php");;
}
?>