<?php
include_once 'conecao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_imovel'])) {
    header("Location: ../TelaListarImovelFUNC.php");
    exit();
}

$id_imovel = $_POST['id_imovel'];
$conexao = conectar("bdimovel");
$sql = "SELECT * FROM imovel WHERE id = ?";
$pstmt = $conexao->prepare($sql);
$pstmt->execute([$id_imovel]);
$imovel = $pstmt->fetch();

if (!$imovel) {
    echo "Imóvel não encontrado!";
    exit();
}

$baseImagePath = '../imgImovel/';
return $imovel;
?>