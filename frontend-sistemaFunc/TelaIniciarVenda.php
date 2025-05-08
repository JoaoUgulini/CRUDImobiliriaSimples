<?php
require_once '../backend/conecao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela Inicial Login Imobiliaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body class="containerHomeFunc">
<form action="../backend/IniciarVenda.php" method="post">
    <label>Nome Do Imovel</label>
    <select name="nomeImovel">
        <?php
        include_once "../backend/conexao.php";
        $conecao = conectar("bdimovel");
        $sql = "SELECT * FROM imovel where ativo = 1 ORDER BY id";
        $result = mysqli_query($conecao, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['id'] . "'>" . $row['titulo'] . "</option>";
        }
        ?>
    </select>


</form>




</body>
</html>