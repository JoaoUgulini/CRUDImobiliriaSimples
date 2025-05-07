<?php
include_once 'conecao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deletar'])) {
        $id = $_POST['id_imovel'];
        $conexao = conectar("bdimovel");
        $sql = "DELETE FROM imovel WHERE id = :id";
        $pstmt = $conexao->prepare($sql);
        $pstmt->bindValue(':id', $_POST['id_imovel']);
        $pstmt->execute();
        $conexao = encerrar();
        echo "$id";
        header("Location: ../frontend-sistemaFunc/TelaListarImovelFUNC.php");
}
?>