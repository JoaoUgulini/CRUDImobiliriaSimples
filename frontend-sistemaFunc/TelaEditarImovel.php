<?php
require_once '../backend/buscar_imovel.php';

$id_imovel = $_POST['id_imovel'];
$imovel = buscarDadosImovel($id_imovel);

$nomeImovel = $imovel['titulo'];
$cpf = $imovel['cpf_proprietario'];
$tipoImovel = $imovel['tipo'];
$finalidade = $imovel['finalidade'];
$valor = $imovel['valor'];
$medidaFrente = $imovel['medida_frente'];
$medidaLateral = $imovel['medida_lateral'];
$quarto = $imovel['quartos'];
$banheiro = $imovel['banheiros'];
$garagem = $imovel['vagas_garagem'];
$endereco = $imovel['endereco'];
$numero = $imovel['numero'];
$complemento = $imovel['complemento'];
$bairro = $imovel['bairro'];
$cidade = $imovel['cidade'];
$estado = $imovel['estado'];
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela de Alteração de Imovel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<form action="TelaListarImovelFUNC.php" method="post">
    <input type="submit" name="voltar" value="Voltar">
</form>
<form enctype="multipart/form-data" action="../backend/UpdateImovel.php" method="post">
    <label>Nome do Imovel</label>
    <input type="text" name="nomeImovel" value="<?php echo $nomeImovel; ?>">
    <label>CPF do Dono</label>
    <input type="text" name="cpf" value="<?php echo $cpf; ?>">
    <label>Tipo do Imovel</label>
    <select name="tipoImovel">
        <option value="casa">Casa</option>
        <option value="apartamento">Apartamento</option>
        <option value="kitnet">Kitnet</option>  
        <option value="terreno">Terreno</option>
        <option value="comercial">Espaço Comercial</option>
        <option value="fazenda">Fazenda</option>
    </select>
    <label>Finalidade</label>
    <select name="finalidade">
        <option value="venda">Venda</option>
        <option value="aluguel">Aluguel</option>
    </select>
    <label>Valor</label>
    <input type="text" name="valor" value="<?php echo $valor ?>"><br>
    <label>Medidas</label>
    <div class="medidas-group">
        <input type="text" name="medidaFrente" value="<?php echo $medidaFrente; ?>">
        <input type="text" name="medidaLateral" value="<?php echo $medidaLateral; ?>">
    </div>
    <label>Detalhes</label>
    <div class="detalhes-group">
        <input type="text" name="quarto" value="<?php echo $quarto; ?>">
        <input type="text" name="banheiro" value="<?php echo $banheiro; ?>">
        <input type="text" name="garagem" value="<?php echo $garagem; ?>">
    </div>
    <label>Endereço</label>
    <div class="endereco-group">
        <input type="text" name="endereco" value="<?php echo $endereco; ?>">
        <input type="text" name="numero" value="<?php echo $numero; ?>">
        <input type="text" name="complemento" value="<?php echo $complemento; ?>">
    </div>
    <div class="endereco-group">
        <input type="text" name="bairro" value="<?php echo $bairro; ?>">
        <input type="text" name="cidade" value="<?php echo $cidade; ?>">
        <input type="text" name="estado" value="<?php echo $estado; ?>">
    </div>
    <input type="hidden" name="id_imovel" value="<?php echo $id_imovel; ?>">
    <input type="submit" value="Editar Imovel">

</form>
</body>
</html>