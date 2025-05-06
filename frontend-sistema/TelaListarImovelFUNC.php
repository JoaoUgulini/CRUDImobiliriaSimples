<<?php
include_once '../backend/conecao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Inicial Login Imobiliaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
</head>
<body >
<?php
$conexao = conectar("bdimovel");
$sql = "SELECT path,titulo,tipo,finalidade,valor FROM imovel";
$pstmt = $conexao->prepare($sql);
$pstmt->execute();
$registros = $pstmt->fetchAll();
$baseImagePath = '../imgImovel/';
foreach ($registros as $registro) {
    $imagePath = $baseImagePath . $registro['path'];
    if (file_exists($imagePath)) {
        echo '<img src="' . $imagePath . '" alt="Imagem do Imóvel">';
    } else {
        echo '<p>Imagem não encontrada: ' . $imagePath . '</p>';
    }
    echo "<h1>Nome do Imovel: " . $registro['titulo'] . "</h1>";
    echo "<h2>Tipo do Imovel: " . $registro['tipo'] . "</h2>";
echo "<h3>Finalidade: " . $registro['finalidade'] . "</h3>";
  echo "<h4>Valor: " . $registro['valor'] . "</h4>";
}
?>
</body>
</html>