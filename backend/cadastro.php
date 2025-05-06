<?php
include_once 'conecao.php';
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
        $conexao = conectar("bdimovel");
        $sql = "Insert into funcionario (nome, sobrenome, cpf, email, senha, creci) values (:nome, :sobrenome, :cpf, :email, :senha, :creci )";
        $pstmt = $conexao->prepare($sql);
        $pstmt->bindValue(':nome', $nome);
        $pstmt->bindValue(':sobrenome', $sobrenome);
        $pstmt->bindValue(':cpf', $cpf);
        $pstmt->bindValue(':email', $email);
        $pstmt->bindValue(':senha', $senha);
        $pstmt->bindValue(':creci', $creci);
        $pstmt->execute();
        $conexao = encerrar();
        echo "Funcionário cadastrado: $nome $sobrenome, CRECI: $creci";
    } else {
        $telefone = $_POST['telefone'];
        $conexao = conectar("bdimovel");
        $sql = "INSERT INTO cliente (nome, sobrenome, cpf, telefone, email, senha) VALUES (:nome, :sobrenome, :cpf, :telefone, :email, :senha)";

        $pstmt = $conexao->prepare($sql);
        $pstmt->bindValue(':nome', $nome);
        $pstmt->bindValue(':sobrenome', $sobrenome);
        $pstmt->bindValue(':cpf', $cpf);
        $pstmt->bindValue(':telefone', $telefone);
        $pstmt->bindValue(':email', $email);
        $pstmt->bindValue(':senha', $senha);
        $pstmt->execute();
        $conexao = encerrar();
        echo "Cliente cadastrado: $nome $sobrenome, Telefone: $telefone";
    }
    header("Location: ../frontend-Login/TelaInicialLogin.php");;
}
?>