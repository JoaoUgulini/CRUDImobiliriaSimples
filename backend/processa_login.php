<?php
require_once 'conecao.php';
session_start();

if (isset($_POST['cadastro'])) {
    $perfil = $_POST['perfil'];
    if ($perfil == 'cliente') {
        header("Location: ../frontend-Login/TelaCadCliente.php");
    } elseif ($perfil == 'funcionario') {
        header("Location: ../frontend-Login/TelaCadFunc.php");
    }
    exit();
}

$email = trim($_POST['email']);
$senha = trim($_POST['senha']);
$perfil = $_POST['perfil'];

if (empty($email) || empty($senha)) {
    $_SESSION['erro_login'] = "Login e senha são obrigatórios!";
    header("Location: ../frontend-Login/TelaInicialLogin.php");
    exit();
}

$conexao = conectar("bdimovel");

if ($perfil == 'funcionario') {
    $sql = "SELECT * FROM funcionario WHERE email = :email AND senha = :senha";
} else {
    $sql = "SELECT * FROM cliente WHERE email = :email AND senha = :senha";
}

$pstmt = $conexao->prepare($sql);
$pstmt->bindParam(':email', $email);
$pstmt->bindParam(':senha', $senha);
$pstmt->execute();

if ($pstmt->rowCount() == 1) {
    $usuario = $pstmt->fetch(PDO::FETCH_ASSOC);

    if ($senha === $usuario['senha']) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'login' => isset($usuario['login']) ? $usuario['login'] : $usuario['email'],
            'perfil' => $perfil,
            'nome' => $usuario['nome']
        ];

        if ($perfil == 'funcionario') {
            header("Location: ../frontend-sistema/area_funcionario.php");
        } else {
            header("Location: ../frontend-sistema/area_cliente.php");
        }
        exit();
    } else {
        $_SESSION['erro_login'] = "Senha incorreta.";
    }
} else {
    $_SESSION['erro_login'] = "Usuário não encontrado.";
}

header("Location: ../frontend-Login/TelaInicialLogin.php");
exit();