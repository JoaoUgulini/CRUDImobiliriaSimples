<?php
require_once '../backend/conecao.php';
$conn = new conexao(); // Instancia a classe de conexão
$conn->connect(); // Abre a conexão com o banco
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Listagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<?php
    $sql = "SELECT id, path, titulo, tipo, finalidade, valor FROM imovel WHERE ativo = 1 ORDER BY id";

    $resultado = $conn->getConnection()->query($sql);

    if (!$resultado) {
        throw new Exception("Erro ao buscar imóveis: " . $conn->getConnection()->error);
    }

    echo '<div class="container-grid">';

    while ($imovel = $resultado->fetch_assoc()) {
        $baseImagePath = '../imgImovel/';
        $imagePath = $baseImagePath . $imovel['path'];

        echo '<form method="post" action="TelaDetalhesImovel.php" class="detalhes-form">';
        echo '<input type="hidden" name="id_imovel" value="' . htmlspecialchars($imovel['id']) . '">';
        echo '<button type="submit" class="imovel-card">';

        if (file_exists($imagePath)) {
            echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Imagem do Imóvel">';
        } else {
            echo '<p>Imagem não encontrada</p>';
        }

        echo '<div class="imovel-info">';
        echo "<h1>" . htmlspecialchars($imovel['titulo']) . "</h1>";
        echo "<h2>" . htmlspecialchars($imovel['tipo']) . "</h2>";
        echo "<h3>" . htmlspecialchars($imovel['finalidade']) . "</h3>";
        echo "<h4>R$ " . number_format($imovel['valor'], 2, ',', '.') . "</h4>";
        echo '</div></button></form>';
    }

    echo '</div>';


?>
</body>
</html>