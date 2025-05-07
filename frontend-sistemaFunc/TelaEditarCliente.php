<?php
require_once '../backend/conecao.php';
$id = $_POST['id_cliente'];

$conexao = conectar("bdimovel");
$sql = "SELECT * FROM cliente WHERE id_cliente = :id_cliente";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_cliente', $id);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tela De Alteração de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/stylelogin.css" rel="stylesheet">
</head>
<body class="containerCliente">
<form action="telaListarClientes.php" method="post">
    <h1>Tela De Alteração de Clientes</h1>
    <input type="submit" name="voltar" value="Voltar">
</form>
<form name="entrada" method="post" action="../backend/UpdateCliente.php">
    <input type="hidden" name="tipo" value="cliente">
    <Label>Nome: </Label>
    <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required>
    <label>Sobrenome: </label>
    <input type="text" name="sobrenome" value="<?php echo $cliente['sobrenome']; ?>" required>
    <label>CPF: </label>
    <input type="text" name="cpf" value="<?php echo $cliente['cpf']; ?>" required>
    <label>Telefone: </label>
    <input type="tel" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
    <label>Email: </label>
    <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required>
    <label>Senha: </label>
    <input type="password" name="senha" value="<?php echo $cliente['senha']; ?>" required>
    <Label>Status do Cliente</Label>
    <label>
        <input type="radio" name="ativo" value="1" checked>Ativo
    </label>
    <label>
        <input type="radio" name="ativo" value="0">Inativo
    </label><br>
    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
    <input type="submit" name="botao" value="Editar Cliente">
</form>
</body>
</html>