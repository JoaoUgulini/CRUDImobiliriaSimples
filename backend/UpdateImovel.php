<?php
include_once 'conecao.php';
session_start();

$id_imovel = $_POST['id_imovel'];
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


$conexao = conectar("bdimovel");
$sqlID = "SELECT id_cliente FROM cliente WHERE cpf = :cpf";
$stmt = $conexao->prepare($sqlID);
$stmt->bindValue(':cpf', $cpf);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
if ($resultado) {
    $id_Proprietario = $resultado['id_cliente'];
} else {
    die("CPF não encontrado no cadastro de clientes");
}
$sql = "UPDATE imovel SET id_proprietario = :id_proprietario, titulo = :titulo, tipo = :tipo, finalidade = :finalidade, valor = :valor, medida_frente = :medida_frente, medida_lateral = :medida_lateral, quartos = :quartos, banheiros = :banheiros, vagas_garagem = :vagas_garagem, endereco = :endereco, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado WHERE id = :id";
$pstmt = $conexao->prepare($sql);
$pstmt->bindValue(':id', $id_imovel);
$pstmt->bindValue(':id_proprietario', $id_Proprietario);
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
$pstmt->execute();
$conexao = encerrar();
echo "Imovel atualizado";
echo $id_imovel."<br>";
echo $id_Proprietario."<br>";
echo $titulo."<br>";
echo $tipo."<br>";
echo $finalidade."<br>";
echo $valor."<br>";
echo $medida_frente."<br>";
echo $medida_lateral."<br>";
echo $quartos."<br>";
echo $banheiros."<br>";
echo $vagas_garagem."<br>";
echo $endereco."<br>";
echo $numero."<br>";
echo $complemento."<br>";
echo $bairro."<br>";
echo $cidade."<br>";
echo $estado."<br>";
header("Location: ../frontend-sistemaFunc/TelaListarImovelFUNC.php");
exit;
?>

?>
