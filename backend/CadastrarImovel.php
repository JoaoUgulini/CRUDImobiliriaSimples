<?php
include_once 'conecao.php';
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
    if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg") {
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

        $conexao = conectar("bdimovel");
        $sqlID = "SELECT id FROM cliente WHERE cpf = :cpf";
        $stmt = $conexao->prepare($sqlID);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            $id_Proprietario = $resultado['id'];
        } else {
            die("CPF não encontrado no cadastro de clientes");
        }
        $sql = "Insert into imovel (id_Proprietario, titulo, tipo, finalidade, valor, medida_frente, medida_lateral, quartos, banheiros, vagas_garagem, endereco, numero, complemento, bairro, cidade, estado, path) 
                values (:id_Proprietario, :titulo, :tipo, :finalidade, :valor, :medida_frente, :medida_lateral, :quartos, :banheiros, :vagas_garagem, :endereco, :numero, :complemento, :bairro, :cidade, :estado, :path)";
        $pstmt = $conexao->prepare($sql);

        $pstmt->bindValue(':id_Proprietario', $id_Proprietario);
        $pstmt->bindValue(':titulo', $titulo);
        $pstmt->bindValue(':tipo', $tipo);
        $pstmt->bindValue(':finalidade', $finalidade);
        $pstmt->bindValue(':valor', $valor);
        $pstmt->bindValue(':medida_frente', $medida_frente);
        $pstmt->bindValue(':medida_lateral', $medida_lateral);
        $pstmt->bindValue(':quartos', $quartos);
        $pstmt->bindValue(':banheiros', $banheiros);
        $pstmt->bindValue(':vagas_garagem', $vagas_garagem);
        $pstmt->bindValue(':endereco', $endereco);
        $pstmt->bindValue(':numero', $numero);
        $pstmt->bindValue(':complemento', $complemento);
        $pstmt->bindValue(':bairro', $bairro);
        $pstmt->bindValue(':cidade', $cidade);
        $pstmt->bindValue(':estado', $estado);
        $pstmt->bindValue(':path', $path);
        $pstmt->execute();
        $conexao = encerrar();
        echo "Imovel cadastrado";
        header("Location: ../frontend-sistema/area_funcionario.php");
        exit;
    }
}
?>

?>
