<?php
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id = $_POST['id_imovel'];

    $stmt = $conn->getConnection()->prepare("DELETE FROM imovel WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    inserirLog($_SESSION['id_funcionario'], 'Deletou um imovel');

    header("Location: ../frontend-sistemaFunc/TelaListarImovelFUNC.php");
    exit();
}
?>
