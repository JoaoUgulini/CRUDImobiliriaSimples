<?php
require_once 'conecao.php';
$conn = new conexao(); // Instancia a classe de conexão
$conn ->connect(); // Abre a conexão com o banco
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


try {
    if ($perfil == 'funcionario') {
        $sql = "SELECT * FROM funcionario WHERE email = ? AND senha = ?";
    } else {
        $sql = "SELECT * FROM cliente WHERE email = ? AND senha = ?";
    }

    $stmt = $conn->getConnection()->prepare($sql);

    if (!$stmt) {
        throw new Exception("Erro na preparação da consulta: " . $conn->getConnection()->error);
    }

    $stmt->bind_param("ss", $email, $senha);

    if (!$stmt->execute()) {
        throw new Exception("Erro ao executar consulta: " . $stmt->error);
    }

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        if ($senha === $usuario['senha']) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'login' => isset($usuario['login']) ? $usuario['login'] : $usuario['email'],
                'perfil' => $perfil,
                'nome' => $usuario['nome']
            ];

            if ($perfil == 'funcionario') {
                header("Location: ../frontend-sistemaFunc/area_funcionario.php");
            } else {
                header("Location: ../frontend-sistemaCliente/area_cliente.php");
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

} catch (Exception $e) {
    $_SESSION['erro_login'] = "Erro no sistema: " . $e->getMessage();
    header("Location: ../frontend-Login/TelaInicialLogin.php");
    exit();
}
