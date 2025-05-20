<?php
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();
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

if ($perfil == 'funcionario') {
    $sql = "SELECT * FROM funcionario WHERE email = ? AND senha = ?";
} else {
    $sql = "SELECT * FROM cliente WHERE email = ? AND senha = ?";
}

$stmt = $conn->getConnection()->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();
    
    if ($senha === $usuario['senha']) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'login' => isset($usuario['login']) ? $usuario['login'] : $usuario['email'],
            'perfil' => $perfil,
            'nome' => $usuario['nome']
        ];

        if ($perfil == 'funcionario') {
            $_SESSION['id_funcionario'] = $usuario['id_funcionario'];
            inserirLog($usuario['id_funcionario'], 'Foi logado como funcionario');
            header("Location: ../frontend-sistemaFunc/area_funcionario.php");
        } else {
            inserirLog($usuario['id'], 'Foi logado como cliente');
            header("Location: ../frontend-sistemaCliente/area_cliente.php");
        }
        exit();
    }
}

header("Location: ../frontend-Login/TelaInicialLogin.php");
exit();