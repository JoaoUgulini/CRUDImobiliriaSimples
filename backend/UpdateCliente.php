<?php
include_once 'conecao.php';
session_start();

$id_cliente = $_POST['id_cliente'];
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$ativo = $_POST['ativo'];

$conexao = conectar("bdimovel");
$sql = "UPDATE cliente set nome = :nome, sobrenome = :sobrenome, cpf = :cpf, telefone = :telefone, email = :email, senha = :senha, ativo = :ativo WHERE id_cliente = :id_cliente";
$pstmt = $conexao->prepare($sql);
$pstmt->bindValue(':id_cliente', $id_cliente);
$pstmt->bindValue(':nome', $nome);
$pstmt->bindValue(':sobrenome', $sobrenome);
$pstmt->bindValue(':cpf', $cpf);
$pstmt->bindValue(':telefone', $telefone);
$pstmt->bindValue(':email', $email);
$pstmt->bindValue(':senha', $senha);
$pstmt->bindValue(':ativo', $ativo);
$pstmt->execute();
$conexao = encerrar();
header("Location: ../frontend-sistemaFunc/area_funcionario.php");
exit;
?>