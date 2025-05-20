<?php
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id_imovel'])) {
    header("Location: ../TelaListarImovelFUNC.php");
    exit();
}

    $id_imovel = $_POST['id_imovel'];

    $sql = "SELECT * FROM imovel WHERE id = ?";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("i", $id_imovel);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $imovel = $resultado->fetch_assoc();
    $baseImagePath = '../imgImovel/';
    $acao= "Abriu para ver os detalhes do imovel: ".$id_imovel;
    inserirLog($_SESSION['id_funcionario'], $acao);
    return $imovel;

?>
