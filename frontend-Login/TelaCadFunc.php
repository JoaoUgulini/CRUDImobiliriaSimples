<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tela De Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/stylelogin.css" rel="stylesheet">
</head>
<body class="containerFunc">
<form action="TelaInicialLogin.php" method="post">
    <h1>Tela de Cadastro de Funcionario</h1>
    <input type="submit" name="voltar" value="Voltar">
</form>
<form name="entrada" method="post" action="../backend/cadastro.php">
    <input type="hidden" name="tipo" value="funcionario"> <Label>Nome: </Label>

    <input type="text" name="nome" placeholder="Nome" required>
    <label>Sobrenome: </label>
    <input type="text" name="sobrenome" placeholder="Sobrenome" required>
    <label>CPF: </label>
    <input type="text" name="cpf" placeholder="CPF" required>
    <label>Email: </label>
    <input type="email" name="email" placeholder="Email" required>
    <label>Senha: </label>
    <input type="password" name="senha" placeholder="Senha" required>
    <label>Creci: </label>
    <input type="text" name="creci" required>
    <input type="submit" name="botao" value="Cadastrar">
</form>
</body>
</html>