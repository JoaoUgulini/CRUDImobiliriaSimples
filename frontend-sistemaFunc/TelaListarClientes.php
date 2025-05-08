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
    <title>Tela Listagem de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<?php
try {
    $sql = "SELECT id_cliente, nome, sobrenome, cpf, telefone, email, data_cadastro, ativo 
            FROM cliente 
            ORDER BY nome";

    $resultado = $conn->getConnection()->query($sql);

    if (!$resultado) {
        throw new Exception("Erro ao buscar clientes: " . $conn->getConnection()->error);
    }

    echo '<div class="lista-clientes">';

    while ($cliente = $resultado->fetch_assoc()) {
        echo '<div class="cliente-item">';
        echo '<div class="cliente-info">';
        echo "<h2>" . htmlspecialchars($cliente['nome']) . " " . htmlspecialchars($cliente['sobrenome']) . "</h2>";
        echo "<p><strong>CPF:</strong> " . htmlspecialchars($cliente['cpf']) .
            " | <strong>Tel:</strong> " . htmlspecialchars($cliente['telefone']) .
            " | <strong>Email:</strong> " . htmlspecialchars($cliente['email']) . "</p>";
        echo "<p><strong>Data Cadastro:</strong> " . htmlspecialchars($cliente['data_cadastro']) .
            " | <strong>Status:</strong> " . ($cliente['ativo'] == 1 ? 'Ativo' : 'Desativado') . "</p>";
        echo '</div>';

        echo '<div class="cliente-acoes">';
        echo '<form method="post" action="TelaEditarCliente.php">';
        echo '<input type="hidden" name="id_cliente" value="' . htmlspecialchars($cliente['id_cliente']) . '">';
        echo '<button type="submit" class="btn-acao btn-editar">Editar</button>';
        echo '</form>';

        echo '<form method="post" action="../backend/DeletarCliente.php">';
        echo '<input type="hidden" name="id_cliente" value="' . htmlspecialchars($cliente['id_cliente']) . '">';
        echo '<button type="submit" name="deletar" class="btn-acao btn-excluir">Excluir</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';

} catch (Exception $e) {
    echo '<div class="alert alert-danger">';
    echo 'Erro: ' . $e->getMessage();
    echo '</div>';
}
?>
</body>
</html>