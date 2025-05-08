<?php

require_once 'conecao.php';
$conn = new conexao();
$conn->connect();
session_start();

if (isset($_FILES['imgImovel'])) {
    $arquivo = $_FILES['imgImovel'];

    if ($arquivo['error']) {
        echo "Erro ao enviar o arquivo";
        exit;
    }
    $pasta = "../imgImovel/";
    $nomeArquivo = $arquivo['name'];
    $novoArqNome = uniqid();
    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
    if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg" && $extensao != "jfif") {
        die("Tipo de arquivo nao aceito");
    }
    $caminhoCompleto = $pasta . $novoArqNome . "." . $extensao;
    if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
        $titulo = $_POST['nomeImovel'];
        $cpf = $_POST['cpf'];
        $tipo = $_POST['tipoImovel'];
        $finalidade = $_POST['finalidade'];
        $valor = $_POST['valor'];
        $medida_frente = $_POST['medidaFrente'];
        $medida_lateral = $_POST['medidaLateral'];
        $quartos = $_POST['quarto'];
        $banheiros = $_POST['banheiro'];
        $vagas_garagem = $_POST['garagem'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $path = $caminhoCompleto;
        $consulta = $conn->getConnection()->query("SELECT id_cliente FROM cliente WHERE cpf = '$cpf' ");
        $campo = $consulta->fetch_assoc();
        $id_Proprietario = $campo['id_cliente'];
        $sql = "INSERT INTO imovel (
            titulo, id_proprietario, tipo, finalidade, valor, 
            medida_frente, medida_lateral, quartos, banheiros, 
            vagas_garagem, endereco, numero, complemento, bairro, 
            cidade, estado, path
        ) VALUES (
            '$titulo', $id_Proprietario, '$tipo', '$finalidade', $valor,
            $medida_frente, $medida_lateral, $quartos, $banheiros,
            $vagas_garagem, '$endereco', '$numero', '$complemento', '$bairro',
            '$cidade', '$estado', '$path'
        )";
            header("Location: ../frontend-sistemaFunc/area_funcionario.php");
            exit;

    }
}

?>

