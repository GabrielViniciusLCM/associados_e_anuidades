<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Anuidade</title>
</head>
<body>
    <h1>Cadastro de Anuidade</h1>
    <form action="processa_cadastro_anuidade.php" method="POST">
        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required><br><br>
        
        <label for="valor">Valor (R$):</label>
        <input type="number" step="0.01" id="valor" name="valor" required><br><br>
        
        <input type="submit" value="Cadastrar Anuidade">
    </form>
</body>
</html>
