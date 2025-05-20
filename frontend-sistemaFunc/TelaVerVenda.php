<?php
require_once '../backend/conecao.php';
$conn = new conexao();
$conn->connect();
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Listagem de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<form action="area_funcionario.php" method="post">
    <input type="submit" name="voltar" value="Voltar">
</form>

<?php
$sql = "SELECT * FROM venda ORDER BY id DESC";
$resultado = $conn->getConnection()->query($sql);

echo '<div class="lista-clientes">';

if ($resultado->num_rows > 0) {
    while ($venda = $resultado->fetch_assoc()) {
        echo '<div class="venda-item">';
        echo '<div class="venda-info">';
        echo "<h2>Venda #" . htmlspecialchars($venda['id']) . "</h2>";
        echo "<p><strong>ID Imóvel:</strong> " . htmlspecialchars($venda['id_imovel']) . "</p>";
        echo "<p><strong>ID Vendedor:</strong> " . htmlspecialchars($venda['id_cliente_vendedor']) . "</p>";
        echo "<p><strong>ID Comprador:</strong> " . htmlspecialchars($venda['id_cliente_comprador']) . "</p>";
        echo "<p><strong>ID Funcionário:</strong> " . htmlspecialchars($venda['id_funcionario']) . "</p>";
        echo "<p><strong>Valor:</strong> R$ " . number_format($venda['valor'], 2, ',', '.') . "</p>";
        echo "<p><strong>Data da Venda:</strong> " . htmlspecialchars($venda['data_venda']) . "</p>";
        echo '</div>';
        echo '</div>';
    }
}
echo '</div>';
?>
</body>
</html>
