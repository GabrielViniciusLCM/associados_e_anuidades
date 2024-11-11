<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Associado</title>
</head>
<body>
    <h1>Cadastro de Associado</h1>
    <form action="processa_cadastro_associado.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required><br><br>
        
        <label for="data_filiacao">Data de Filiação:</label>
        <input type="date" id="data_filiacao" name="data_filiacao" required><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
