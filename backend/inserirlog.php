<?php
session_start();
require_once 'conecao.php';

function inserirLog($id_usr, $acao) {
    $conn = new conexao();
    $conn->connect();
    $sql = "INSERT INTO log (id_usr, acao) VALUES (?, ?)";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->bind_param("is", $id_usr, $acao);
    return $stmt->execute();
}