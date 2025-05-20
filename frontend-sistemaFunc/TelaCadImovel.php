<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tela de Cadastro de Imovel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="../CSS/styleSistema.css" rel="stylesheet">
</head>
<body>
<form action="area_funcionario.php" method="post">
    <input type="submit" name="voltar" value="Voltar">
</form>
<form enctype="multipart/form-data" action="../backend/CadastrarImovel.php" method="post">
    <label>Nome do Imovel</label>
    <input type="text" name="nomeImovel" placeholder="Nome do Imovel">
    <label>CPF do Dono</label>
    <input type="text" name="cpf" placeholder="CPF do Dono"
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
    <input type="text" name="valor" placeholder="Valor"><br>
    <label>Medidas</label>
    <div class="medidas-group">
        <input type="text" name="medidaFrente" placeholder="Medida da Frente">
        <input type="text" name="medidaLateral" placeholder="Medida da Lateral">
    </div>
    <label>Detalhes</label>
    <div class="detalhes-group">
        <input type="text" name="quarto" placeholder="Quartos">
        <input type="text" name="banheiro" placeholder="Banheiros">
        <input type="text" name="garagem" placeholder="Garagem">
    </div>
    <label>Endereço</label>
    <div class="endereco-group">
        <input type="text" name="endereco" placeholder="Rua">
        <input type="text" name="numero" placeholder="Número">
        <input type="text" name="complemento" placeholder="Complemento (se houver)">
    </div>
    <div class="endereco-group">
        <input type="text" name="bairro" placeholder="Bairro">
        <input type="text" name="cidade" placeholder="Cidade">
        <input type="text" name="estado" placeholder="Estado">
    </div>
    <label>Foto do Imovel:</label>
    <input type="file" name="imgImovel"><br>
    <input type="submit" value="Cadastrar Imovel">

</form>
</body>
</html>