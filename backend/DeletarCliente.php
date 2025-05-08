<?php
require_once '../backend/conecao.php';
$conn = new conexao(); // Instancia a classe de conexão
$conn->connect(); // Abre a conexão com o banco
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id_cliente = $_POST['id_cliente'];;

    $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";

    $pstmt = $conexao->prepare($sql);
    $conexao = encerrar();
    echo "$id_cliente";
    header("Location: ../frontend-sistemaFunc/TelaListarClientes.php");;
}
?>