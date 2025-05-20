<?php
session_start();
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();

$id_imovel = $_POST['id_imovel'];
$id_cliente_comprador = $_POST['id_cliente_comprador'];
$id_funcionario = $_SESSION['id_funcionario'];
$valor = $_POST['valor'];

$sql = "INSERT INTO venda (id_imovel, id_cliente_vendedor, id_cliente_comprador, id_funcionario, valor)
        VALUES (?, (SELECT id_proprietario FROM imovel WHERE id = ?), ?, ?, (SELECT valor FROM imovel WHERE id = ?))";

$stmt = $conn->getConnection()->prepare($sql);

$stmt->bind_param("iiisd", $id_imovel, $id_imovel, $id_cliente_comprador, $id_funcionario, $id_imovel);
$stmt->execute();

$sql_update = "UPDATE imovel SET ativo = 0 WHERE id = ?";
$stmt_update = $conn->getConnection()->prepare($sql_update);
$stmt_update->bind_param("i", $id_imovel);
$stmt_update->execute();

$acao ="O imovel com o ". $id_imovel." foi vendido";
inserirLog($_SESSION['id_funcionario'],$acao);

$conn->disconnect();
header("Location: ../frontend-sistemaFunc/area_funcionario.php");

?>
