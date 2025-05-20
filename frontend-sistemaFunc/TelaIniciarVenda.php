<?php
require_once '../backend/conecao.php';
$conn = new conexao();
$conn->connect();
session_start();
$id_funcionario = $_SESSION['id_funcionario'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Inicial Login Imobiliaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
    <style>

</style>
</head>
<body>
<form action="area_funcionario.php" method="post">
    <input type="submit" name="voltar" value="Voltar">
</form>
<form action="../backend/IniciarVenda.php" method="post">
    <label>Nome Do Imóvel</label>
    <select name="id_imovel" id="id_imovel" required>
        <?php
        $sql = "SELECT i.id, i.titulo, i.tipo, i.valor, c.nome, c.cpf, c.id_cliente
                FROM imovel i
                LEFT JOIN cliente c ON i.id_proprietario = c.id_cliente
                WHERE i.ativo = 1
                ORDER BY i.tipo, i.titulo";

        $resultado = $conn->getConnection()->query($sql);

        if ($resultado) {
            $tipo_atual = '';
            while ($consulta = $resultado->fetch_assoc()) {
                if ($tipo_atual != $consulta['tipo']) {
                    if ($tipo_atual != '') {
                        echo '</optgroup>';
                    }
                    $tipo_atual = $consulta['tipo'];
                    echo '<optgroup label="' . ucfirst($tipo_atual) . '">';
                }

                $info = $consulta['titulo'];
                if (!empty($consulta['nome'])) {
                    $info .= " - Proprietário: " . $consulta['nome'];
                }
                if (!empty($consulta['cpf'])) {
                    $info .= " (CPF: " . $consulta['cpf'] . ")";
                }

                // Incluindo valor diretamente no backend
                echo '<option value="' . $consulta['id'] . '" data-valor="' . $consulta['valor'] . '">' .
                    htmlspecialchars($info) .
                    '</option>';
            }
            if ($tipo_atual != '') {
                echo '</optgroup>';
            }
        }
        ?>
    </select>

    <input type="hidden" name="valor" id="valor">

    <label>Comprador</label>
    <select name="id_cliente_comprador" required>
        <option value="">Selecione um cliente</option>
        <?php
        $sql = "SELECT c.id_cliente, c.nome, c.sobrenome, c.cpf 
                FROM cliente c 
                WHERE c.ativo = 1 
                ORDER BY c.nome, c.sobrenome";

        $resultado = $conn->getConnection()->query($sql);

        if ($resultado) {
            while ($consultaC = $resultado->fetch_assoc()) {
                $nomeCompleto = trim($consultaC['nome'] . ' ' . $consultaC['sobrenome']);
                $info = $nomeCompleto;
                if (!empty($consultaC['cpf'])) {
                    $info .= " - CPF: " . $consultaC['cpf'];
                }

                echo '<option value="' . $consultaC['id_cliente'] . '">' . htmlspecialchars($info) . '</option>';
            }
        }
        ?>
    </select>

    <input type="hidden" name="id_funcionario" value="<?php echo $_SESSION['id_funcionario']; ?>">

    <input type="submit" name="iniciarVenda" value="Iniciar Venda">
</form>

<?php
$conn->disconnect();
?>





</body>
</html>