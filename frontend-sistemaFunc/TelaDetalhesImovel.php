<?php
$imovel = include_once '../backend/detalhesImovel.php';
$id_imovel = $imovel['id'];
$baseImagePath = '../imgImovel/';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $imovel['titulo']; ?> - Detalhes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<form action="TelaListarImovelFUNC.php" method="post">
    <input type="submit" name="voltar" value="Voltar">
</form>
<div class="container-detalhes">
    <h1 class="titulo-detalhes"><?php echo $imovel['titulo']; ?></h1>

    <div class="imagem-detalhes">
        <?php
        $imagePath = $baseImagePath . $imovel['path'];
        if (file_exists($imagePath)) {
            echo '<img src="' . $imagePath . '" alt="Imagem do Imóvel" class="img-fluid">';
        }
        ?>
    </div>

    <div class="info-detalhes">
        <p><strong>Tipo:</strong> <?php echo $imovel['tipo']; ?></p>
        <p><strong>Finalidade:</strong> <?php echo $imovel['finalidade']; ?></p>
        <p><strong>Valor:</strong> R$ <?php echo number_format($imovel['valor'], 2, ',', '.'); ?></p>
        <p><strong>Quartos:</strong> <?php echo isset($imovel['quartos']) ? $imovel['quartos'] : 'Não informado'; ?></p>
        <p><strong>Banheiros:</strong> <?php echo isset($imovel['banheiros']) ? $imovel['banheiros'] : 'Não informado'; ?></p>
        <p><strong>Vagas de Garagem:</strong> <?php echo isset($imovel['vagas_garagem']) ? $imovel['vagas_garagem'] : 'Não informado'; ?></p>
        <p><strong>Área:</strong> <?php echo isset($imovel['medida_frente']) && isset($imovel['medida_lateral']) ? ($imovel['medida_frente'] * $imovel['medida_lateral']) : 'Não informada'; ?>m²</p>
        <p><strong>Endereço:</strong> <?php echo isset($imovel['endereco']) ? $imovel['endereco'] : 'Não informado'; ?></p>
        <p><strong>Numero:</strong><?php echo isset($imovel['numero']) ? $imovel['numero'] :'Não informado' ?></p>
        <p><strong>Complemento:</strong><?php echo isset($imovel['complemento']) ? $imovel['complemento'] :'Não informado' ?></p>
        <p><strong>Bairro:</strong><?php echo isset($imovel['bairro']) ? $imovel['bairro'] :'Não informado' ?></p>
        <p><strong>Cidade:</strong><?php echo (isset($imovel['cidade']) ? $imovel['cidade'] : 'Não informado') . ' - ' . (isset($imovel['estado']) ? $imovel['estado'] : 'Não informado'); ?></p>
    </div>

    <div class="action-buttons">
        <form action="TelaListarImovelFUNC.php" method="post">
            <input type="submit" class="btn btn-primary" name="voltar" value="Voltar">
        </form>

        <form action="TelaEditarImovel.php" method="post">
            <input type="hidden" name="id_imovel" value="<?php echo $imovel['id']; ?>">
            <input type="submit" name="editar" value="Editar">
        </form>

        <form action="../backend/DeletarImovel.php" method="post">
            <input type="hidden" name="id_imovel" value="<?php echo $imovel['id']; ?>">
            <input type="submit"  name="deletar" value="Deletar">
        </form>
    </div>
</div>
</body>
</html>