<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Inicial Login Imobiliaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/stylelogin.css" rel="stylesheet">
</head>
<body>
<form name="entrada" method="post" action="../backend/processa_login.php">

    <h1>Login</h1>
    <div class="radio-container">
        <label>
            <input type="radio" name="perfil" value="cliente" checked> Cliente
        </label>
        <label>
            <input type="radio" name="perfil" value="funcionario"> Funcionário
        </label>
    </div>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="senha" placeholder="Senha"><br><br>

    <input type="submit" name="entrar" value="Entrar">
    <input type="submit" name="cadastro" value="Não tenho cadastro">

</form>
</body>
</html>