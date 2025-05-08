<?php
require_once 'conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_imovel'])) {
    header("Location: ../TelaListarImovelFUNC.php");
    exit();
}

try {
    $id_imovel = $_POST['id_imovel'];

    $sql = "SELECT * FROM imovel WHERE id = ?";
    $stmt = $conn->getConnection()->prepare($sql);

    if (!$stmt) {
        throw new Exception("Erro na preparação da consulta: " . $conn->getConnection()->error);
    }

    $stmt->bind_param("i", $id_imovel);

    if (!$stmt->execute()) {
        throw new Exception("Erro ao executar consulta: " . $stmt->error);
    }

    $resultado = $stmt->get_result();
    $imovel = $resultado->fetch_assoc();

    if (!$imovel) {
        throw new Exception("Imóvel não encontrado!");
    }

    $baseImagePath = '../imgImovel/';
    return $imovel;

} catch (Exception $e) {
    echo '<div class="alert alert-danger">';
    echo 'Erro: ' . $e->getMessage();
    echo '</div>';
    exit();
}
?>
