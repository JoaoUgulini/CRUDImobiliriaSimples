<?php
session_start();
require_once 'conecao.php';
require_once 'inserirlog.php';
$conn = new conexao();
$conn->connect();

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


$consulta = $conn->getConnection()->query("SELECT id_cliente FROM cliente WHERE cpf = '$cpf'");
$campo = $consulta->fetch_assoc();
$id_Proprietario = $campo['id_cliente'];
$sql = "UPDATE imovel SET id_proprietario = ?, titulo = ?, tipo = ?, finalidade = ?, valor = ?, 
        medida_frente = ?, medida_lateral = ?, quartos = ?, banheiros = ?, vagas_garagem = ?, 
        endereco = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ? 
        WHERE id = ?";


$stmt = $conn->getConnection()->prepare($sql);

$stmt->bind_param("isssdddiiissssssi",$id_Proprietario,$titulo,$tipo,$finalidade, $valor,$medida_frente, $medida_lateral,$quartos,$banheiros,$vagas_garagem,$endereco,$numero,$complemento,$bairro,$cidade,$estado,$id_imovel
);

$stmt->execute();
$stmt->close();
$conn->getConnection()->close();


echo "Imovel atualizado<br>";
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
$acao = "Atulizou o Imovel: ".$titulo;
echo $acao."<br>";
inserirLog($_SESSION['id_funcionario'], 'Atualizou o Imóvel');
header("Location: ../frontend-sistemaFunc/TelaListarImovelFUNC.php");
exit;
?>

?>
