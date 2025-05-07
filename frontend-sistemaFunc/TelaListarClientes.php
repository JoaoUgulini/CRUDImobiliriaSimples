<?php
include_once '../backend/conecao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Listagem de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<?php
$conexao = conectar("bdimovel");
$sql = "SELECT * FROM cliente";
$pstmt = $conexao->prepare($sql);
$pstmt->execute();
$registros = $pstmt->fetchAll();

echo '<div class="lista-clientes">';
foreach ($registros as $registro) {
    echo '<div class="cliente-item">';
    echo '<div class="cliente-info">';
    echo "<h2>" . $registro['nome'] . " " . $registro['sobrenome'] . "</h2>";
    echo "<p><strong>CPF:</strong> " . $registro['cpf'] .
        " | <strong>Tel:</strong> " . $registro['telefone'] .
        " | <strong>Email:</strong> " . $registro['email'] . "</p>";
    echo "<p><strong>Data Cadastro:</strong> " . $registro['data_cadastro'] .
        " | <strong>Status:</strong> " . ($registro['ativo'] == 1 ? 'Ativo' : 'Desativado') . "</p>";
    echo '</div>';
    echo '<div class="cliente-acoes">';
    echo '<form method="post" action="TelaEditarCliente.php">';
    echo '<input type="hidden" name="id_cliente" value="' . $registro['id_cliente'] . '">';
    echo '<button type="submit" class="btn-acao btn-editar">Editar</button>';
    echo '</form>';
    echo '<form method="post" action="../backend/DeletarCliente.php">';
    echo '<input type="hidden" name="id_cliente" value="' . $registro['id_cliente'] . '">';
    echo '<button type="submit" name="deletar" class="btn-acao btn-excluir">Excluir</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
?>
</body>
</html>