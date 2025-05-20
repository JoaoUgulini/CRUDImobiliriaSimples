<?php
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();
session_start();

$id_cliente = $_POST['id_cliente'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$ativo = $_POST['ativo'];


$sql = "UPDATE cliente SET nome = ?,sobrenome = ?,cpf = ?,telefone = ?, email = ?,senha = ?,ativo = ? WHERE id_cliente = ?";

$stmt = $conn->getConnection()->prepare($sql);

$stmt->bind_param("ssssssii",$nome,$sobrenome,$cpf,$telefone,$email,$senha,$ativo,$id_cliente
);
$stmt->execute();

$acao = "Atulizou o cadastro do cliente: ".$nome." ".$sobrenome." com o CPF: ".$cpf." ";
echo $acao."<br>";
inserirLog($_SESSION['id_funcionario'], 'Atualizou o Imóvel');

$stmt->close();
$conn->getConnection()->close();

header("Location: ../frontend-sistemaFunc/area_funcionario.php");
exit();

?>