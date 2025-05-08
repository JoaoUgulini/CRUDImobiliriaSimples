<?php
require_once '../backend/conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id = $_POST['id_imovel'];

    $this->$conn->getConnection()->query("DELETE FROM imovel WHERE id = :id");
    echo "$id";
    header("Location: ../frontend-sistemaFunc/TelaListarImovelFUNC.php");
}
?>