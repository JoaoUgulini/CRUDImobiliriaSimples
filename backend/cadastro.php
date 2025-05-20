<?php
require_once 'conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo = $_POST['tipo'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($tipo == 'funcionario') {
        $creci = $_POST['creci'];
        $sql = "INSERT INTO funcionario (nome, sobrenome, cpf, email, senha, creci) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $sobrenome, $cpf, $email, $senha, $creci);
        $acao = "Cadastrou o funcionario: ".$nome." ".$sobrenome." com o CPF: ".$cpf." ";
    } else {
        $telefone = $_POST['telefone'];
        $sql = "INSERT INTO cliente (nome, sobrenome, cpf, telefone, email, senha) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $sobrenome, $cpf, $telefone, $email, $senha);
        $acao = "Cadastrou o cliente: ".$nome." ".$sobrenome." com o CPF: ".$cpf." ";
    }
    
    if($stmt->execute()) {
        $stmt->close();
        header("Location: ../frontend-Login/TelaInicialLogin.php");
        exit;
    }
}
?>