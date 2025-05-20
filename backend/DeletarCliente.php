<?php
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id_cliente = $_POST['id_cliente'];

    $stmt = $conn->getConnection()->prepare("DELETE FROM cliente WHERE id_cliente = ?");
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $acao = "Deletou o cliente com o id: ".$id_cliente;
    inserirLog($_SESSION['id_funcionario'], $acao);

    header("Location: ../frontend-sistemaFunc/TelaListarClientes.php");
}
?>
