<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Anuidades</title>
</head>
<body>
    <h1>Anuidades Cadastradas</h1>
    <?php
    $host = 'localhost';
    $dbname = 'devs_do_rn';
    $user = 'postgres';
    $password = '123456';

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta todas as anuidades
        $sql = "SELECT * FROM anuidades";
        $stmt = $pdo->query($sql);

        echo "<table border='1'>";
        echo "<tr><th>Ano</th><th>Valor (R$)</th><th>Ações</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['ano']}</td>";
            echo "<td>{$row['valor']}</td>";
            echo "<td><a href='editar_anuidade.php?id={$row['id']}'>Editar</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Erro ao listar anuidades: " . $e->getMessage();
    }
    ?>
</body>
</html>
