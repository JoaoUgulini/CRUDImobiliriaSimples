<?php
require_once '../backend/conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
    $id_cliente = $_POST['id_cliente'];;

    $this->$conn->getConnection()->query("DELETE FROM cliente WHERE id_cliente = 'id_cliente' ");
    echo "$id_cliente";
    header("Location: ../frontend-sistemaFunc/TelaListarClientes.php");;
}
?>