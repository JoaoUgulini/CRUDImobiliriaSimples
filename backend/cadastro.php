<?php
require_once 'conecao.php';
$con = new conexao(); // Instancia a classe de conexão
$con->connect(); // Abre a conexão com o banco
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

        $sql = "INSERT INTO funcionario (nome, sobrenome, cpf, email, senha, creci) 
                VALUES ('$nome', '$sobrenome', '$cpf', '$email', '$senha', '$creci')";

        if (!$con->getConnection()->query($sql)) {
            echo "Erro ao cadastrar funcionário: " . $con->getConnection()->error;
            exit;
        } else {
            echo "Funcionário cadastrado: $nome $sobrenome, CRECI: $creci";
        }
    } else {
        $telefone = $_POST['telefone'];

        $sql = "INSERT INTO cliente (nome, sobrenome, cpf, telefone, email, senha) 
                VALUES ('$nome', '$sobrenome', '$cpf', '$telefone', '$email', '$senha')";

        if (!$con->getConnection()->query($sql)) {
            echo "Erro ao cadastrar cliente: " . $con->getConnection()->error;
            exit;
        } else {
            echo "Cliente cadastrado: $nome $sobrenome, Telefone: $telefone";
        }
    }

    header("Location: ../frontend-Login/TelaInicialLogin.php");
    exit;
}
?>